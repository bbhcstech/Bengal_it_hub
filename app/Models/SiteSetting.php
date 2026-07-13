<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected function casts(): array
    {
        return ['value' => 'array'];
    }

    public static function value(string $key, mixed $fallback = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $fallback;
    }
}
