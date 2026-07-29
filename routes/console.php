<?php

use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\SeoController;
use App\Models\TechNews;
use App\Services\RssImportService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('rss:sync')->everyFifteenMinutes()->withoutOverlapping()->runInBackground();

Artisan::command('rss:backfill-images {--limit=0 : Max articles to process this run, 0 = all}', function (RssImportService $importer) {
    $query = TechNews::query()
        ->where(fn ($q) => $q->whereNull('image')->orWhere('image', ''))
        ->orderBy('id');

    $limit = (int) $this->option('limit');
    if ($limit > 0) {
        $query->limit($limit);
    }

    $articles = $query->get(['id', 'original_url']);
    $total = $articles->count();

    if ($total === 0) {
        $this->info('No articles are missing an image.');

        return self::SUCCESS;
    }

    $this->info("Backfilling images for {$total} article(s) by reading each one's real og:image...");
    $bar = $this->output->createProgressBar($total);
    $bar->start();

    $fixed = 0;
    $stillMissing = 0;

    foreach ($articles as $article) {
        $image = $importer->fetchOgImage($article->original_url);

        if ($image) {
            $article->update(['image' => $image]);
            $fixed++;
        } else {
            $stillMissing++;
        }

        $bar->advance();
    }

    $bar->finish();
    $this->newLine();
    $this->info("Fixed {$fixed}, still no image found for {$stillMissing} (their real pages had no og:image/twitter:image either).");

    return self::SUCCESS;
})->purpose("Backfill TechNews.image for existing rows by fetching each article's real og:image");

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
