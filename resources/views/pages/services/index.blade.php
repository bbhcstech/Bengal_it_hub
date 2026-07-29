@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['level' => 'h1', 'eyebrow' => 'Services', 'title' => 'Services Built For Growth, Talent, And Execution', 'intro' => 'Bengal IT Hub provides '.count($services).' services spanning technology education, talent development, AI-driven marketing, business consulting, collaboration, and operations support — built to help organizations grow, hire, and execute with less friction.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $slug => $service)
                <a class="bih-card block p-6 transition hover:-translate-y-1 hover:border-teal-500" href="/{{ $slug }}">
                    <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
                    <h2 class="mt-3 text-2xl font-black">{{ $service['title'] }}</h2>
                    <p class="mt-3 leading-7 text-slate-600">{{ $service['summary'] }}</p>
                    <span class="mt-5 inline-flex font-extrabold text-teal-700">Learn more</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

@php
    $bihServiceFaqs = [
        ['What services does Bengal IT Hub provide?', 'Bengal IT Hub provides '.count($services).' services: '.collect($services)->pluck('title')->join(', ', ', and ').'.'],
        ['Does Bengal IT Hub offer staff augmentation?', 'Yes. Staff Augmentation is one of Bengal IT Hub\'s core services, alongside Corporate Operations Outsourcing and E-Collab for extended team collaboration.'],
        ['Where is Bengal IT Hub based?', 'Bengal IT Hub is based in Kolkata, India.'],
        ['How do I get started with a Bengal IT Hub service?', 'Contact Bengal IT Hub through the contact page to discuss your requirement, and the team will follow up directly.'],
    ];
@endphp
<section class="bih-section bg-slate-50">
    <div class="bih-container max-w-3xl">
        <p class="bih-eyebrow">Common Questions</p>
        <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Services FAQ</h2>
        <div class="mt-8 grid gap-4">
            @foreach($bihServiceFaqs as [$question, $answer])
                <details class="rounded-md border border-slate-200 bg-white p-4">
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
            'mainEntity' => collect($bihServiceFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
