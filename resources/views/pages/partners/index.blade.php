@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-35" src="{{ $content['intro']['image'] }}" alt="Bengal IT Hub partner ecosystem">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/92 to-slate-950/55"></div>
    <div class="pointer-events-none absolute -top-24 right-[-10%] h-96 w-96 rounded-full bg-teal-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-amber-400/10 blur-3xl"></div>
    <div class="bih-container relative py-20">
        <p class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-wide text-amber-300">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-300"></span>
            {{ $content['intro']['eyebrow'] }}
        </p>
        <h1 class="mt-4 max-w-3xl text-5xl font-black leading-[1.05] tracking-tight text-white md:text-7xl">{{ $content['intro']['title'] }}</h1>
        <p class="bih-page-intro bih-on-dark mt-6 max-w-2xl">{{ $content['intro']['body'] }}</p>
        <div class="mt-9 flex flex-wrap gap-3">
            <a class="bih-button" href="#directory">See Every Partner</a>
            <a class="bih-button bih-button-light" href="#become-a-partner">Become a Partner</a>
        </div>

        @if(!empty($content['intro']['stats']))
            <div class="mt-14 grid gap-4 border-t border-white/15 pt-10 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($content['intro']['stats'] as $stat)
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm transition duration-300 hover:border-teal-400/40 hover:bg-white/10">
                        <p class="text-3xl font-black leading-tight text-white md:text-4xl">{{ $stat['value'] }}</p>
                        <p class="mt-1.5 text-xs font-black uppercase tracking-wide text-white/60">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Why Partner With Us</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">What Working With Bengal IT Hub Looks Like</h2>
            <p class="bih-page-intro mt-5">Every partnership is built the same way: clear scope, shared visibility, and room to grow as trust builds up.</p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($content['benefits'] as $benefit)
                <article class="group relative flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-xl">
                    <span class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                    <span class="grid h-12 w-12 place-items-center rounded-xl bg-linear-to-br from-teal-600 to-teal-800 text-white shadow-md shadow-teal-900/20 transition duration-300 group-hover:scale-105">
                        @include('partials.icon', ['name' => $benefit['icon']])
                    </span>
                    <h3 class="mt-4 text-lg font-black leading-snug tracking-tight text-slate-950">{{ $benefit['title'] }}</h3>
                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $benefit['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Six Ways We Collaborate</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">Partnership Categories</h2>
            <p class="bih-page-intro mt-5">Every partner below fits into one of these categories. Open the directory to see the actual companies and collaborators in each.</p>
        </div>

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($content['categories'] as $category)
                <div class="group flex items-start gap-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                    <span class="grid h-12 w-12 flex-none place-items-center rounded-xl bg-teal-50 text-teal-700 ring-1 ring-teal-600/10 transition duration-300 group-hover:bg-teal-700 group-hover:text-white">
                        @include('partials.icon', ['name' => $category['icon']])
                    </span>
                    <div>
                        <h3 class="font-black leading-snug text-slate-950">{{ $category['name'] }}</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $category['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="directory" class="bih-section bg-white scroll-mt-20">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">The Directory</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">Meet Our Partners</h2>
            <p class="bih-page-intro mt-5">Open a profile to see what each partner does, the projects and products they bring, and how to reach them.</p>
        </div>

        @if($partners->isEmpty())
            <div class="mt-10 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/60 p-10 text-center">
                <span class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-white text-teal-700 shadow-sm">
                    @include('partials.icon', ['name' => 'partners'])
                </span>
                <p class="mt-4 font-bold text-slate-500">Partner profiles are being added. Check back soon.</p>
            </div>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($partners as $partner)
                    <a href="{{ route('our-partners.show', $partner->slug) }}" class="group relative flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-2xl">
                        <span class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400 transition-all duration-300 group-hover:h-1.5"></span>
                        <div class="flex items-center gap-4 p-6 pb-0">
                            @if($partner->logo)
                                <img class="h-14 w-14 flex-none rounded-xl border border-slate-100 object-contain p-1.5 shadow-sm ring-1 ring-slate-100 transition duration-300 group-hover:ring-teal-100" src="{{ $partner->logo }}" alt="{{ $partner->name }} logo">
                            @else
                                <span class="grid h-14 w-14 flex-none place-items-center rounded-xl bg-linear-to-br from-teal-50 to-teal-100 text-lg font-black text-teal-700 shadow-sm ring-1 ring-teal-600/10">{{ Str::substr($partner->name, 0, 2) }}</span>
                            @endif
                            <div class="min-w-0">
                                <h3 class="truncate text-lg font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $partner->name }}</h3>
                                <span class="mt-1 inline-flex items-center rounded-full bg-teal-50 px-2.5 py-0.5 text-xs font-black uppercase tracking-wide text-teal-700">{{ ucfirst($partner->scope) }} Partner</span>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <p class="flex-1 text-sm leading-7 text-slate-600">{{ $partner->description ? Str::limit($partner->description, 120) : 'Profile details coming soon.' }}</p>
                            @if($partner->address)
                                <p class="mt-3 flex items-center gap-1.5 text-xs font-bold text-slate-500">
                                    <span class="text-teal-600">@include('partials.icon', ['name' => 'globe', 'size' => 'h-3.5 w-3.5'])</span>
                                    <span class="truncate">{{ $partner->address }}</span>
                                </p>
                            @endif
                            @if($partner->clients_count || $partner->employees_count)
                                <div class="mt-4 flex gap-5 border-t border-slate-100 pt-4">
                                    @if($partner->clients_count)
                                        <div class="flex items-center gap-2">
                                            <span class="grid h-7 w-7 flex-none place-items-center rounded-md bg-teal-50 text-teal-700">@include('partials.icon', ['name' => 'partners', 'size' => 'h-3.5 w-3.5'])</span>
                                            <div><span class="block text-base font-black leading-none text-teal-700">{{ $partner->clients_count }}</span><span class="text-xs font-bold uppercase text-slate-500">Clients</span></div>
                                        </div>
                                    @endif
                                    @if($partner->employees_count)
                                        <div class="flex items-center gap-2">
                                            <span class="grid h-7 w-7 flex-none place-items-center rounded-md bg-teal-50 text-teal-700">@include('partials.icon', ['name' => 'briefcase', 'size' => 'h-3.5 w-3.5'])</span>
                                            <div><span class="block text-base font-black leading-none text-teal-700">{{ $partner->employees_count }}</span><span class="text-xs font-bold uppercase text-slate-500">Employees</span></div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-extrabold text-teal-700">
                                View Profile
                                <svg class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section id="become-a-partner" class="bih-section bg-slate-50 scroll-mt-20">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Become A Partner</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">How Partnership Works</h2>
            <p class="bih-page-intro mt-5">A straightforward path from first conversation to a working, growing partnership.</p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($content['process'] as $step)
                <div class="group relative overflow-hidden rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-600/40 hover:shadow-lg">
                    <span class="text-4xl font-black leading-none text-teal-600/20 transition group-hover:text-teal-600/35">{{ $step['step'] }}</span>
                    <h3 class="mt-4 text-lg font-black leading-snug tracking-tight text-slate-950">{{ $step['title'] }}</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ $step['body'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase tracking-wide text-amber-300">Want to Partner With Us?</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight md:text-4xl">Let's build something together</h2>
        <p class="mx-auto mt-4 max-w-2xl leading-8 text-white/82">Tell us what you're working on, and where a partnership with Bengal IT Hub could help move it forward.</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a class="bih-button" href="/contact?interest=Partnership">Start a Conversation</a>
            <a class="bih-button bih-button-light" href="/awards-recognition">See Our Recognition</a>
        </div>
    </div>
</section>

@php
    $bihPartnerFaqs = [
        ['Who are Bengal IT Hub\'s partners?', 'Bengal IT Hub partners across '.count($content['categories']).' categories: '.collect($content['categories'])->pluck('name')->join(', ', ', and ').'.'],
        ['How does partnership with Bengal IT Hub work?', collect($content['process'])->pluck('title')->join(' → ').' — a straightforward path from first conversation to a working, growing partnership.'],
        ['How can I become a partner?', 'Start a conversation through the contact page with a Partnership interest, and the team will follow up to map out scope and fit.'],
    ];
@endphp
<section class="bih-section bg-white">
    <div class="bih-container max-w-3xl">
        <p class="bih-eyebrow">Common Questions</p>
        <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Partners FAQ</h2>
        <div class="mt-8 grid gap-4">
            @foreach($bihPartnerFaqs as [$question, $answer])
                <details class="group rounded-xl border border-slate-200 bg-slate-50 p-4 transition duration-300 open:border-teal-600/30 open:bg-white open:shadow-sm">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-3 font-extrabold text-slate-950">
                        {{ $question }}
                        <svg class="h-4 w-4 flex-none text-teal-700 transition duration-300 group-open:rotate-180" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </summary>
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
            'mainEntity' => collect($bihPartnerFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
