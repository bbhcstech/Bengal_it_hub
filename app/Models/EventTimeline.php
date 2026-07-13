<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTimeline extends Model
{
    protected $fillable = ['event_id', 'label', 'date', 'is_open', 'sort_order'];

    protected function casts(): array
    {
        return ['is_open' => 'boolean'];
    }
}
