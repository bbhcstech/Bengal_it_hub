@extends('layouts.app')

@section('content')
@include('partials.internal-links', [
    'links' => [],
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Products', 'url' => route('products.index')],
        ['name' => $product['title'], 'url' => url()->current()],
    ],
])

<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-40" src="{{ $product['image'] }}" alt="{{ $product['title'] }} service at Bengal IT Hub">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/90 to-slate-950/48"></div>
    <div class="bih-container relative grid min-h-[56vh] gap-10 py-16 lg:items-center">
        <div class="max-w-3xl">
            <p class="text-sm font-black uppercase text-amber-300">{{ $product['segment'] }}</p>
            <h1 class="mt-4 text-5xl font-black leading-tight text-white md:text-7xl">{{ $product['title'] }}</h1>
            <p class="bih-page-intro bih-on-dark mt-6">{{ $product['summary'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact?interest={{ urlencode($product['title']) }}">Discuss This Product</a>
                <a class="bih-button bih-button-light" href="{{ $product['website'] ?? url('/') }}" target="_blank" rel="noopener">Visit Website</a>
                <a class="bih-button bih-button-light" href="{{ route('products.index') }}">Back to Products</a>
            </div>
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[1.1fr_.9fr] lg:items-start">
        <div>
            <p class="bih-eyebrow">About This Product Line</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">What We Build in {{ $product['segment'] }}</h2>
            <p class="bih-page-intro mt-5">{{ $product['summary'] }}</p>
            <p class="bih-copy mt-4">Every engagement in this segment is built on Bengal IT Hub's production-tested stack, shaped around your specific use case, users, and growth goals rather than a one-size-fits-all template.</p>
        </div>
        <div class="bih-card p-6">
            <p class="text-xs font-black uppercase tracking-wide text-teal-700">Technologies Used</p>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($technologies as $tech)
                    <span class="rounded-full border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-black text-slate-700">{{ $tech }}</span>
                @endforeach
            </div>
            <div class="mt-6 grid gap-3 border-t border-slate-100 pt-5">
                <a class="bih-button justify-center" href="/contact?interest={{ urlencode($product['title']) }}">Talk to the Team</a>
                <a class="inline-flex min-h-11 items-center justify-center gap-2 rounded-md border-2 border-sky-700 px-4 py-3 font-extrabold text-sky-700 transition hover:bg-sky-700 hover:text-white" href="{{ $product['website'] ?? url('/') }}" target="_blank" rel="noopener">Visit Product Website</a>
                <a class="inline-flex min-h-11 items-center justify-center gap-2 rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="{{ $siteBrand['socials']['LinkedIn'] ?? config('bengalhub.brand.socials.LinkedIn') }}" target="_blank" rel="noopener">Follow on LinkedIn</a>
            </div>
        </div>
    </div>
</section>

@if($otherProducts->isNotEmpty())
    <section class="bih-section bg-slate-50">
        <div class="bih-container">
            <div class="max-w-3xl">
                <p class="bih-eyebrow">Explore More</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Other Products From Bengal IT Hub</h2>
            </div>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($otherProducts as $other)
                    <article class="bih-card bih-image-card flex flex-col overflow-hidden">
                        <img class="h-40 w-full object-cover" src="{{ $other['image'] }}" alt="{{ $other['title'] }} service at Bengal IT Hub">
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="bih-section-title text-lg">{{ $other['title'] }}</h3>
                            <p class="bih-copy mt-2 flex-1 text-sm">{{ Str::limit($other['summary'], 90) }}</p>
                            <a class="bih-link mt-4" href="{{ route('products.show', $other['slug']) }}">See More &rarr;</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Services, Articles, And Case Studies',
    'intro' => 'Use these links to move from this product line into connected services, topical reading, and Bengal IT Hub proof pages.',
])

@push('schema')
    {{--
        This is a B2B build service ("we build software/apps/AI for you"),
        not a purchasable good with a price — Product schema without
        offers/price is invalid for Google's Product rich result and
        misrepresents what this page actually is. Service is the correct,
        valid type here, matching services/show.blade.php's own pattern.
    --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $product['title'],
            'description' => $product['summary'],
            'url' => url()->current(),
            'serviceType' => $product['segment'],
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Products', 'url' => route('products.index')],
        ['name' => $product['title'], 'url' => url()->current()],
    ]])
@endpush
@endsection
