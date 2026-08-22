@extends('layouts.app')

@php
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($article->title);
@endphp

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Tech Innovation Show View (Light & Dark Mode Support)
     Scoped strictly under [data-tech-show]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-tech-show] {
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
    --bs-tint:        #D8E9EC;
    --bs-radius-sm:   8px;
    --bs-radius-md:   16px;
    --bs-radius-lg:   28px;
    --bs-radius-pill: 999px;
    --bs-shadow-sm:   0 1px 3px rgba(10,31,40,.08);
    --bs-shadow-md:   0 12px 32px rgba(10,31,40,.10);
    --bs-shadow-lg:   0 28px 64px rgba(10,31,40,.18);
    font-family: 'Inter', sans-serif;
    color: var(--bs-text);
    background-color: var(--bs-bg);
    transition: background-color 260ms ease, color 260ms ease;
}

/* ---------- Dark mode (when html.dark or [data-theme="dark"]) ---------- */
html.dark [data-tech-show],
[data-theme="dark"] [data-tech-show] {
    --bs-ink:         #0A1F28;
    --bs-primary:     #4F9BB8;
    --bs-primary-lt:  #6FB6D0;
    --bs-gold:        #E8AA3D;
    --bs-gold-lt:     #F5C978;
    --bs-text:        #EAF4F6;
    --bs-muted:       #93B2BA;
    --bs-border:      #21454F;
    --bs-surface:     #123039;
    --bs-surface-alt: #163944;
    --bs-bg:          #0A1F28;
    --bs-tint:        #16414C;
    --bs-shadow-sm:   0 1px 3px rgba(0,0,0,0.4);
    --bs-shadow-md:   0 12px 32px rgba(0,0,0,0.5);
    --bs-shadow-lg:   0 28px 64px rgba(0,0,0,0.6);
    color-scheme: dark;
}

[data-tech-show] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- breadcrumb ---------- */
[data-tech-show] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-tech-show] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-tech-show] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-tech-show] .bs-breadcrumb .sep { opacity: .5; }
[data-tech-show] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- cards & badges ---------- */
[data-tech-show] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 24px 20px;
    box-shadow: var(--bs-shadow-sm);
}
[data-tech-show] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 14px;
    width: fit-content;
}
[data-tech-show] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
}
html.dark [data-tech-show] .bs-badge-outline,
[data-theme="dark"] [data-tech-show] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

[data-tech-show] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-tech-show] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

[data-tech-show] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-tech-show] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-tech-show] .bs-btn-outline,
[data-theme="dark"] [data-tech-show] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-tech-show] .bs-btn-outline:hover,
[data-theme="dark"] [data-tech-show] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

[data-tech-show] .bs-section { padding: 40px 0 80px; }
</style>

<div data-tech-show>
    <div class="bih-container" style="padding-top: 1.5rem; padding-bottom: 0;">
        <nav class="bs-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('tech-innovation.index') }}">Tech Innovation</a>
            <span class="sep">/</span>
            @if($article->category)
                <a href="{{ route('tech-innovation.index', ['category' => $article->category->slug]) }}">{{ $article->category->name }}</a>
                <span class="sep">/</span>
            @endif
            <span class="current">{{ Str::limit($article->title, 50) }}</span>
        </nav>
    </div>

    <section class="bs-section" style="padding-top: 16px;">
        <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.34fr] lg:items-start">
            <article>
                <span class="bs-badge-tag">{{ $article->category?->name ?? 'Technology' }}</span>
                <h1 style="font-family: 'Fraunces', serif; font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 600; line-height: 1.2; color: var(--bs-text); margin: 0 0 16px;">{{ $article->title }}</h1>

                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 12px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: var(--bs-muted); margin-bottom: 24px;">
                    @if($article->source)
                        <span>{{ $article->source->name }}</span>
                        <span>&middot;</span>
                    @endif
                    @if($article->author)
                        <span>By {{ $article->author }}</span>
                        <span>&middot;</span>
                    @endif
                    <time datetime="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">{{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</time>
                    <span>&middot;</span>
                    <span>{{ number_format($article->views_count) }} views</span>
                </div>

                @if($article->image)
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" style="width: 100%; max-height: 440px; object-fit: cover; border-radius: var(--bs-radius-lg); box-shadow: var(--bs-shadow-md); border: 1px solid var(--bs-border); margin-bottom: 24px;">
                @endif

                @if($article->description)
                    <p style="font-size: 1.15rem; line-height: 1.8; color: var(--bs-text); font-weight: 500; margin-bottom: 20px;">{{ $article->description }}</p>
                @endif

                @if($article->content)
                    <div style="display: grid; gap: 16px; font-size: 1.02rem; line-height: 1.85; color: var(--bs-muted);">
                        @foreach(explode("\n\n", $article->content) as $paragraph)
                            @continue(trim($paragraph) === '')
                            <p style="margin: 0;">{{ trim($paragraph) }}</p>
                        @endforeach
                    </div>
                @endif

                <div style="margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--bs-border); display: flex; flex-wrap: wrap; align-items: center; gap: 12px;">
                    <a href="{{ $article->original_url }}" target="_blank" rel="noopener nofollow" class="bs-btn-gold">Read Original Article</a>
                    <a href="{{ route('tech-innovation.index') }}" class="bs-btn-outline">Back to Tech Innovation</a>
                </div>

                <div style="margin-top: 20px; display: flex; align-items: center; gap: 12px; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 700; color: var(--bs-muted);">
                    <span>Share:</span>
                    <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" rel="noopener" style="color: var(--bs-primary); text-decoration: none;">X</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" style="color: var(--bs-primary); text-decoration: none;">Facebook</a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" style="color: var(--bs-primary); text-decoration: none;">LinkedIn</a>
                    <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener" style="color: var(--bs-primary); text-decoration: none;">WhatsApp</a>
                </div>
            </article>

            <aside style="display: grid; gap: 24px;">
                <div class="bs-card">
                    <span class="bs-badge-outline" style="margin-bottom: 8px;">Source</span>
                    <p style="font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 600; color: var(--bs-text); margin: 6px 0 10px;">{{ $article->source?->name ?? 'Bengal IT Hub' }}</p>
                    <a href="{{ $article->original_url }}" target="_blank" rel="noopener nofollow" style="color: var(--bs-primary); font-family: 'Outfit', sans-serif; font-size: 0.86rem; font-weight: 800; text-decoration: none;">Visit Original Source &rarr;</a>
                </div>

                @if($related->isNotEmpty())
                    <div class="bs-card">
                        <span class="bs-badge-outline" style="margin-bottom: 12px;">Related Articles</span>
                        <div style="display: grid; gap: 14px;">
                            @foreach($related as $item)
                                <a href="{{ route('tech-innovation.show', $item->slug) }}" style="display: flex; gap: 12px; text-decoration: none; color: var(--bs-text); transition: color .2s;">
                                    @if($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width: 56px; height: 56px; border-radius: 8px; object-fit: cover; flex-shrink: 0; border: 1px solid var(--bs-border);">
                                    @else
                                        <span style="display: grid; place-items: center; width: 56px; height: 56px; border-radius: 8px; background: var(--bs-surface-alt); font-weight: 800; font-size: 1rem; color: var(--bs-primary); flex-shrink: 0; border: 1px solid var(--bs-border);">{{ Str::substr($item->source?->name ?? 'BIH', 0, 1) }}</span>
                                    @endif
                                    <span style="font-size: 0.86rem; font-weight: 700; line-height: 1.5;">{{ Str::limit($item->title, 65) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>

    @include('partials.internal-links', [
        'links' => $internalLinks ?? [],
        'title' => 'Related Services, Blogs, And Case Studies',
        'intro' => 'Move from this technology article into connected Bengal IT Hub services, product capabilities, blogs, and proof pages.',
    ])
</div>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article->title,
            'description' => $article->description,
            'image' => $article->image ? [$article->image] : [],
            'datePublished' => optional($article->published_at)->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'author' => ['@type' => 'Person', 'name' => $article->author ?: ($article->source?->name ?? 'Bengal IT Hub')],
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
        ['name' => 'Tech Innovation', 'url' => route('tech-innovation.index')],
        ['name' => $article->title, 'url' => url()->current()],
    ]])
@endpush
@endsection
