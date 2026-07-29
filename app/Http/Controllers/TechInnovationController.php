<?php

namespace App\Http\Controllers;

use App\Models\RssSource;
use App\Models\TechNews;
use App\Models\TechNewsCategory;
use App\Support\InternalLinks;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechInnovationController extends Controller
{
    public function index(Request $request): View
    {
        $categories = TechNewsCategory::orderBy('sort_order')->orderBy('name')->get();
        $sources = RssSource::active()->ordered()->get();

        $query = TechNews::query()->with(['source', 'category']);

        if ($request->filled('q')) {
            $query->search($request->string('q'));
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        if ($request->filled('source')) {
            $query->whereHas('source', fn ($q) => $q->where('slug', $request->string('source')));
        }

        match ($request->string('sort', 'latest')->value()) {
            'oldest' => $query->oldestPublished(),
            'trending' => $query->trending(),
            'most-viewed' => $query->mostViewed(),
            default => $query->latestPublished(),
        };

        $featured = TechNews::whereNotNull('image')->latestPublished()->first();

        return view('pages.tech-innovation.index', [
            'seo' => $this->buildSeo(
                'Tech Innovation | Bengal IT Hub',
                'A centralized technology news hub aggregating the latest AI, software, cloud, cybersecurity, and business technology news in one place.',
                $featured?->image,
            ),
            'categories' => $categories,
            'sources' => $sources,
            'news' => $query->paginate(12)->withQueryString(),
            'featured' => $featured,
            'trending' => TechNews::trending()->take(5)->get(),
            'mostViewed' => TechNews::mostViewed()->take(5)->get(),
            'filters' => $request->only(['q', 'category', 'source', 'sort']),
        ]);
    }

    public function show(string $slug): View
    {
        $article = TechNews::with(['source', 'category'])->where('slug', $slug)->firstOrFail();
        $article->increment('views_count');

        $related = TechNews::where('tech_news_category_id', $article->tech_news_category_id)
            ->where('id', '!=', $article->id)
            ->latestPublished()
            ->take(4)
            ->get();

        return view('pages.tech-innovation.show', [
            'seo' => $this->buildSeo(
                $article->title.' | Bengal IT Hub Tech Innovation',
                $article->description ?: $article->title,
                $article->image,
                type: 'article',
                publishedTime: $article->published_at?->toAtomString(),
                author: $article->author,
            ),
            'article' => $article,
            'related' => $related,
            'internalLinks' => InternalLinks::forArticle($article),
        ]);
    }

    private function buildSeo(string $title, string $description, ?string $image = null, ?string $type = null, ?string $publishedTime = null, ?string $author = null): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'image' => $image ?: asset('logo_bengal_it_hub.svg'),
            'keywords' => config('bengalhub.seo.keywords'),
            'robots' => config('bengalhub.seo.robots'),
            'type' => $type,
            'publishedTime' => $publishedTime,
            'author' => $author,
        ];
    }
}
