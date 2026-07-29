<?php

namespace App\Console\Commands;

use App\Models\RssSource;
use App\Services\RssImportService;
use Illuminate\Console\Command;

class SyncRssFeeds extends Command
{
    protected $signature = 'rss:sync {source? : Slug of a single RSS source to sync}';

    protected $description = 'Fetch, parse, and import active RSS sources into the Tech Innovation news feed';

    public function handle(RssImportService $importer): int
    {
        $slug = $this->argument('source');

        if ($slug) {
            $source = RssSource::where('slug', $slug)->first();

            if (! $source) {
                $this->error("No RSS source found with slug [{$slug}].");

                return self::FAILURE;
            }

            $result = $importer->syncSource($source);
            $this->reportResult($source->name, $result);

            return $result['status'] === 'success' ? self::SUCCESS : self::FAILURE;
        }

        $results = $importer->syncAll();

        if (empty($results)) {
            $this->warn('No active RSS sources to sync.');

            return self::SUCCESS;
        }

        $hadFailure = false;

        foreach ($results as $sourceSlug => $result) {
            $this->reportResult($sourceSlug, $result);
            $hadFailure = $hadFailure || $result['status'] !== 'success';
        }

        return $hadFailure ? self::FAILURE : self::SUCCESS;
    }

    private function reportResult(string $label, array $result): void
    {
        if ($result['status'] === 'success') {
            $this->info("[{$label}] imported {$result['imported']}, skipped {$result['skipped']}.");

            return;
        }

        $this->error("[{$label}] failed: ".($result['message'] ?? 'unknown error'));
    }
}
