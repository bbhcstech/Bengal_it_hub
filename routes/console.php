<?php

use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('rss:sync')->everyFifteenMinutes()->withoutOverlapping()->runInBackground();

Artisan::command('sitemap:generate', function (SeoController $seo): int {
    $targets = [
        'sitemap-pages.xml' => fn () => $seo->sitemapPages(),
        'sitemap-services.xml' => fn () => $seo->sitemapServices(),
        'sitemap-industries.xml' => fn () => $seo->sitemapIndustries(),
        'sitemap-partners.xml' => fn () => $seo->sitemapPartners(),
        'robots.txt' => fn () => $seo->robots(),
    ];

    $sitemapIndex = $seo->sitemap()->getContent();
    file_put_contents(public_path('sitemap.xml'), $sitemapIndex);
    $this->line('Generated sitemap.xml');

    preg_match_all('/sitemap-tech-news-(\d+)\.xml/', $sitemapIndex, $matches);
    foreach (array_unique($matches[1] ?? []) as $page) {
        $targets["sitemap-tech-news-{$page}.xml"] = fn () => $seo->sitemapTechNews((int) $page);
    }

    foreach ($targets as $filename => $responseFactory) {
        $path = public_path($filename);
        file_put_contents($path, $responseFactory()->getContent());
        $this->line("Generated {$filename}");
    }

    return self::SUCCESS;
})->purpose('Generate physical XML sitemap and robots files in public/');
