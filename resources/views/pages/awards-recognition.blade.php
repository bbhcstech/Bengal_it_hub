@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-35" src="{{ $awards['intro']['image'] }}" alt="Awards and recognition at Bengal IT Hub">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/92 to-slate-950/55"></div>
    <div class="bih-container relative py-20">
        <p class="text-sm font-black uppercase tracking-wide text-amber-300">{{ $awards['intro']['eyebrow'] }}</p>
        <h1 class="mt-4 max-w-3xl text-5xl font-black leading-[1.05] tracking-tight text-white md:text-7xl">{{ $awards['intro']['title'] }}</h1>
        @foreach($awards['intro']['body'] as $paragraph)
            <p class="bih-page-intro bih-on-dark mt-5 max-w-2xl">{{ $paragraph }}</p>
        @endforeach
        <div class="mt-9 flex flex-wrap gap-3">
            <a class="bih-button" href="/contact?interest=Awards+%26+Recognition">Get In Touch</a>
            <a class="bih-button bih-button-light" href="#categories">See How It's Organized</a>
        </div>

        @if(!empty($awards['intro']['stats']))
            <div class="mt-14 grid gap-5 border-t border-white/15 pt-10 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($awards['intro']['stats'] as $stat)
                    <div>
                        <p class="text-3xl font-black leading-tight text-white md:text-4xl">{{ $stat['value'] }}</p>
                        <p class="mt-1.5 text-xs font-black uppercase tracking-wide text-white/60">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section id="categories" class="bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">How This Page Is Organized</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">Four Kinds of Recognition We're Tracking</h2>
            <p class="bih-page-intro mt-5">As Bengal IT Hub earns awards, certifications, and recognition, they're organized here by category, so you always know exactly where to look.</p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($awards['categories'] as $category)
                <article class="group relative flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-xl">
                    <span class="absolute inset-x-0 top-0 z-10 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                    <div class="relative h-32 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $category['image'] }}" alt="{{ $category['title'] }}">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                        <span class="absolute bottom-3 left-4 grid h-10 w-10 place-items-center rounded-md bg-white/95 text-teal-700 shadow-sm">
                            @include('partials.icon', ['name' => $category['icon']])
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-lg font-black leading-snug tracking-tight text-slate-950">{{ $category['title'] }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $category['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">The Bigger Picture</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">What Recognition Is Building Toward</h2>
            <p class="bih-page-intro mt-5">Awards and mentions matter most when they add up to something. Here's the throughline connecting our present milestones to where we're headed.</p>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @foreach($awards['journey'] as $item)
                <article class="group flex flex-col rounded-lg border border-slate-200 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-xl">
                    <span class="grid h-12 w-12 flex-none place-items-center rounded-md bg-teal-700 text-white">
                        @include('partials.icon', ['name' => $item['icon']])
                    </span>
                    <p class="mt-5 text-xs font-black uppercase tracking-wide text-teal-700">{{ $item['tag'] }}</p>
                    <h3 class="mt-2 text-xl font-black leading-snug tracking-tight text-slate-950">{{ $item['title'] }}</h3>
                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $item['body'] }}</p>
                    <a class="mt-5 inline-flex items-center gap-1.5 text-sm font-extrabold text-teal-700" href="{{ $item['href'] }}">
                        {{ $item['cta'] }}
                        <svg class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="max-w-2xl">
                <p class="bih-eyebrow">Reserved &amp; In Progress</p>
                <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">The Showcase We're Filling In</h2>
                <p class="bih-page-intro mt-5">We'd rather show you an honest, growing wall than a fabricated one. Each slot below is reserved for a real, upcoming milestone as it's earned.</p>
            </div>
        </div>

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($awards['placeholders'] as $slot)
                <div class="flex items-center gap-4 rounded-lg border-2 border-dashed border-slate-200 bg-slate-50/60 p-6 transition duration-300 hover:border-teal-600/40 hover:bg-teal-50/40">
                    <span class="grid h-12 w-12 flex-none place-items-center rounded-md bg-white text-slate-500 shadow-sm">
                        @include('partials.icon', ['name' => $slot['icon']])
                    </span>
                    <div>
                        <p class="font-black leading-tight text-slate-500">{{ $slot['label'] }}</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-wide text-slate-500">Reserved &middot; Coming Soon</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container">
        <div class="grid gap-10 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm lg:grid-cols-2">
            <div class="flex flex-col justify-center p-8 md:p-10">
                <p class="bih-eyebrow">Where This Is Headed</p>
                <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Every Milestone Feeds Vision 2030</h2>
                <p class="bih-copy mt-4">Every award, certification, and mention we work toward supports the same goal: positioning Bengal as India's AI Innovation Hub, and building a track record the whole ecosystem can point to.</p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a class="bih-button inline-flex w-fit" href="/vision-2030">Explore Vision 2030</a>
                    <a class="bih-button-secondary inline-flex w-fit" href="/our-partners">Meet Our Partners</a>
                </div>
            </div>
            <div class="relative h-64 lg:h-full">
                <img class="h-full w-full object-cover" src="{{ $awards['intro']['image'] }}" alt="Bengal IT Hub working toward Vision 2030 recognition">
                <div class="absolute inset-0 bg-linear-to-l from-transparent to-white/10 lg:bg-linear-to-r"></div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase tracking-wide text-amber-300">Have Something to Share?</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight tracking-tight md:text-4xl">Won an award, got featured, or partnered with us?</h2>
        <p class="mx-auto mt-4 max-w-2xl leading-8 text-white/82">If Bengal IT Hub has been recognized somewhere and you'd like it featured on this page, let us know.</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a class="bih-button" href="/contact?interest=Awards+%26+Recognition">Get In Touch</a>
            <a class="bih-button bih-button-light" href="/blog">See Our Story So Far</a>
        </div>
    </div>
</section>
@endsection
