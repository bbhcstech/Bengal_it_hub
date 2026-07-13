<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $now = now();

        $staticUrls = collect(['/', '/hackfest-2026', '/sponsor-form-hackfest-2026', '/services', '/contact'])
            ->map(fn ($url) => ['loc' => $url, 'lastmod' => $now]);

        $pageUrls = Schema::hasTable('pages')
            ? Page::where('status', 'published')->get(['slug', 'updated_at'])->map(fn (Page $page) => ['loc' => '/'.$page->slug, 'lastmod' => $page->updated_at])
            : collect(['/vision-2030', '/about-us', '/our-partners', '/faq', '/blog', '/terms-conditions', '/privacy-policy'])->map(fn ($url) => ['loc' => $url, 'lastmod' => $now]);

        $serviceUrls = Schema::hasTable('services')
            ? Service::published()->get(['slug', 'updated_at'])->map(fn (Service $service) => ['loc' => '/'.$service->slug, 'lastmod' => $service->updated_at])
            : collect(array_keys(config('bengalhub.services')))->map(fn ($slug) => ['loc' => '/'.$slug, 'lastmod' => $now]);

        $urls = $staticUrls->merge($pageUrls)->merge($serviceUrls)->unique('loc')->values();

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nDisallow: /bih-console\nSitemap: ".url('/sitemap.xml')."\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
