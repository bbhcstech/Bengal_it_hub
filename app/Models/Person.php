<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'event_id',
        'role_type',
        'name',
        'designation',
        'photo',
        'bio',
        'linkedin_url',
        'sort_order',
        'status',
    ];
}
