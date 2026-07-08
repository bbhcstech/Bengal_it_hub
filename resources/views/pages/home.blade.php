@extends('layouts.app')

@section('content')
<section class="bih-hero">
    <div class="bih-container py-20">
        <div class="max-w-3xl">
            <p class="text-sm font-black uppercase text-amber-300">Future Ready Bengal</p>
            <h1 class="mt-5 text-5xl font-black leading-tight md:text-7xl">Bengal IT Hub</h1>
            <p class="mt-6 max-w-2xl text-xl leading-9 text-white/86">Igniting Zen X innovation in Eastern India. We bridge fresh ideas to market reality through digital services, talent empowerment, and PRAGATI 2026.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026">Explore HackFest</a>
                <a class="bih-button bih-button-secondary" href="/services">View Services</a>
            </div>
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Who We Are', 'title' => 'Where Technology Creates Real Impact', 'intro' => 'A technology-driven innovation center transforming businesses through advanced IT solutions, digital engineering, and talent empowerment.'])
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach(['Mission' => 'Empowering businesses and talent through future-ready digital innovation.', 'Vision' => 'To build a global technology hub from Eastern India.', 'Positioning' => 'A strategic IT powerhouse delivering impactful digital solutions globally.'] as $label => $text)
                <article class="bih-card p-6">
                    <h3 class="text-xl font-black">{{ $label }}</h3>
                    <p class="mt-3 leading-7 text-slate-600">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Services', 'title' => 'End-To-End Digital Services For Business Growth', 'intro' => 'Custom software, SaaS, cloud, AI-driven insights, education, and workforce delivery brought into one scalable ecosystem.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $slug => $service)
                <a href="/{{ $slug }}" class="bih-card block p-6 transition hover:-translate-y-1 hover:border-teal-500">
                    <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
                    <h3 class="mt-3 text-2xl font-black">{{ $service['title'] }}</h3>
                    <p class="mt-3 leading-7 text-slate-600">{{ $service['summary'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container grid gap-8 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
        <div>
            @include('partials.section-heading', ['eyebrow' => 'Flagship Event', 'title' => $event['name'], 'intro' => $event['tagline']])
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach($event['counters'] as $label => $value)
                    <div class="rounded-md bg-slate-950 p-5 text-white">
                        <div class="text-3xl font-black text-amber-300">{{ $value }}</div>
                        <div class="mt-1 text-sm font-bold text-white/70">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bih-card p-6">
            <p class="bih-eyebrow">Grand Finale</p>
            <h3 class="mt-3 text-3xl font-black">{{ $event['finale'] }}</h3>
            <p class="mt-4 leading-7 text-slate-600">{{ $event['venue'] }}</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Sponsor Meeting</a>
            </div>
        </div>
    </div>
</section>
@endsection
