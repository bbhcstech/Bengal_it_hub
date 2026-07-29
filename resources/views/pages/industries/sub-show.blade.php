@extends('layouts.app')

@section('content')
<section class="bih-industry-breadcrumb bg-white pt-10 pb-6">
    <div class="bih-container">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-bold text-slate-500" aria-label="Breadcrumb">
            <a class="transition hover:text-teal-700" href="{{ route('industries.index') }}">Industries</a>
            <span class="text-slate-300">/</span>
            <a class="transition hover:text-teal-700" href="{{ route('industries.show', $industrySlug) }}">{{ $industry['name'] }}</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-500">{{ $branch['name'] }}</span>
        </nav>
    </div>
</section>

<section class="bih-section bih-industry-sub-hero bg-white pt-4">
    <div class="bih-container grid gap-12 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div>
            <span class="grid h-14 w-14 place-items-center rounded-md bg-teal-50 text-teal-700 shadow-sm">
                @include('partials.icon', ['name' => $branch['icon'] ?? 'target', 'size' => 'h-6 w-6'])
            </span>
            <p class="mt-5 text-sm font-black uppercase text-teal-700">{{ $industry['name'] }}</p>
            <h1 class="bih-page-title mt-3 text-4xl leading-[1.05] md:text-6xl">{{ $branch['name'] }}</h1>
            <p class="bih-page-intro mt-6">{{ $branch['summary'] }}</p>
            <p class="mt-4 text-lg leading-8 text-slate-600">{{ $branch['body'] }}</p>
            <div class="mt-9 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact?interest={{ urlencode($branch['name']) }}">Discuss This Requirement</a>
                <a class="bih-button bih-button-secondary" href="{{ route('industries.show', $industrySlug) }}">Back to {{ $industry['name'] }}</a>
            </div>
        </div>
        <div class="bih-industry-sub-visual relative overflow-hidden rounded-lg shadow-2xl">
            <img class="h-72 w-full object-cover sm:h-96" src="{{ $branch['image'] }}" alt="{{ $branch['name'] }} at Bengal IT Hub">
            <span class="absolute inset-x-0 bottom-0 h-1.5 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
        </div>
    </div>
</section>

@if(count($industry['subBranches']) > 1)
    <section class="bih-section bih-industry-focus bg-slate-50">
        <div class="bih-container">
            <p class="bih-eyebrow">More In {{ $industry['name'] }}</p>
            <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Other Focus Areas</h2>
            <div class="mt-9 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($industry['subBranches'] as $branchSlug => $other)
                    @continue($other['name'] === $branch['name'])
                    <a href="{{ route('industries.sub-show', [$industrySlug, $branchSlug]) }}" class="bih-industry-mini-card group flex gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                        <span class="grid h-11 w-11 flex-none place-items-center rounded-md bg-teal-50 text-teal-700">
                            @include('partials.icon', ['name' => $other['icon'] ?? 'target'])
                        </span>
                        <div>
                            <h3 class="font-black leading-snug text-slate-950 transition group-hover:text-teal-700">{{ $other['name'] }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ Str::limit($other['summary'], 90) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Explore More Around '.$branch['name'],
    'intro' => 'Continue through connected Bengal IT Hub services, product capabilities, related articles, and proof pages.',
])

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $branch['name'],
            'description' => $branch['summary'],
            'url' => url()->current(),
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
            'serviceType' => $industry['name'],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Industries', 'url' => route('industries.index')],
        ['name' => $industry['name'], 'url' => route('industries.show', $industrySlug)],
        ['name' => $branch['name'], 'url' => url()->current()],
    ]])
@endpush
@endsection
