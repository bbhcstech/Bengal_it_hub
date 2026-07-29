@extends('layouts.app')

@php
    $eventLogo = asset('HackFest/'.rawurlencode('Hackathon_Logo_B&W.png'));
@endphp

@section('content')
<section class="bih-section bih-hackfest-venue-section">
    <div class="bih-container">
        <a class="bih-link" href="/hackfest-2026">&larr; Back to The Bengal HackFest PRAGATI 2026</a>
        <div class="mt-8 grid gap-8 lg:grid-cols-[.95fr_1.05fr] lg:items-start">
            <div class="bih-hackfest-venue">
                @if(!empty($event['venueDetails']['tags']))
                    <div class="flex flex-wrap gap-2">
                        @foreach($event['venueDetails']['tags'] as $tag)
                            <span>{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
                @include('partials.section-heading', ['level' => 'h1', 'eyebrow' => 'Hosted at', 'title' => $event['venueDetails']['name'] ?? $event['venue'], 'intro' => 'Grand Finale: '.$event['finale']])
                @if(!empty($event['venueDetails']))
                    <p class="mt-2 font-bold text-slate-700">{{ $event['venueDetails']['campus'] }}, {{ $event['venueDetails']['address'] }}</p>
                    <p class="mt-3 leading-7 text-slate-600">{{ $event['venueDetails']['description'] }}</p>
                @endif
                <div class="mt-6 flex flex-wrap gap-3">
                    <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
                    <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                    <a class="bih-button bih-button-secondary" href="/academic-partnership">Academic Partnership</a>
                </div>
            </div>
            <div class="bih-hackfest-image-frame">
                <img src="{{ $eventLogo }}" alt="The Bengal HackFest PRAGATI 2026 venue">
            </div>
        </div>
    </div>
</section>
@endsection
