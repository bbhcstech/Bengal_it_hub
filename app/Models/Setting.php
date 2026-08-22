<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['group', 'key', 'label', 'value', 'type', 'order'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::flush());
        static::deleted(fn () => Cache::flush());
    }

    /** Get a single setting value by key, with an optional fallback. */
    public static function get(string $key, ?string $default = null): ?string
    {
        $all = static::allCached();

        return $all[$key] ?? $default;
    }

    /** All settings as a flat [key => value] array, cached for performance. */
    public static function allCached(): array
    {
        return Cache::rememberForever('site_settings', function () {
            return static::query()->pluck('value', 'key')->toArray();
        });
    }
}
