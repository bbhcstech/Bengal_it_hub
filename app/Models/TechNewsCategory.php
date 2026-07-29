<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechNewsCategory extends Model
{
    protected $fillable = ['name', 'slug', 'sort_order'];

    public function rssSources(): HasMany
    {
        return $this->hasMany(RssSource::class);
    }

    public function techNews(): HasMany
    {
        return $this->hasMany(TechNews::class);
    }
}
