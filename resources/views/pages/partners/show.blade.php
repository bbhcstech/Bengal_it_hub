@extends('layouts.app')

@section('content')
<section class="bg-white pt-10 pb-6">
    <div class="bih-container">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-bold text-slate-500" aria-label="Breadcrumb">
            <a class="transition hover:text-teal-700" href="{{ route('our-partners.index') }}">Our Partners</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-500">{{ $partner->name }}</span>
        </nav>
    </div>
</section>

<section class="bih-section bg-white pt-4">
    <div class="bih-container grid gap-12 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div>
            <div class="flex items-center gap-4">
                @if($partner->logo)
                    <img class="h-16 w-16 flex-none rounded-xl border border-slate-100 object-contain p-2 shadow-sm ring-1 ring-slate-100" src="{{ $partner->logo }}" alt="{{ $partner->name }} logo">
                @else
                    <span class="grid h-16 w-16 flex-none place-items-center rounded-xl bg-linear-to-br from-teal-50 to-teal-100 text-xl font-black text-teal-700 shadow-sm ring-1 ring-teal-600/10">{{ Str::substr($partner->name, 0, 2) }}</span>
                @endif
                <span class="inline-flex items-center rounded-full bg-teal-50 px-3 py-1 text-sm font-black uppercase tracking-wide text-teal-700">{{ ucfirst($partner->scope) }} Partner</span>
            </div>
            <h1 class="bih-page-title mt-5 text-4xl leading-[1.05] tracking-tight md:text-6xl">{{ $partner->name }}</h1>
            <p class="bih-page-intro mt-6">{{ $partner->description ?: 'Full profile details for this partner are coming soon.' }}</p>

            @if($partner->address)
                <p class="mt-4 flex items-center gap-2 text-sm font-bold text-slate-600">
                    <span class="text-teal-600">@include('partials.icon', ['name' => 'globe', 'size' => 'h-4 w-4'])</span>
                    {{ $partner->address }}
                </p>
            @endif

            <div class="mt-9 flex flex-wrap gap-3">
                @if($partner->link_url)
                    <a class="bih-button" href="{{ $partner->link_url }}" target="_blank" rel="noopener">Visit Website</a>
                @endif
                <a class="inline-flex min-h-11 items-center justify-center rounded-xl border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition duration-300 hover:bg-teal-700 hover:text-white hover:shadow-lg hover:shadow-teal-900/20" href="{{ route('our-partners.index') }}">Back to Our Partners</a>
            </div>
        </div>

        @if($partner->clients_count || $partner->employees_count)
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg shadow-slate-200/50">
                <div class="bg-linear-to-r from-teal-800 via-teal-700 to-teal-600 px-5 py-3.5">
                    <p class="text-xs font-black uppercase tracking-wide text-white">At a Glance</p>
                </div>
                <div class="grid grid-cols-2 gap-4 p-6">
                    @if($partner->clients_count)
                        <div class="text-center">
                            <span class="mx-auto grid h-9 w-9 place-items-center rounded-lg bg-teal-50 text-teal-700">@include('partials.icon', ['name' => 'partners', 'size' => 'h-4 w-4'])</span>
                            <p class="mt-2 text-3xl font-black leading-tight text-teal-700">{{ $partner->clients_count }}</p>
                            <p class="mt-1 text-xs font-black uppercase text-slate-500">Total Clients</p>
                        </div>
                    @endif
                    @if($partner->employees_count)
                        <div class="text-center">
                            <span class="mx-auto grid h-9 w-9 place-items-center rounded-lg bg-teal-50 text-teal-700">@include('partials.icon', ['name' => 'briefcase', 'size' => 'h-4 w-4'])</span>
                            <p class="mt-2 text-3xl font-black leading-tight text-teal-700">{{ $partner->employees_count }}</p>
                            <p class="mt-1 text-xs font-black uppercase text-slate-500">Total Employees</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

@if(!empty($partner->products))
    <section class="bih-section bg-slate-50">
        <div class="bih-container">
            <p class="bih-eyebrow">Products</p>
            <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">What {{ $partner->name }} Builds</h2>
            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($partner->products as $product)
                    <div class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                        <span class="grid h-9 w-9 flex-none place-items-center rounded-lg bg-linear-to-br from-teal-600 to-teal-800 text-white shadow-sm transition duration-300 group-hover:scale-105">
                            @include('partials.icon', ['name' => 'chip', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold text-slate-900">{{ $product }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if(!empty($partner->projects))
    <section class="bih-section bg-white">
        <div class="bih-container">
            <p class="bih-eyebrow">Projects</p>
            <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">What We've Worked On Together</h2>
            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($partner->projects as $project)
                    <div class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                        <span class="grid h-9 w-9 flex-none place-items-center rounded-lg bg-teal-50 text-teal-700 ring-1 ring-teal-600/10 transition duration-300 group-hover:bg-teal-700 group-hover:text-white">
                            @include('partials.icon', ['name' => 'target', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold text-slate-900">{{ $project }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if($related->isNotEmpty())
    <section class="bih-section bg-slate-50">
        <div class="bih-container">
            <p class="bih-eyebrow">More Partners</p>
            <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Other {{ ucfirst($partner->scope) }} Partners</h2>
            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($related as $other)
                    <a href="{{ route('our-partners.show', $other->slug) }}" class="group flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                        @if($other->logo)
                            <img class="h-12 w-12 flex-none rounded-xl border border-slate-100 object-contain p-1.5 shadow-sm ring-1 ring-slate-100 transition duration-300 group-hover:ring-teal-100" src="{{ $other->logo }}" alt="{{ $other->name }} logo">
                        @else
                            <span class="grid h-12 w-12 flex-none place-items-center rounded-xl bg-linear-to-br from-teal-50 to-teal-100 text-sm font-black text-teal-700 shadow-sm ring-1 ring-teal-600/10">{{ Str::substr($other->name, 0, 2) }}</span>
                        @endif
                        <h3 class="font-black leading-snug text-slate-950 transition group-hover:text-teal-700">{{ $other->name }}</h3>
                        <svg class="ml-auto h-4 w-4 flex-none text-teal-700 opacity-0 transition duration-300 group-hover:translate-x-1 group-hover:opacity-100" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase tracking-wide text-amber-300">Like What You See?</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight tracking-tight md:text-4xl">Explore partnership opportunities of your own</h2>
        <p class="mx-auto mt-4 max-w-2xl leading-8 text-white/82">See every category we collaborate through, and how to start a partnership with Bengal IT Hub.</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a class="bih-button" href="/contact?interest=Partnership">Start a Conversation</a>
            <a class="bih-button bih-button-light" href="{{ route('our-partners.index') }}">Back to Our Partners</a>
        </div>
    </div>
</section>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $partner->name,
            'description' => $partner->description,
            'url' => $partner->link_url,
            'address' => $partner->address,
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Our Partners', 'url' => route('our-partners.index')],
        ['name' => $partner->name, 'url' => url()->current()],
    ]])
@endpush
@endsection
