@extends('layouts.app')

@section('content')
@include('partials.internal-links', [
    'links' => [],
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Industries', 'url' => route('industries.index')],
        ['name' => $industry['name'], 'url' => url()->current()],
    ],
])

<section class="bih-industry-hero relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover" src="{{ $industry['image'] }}" alt="{{ $industry['name'] }} technology solutions at Bengal IT Hub">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/90 to-slate-950/42"></div>
    <div class="bih-container relative grid min-h-[72vh] gap-10 py-16 lg:grid-cols-[1fr_.42fr] lg:items-end">
        <div>
            <a class="inline-flex items-center gap-2 rounded-full border border-white/14 bg-white/8 px-3 py-2 text-xs font-black uppercase text-white/76 transition hover:border-white/35 hover:text-white" href="{{ route('industries.index') }}">&larr; All Industries</a>
            <p class="mt-7 text-sm font-black uppercase text-amber-300">{{ $industry['kicker'] }}</p>
            <h1 class="mt-4 max-w-3xl text-5xl font-black leading-[1.05] text-white md:text-7xl">{{ $industry['name'] }}</h1>
            <p class="bih-page-intro bih-on-dark mt-6 max-w-2xl">{{ $industry['summary'] }}</p>
            <p class="mt-4 max-w-2xl text-lg leading-8 text-white/82">{{ $industry['body'] }}</p>
            <div class="mt-9 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact?interest={{ urlencode($industry['name']) }}">Discuss Your Requirement</a>
                <a class="bih-button bih-button-light" href="#focus-areas">Explore Focus Areas</a>
            </div>
        </div>
        <div class="bih-industry-hero-panel">
            <p>Digital Operating Layer</p>
            <div>
                <span>{{ count($industry['subBranches']) }}</span>
                <strong>Focused property systems</strong>
            </div>
            <div>
                <span>01</span>
                <strong>Connected buyer, asset, and operations flow</strong>
            </div>
        </div>
    </div>
</section>

<section id="focus-areas" class="bih-section bih-industry-focus bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Focus Areas</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">What We Deliver in {{ $industry['name'] }}</h2>
            <p class="bih-page-intro mt-5">Specialized systems for the moments that matter most: discovery, sales, operations, maintenance, analytics, and smarter buildings.</p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($industry['subBranches'] as $branchSlug => $branch)
                <a href="{{ route('industries.sub-show', [$slug, $branchSlug]) }}" class="bih-card bih-industry-branch-card group relative flex flex-col overflow-hidden">
                    <span class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                    <div class="relative h-44 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $branch['image'] }}" alt="{{ $branch['name'] }} at Bengal IT Hub">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/10 to-transparent"></div>
                        <span class="absolute left-4 top-4 grid h-11 w-11 place-items-center rounded-full bg-white text-teal-700 shadow-lg">
                            @include('partials.icon', ['name' => $branch['icon'] ?? 'target'])
                        </span>
                        <span class="absolute bottom-3 right-4 text-3xl font-black leading-none text-white/25">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-xl font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $branch['name'] }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $branch['summary'] }}</p>
                        <span class="bih-industry-card-link mt-5 inline-flex items-center gap-1.5 text-sm font-extrabold text-teal-700">
                            Explore Focus Area
                            <svg class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-industry-cta relative overflow-hidden bg-slate-950 py-16 text-white">
    <div class="bih-container relative text-center">
        <p class="text-sm font-black uppercase text-amber-300">Let's Build Together</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight md:text-4xl">Ready to bring better digital flow to your {{ Str::lower($industry['name']) }} business?</h2>
        <a class="bih-button mt-8 inline-flex" href="/contact?interest={{ urlencode($industry['name']) }}">Discuss Your Requirement</a>
    </div>
</section>

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Solutions For '.$industry['name'],
    'intro' => 'Explore adjacent services, product lines, articles, and proof pages connected to this industry.',
])

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $industry['name'].' Technology Solutions',
            'description' => $industry['summary'],
            'url' => url()->current(),
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Industries', 'url' => route('industries.index')],
        ['name' => $industry['name'], 'url' => url()->current()],
    ]])
@endpush
@endsection
