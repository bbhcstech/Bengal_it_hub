<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RssSource extends Model
{
    protected $fillable = [
        'tech_news_category_id',
        'name',
        'slug',
        'feed_url',
        'logo',
        'is_active',
        'last_synced_at',
        'last_sync_status',
        'last_sync_message',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'last_synced_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TechNewsCategory::class, 'tech_news_category_id');
    }

    public function techNews(): HasMany
    {
        return $this->hasMany(TechNews::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
