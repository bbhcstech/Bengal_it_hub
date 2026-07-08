<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'form_type',
        'event_slug',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'payload',
        'status',
        'source_page',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }
}
