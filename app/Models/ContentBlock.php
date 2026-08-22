<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContentBlock extends Model
{
    protected $fillable = ['page', 'section_key', 'label', 'content', 'type', 'order'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::flush());
        static::deleted(fn () => Cache::flush());
    }

    /** All editable text blocks for a page, as [section_key => content]. */
    public static function forPage(string $page): array
    {
        return Cache::remember("content_blocks_{$page}", 3600, function () use ($page) {
            return static::where('page', $page)->orderBy('order')->pluck('content', 'section_key')->toArray();
        });
    }

    /** Convenience accessor: ContentBlock::text('home', 'hero_headline', 'Fallback text') */
    public static function text(string $page, string $key, string $default = ''): string
    {
        $blocks = static::forPage($page);

        return $blocks[$key] ?? $default;
    }
}
