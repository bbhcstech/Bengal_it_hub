<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_url',
        'target_url',
        'status_code',
        'is_active',
        'hits',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'status_code' => 'integer',
        'hits' => 'integer',
    ];

    /**
     * Find an active redirect matching a request path.
     */
    public static function matchPath(string $path): ?self
    {
        $normalized = '/' . ltrim($path, '/');
        return static::where('is_active', true)
            ->where(function ($q) use ($normalized, $path) {
                $q->where('source_url', $normalized)
                  ->orWhere('source_url', $path);
            })
            ->first();
    }
}
