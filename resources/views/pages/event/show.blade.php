@extends('layouts.app')

@section('content')
<section class="bih-hero">
    <div class="bih-container py-20">
        <div class="max-w-4xl">
            <p class="text-sm font-black uppercase text-amber-300">East India’s Premier HackFest</p>
            <h1 class="mt-5 text-5xl font-black leading-tight md:text-7xl">{{ $event['name'] }}</h1>
            <p class="mt-6 text-xl leading-9 text-white/86">{{ $event['tagline'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                <a class="bih-button bih-button-secondary" href="/academic-partnership">Academic Partnership</a>
            </div>
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($event['counters'] as $label => $value)
                <div class="bih-card p-6 text-center">
                    <div class="text-4xl font-black text-teal-700">{{ $value }}</div>
                    <div class="mt-2 font-bold text-slate-600">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="bih-container grid gap-10 lg:grid-cols-2">
        <div>
            @include('partials.section-heading', ['eyebrow' => 'Timeline', 'title' => 'From Idea To Finale', 'intro' => 'Admin-editable milestones keep each HackFest edition accurate year after year.'])
            <div class="mt-8 grid gap-4">
                @foreach($event['timeline'] as [$label, $date])
                    <div class="bih-card p-5">
                        <p class="font-black">{{ $label }}</p>
                        <p class="mt-1 text-slate-600">{{ $date }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            @include('partials.section-heading', ['eyebrow' => 'People', 'title' => 'Chief Guest, Adviser, Speakers & Panelists'])
            <div class="mt-8 grid gap-4">
                @foreach($event['people'] as [$role, $name, $bio])
                    <article id="{{ Str::slug($role) }}" class="bih-card p-5">
                        <p class="bih-eyebrow">{{ $role }}</p>
                        <h3 class="mt-2 text-2xl font-black">{{ $name }}</h3>
                        <p class="mt-3 leading-7 text-slate-600">{{ $bio }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-section" id="venue">
    <div class="bih-container grid gap-8 lg:grid-cols-2 lg:items-center">
        <div>
            @include('partials.section-heading', ['eyebrow' => 'Venue', 'title' => $event['venue'], 'intro' => 'Grand Finale: '.$event['finale']])
        </div>
        <div class="bih-card p-6" id="faq">
            <h2 class="text-2xl font-black">HackFest FAQ</h2>
            <div class="mt-5 grid gap-4">
                @foreach($event['faqs'] as [$question, $answer])
                    <details class="rounded-md border border-slate-200 bg-white p-4">
                        <summary class="cursor-pointer font-extrabold">{{ $question }}</summary>
                        <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
