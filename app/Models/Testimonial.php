<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'client_name', 'designation', 'company', 'quote', 'photo', 'rating', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
