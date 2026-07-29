@extends('layouts.app')

@section('content')
<section class="bih-products-hero">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.82fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">{{ $products['intro']['eyebrow'] }}</p>
            <h1 class="bih-page-title mt-4 text-5xl md:text-6xl">{{ $products['intro']['title'] }}</h1>
            @foreach($products['intro']['body'] as $paragraph)
                <p class="bih-page-intro mt-5">{{ $paragraph }}</p>
            @endforeach
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact">Discuss Your Product</a>
                <a class="inline-flex min-h-11 items-center justify-center rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="#catalog">Browse Products</a>
            </div>
        </div>
        <div class="bih-products-stack-panel">
            <div class="bih-products-stack-screen">
                <div class="bih-products-screen-bar">
                    <span></span><span></span><span></span>
                </div>
                <p>production_stack</p>
                <div class="mt-4 grid gap-3">
                    @foreach(array_slice($products['technologies'], 0, 6) as $tech)
                        <div class="bih-products-stack-row">
                            <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <strong>{{ $tech }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bih-products-stack-chips">
                @foreach(array_slice($products['technologies'], 6) as $tech)
                    <span>{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-products-company py-16">
    <div class="bih-container">
        <div class="grid gap-8 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
            <div>
                <p class="bih-eyebrow">What We Work For</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">We Build Practical IT Products For Real Business Use</h2>
                <p class="bih-page-intro mt-5">Bengal IT Hub works with startups, founders, institutions, MSMEs, and growing companies that need useful software, not decorative screens. Our focus is product planning, engineering, launch support, automation, and long-term improvement.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach([
                    ['01', 'Business Systems', 'CRM tools, admin panels, dashboards, portals, automation workflows, and internal applications.'],
                    ['02', 'Customer Products', 'Websites, mobile apps, SaaS platforms, booking flows, creator products, and digital experiences.'],
                    ['03', 'Future Tech', 'AI tools, agentic workflows, IoT dashboards, data systems, and cloud-ready product infrastructure.'],
                ] as [$number, $title, $body])
                    <article class="bih-products-company-card">
                        <span>{{ $number }}</span>
                        <h3>{{ $title }}</h3>
                        <p>{{ $body }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="catalog" class="bih-products-catalog bih-section bg-slate-50">
    <div class="bih-container">
        <div class="grid gap-8 lg:grid-cols-[.8fr_1.2fr] lg:items-end">
            <div>
                <p class="bih-eyebrow">Our Product Catalog</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Browse By Segment</h2>
                <p class="bih-page-intro mt-5">Every product line below can be filtered by segment, or explored in full as one connected catalog.</p>
            </div>
            <div class="bih-products-metrics">
                <div><strong>{{ count($products['items']) }}</strong><span>Product lines</span></div>
                <div><strong>{{ count($products['technologies']) }}</strong><span>Core technologies</span></div>
                <div><strong>1</strong><span>Production team</span></div>
            </div>
        </div>

        <div class="bih-products-filter mt-8 flex flex-wrap gap-2">
            <button type="button" class="bih-filter-btn is-active" data-product-filter="all">All Products</button>
            @foreach($products['items'] as $item)
                <button type="button" class="bih-filter-btn" data-product-filter="{{ $item['slug'] }}">{{ $item['segment'] }}</button>
            @endforeach
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" data-product-grid>
            @foreach($products['items'] as $item)
                <article data-product-card data-segment="{{ $item['slug'] }}" class="bih-card bih-products-card bih-image-card flex flex-col overflow-hidden">
                    <div class="bih-products-card-image">
                        <img class="h-48 w-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['title'] }} service at Bengal IT Hub">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <p class="bih-eyebrow">{{ $item['segment'] }}</p>
                        <h3 class="bih-section-title mt-2 text-xl">{{ $item['title'] }}</h3>
                        <p class="bih-copy mt-3 flex-1 text-sm">{{ $item['summary'] }}</p>
                        <div class="bih-products-card-actions mt-5">
                            <a class="bih-button" href="{{ route('products.show', $item['slug']) }}">See More</a>
                            <a class="bih-products-website" href="{{ $item['website'] ?? url('/') }}" target="_blank" rel="noopener">Website</a>
                            <a class="bih-products-linkedin" href="{{ config('bengalhub.brand.socials.LinkedIn') }}" target="_blank" rel="noopener">LinkedIn</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <p data-product-empty class="mt-8 hidden text-center font-bold text-slate-500">No products found in this segment yet.</p>
    </div>
</section>

<section class="bih-products-process bg-white py-16">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Production Workflow</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">From Product Idea To Stable Release</h2>
            <p class="bih-page-intro mt-5">Every build is shaped for real users, reliable delivery, and long-term maintainability across web, mobile, cloud, IoT, and AI systems.</p>
        </div>
        <div class="mt-10 grid gap-4 md:grid-cols-4">
            @foreach([
                ['Plan', 'Requirements, product scope, roadmap, and success metrics.'],
                ['Design', 'User flows, interface systems, architecture, and data models.'],
                ['Build', 'Backend, frontend, APIs, AI workflows, integrations, and testing.'],
                ['Launch', 'Deployment, monitoring, optimization, and support for scale.'],
            ] as [$title, $body])
                <article class="bih-products-process-card">
                    <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $body }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-products-mission bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
        <div class="max-w-3xl">
            <p class="text-sm font-black uppercase text-amber-300">{{ $products['mission']['eyebrow'] }}</p>
            <h2 class="mt-3 text-4xl font-black leading-tight text-white md:text-5xl">{{ $products['mission']['title'] }}</h2>
            @foreach($products['mission']['body'] as $paragraph)
                <p class="mt-5 leading-8 text-white/82">{{ $paragraph }}</p>
            @endforeach
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            @foreach($products['mission']['images'] as $image)
                <img class="bih-products-mission-image h-64 w-full rounded-md object-cover shadow-xl" src="{{ $image['src'] }}" alt="{{ $image['alt'] }}">
            @endforeach
        </div>
    </div>
</section>

@php
    $bihProductFaqs = [
        ['What products does Bengal IT Hub build?', 'Bengal IT Hub builds '.count($products['items']).' product lines: '.collect($products['items'])->pluck('title')->join(', ', ', and ').'.'],
        ['What technologies does Bengal IT Hub use?', 'Bengal IT Hub builds on '.count($products['technologies']).' core technologies, including '.collect($products['technologies'])->take(4)->join(', ', ', and ').', among others.'],
        ['Does Bengal IT Hub build AI products?', 'Yes. Generative AI and Agentic AI are both dedicated product lines, covering AI content tools, chat interfaces, and AI agents that plan, call tools, and automate tasks.'],
        ['Who does Bengal IT Hub build products for?', 'Bengal IT Hub works with startups, founders, institutions, MSMEs, and growing companies that need product planning, engineering, launch support, and long-term improvement.'],
    ];
@endphp
<section class="bih-section bg-white">
    <div class="bih-container max-w-3xl">
        <p class="bih-eyebrow">Common Questions</p>
        <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Products FAQ</h2>
        <div class="mt-8 grid gap-4">
            @foreach($bihProductFaqs as [$question, $answer])
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
            'mainEntity' => collect($bihProductFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
