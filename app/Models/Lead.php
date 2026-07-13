<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'form_type',
        'event_slug',
        'event_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'payload',
        'status',
        'notes',
        'source_page',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
