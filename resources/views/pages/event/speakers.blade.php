@extends('layouts.app')

@php
    $speakers = collect($event['people'])->filter(fn ($p) => $p[0] === 'Speakers & Panelists')->values();
@endphp

@section('content')
<section class="bih-section bih-hackfest-panelists">
    <div class="bih-container">
        <a class="bih-link" href="/hackfest-2026">&larr; Back to The Bengal HackFest PRAGATI 2026</a>
        <div class="mt-4">
            @include('partials.section-heading', ['eyebrow' => 'People', 'title' => 'The Speakers & Panelists', 'intro' => "A polished showcase of the event's expert speakers, panelists, and industry leaders."])
        </div>

        <div class="mt-10 grid items-stretch gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($speakers as $person)
                @include('partials.hackfest-person-card', ['person' => $person, 'variant' => 'grid'])
            @endforeach
        </div>

        <div class="mt-10 flex flex-wrap gap-3">
            <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
            <a class="bih-button bih-button-secondary" href="/hackfest-2026/chief-guest">Meet the Chief Guest</a>
            <a class="bih-button bih-button-secondary" href="/hackfest-2026/chief-adviser">Meet the Chief Adviser</a>
        </div>
    </div>
</section>
@endsection
