@extends('layouts.app')

@section('content')
@include('partials.internal-links', [
    'links' => [],
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => $page[0], 'url' => url()->current()],
    ],
])

<section class="bih-section">
    <div class="bih-container">
        <div class="grid gap-8 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
            <div>
                <p class="bih-eyebrow">{{ $page[1] }}</p>
                <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">{{ $page[0] }}</h1>
                <p class="mt-5 text-xl leading-9 text-slate-600">{{ $page[2] }}</p>
                <a class="bih-button mt-8" href="/contact">Start a Conversation</a>
            </div>
            <div class="bih-card p-7">
                @if($slug === 'faq')
                    <h2 class="text-2xl font-black">Frequently Asked Questions</h2>
                    <div class="mt-5 grid gap-4">
                        @foreach($faqs as [$question, $answer])
                            <details class="rounded-md border border-slate-200 p-4">
                                <summary class="cursor-pointer font-extrabold">{{ $question }}</summary>
                                <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                            </details>
                        @endforeach
                    </div>
                    @push('schema')
                        <script type="application/ld+json">
                            {!! json_encode([
                                '@'.'context' => 'https://schema.org',
                                '@type' => 'FAQPage',
                                'mainEntity' => collect($faqs)->map(fn ($faq) => [
                                    '@type' => 'Question',
                                    'name' => $faq[0],
                                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
                                ])->all(),
                            ], JSON_UNESCAPED_SLASHES) !!}
                        </script>
                    @endpush
                @else
                    <h2 class="text-2xl font-black">Laravel Migration Page</h2>
                    <p class="mt-4 leading-8 text-slate-600">This page preserves the current WordPress URL inventory and gives the CMS build a clean place to migrate rich text, images, SEO metadata, and reusable content blocks.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Pages Across Bengal IT Hub',
    'intro' => 'Use these internal links to continue into connected services, articles, and ecosystem proof pages.',
])
@endsection
