@extends('layouts.app')

@section('content')
@php
    $storySections = collect($blog['storySections'] ?? []);
    $configuredSectionSlugs = $storySections->pluck('slug');
    $extraSections = $categories->reject(fn ($category) => $configuredSectionSlugs->contains($category->slug));
@endphp

<section class="bih-blog-hero bg-white pt-14 pb-12 md:pt-20">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.44fr] lg:items-end">
        <div>
            <p class="bih-eyebrow">{{ $blog['intro']['eyebrow'] }}</p>
            <h1 class="bih-page-title mt-4 text-5xl leading-[1.05] md:text-7xl">{{ $blog['intro']['title'] }}</h1>
            @foreach($blog['intro']['body'] as $paragraph)
                <p class="bih-page-intro mt-5 max-w-3xl">{{ $paragraph }}</p>
            @endforeach
        </div>
        <div class="bih-blog-hero-panel">
            <p>Publish Anything</p>
            <div>
                <span>01</span>
                <strong>Birthday, interview, new joiner, function, event, culture, and company posts.</strong>
            </div>
            <div>
                <span>02</span>
                <strong>Admin-managed sections with featured images, status, dates, and SEO fields.</strong>
            </div>
        </div>
    </div>
    <div class="bih-container">
        <div class="bih-blog-nav mt-8 flex flex-wrap gap-2">
            <a href="#latest" class="bih-filter-btn">Latest Posts</a>
            @foreach($storySections as $section)
                <a href="#{{ $section['slug'] }}" class="bih-filter-btn">{{ $section['title'] }}</a>
            @endforeach
            @foreach($extraSections as $category)
                <a href="#{{ $category->slug }}" class="bih-filter-btn">{{ $category->name }}</a>
            @endforeach
            <a href="#events" class="bih-filter-btn">Events</a>
            <a href="#culture" class="bih-filter-btn">Life at Bengal IT Hub</a>
            <a href="#opportunities" class="bih-filter-btn">Opportunities</a>
        </div>
    </div>
</section>

{{-- Latest From the Blog --}}
<section id="latest" class="bih-section bih-blog-latest bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Latest From the Blog</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">Latest stories, updates, and people moments</h2>
            <p class="bih-page-intro mt-5">Every published admin post appears here first, then also flows into its matching section below.</p>
        </div>

        @if($posts->isNotEmpty())
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="bih-card bih-blog-post-card group relative flex flex-col overflow-hidden">
                        <span class="absolute inset-x-0 top-0 z-10 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                        @if($post->featured_image)
                            <img class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <div class="grid h-44 w-full place-items-center bg-linear-to-br from-teal-700 to-slate-950 text-3xl font-black text-white">{{ Str::substr($post->title, 0, 1) }}</div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            @if($post->category)
                                <p class="bih-eyebrow">{{ $post->category->name }}</p>
                            @endif
                            <h3 class="mt-2 text-xl font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $post->title }}</h3>
                            <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($post->body), 120) }}</p>
                            <time datetime="{{ $post->published_at?->toIso8601String() }}" class="mt-5 border-t border-slate-100 pt-4 text-xs font-black uppercase text-slate-500">{{ $post->published_at?->format('d M Y') }}</time>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_.6fr] lg:items-center">
                <div class="bih-card p-8">
                    <p class="bih-eyebrow">Coming Soon</p>
                    <h3 class="mt-2 text-2xl font-black text-slate-950">Our First Posts Are In The Works</h3>
                    <p class="bih-copy mt-4">We're preparing our first round of blog posts on technology, hiring, events, and company updates. Check back soon, or explore what's already live below.</p>
                    <a class="bih-button mt-6 inline-flex" href="/contact">Get Notified</a>
                </div>
                @if($categories->isNotEmpty())
                    <div class="bih-card p-8">
                        <p class="bih-eyebrow">Topics Coming Soon</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <span class="rounded-full border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-black text-slate-700">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>

{{-- Admin-Managed Blog Sections --}}
@foreach($storySections as $section)
    @php($items = $sectionPosts->get($section['slug'], collect()))
    <section id="{{ $section['slug'] }}" class="bih-section bih-blog-story-section {{ $loop->odd ? 'bg-white' : 'bg-slate-50' }}">
        <div class="bih-container">
            <div class="grid gap-8 lg:grid-cols-[.48fr_1fr] lg:items-start">
                <div>
                    <p class="bih-eyebrow">{{ $section['eyebrow'] }}</p>
                    <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">{{ $section['title'] }}</h2>
                    <p class="bih-page-intro mt-5">{{ $section['intro'] }}</p>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    @if($items->isNotEmpty())
                        @foreach($items->take(4) as $post)
                            <a href="{{ route('blog.show', $post->slug) }}" class="bih-card bih-blog-section-card group overflow-hidden">
                                @if($post->featured_image)
                                    <img class="h-52 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                                @else
                                    <div class="grid h-52 w-full place-items-center bg-linear-to-br from-teal-700 to-slate-950 text-3xl font-black text-white">{{ Str::substr($post->title, 0, 1) }}</div>
                                @endif
                                <div class="p-5">
                                    <p class="bih-eyebrow">{{ $post->category?->name }}</p>
                                    <h3 class="mt-2 text-lg font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $post->title }}</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($post->body), 110) }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                        @foreach($section['fallback'] as $fallback)
                            <article class="bih-card bih-blog-section-card overflow-hidden">
                                <img class="h-52 w-full object-cover" src="{{ $fallback['image'] }}" alt="{{ $fallback['title'] }} at Bengal IT Hub">
                                <div class="p-5">
                                    <p class="bih-eyebrow">Ready For Posts</p>
                                    <h3 class="mt-2 text-lg font-black leading-tight text-slate-950">{{ $fallback['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ $fallback['body'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endforeach

@foreach($extraSections as $category)
    @php($items = $sectionPosts->get($category->slug, collect()))
    <section id="{{ $category->slug }}" class="bih-section bih-blog-story-section bg-white">
        <div class="bih-container">
            <div class="max-w-3xl">
                <p class="bih-eyebrow">Custom Section</p>
                <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">{{ $category->name }}</h2>
                <p class="bih-page-intro mt-5">This section is controlled from the blog admin panel. Add posts with images under this category to fill it.</p>
            </div>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($items->take(6) as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="bih-card bih-blog-section-card group overflow-hidden">
                        @if($post->featured_image)
                            <img class="h-52 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <div class="grid h-52 w-full place-items-center bg-linear-to-br from-teal-700 to-slate-950 text-3xl font-black text-white">{{ Str::substr($post->title, 0, 1) }}</div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-lg font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $post->title }}</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($post->body), 110) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="bih-card p-6">
                        <p class="bih-eyebrow">Empty Section</p>
                        <h3 class="mt-2 text-xl font-black text-slate-950">Ready for {{ $category->name }} posts</h3>
                        <p class="bih-copy mt-3 text-sm">Create a post in the admin panel, assign it to this section, add a featured image, and publish it.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endforeach

{{-- Company Events --}}
<section id="events" class="bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Events</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">What We Host & Show Up For</h2>
            <p class="bih-page-intro mt-5">From our flagship hackathon to partner showcases, here's where Bengal IT Hub shows up in person.</p>
        </div>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($blog['events'] as $event)
                <a href="{{ $event['href'] }}" class="group relative flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-xl">
                    <div class="relative h-36 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $event['image'] }}" alt="{{ $event['title'] }} at Bengal IT Hub">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-slate-950/10 to-transparent"></div>
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="font-black leading-snug text-slate-950 transition group-hover:text-teal-700">{{ $event['title'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-6 text-slate-600">{{ $event['body'] }}</p>
                        <span class="mt-4 text-xs font-extrabold uppercase text-teal-700">{{ $event['cta'] }} &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Life at Bengal IT Hub / Culture --}}
<section id="culture" class="relative overflow-hidden bg-slate-950 py-16 text-white">
    <div class="bih-container relative">
        <div class="max-w-3xl">
            <p class="text-sm font-black uppercase tracking-wide text-amber-300">Life at Bengal IT Hub</p>
            <h2 class="mt-3 text-4xl font-black leading-tight tracking-tight md:text-5xl">More Than Just Work</h2>
            <p class="mt-5 max-w-2xl text-lg leading-8 text-white/80">Celebrations, festivals, milestones, and time spent together outside the sprint board.</p>
        </div>
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($blog['culture'] as $moment)
                <div class="group relative overflow-hidden rounded-lg">
                    <img class="h-56 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $moment['image'] }}" alt="{{ $moment['title'] }} at Bengal IT Hub">
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/90 via-slate-950/10 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <h3 class="font-black leading-snug text-white">{{ $moment['title'] }}</h3>
                        <p class="mt-1 text-xs leading-5 text-white/75">{{ $moment['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Awards & Recognition --}}
<section id="awards" class="bih-section bg-white">
    <div class="bih-container">
        <div class="grid gap-10 overflow-hidden rounded-lg border border-slate-200 shadow-sm lg:grid-cols-2">
            <div class="relative h-64 lg:h-full">
                <img class="h-full w-full object-cover" src="{{ $blog['awards']['image'] }}" alt="Awards and recognition at Bengal IT Hub">
                <div class="absolute inset-0 bg-linear-to-t from-slate-950/60 via-transparent to-transparent lg:bg-linear-to-r"></div>
            </div>
            <div class="flex flex-col justify-center p-8 md:p-10">
                <p class="bih-eyebrow">Awards & Recognition</p>
                <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">{{ $blog['awards']['title'] }}</h2>
                <p class="bih-copy mt-4">{{ $blog['awards']['body'] }}</p>
                <a class="bih-button mt-6 inline-flex w-fit" href="{{ $blog['awards']['href'] }}">View Awards & Recognition</a>
            </div>
        </div>
    </div>
</section>

{{-- Opportunities --}}
<section id="opportunities" class="bih-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Opportunities</p>
            <h2 class="bih-section-title mt-3 text-4xl leading-tight md:text-5xl">Grow With Bengal IT Hub</h2>
            <p class="bih-page-intro mt-5">Ways to learn, work, and partner with us as we build.</p>
        </div>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($blog['opportunities'] as $opportunity)
                <article class="bih-card p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-md bg-teal-700 text-white">
                        @include('partials.icon', ['name' => $opportunity['icon']])
                    </span>
                    <h3 class="mt-4 font-black text-slate-950">{{ $opportunity['title'] }}</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $opportunity['body'] }}</p>
                </article>
            @endforeach
        </div>
        <div class="mt-10 flex justify-center">
            <a class="bih-button" href="/contact?interest=Careers">Get In Touch About Opportunities</a>
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase text-amber-300">Stay Connected</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight md:text-4xl">Never miss what's happening at Bengal IT Hub</h2>
        <p class="mx-auto mt-4 max-w-xl leading-8 text-white/82">Newsletter sign-up is coming soon. Until then, this page is the best place to catch new posts, events, and updates.</p>
    </div>
</section>
@endsection
