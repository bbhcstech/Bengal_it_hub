<?php

namespace App\Support;

use App\Models\BlogPost;
use App\Models\TechNews;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class InternalLinks
{
    public static function forService(string $slug, array $service): array
    {
        return self::forTopic(
            self::topicText([$service['title'] ?? '', $service['kicker'] ?? '', $service['summary'] ?? '', $service['body'] ?? '', $service['features'] ?? []]),
            ['service' => $slug]
        );
    }

    public static function forProduct(array $product): array
    {
        return self::forTopic(
            self::topicText([$product['title'] ?? '', $product['segment'] ?? '', $product['summary'] ?? '']),
            ['product' => $product['slug'] ?? null]
        );
    }

    public static function forIndustry(string $slug, array $industry, ?array $branch = null): array
    {
        return self::forTopic(
            self::topicText([
                $industry['name'] ?? '',
                $industry['summary'] ?? '',
                $industry['body'] ?? '',
                $branch['name'] ?? '',
                $branch['summary'] ?? '',
                $branch['body'] ?? '',
            ]),
            ['industry' => $slug]
        );
    }

    public static function forPost(BlogPost $post): array
    {
        return self::forTopic(
            self::topicText([$post->title, $post->category?->name, $post->body]),
            ['blog' => $post->slug]
        );
    }

    public static function forArticle(TechNews $article): array
    {
        return self::forTopic(
            self::topicText([$article->title, $article->category?->name, $article->description, $article->content]),
            ['article' => $article->slug]
        );
    }

    public static function forStatic(string $slug, array $page): array
    {
        return self::forTopic(self::topicText($page), ['static' => $slug]);
    }

    public static function caseStudies(?string $topic = null, int $take = 3): Collection
    {
        $items = collect([
            [
                'title' => 'The Bengal HackFest PRAGATI 2026',
                'summary' => 'A regional innovation platform connecting students, colleges, mentors, and corporate partners.',
                'url' => route('event.show'),
                'keywords' => 'hackathon students colleges ai innovation mentorship hiring partners',
            ],
            [
                'title' => 'TechBiz Collaboration Stories',
                'summary' => 'Meetings, partner conversations, product milestones, and ecosystem-building updates.',
                'url' => route('techbiz.index'),
                'keywords' => 'business collaboration partners product milestones technology meetings',
            ],
            [
                'title' => 'Awards & Recognition',
                'summary' => 'A growing proof hub for certifications, recognition, media mentions, and ecosystem milestones.',
                'url' => route('awards-recognition'),
                'keywords' => 'awards recognition proof certification media milestones',
            ],
            [
                'title' => 'Partner Ecosystem',
                'summary' => 'Academic, hiring, innovation, and technology partners connected with Bengal IT Hub.',
                'url' => route('our-partners.index'),
                'keywords' => 'partners academic hiring innovation technology ecosystem',
            ],
        ]);

        return self::rank($items, $topic ?: 'technology innovation partners')->take($take)->values();
    }

    public static function forTopic(string $topic, array $exclude = []): array
    {
        return [
            'services' => self::relatedServices($topic, $exclude['service'] ?? null),
            'products' => self::relatedProducts($topic, $exclude['product'] ?? null),
            'blogs' => self::relatedBlogs($topic, $exclude['blog'] ?? null),
            'articles' => self::relatedArticles($topic, $exclude['article'] ?? null),
            'caseStudies' => self::caseStudies($topic),
        ];
    }

    private static function relatedServices(string $topic, ?string $excludeSlug): Collection
    {
        return self::rank(
            collect(config('bengalhub.services', []))->map(fn ($service, $slug) => [
                'title' => $service['title'],
                'summary' => $service['summary'] ?? '',
                'url' => url('/'.$slug),
                'keywords' => self::topicText([$service['title'] ?? '', $service['kicker'] ?? '', $service['summary'] ?? '', $service['body'] ?? '', $service['features'] ?? []]),
                'slug' => $slug,
            ])->reject(fn ($item) => $item['slug'] === $excludeSlug)->values(),
            $topic
        )->take(3)->values();
    }

    private static function relatedProducts(string $topic, ?string $excludeSlug): Collection
    {
        return self::rank(
            collect(config('bengalhub.products.items', []))->map(fn ($product) => [
                'title' => $product['title'],
                'summary' => $product['summary'] ?? '',
                'url' => route('products.show', $product['slug']),
                'keywords' => self::topicText([$product['title'] ?? '', $product['segment'] ?? '', $product['summary'] ?? '']),
                'slug' => $product['slug'],
            ])->reject(fn ($item) => $item['slug'] === $excludeSlug)->values(),
            $topic
        )->take(3)->values();
    }

    private static function relatedBlogs(string $topic, ?string $excludeSlug): Collection
    {
        if (! Schema::hasTable('blog_posts')) {
            return collect();
        }

        $posts = BlogPost::with('category')
            ->where('status', 'published')
            ->when($excludeSlug, fn ($query) => $query->where('slug', '!=', $excludeSlug))
            ->latest('published_at')
            ->take(24)
            ->get()
            ->map(fn (BlogPost $post) => [
                'title' => $post->title,
                'summary' => Str::limit(strip_tags($post->body), 120),
                'url' => route('blog.show', $post->slug),
                'keywords' => self::topicText([$post->title, $post->category?->name, $post->body]),
            ]);

        return self::rank($posts, $topic)->take(3)->values();
    }

    private static function relatedArticles(string $topic, ?string $excludeSlug): Collection
    {
        if (! Schema::hasTable('tech_news')) {
            return collect();
        }

        $articles = TechNews::with('category')
            ->when($excludeSlug, fn ($query) => $query->where('slug', '!=', $excludeSlug))
            ->latestPublished()
            ->take(36)
            ->get()
            ->map(fn (TechNews $article) => [
                'title' => $article->title,
                'summary' => Str::limit($article->description ?: $article->category?->name ?: 'Technology article', 120),
                'url' => route('tech-innovation.show', $article->slug),
                'keywords' => self::topicText([$article->title, $article->category?->name, $article->description]),
            ]);

        return self::rank($articles, $topic)->take(4)->values();
    }

    private static function rank(Collection $items, string $topic): Collection
    {
        $terms = collect(preg_split('/[^a-z0-9]+/', Str::lower($topic), -1, PREG_SPLIT_NO_EMPTY))
            ->reject(fn ($term) => strlen($term) < 3)
            ->unique()
            ->values();

        return $items->map(function ($item) use ($terms) {
            $haystack = Str::lower(($item['title'] ?? '').' '.($item['summary'] ?? '').' '.($item['keywords'] ?? ''));
            $score = $terms->sum(fn ($term) => Str::contains($haystack, $term) ? 1 : 0);

            return $item + ['score' => $score];
        })->sortByDesc('score')->values();
    }

    private static function topicText(array $parts): string
    {
        return collect($parts)->flatten()->filter()->implode(' ');
    }
}
