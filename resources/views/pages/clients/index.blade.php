@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-30" src="{{ $clients['intro']['image'] }}" alt="Bengal IT Hub client companies">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/92 to-slate-950/55"></div>
    <div class="bih-container relative py-20">
        <p class="text-sm font-black uppercase tracking-wide text-amber-300">{{ $clients['intro']['eyebrow'] }}</p>
        <h1 class="mt-4 max-w-3xl text-5xl font-black leading-[1.05] tracking-tight text-white md:text-7xl">{{ $clients['intro']['title'] }}</h1>
        <p class="bih-page-intro bih-on-dark mt-6 max-w-2xl">{{ $clients['intro']['body'] }}</p>
        <div class="mt-9 flex flex-wrap gap-3">
            <a class="bih-button" href="#client-directory">See Client Details</a>
            <a class="bih-button bih-button-light" href="{{ route('contact', ['interest' => 'Client Project']) }}">Start Your Project</a>
        </div>

        <div class="mt-14 grid gap-5 border-t border-white/15 pt-10 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($clients['intro']['stats'] as $stat)
                <div>
                    <p class="text-3xl font-black leading-tight text-white md:text-4xl">{{ $stat['value'] }}</p>
                    <p class="mt-1.5 text-xs font-black uppercase tracking-wide text-white/60">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Logo Wall', 'title' => 'Companies Across Practical Business Sectors', 'intro' => 'A dense client-logo view for quick scanning before opening the detailed client directory below.'])
            <a class="bih-button" href="#client-directory">View Details</a>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach($clients['items'] as $client)
                <a href="#client-{{ Str::slug($client['name']) }}" class="group rounded-md border border-slate-200 bg-white p-4 text-center shadow-sm transition hover:-translate-y-1 hover:border-teal-600/50 hover:shadow-lg">
                    <img class="mx-auto h-16 w-16 rounded-md object-cover shadow-sm" src="{{ $client['logo'] }}" alt="{{ $client['name'] }} logo" width="160" height="160" loading="lazy" decoding="async">
                    <p class="mt-3 text-sm font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $client['name'] }}</p>
                    <p class="mt-1 text-xs font-bold uppercase text-slate-500">{{ $client['industry'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'What We Capture', 'title' => 'Every Client Entry Shows The Useful Details', 'intro' => 'The page is structured so visitors can understand company logo, industry, deal type, delivered product, and current collaboration status without hunting around.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($clients['capabilities'] as $item)
                <article class="bih-card p-6">
                    <p class="bih-eyebrow">0{{ $loop->iteration }}</p>
                    <h2 class="bih-section-title mt-3 text-xl">{{ $item['title'] }}</h2>
                    <p class="bih-copy mt-3">{{ $item['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="client-directory" class="bih-section bg-white scroll-mt-20">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Client Directory', 'title' => 'Client Company Details, Deal Products, And Delivery Context', 'intro' => 'Browse the client cards to see the kind of business, the deal/product area, and what Bengal IT Hub supports for each company.'])
            <a class="bih-button" href="{{ route('contact', ['interest' => 'Client Project']) }}">Work With Us</a>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($clients['items'] as $client)
                <article id="client-{{ Str::slug($client['name']) }}" class="bih-card flex scroll-mt-24 flex-col p-6">
                    <div class="flex items-center gap-4">
                        <img class="h-16 w-16 flex-none rounded-md object-cover shadow-sm" src="{{ $client['logo'] }}" alt="{{ $client['name'] }} logo" width="160" height="160" loading="lazy" decoding="async">
                        <div class="min-w-0">
                            <p class="text-xs font-black uppercase tracking-wide text-teal-700">{{ $client['industry'] }}</p>
                            <h2 class="mt-1 text-xl font-black leading-tight text-slate-950">{{ $client['name'] }}</h2>
                        </div>
                    </div>
                    <div class="mt-6 rounded-md bg-slate-50 p-4">
                        <p class="text-xs font-black uppercase tracking-wide text-slate-500">Deal Product</p>
                        <p class="mt-2 font-black leading-snug text-slate-950">{{ $client['deal'] }}</p>
                    </div>
                    <p class="bih-copy mt-5 flex-1">{{ $client['product'] }}</p>
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-5">
                        <span class="rounded-full bg-teal-50 px-3 py-1.5 text-xs font-black uppercase text-teal-700">{{ $client['status'] }}</span>
                        <a class="text-sm font-extrabold text-teal-700" href="{{ route('contact', ['interest' => $client['name']]) }}">Discuss Similar Work</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-8 lg:grid-cols-[1fr_.8fr] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">Become The Next Client Story</p>
            <h2 class="mt-3 text-4xl font-black leading-tight text-white md:text-5xl">Bring Your Product, Platform, Or Business System To Bengal IT Hub</h2>
            <p class="bih-page-intro bih-on-dark mt-5">Share the business problem, the workflow, or the product idea. The team can help shape it into a clear build plan with design, engineering, launch, and growth support.</p>
        </div>
        <div class="rounded-md border border-white/10 bg-white/8 p-6">
            <p class="text-lg font-black text-white">Typical starting points</p>
            <div class="mt-5 grid gap-3">
                @foreach(['Company website or landing page', 'CRM, dashboard, or internal portal', 'SaaS, mobile app, or AI product', 'Industry-specific automation workflow'] as $item)
                    <div class="rounded-md bg-white/8 p-4 font-bold text-white/82">{{ $item }}</div>
                @endforeach
            </div>
            <a class="bih-button mt-6 w-full" href="{{ route('contact') }}">Contact Us Today</a>
        </div>
    </div>
</section>
@endsection
