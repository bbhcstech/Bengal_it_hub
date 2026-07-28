@extends('layouts.app')

@section('content')
<section class="bih-techbiz-hero bg-white pt-12 pb-10 md:pt-16">
    <div class="bih-container grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-center">
        <div class="lg:col-span-8">
            <p class="bih-eyebrow">{{ $techbiz['intro']['eyebrow'] }}</p>
            <h1 class="bih-page-title mt-4 text-5xl md:text-6xl">{{ $techbiz['intro']['title'] }}</h1>
            @foreach($techbiz['intro']['body'] as $paragraph)
                <p class="bih-page-intro mt-5">{{ $paragraph }}</p>
            @endforeach
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="#conversations">Explore Conversations</a>
                <a class="inline-flex min-h-11 items-center justify-center rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="/contact">Start a Conversation</a>
            </div>
        </div>
        <div class="lg:col-span-4">
            <div class="bih-card bih-techbiz-brief overflow-hidden">
                <div class="bih-techbiz-brief-head bg-linear-to-r from-teal-800 to-teal-600 px-5 py-3.5">
                    <p class="text-xs font-black uppercase tracking-wide text-white">What This Page Covers</p>
                </div>
                <div class="grid gap-3 p-5">
                    @foreach($techbiz['categories'] as $category)
                        <div class="bih-techbiz-brief-item flex items-center gap-3">
                            <span class="grid h-9 w-9 flex-none place-items-center rounded-full bg-teal-50 text-teal-700">
                                @include('partials.icon', ['name' => $category['icon']])
                            </span>
                            <p class="text-sm font-extrabold leading-tight text-slate-900">{{ $category['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bih-techbiz-covers bih-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">What TechBiz Covers</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Four Kinds Of Conversations We Share</h2>
            <p class="bih-page-intro mt-5">Every update here falls into one of these categories, so you can find what matters to you quickly.</p>
        </div>
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($techbiz['categories'] as $category)
                <article class="bih-card bih-techbiz-cover-card p-6">
                    <span class="bih-techbiz-cover-icon grid h-12 w-12 place-items-center rounded-md bg-teal-700 text-white">
                        @include('partials.icon', ['name' => $category['icon']])
                    </span>
                    <h3 class="mt-4 text-lg font-black text-slate-950">{{ $category['title'] }}</h3>
                    <p class="bih-copy mt-3 text-sm">{{ $category['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="conversations" class="bih-techbiz-conversations bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">The Conversations Behind Our Work</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Meetings, Milestones, and Collaboration</h2>
            <p class="bih-page-intro mt-5">A look at the kind of work sessions, reviews, and partner conversations that shape Bengal IT Hub day to day.</p>
        </div>

        <div class="bih-techbiz-filter mt-8 flex flex-wrap gap-2">
            <button type="button" class="bih-filter-btn is-active" data-product-filter="all">All Updates</button>
            @foreach($techbiz['categories'] as $category)
                <button type="button" class="bih-filter-btn" data-product-filter="{{ Str::slug($category['title']) }}">{{ $category['title'] }}</button>
            @endforeach
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($techbiz['conversations'] as $item)
                <article data-product-card data-segment="{{ Str::slug($item['tag']) }}" class="bih-card bih-techbiz-update-card bih-image-card flex flex-col overflow-hidden">
                    <div class="bih-techbiz-update-image">
                        <img class="h-44 w-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['title'] }} at Bengal IT Hub">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <p class="bih-eyebrow">{{ $item['tag'] }}</p>
                        <h3 class="bih-section-title mt-2 text-lg">{{ $item['title'] }}</h3>
                        <p class="bih-copy mt-3 flex-1 text-sm">{{ $item['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <p data-product-empty class="mt-8 hidden text-center font-bold text-slate-500">No updates found in this category yet.</p>
    </div>
</section>

<section class="bih-techbiz-cta bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase text-amber-300">Let's Talk Technology</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-4xl font-black leading-tight text-white md:text-5xl">Have a partnership, project, or idea to discuss?</h2>
        <p class="mx-auto mt-4 max-w-2xl leading-8 text-white/82">Whether it is a technology partnership, a product idea, or an academic collaboration, TechBiz starts with a conversation. Let's have it.</p>
        <a class="bih-button mt-8 inline-flex" href="/contact">Start a Conversation</a>
    </div>
</section>
@endsection
