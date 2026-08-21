<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'address',
        'projects',
        'products',
        'clients_count',
        'employees_count',
        'link_url',
        'scope',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'projects' => 'array',
            'products' => 'array',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeHasSlug(Builder $query): Builder
    {
        return $query->whereNotNull('slug')->where('slug', '!=', '');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
