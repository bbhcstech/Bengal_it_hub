<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\TechNews;
use App\Support\InternalLinks;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SeoController extends Controller
{
    /**
     * TechNews grows continuously via the RSS scheduler, so its sitemap is
     * pre-sharded now rather than left as a single ever-growing file.
     */
    private const TECH_NEWS_CHUNK = 5000;

    /**
     * /sitemap.xml is a sitemap index, not a flat urlset. Each content type
     * gets its own child sitemap so the file that keeps growing (tech news)
     * never risks approaching the 50,000-URL sitemap protocol limit and
     * doesn't force a re-crawl of the whole site when only one section changes.
     */
    public function sitemap(): Response
    {
        $now = now();

        $sitemaps = collect([
            ['loc' => '/sitemap-pages.xml', 'lastmod' => $now],
            ['loc' => '/sitemap-services.xml', 'lastmod' => $now],
            ['loc' => '/sitemap-industries.xml', 'lastmod' => $now],
            ['loc' => '/sitemap-partners.xml', 'lastmod' => $now],
        ]);

        $techNewsCount = Schema::hasTable('tech_news') ? TechNews::count() : 0;
        $chunks = max(1, (int) ceil($techNewsCount / self::TECH_NEWS_CHUNK));

        for ($page = 1; $page <= $chunks; $page++) {
            $sitemaps->push(['loc' => "/sitemap-tech-news-{$page}.xml", 'lastmod' => $now]);
        }

        return response(view('seo.sitemap-index', [
            'publicUrl' => fn (string $path) => $this->publicUrl($path),
            'sitemaps' => $sitemaps,
        ])->render(), 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Static marketing pages, the WordPress-migration Page model/fallback
     * inventory, HackFest sub-pages, and blog posts. Lead-capture-only forms
     * (event registration, sponsor form) are deliberately excluded — they are
     * conversion pages, not content Google should be encouraged to land on.
     */
    public function sitemapPages(): Response
    {
        $now = now();

        $core = collect([
            ['loc' => '/', 'lastmod' => $now],
            ['loc' => '/services', 'lastmod' => $now],
            ['loc' => '/products', 'lastmod' => $now],
            ['loc' => '/tech-biz', 'lastmod' => $now],
            ['loc' => '/tech-innovation', 'lastmod' => $now],
            ['loc' => '/our-clients', 'lastmod' => $now],
            ['loc' => '/industries', 'lastmod' => $now],
            ['loc' => '/our-partners', 'lastmod' => $now],
            ['loc' => '/awards-recognition', 'lastmod' => $now],
            ['loc' => '/blog', 'lastmod' => $now],
            ['loc' => '/hackfest-2026', 'lastmod' => $now],
            ['loc' => '/hackfest-2026/chief-guest', 'lastmod' => $now],
            ['loc' => '/hackfest-2026/chief-adviser', 'lastmod' => $now],
            ['loc' => '/hackfest-2026/speakers', 'lastmod' => $now],
            ['loc' => '/hackfest-2026/faq', 'lastmod' => $now],
            ['loc' => '/hackfest-2026/venue', 'lastmod' => $now],
        ]);

        $fallbackSlugs = array_keys(app(PageController::class)->fallbackPages());
        $pageRows = Schema::hasTable('pages')
            ? Page::where('status', 'published')->get(['slug', 'updated_at'])->keyBy('slug')
            : collect();

        $pageUrls = collect($fallbackSlugs)
            ->merge($pageRows->keys())
            ->unique()
            ->map(fn ($slug) => [
                'loc' => '/'.$slug,
                'lastmod' => optional($pageRows->get($slug))->updated_at ?: $now,
            ]);

        $blogUrls = Schema::hasTable('blog_posts')
            ? BlogPost::where('status', 'published')->get(['slug', 'updated_at'])
                ->map(fn (BlogPost $post) => ['loc' => '/blog/'.$post->slug, 'lastmod' => $post->updated_at])
            : collect();

        return $this->respond($core->merge($pageUrls)->merge($blogUrls));
    }

    public function sitemapServices(): Response
    {
        $now = now();

        $serviceUrls = Schema::hasTable('services') && Service::published()->exists()
            ? Service::published()->get(['slug', 'updated_at'])
                ->map(fn (Service $service) => ['loc' => '/'.$service->slug, 'lastmod' => $service->updated_at])
            : collect(array_keys(config('bengalhub.services', [])))
                ->map(fn ($slug) => ['loc' => '/'.$slug, 'lastmod' => $now]);

        $productUrls = collect(config('bengalhub.products.items', []))
            ->map(fn ($item) => ['loc' => '/products/'.$item['slug'], 'lastmod' => $now]);

        return $this->respond($serviceUrls->merge($productUrls));
    }

    public function sitemapIndustries(): Response
    {
        $now = now();
        $urls = collect();

        foreach (config('bengalhub.industries', []) as $slug => $industry) {
            $urls->push(['loc' => '/industries/'.$slug, 'lastmod' => $now]);

            foreach ($industry['subBranches'] ?? [] as $subSlug => $sub) {
                $urls->push(['loc' => '/industries/'.$slug.'/'.$subSlug, 'lastmod' => $now]);
            }
        }

        return $this->respond($urls);
    }

    public function sitemapPartners(): Response
    {
        $urls = Schema::hasTable('partners')
            ? Partner::published()->whereNotNull('slug')->get(['slug', 'updated_at'])
                ->map(fn (Partner $partner) => ['loc' => '/our-partners/'.$partner->slug, 'lastmod' => $partner->updated_at])
            : collect();

        return $this->respond($urls);
    }

    public function sitemapTechNews(int $page): Response
    {
        $urls = Schema::hasTable('tech_news')
            ? TechNews::query()->orderBy('id')
                ->forPage($page, self::TECH_NEWS_CHUNK)
                ->get(['slug', 'published_at'])
                ->map(fn (TechNews $article) => ['loc' => '/tech-innovation/'.$article->slug, 'lastmod' => $article->published_at])
            : collect();

        abort_if($page > 1 && $urls->isEmpty(), 404);

        return $this->respond($urls);
    }

    /**
     * Human-readable counterpart to sitemap.xml — helps visitors and crawlers
     * alike find every section from one page, with real internal links.
     */
    public function html(): View
    {
        return view('seo.html-sitemap', [
            'seo' => [
                'title' => 'Sitemap | Bengal IT Hub',
                'description' => 'A complete, human-readable map of every section and page on the Bengal IT Hub website.',
                'robots' => 'index, follow',
            ],
            'services' => collect(config('bengalhub.services', [])),
            'products' => collect(config('bengalhub.products.items', [])),
            'industries' => collect(config('bengalhub.industries', [])),
            'partners' => Schema::hasTable('partners') ? Partner::published()->ordered()->get() : collect(),
            'fallbackPages' => collect(app(PageController::class)->fallbackPages()),
            'blogPosts' => Schema::hasTable('blog_posts') ? BlogPost::where('status', 'published')->latest('published_at')->take(50)->get(['title', 'slug']) : collect(),
            'techArticles' => Schema::hasTable('tech_news') ? TechNews::latestPublished()->take(50)->get(['title', 'slug']) : collect(),
            'caseStudies' => InternalLinks::caseStudies(take: 4),
        ]);
    }

    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nDisallow: /bih-console\nSitemap: ".$this->publicUrl('/sitemap.xml')."\n", 200)
            ->header('Content-Type', 'text/plain');
    }

    private function respond(Collection $urls): Response
    {
        $xml = view('seo.sitemap', [
            'publicUrl' => fn (string $path) => $this->publicUrl($path),
            'urls' => $urls->unique('loc')->values(),
        ])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function publicUrl(string $path): string
    {
        return rtrim((string) config('bengalhub.public_url'), '/').'/'.ltrim($path, '/');
    }
}
