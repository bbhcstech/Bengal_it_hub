@extends('layouts.app')

@php
    $person = collect($event['people'])->first(fn ($p) => $p[0] === 'Chief Guest');
@endphp

@section('content')
<section class="bih-hackfest-section py-16">
    <div class="bih-container">
        <a class="bih-link" href="/hackfest-2026">&larr; Back to The Bengal HackFest PRAGATI 2026</a>
        <div class="mt-4 max-w-3xl">
            @include('partials.section-heading', ['eyebrow' => 'The Bengal HackFest PRAGATI 2026', 'title' => 'Chief Guest', 'intro' => 'Meet the distinguished Chief Guest of honor for PRAGATI 2026.'])
        </div>

        @if($person)
            <div class="mt-10">
                @include('partials.hackfest-person-card', [
                    'person' => $person,
                    'variant' => 'feature',
                    'roleLabel' => 'The Chief Guest',
                    'extraIntro' => "As the distinguished Chief Guest of honor, she will deliver the keynote address, represent the event's highest office, and engage with attendees on strategic themes.",
                ])
            </div>
        @endif

        <div class="mt-10 flex flex-wrap gap-3">
            <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
            <a class="bih-button bih-button-secondary" href="/hackfest-2026/chief-adviser">Meet the Chief Adviser</a>
            <a class="bih-button bih-button-secondary" href="/hackfest-2026/speakers">Meet the Speakers &amp; Panelists</a>
        </div>
    </div>
</section>
@endsection
