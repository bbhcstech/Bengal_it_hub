<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Support\InternalLinks;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::with('category')->where('status', 'published')->latest('published_at')->get();
        $categories = BlogCategory::orderBy('name')->get();

        return view('pages.blog.index', [
            'seo' => $this->buildSeo(
                'Blog | Bengal IT Hub',
                'Blog posts, company events, team culture, awards, and career opportunities at Bengal IT Hub, all in one place.',
            ),
            'blog' => config('bengalhub.blog'),
            'posts' => $posts->take(6),
            'sectionPosts' => $posts->filter(fn ($post) => $post->category)->groupBy(fn ($post) => $post->category->slug),
            'categories' => $categories,
        ]);
    }

    public function show(string $slug): View
    {
        $post = BlogPost::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();

        $related = BlogPost::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->when($post->blog_category_id, fn ($q) => $q->where('blog_category_id', $post->blog_category_id))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog.show', [
            'seo' => $this->buildSeo(
                $post->meta_title ?: $post->title.' | Bengal IT Hub Blog',
                $post->meta_description ?: Str::limit(strip_tags($post->body), 160),
                $post->og_image ?: $post->featured_image,
                type: 'article',
                publishedTime: $post->published_at?->toAtomString(),
            ),
            'post' => $post,
            'related' => $related,
            'internalLinks' => InternalLinks::forPost($post),
        ]);
    }

    private function buildSeo(string $title, string $description, ?string $image = null, ?string $type = null, ?string $publishedTime = null): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'image' => $image ?: asset('logo_bengal_it_hub.svg'),
            'keywords' => config('bengalhub.seo.keywords'),
            'robots' => config('bengalhub.seo.robots'),
            'type' => $type,
            'publishedTime' => $publishedTime,
        ];
    }
}
