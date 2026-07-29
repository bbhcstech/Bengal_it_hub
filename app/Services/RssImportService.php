<?php

namespace App\Services;

use App\Models\RssSource;
use App\Models\TechNews;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SimpleXMLElement;
use Throwable;

class RssImportService
{
    private const NAMESPACES = [
        'content' => 'http://purl.org/rss/1.0/modules/content/',
        'media' => 'http://search.yahoo.com/mrss/',
        'dc' => 'http://purl.org/dc/elements/1.1/',
        'atom' => 'http://www.w3.org/2005/Atom',
    ];

    public function syncAll(): array
    {
        $results = [];

        foreach (RssSource::active()->get() as $source) {
            $results[$source->slug] = $this->syncSource($source);
        }

        return $results;
    }

    public function syncSource(RssSource $source): array
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (compatible; BengalITHubBot/1.0; +https://bengalithub.com)',
                'Accept' => 'application/rss+xml, application/xml, text/xml, application/atom+xml',
            ])->timeout(20)->get($source->feed_url);

            if (! $response->successful()) {
                return $this->markFailed($source, "HTTP {$response->status()} while fetching feed.");
            }

            $items = $this->parseFeed($response->body());

            if ($items === null) {
                return $this->markFailed($source, 'Feed could not be parsed as valid RSS/Atom XML.');
            }

            $imported = 0;
            $skipped = 0;

            foreach ($items as $item) {
                if (blank($item['guid']) || blank($item['original_url']) || blank($item['title'])) {
                    $skipped++;

                    continue;
                }

                $exists = TechNews::where('guid', $item['guid'])
                    ->orWhere('original_url', $item['original_url'])
                    ->exists();

                if ($exists) {
                    $skipped++;

                    continue;
                }

                TechNews::create([
                    'rss_source_id' => $source->id,
                    'tech_news_category_id' => $source->tech_news_category_id,
                    'title' => Str::limit($item['title'], 250, ''),
                    'slug' => $this->uniqueSlug($item['title']),
                    'description' => $item['description'],
                    'content' => $item['content'],
                    'image' => $item['image'],
                    'author' => $item['author'],
                    'original_url' => $item['original_url'],
                    'guid' => $item['guid'],
                    'published_at' => $item['published_at'],
                ]);

                $imported++;
            }

            $source->update([
                'last_synced_at' => now(),
                'last_sync_status' => 'success',
                'last_sync_message' => "Imported {$imported}, skipped {$skipped} (duplicate or incomplete).",
            ]);

            return ['status' => 'success', 'imported' => $imported, 'skipped' => $skipped];
        } catch (Throwable $e) {
            Log::channel('single')->error("RSS sync failed for source [{$source->slug}]: {$e->getMessage()}");

            return $this->markFailed($source, $e->getMessage());
        }
    }

    private function markFailed(RssSource $source, string $message): array
    {
        $source->update([
            'last_synced_at' => now(),
            'last_sync_status' => 'failed',
            'last_sync_message' => Str::limit($message, 500),
        ]);

        return ['status' => 'failed', 'imported' => 0, 'skipped' => 0, 'message' => $message];
    }

    /**
     * @return array<int, array{title: ?string, description: ?string, content: ?string, image: ?string, author: ?string, original_url: ?string, guid: ?string, published_at: ?string}>|null
     */
    private function parseFeed(string $xml): ?array
    {
        libxml_use_internal_errors(true);
        $doc = simplexml_load_string($xml, SimpleXMLElement::class, LIBXML_NOCDATA);

        if ($doc === false) {
            libxml_clear_errors();

            return null;
        }

        $items = [];

        if (isset($doc->channel->item)) {
            foreach ($doc->channel->item as $item) {
                $items[] = $this->extractRssItem($item);
            }
        } elseif (isset($doc->entry)) {
            foreach ($doc->entry as $entry) {
                $items[] = $this->extractAtomEntry($entry);
            }
        } else {
            return null;
        }

        return $items;
    }

    private function extractRssItem(SimpleXMLElement $item): array
    {
        $content = $this->ns($item, 'content', 'encoded');
        $rawContent = $content ?: (string) $item->description;
        $link = trim((string) $item->link);
        $guid = trim((string) $item->guid) ?: $link;
        $author = $this->ns($item, 'dc', 'creator') ?: trim((string) $item->author);

        return [
            'title' => $this->cleanText((string) $item->title),
            'description' => $this->makeSummary((string) $item->description, $rawContent),
            'content' => $this->cleanContent($rawContent),
            'image' => $this->extractImage($item, $rawContent),
            'author' => $author ?: null,
            'original_url' => $link ?: null,
            'guid' => $guid ?: null,
            'published_at' => $this->parseDate((string) $item->pubDate),
        ];
    }

    private function extractAtomEntry(SimpleXMLElement $entry): array
    {
        $link = '';
        foreach ($entry->link as $linkEl) {
            $attrs = $linkEl->attributes();
            if (! isset($attrs['rel']) || (string) $attrs['rel'] === 'alternate') {
                $link = (string) $attrs['href'];
                break;
            }
        }

        $rawContent = (string) $entry->content ?: (string) $entry->summary;
        $author = trim((string) ($entry->author->name ?? ''));

        return [
            'title' => $this->cleanText((string) $entry->title),
            'description' => $this->makeSummary((string) $entry->summary, $rawContent),
            'content' => $this->cleanContent($rawContent),
            'image' => $this->extractImage($entry, $rawContent),
            'author' => $author ?: null,
            'original_url' => $link ?: null,
            'guid' => trim((string) $entry->id) ?: $link,
            'published_at' => $this->parseDate((string) ($entry->published ?: $entry->updated)),
        ];
    }

    private function ns(SimpleXMLElement $element, string $prefix, string $name): ?string
    {
        $children = $element->children(self::NAMESPACES[$prefix] ?? '');
        $value = trim((string) ($children->{$name} ?? ''));

        return $value !== '' ? $value : null;
    }

    private function extractImage(SimpleXMLElement $item, string $rawContent): ?string
    {
        $media = $item->children(self::NAMESPACES['media']);
        if (isset($media->content) && (string) $media->content->attributes()->url !== '') {
            return (string) $media->content->attributes()->url;
        }
        if (isset($media->thumbnail) && (string) $media->thumbnail->attributes()->url !== '') {
            return (string) $media->thumbnail->attributes()->url;
        }

        if (isset($item->enclosure) && (string) $item->enclosure->attributes()->url !== '') {
            $type = (string) $item->enclosure->attributes()->type;
            if ($type === '' || str_starts_with($type, 'image')) {
                return (string) $item->enclosure->attributes()->url;
            }
        }

        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $rawContent, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function makeSummary(string $description, string $fallbackContent): ?string
    {
        $source = trim($description) !== '' ? $description : $fallbackContent;
        $text = $this->cleanText($source);

        return $text !== '' ? Str::limit($text, 280) : null;
    }

    private function cleanContent(string $html): ?string
    {
        if (trim($html) === '') {
            return null;
        }

        $withBreaks = preg_replace('/<\/(p|div|br|h[1-6]|li)>/i', "\n\n", $html);
        $text = $this->cleanText($withBreaks ?? $html);

        return $text !== '' ? $text : null;
    }

    private function cleanText(string $value): string
    {
        $value = strip_tags($value);
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5);
        // Some feeds (notably Stack Overflow's) embed invisible zero-width/bidi-control
        // characters throughout the text as an anti-scraping measure. Strip them so
        // titles and body copy don't silently fill up with junk characters.
        $value = preg_replace('/[\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2060}-\x{2064}\x{FEFF}\x{00AD}]/u', '', $value) ?? $value;
        $value = preg_replace('/[ \t]+/', ' ', $value) ?? $value;
        $value = preg_replace('/\n{3,}/', "\n\n", $value) ?? $value;

        return trim($value);
    }

    private function parseDate(string $value): ?string
    {
        if (trim($value) === '') {
            return null;
        }

        try {
            return \Illuminate\Support\Carbon::parse($value)->toDateTimeString();
        } catch (Throwable) {
            return null;
        }
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug(Str::limit($title, 180, ''));
        $base = $base !== '' ? $base : 'article';
        $slug = $base;
        $i = 1;

        while (TechNews::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
