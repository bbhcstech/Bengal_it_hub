<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechNews extends Model
{
    protected $fillable = [
        'rss_source_id',
        'tech_news_category_id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'author',
        'original_url',
        'guid',
        'published_at',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'views_count' => 'integer',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(RssSource::class, 'rss_source_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TechNewsCategory::class, 'tech_news_category_id');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    public function scopeOldestPublished(Builder $query): Builder
    {
        return $query->orderBy('published_at');
    }

    public function scopeTrending(Builder $query): Builder
    {
        return $query->where('published_at', '>=', now()->subDays(7))->orderByDesc('views_count');
    }

    public function scopeMostViewed(Builder $query): Builder
    {
        return $query->orderByDesc('views_count');
    }
}
