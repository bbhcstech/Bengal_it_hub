<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'kicker',
        'summary',
        'body',
        'features',
        'image',
        'sort_order',
        'is_featured',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
        'og_image',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function toPublicArray(): array
    {
        return [
            'title' => $this->title,
            'kicker' => $this->kicker,
            'summary' => $this->summary,
            'body' => $this->body,
            'features' => $this->features ?: [],
            'image' => $this->image,
        ];
    }
}
