@extends('layouts.app')

@section('content')
@php
    $focusAreaCount = collect($industries)->sum(fn ($industry) => count($industry['subBranches'] ?? []));
@endphp

<section class="bih-industries-hero bg-white pt-14 pb-12 md:pt-20">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.42fr] lg:items-end">
        <div>
            <p class="bih-eyebrow">Where We Work</p>
            <h1 class="bih-page-title mt-4 text-5xl leading-[1.05] md:text-7xl">Industries We Build For</h1>
            <p class="bih-page-intro mt-6 max-w-3xl">Bengal IT Hub designs practical technology for industries where operations, customer experience, data visibility, and speed matter every day.</p>
            <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-600">From property and healthcare to logistics, finance, retail, manufacturing, education, and information services, we shape digital systems around the real workflows each sector depends on.</p>
        </div>
        <div class="bih-industries-hero-panel">
            <p>Industry Coverage</p>
            <div>
                <span>{{ str_pad(count($industries), 2, '0', STR_PAD_LEFT) }}</span>
                <strong>Core industries mapped with dedicated solution areas</strong>
            </div>
            <div>
                <span>{{ str_pad($focusAreaCount, 2, '0', STR_PAD_LEFT) }}</span>
                <strong>Focused capabilities across operations, growth, data, and automation</strong>
            </div>
        </div>
    </div>
</section>

<section class="bih-industries-approach bg-white py-10">
    <div class="bih-container">
        <div class="grid gap-4 md:grid-cols-3">
            <article>
                <span>01</span>
                <h2>Understand the workflow</h2>
                <p>We start with how teams, customers, assets, and data actually move through the business.</p>
            </article>
            <article>
                <span>02</span>
                <h2>Build the right system</h2>
                <p>Each platform is shaped for the industry's daily work, not forced into a generic template.</p>
            </article>
            <article>
                <span>03</span>
                <h2>Make outcomes visible</h2>
                <p>Dashboards, automations, and connected records help leaders see progress clearly.</p>
            </article>
        </div>
    </div>
</section>

<section class="bih-section bih-industries-grid-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Industry Solutions</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Choose your business sector</h2>
            <p class="bih-page-intro mt-5">Each industry opens into dedicated focus areas, with content tailored to the systems, users, and business priorities of that market.</p>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($industries as $slug => $industry)
                <a href="{{ route('industries.show', $slug) }}" class="bih-card bih-industries-card group relative flex flex-col overflow-hidden">
                    <span class="absolute inset-x-0 top-0 z-10 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                    <div class="relative h-48 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $industry['image'] }}" alt="{{ $industry['name'] }} technology solutions at Bengal IT Hub">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/15 to-transparent"></div>
                        <span class="absolute left-4 top-4 grid h-11 w-11 place-items-center rounded-md bg-white text-teal-700 shadow-lg">
                            @include('partials.icon', ['name' => $industry['icon'] ?? 'target'])
                        </span>
                        <span class="absolute bottom-3 right-4 text-3xl font-black leading-none text-white/25">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <p class="bih-eyebrow">{{ $industry['kicker'] }}</p>
                        <h3 class="mt-2 text-2xl font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $industry['name'] }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $industry['summary'] }}</p>
                        <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-black uppercase text-slate-500">{{ count($industry['subBranches'] ?? []) }} focus areas</span>
                            <span class="bih-industries-card-link inline-flex items-center gap-1.5 text-sm font-extrabold text-teal-700">
                            Explore {{ $industry['name'] }}
                                <svg class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-industries-cta bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">Need a sector-specific build?</p>
            <h2 class="mt-3 max-w-2xl text-3xl font-black leading-tight text-white md:text-4xl">Bring us your workflow, customer journey, or operational bottleneck.</h2>
            <p class="mt-4 max-w-2xl leading-8 text-white/82">We will map the right platform, automation, dashboard, or digital product around the way your industry actually works.</p>
        </div>
        <a class="bih-button" href="/contact">Start a Conversation</a>
    </div>
</section>

@php
    $bihIndustryFaqs = [
        ['Which industries does Bengal IT Hub build technology for?', 'Bengal IT Hub builds technology for '.count($industries).' industries: '.collect($industries)->pluck('name')->join(', ', ', and ').'.'],
        ['How many focus areas are covered across industries?', $focusAreaCount.' specialized focus areas span the '.count($industries).' industries, each tailored to a distinct workflow such as property management, patient management, core banking, or transportation management.'],
        ['Does Bengal IT Hub build banking and finance technology?', 'Yes. Banking and Finance is one of the industries Bengal IT Hub builds for, with dedicated focus areas covering core banking, lending, and financial data and AI systems.'],
        ['How is each industry page organized?', 'Each industry page opens into dedicated focus areas, tailored to the systems, users, and business priorities of that specific market.'],
    ];
@endphp
<section class="bih-section bg-white">
    <div class="bih-container max-w-3xl">
        <p class="bih-eyebrow">Common Questions</p>
        <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Industries FAQ</h2>
        <div class="mt-8 grid gap-4">
            @foreach($bihIndustryFaqs as [$question, $answer])
                <details class="rounded-md border border-slate-200 bg-slate-50 p-4">
                    <summary class="cursor-pointer font-extrabold">{{ $question }}</summary>
                    <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($bihIndustryFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
