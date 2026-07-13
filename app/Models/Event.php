<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'venue',
        'venue_address',
        'map_embed_url',
        'finale',
        'registration_opens_at',
        'registration_closes_at',
        'submission_deadline_at',
        'counters',
        'hero_image',
        'brochure_path',
        'download_count',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
    ];

    protected function casts(): array
    {
        return [
            'counters' => 'array',
            'registration_opens_at' => 'date',
            'registration_closes_at' => 'date',
            'submission_deadline_at' => 'date',
        ];
    }

    public function timelines()
    {
        return $this->hasMany(EventTimeline::class)->orderBy('sort_order')->orderBy('id');
    }

    public function people()
    {
        return $this->hasMany(Person::class)->orderBy('sort_order')->orderBy('id');
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'scope', 'slug')->orderBy('sort_order')->orderBy('id');
    }

    public function toPublicArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'tagline' => $this->tagline,
            'venue' => $this->venue,
            'finale' => $this->finale,
            'counters' => $this->counters ?: [],
            'timeline' => $this->timelines->map(fn (EventTimeline $item) => [$item->label, $item->date, $item->is_open])->all(),
            'people' => $this->people->map(fn (Person $person) => [$person->role_type, $person->name, $person->bio, $person->linkedin_url ?: ''])->all(),
            'faqs' => Faq::published()->where('scope', $this->slug)->ordered()->get()->map(fn (Faq $faq) => [$faq->question, $faq->answer])->all(),
        ];
    }
}
