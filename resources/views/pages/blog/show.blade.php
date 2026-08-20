@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Single Blog Post Page
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

[data-blog-post] {
    --bs-ink:         #0A1F28;
    --bs-primary:     #1E4A5F;
    --bs-primary-lt:  #2E7089;
    --bs-gold:        #E8AA3D;
    --bs-gold-lt:     #F5C978;
    --bs-text:        #0F262E;
    --bs-muted:       #52707A;
    --bs-border:      #DCE6E8;
    --bs-surface:     #FFFFFF;
    --bs-surface-alt: #E8F0F1;
    --bs-bg:          #F5F8F8;
    --bs-radius-sm:   8px;
    --bs-radius-md:   16px;
    --bs-radius-pill: 999px;
    --bs-shadow-sm:   0 1px 3px rgba(10,31,40,.08);
    --bs-shadow-md:   0 12px 32px rgba(10,31,40,.10);
    font-family: 'Inter', sans-serif;
    color: var(--bs-text);
    background-color: var(--bs-bg);
}

[data-blog-post] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-blog-post] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-blog-post] .bs-breadcrumb a:hover { color: var(--bs-primary); }
[data-blog-post] .bs-breadcrumb .sep { opacity: .5; }
[data-blog-post] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

[data-blog-post] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
}
[data-blog-post] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

[data-blog-post] .bs-post-title {
    font-family: 'Fraunces', serif;
    font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 600; line-height: 1.18;
    color: var(--bs-text); letter-spacing: -.01em; margin: 0 0 16px;
}

[data-blog-post] .bs-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 24px;
    box-shadow: var(--bs-shadow-sm);
}

[data-blog-post] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-blog-post] .bs-btn-gold:hover { background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35); transform: translateY(-2px); }
</style>

<div data-blog-post>
    <div class="bih-container" style="padding-top: 1.5rem; padding-bottom: 0;">
        <nav class="bs-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('blog.index') }}">Blog</a>
            @if($post->category)
                <span class="sep">/</span>
                <span>{{ $post->category->name }}</span>
            @endif
            <span class="sep">/</span>
            <span class="current">{{ Str::limit($post->title, 50) }}</span>
        </nav>
    </div>

    <section class="py-10" style="background: var(--bs-bg, #F5F8F8);">
        <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.34fr] lg:items-start">
            <article class="bg-white p-8 md:p-12 rounded-2xl border border-[#DCE6E8] shadow-sm">
                @if($post->category)
                    <span class="bs-eyebrow"><span class="dot"></span> {{ $post->category->name }}</span>
                @endif
                <h1 class="bs-post-title">{{ $post->title }}</h1>
                <time datetime="{{ $post->published_at?->toIso8601String() }}" class="block font-['Outfit'] text-xs font-bold uppercase tracking-wider text-[#52707A] mb-6">
                    {{ $post->published_at?->format('d M Y') }}
                </time>

                @if($post->featured_image)
                    <img class="w-full h-80 md:h-[420px] object-cover rounded-xl shadow-md my-6" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                @endif

                <div class="prose prose-slate max-w-none text-[#0F262E] text-base leading-relaxed space-y-4 font-['Inter']">
                    @foreach(explode("\n\n", strip_tags($post->body)) as $paragraph)
                        @continue(trim($paragraph) === '')
                        <p class="leading-8 text-[#52707A] text-lg">{{ trim($paragraph) }}</p>
                    @endforeach
                </div>

                <div class="mt-10 pt-6 border-t border-[#DCE6E8] flex items-center justify-between">
                    <a class="bs-btn-gold" href="{{ route('blog.index') }}">&larr; Back to Blog</a>
                </div>
            </article>

            <aside class="space-y-6">
                @if($related->isNotEmpty())
                    <div class="bs-card">
                        <span class="bs-eyebrow" style="margin-bottom: 14px;"><span class="dot"></span> More Reads</span>
                        <div class="space-y-4 mt-3">
                            @foreach($related as $item)
                                <a href="{{ route('blog.show', $item->slug) }}" class="flex gap-3.5 items-center group text-decoration-none">
                                    @if($item->featured_image)
                                        <img class="h-16 w-16 flex-none rounded-lg object-cover" src="{{ $item->featured_image }}" alt="{{ $item->title }}">
                                    @else
                                        <span class="grid h-16 w-16 flex-none place-items-center rounded-lg bg-[#E8F0F1] text-base font-bold text-[#1E4A5F]">{{ Str::substr($item->title, 0, 1) }}</span>
                                    @endif
                                    <span class="text-sm font-semibold text-[#0F262E] group-hover:text-[#1E4A5F] leading-snug transition-colors">{{ Str::limit($item->title, 70) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>
</div>

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Services, Articles, And Case Studies',
    'intro' => 'Keep following the topic through Bengal IT Hub services, technology articles, and proof pages.',
])

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'image' => ($post->og_image ?: $post->featured_image) ? [$post->og_image ?: $post->featured_image] : [],
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub'],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Bengal IT Hub',
                'url' => url('/'),
                'logo' => ['@type' => 'ImageObject', 'url' => asset('logo_bengal_it_hub.svg')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url()->current()],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => $post->title, 'url' => url()->current()],
    ]])
@endpush
@endsection
