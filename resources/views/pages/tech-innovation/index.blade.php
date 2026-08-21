@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Tech Innovation Hub Page (Light & Dark Mode Support)
     Scoped strictly under [data-tech-innovation]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-tech-innovation] {
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
html.dark [data-tech-innovation],
[data-theme="dark"] [data-tech-innovation] {
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

[data-tech-innovation] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-tech-innovation] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-tech-innovation] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsTechInnoMarquee 32s linear infinite;
}
[data-tech-innovation] .bs-marquee-track span {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 0.84rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #9DC3CC;
    padding: 0 28px;
    display: inline-flex;
    align-items: center;
    gap: 28px;
    white-space: nowrap;
}
[data-tech-innovation] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsTechInnoMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-tech-innovation] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-tech-innovation] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-tech-innovation] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-tech-innovation] .bs-breadcrumb .sep { opacity: .5; }
[data-tech-innovation] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-tech-innovation] .bs-page-hero {
    padding: 64px 0 42px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-tech-innovation] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-tech-innovation] .bs-page-hero p.lead {
    max-width: 720px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-tech-innovation] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-tech-innovation] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-tech-innovation] .bs-eyebrow,
[data-theme="dark"] [data-tech-innovation] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-tech-innovation] .bs-eyebrow .dot,
[data-theme="dark"] [data-tech-innovation] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-tech-innovation] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-tech-innovation] .bs-section { padding: 60px 0 90px; position: relative; }
[data-tech-innovation] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

/* ---------- search form ---------- */
[data-tech-innovation] .bs-search-form {
    display: flex; gap: 10px; max-width: 680px; margin-top: 28px; flex-wrap: wrap;
}
[data-tech-innovation] .bs-search-input {
    flex: 1; min-width: 240px; padding: 13px 20px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid var(--bs-border); background: var(--bs-surface);
    color: var(--bs-text); font-family: 'Inter', sans-serif; font-size: 0.95rem;
    outline: none; transition: border-color 0.2s, box-shadow 0.2s;
}
[data-tech-innovation] .bs-search-input:focus {
    border-color: var(--bs-primary); box-shadow: 0 0 0 3px rgba(30,74,95,0.15);
}
html.dark [data-tech-innovation] .bs-search-input:focus,
[data-theme="dark"] [data-tech-innovation] .bs-search-input:focus {
    border-color: var(--bs-gold); box-shadow: 0 0 0 3px rgba(232,170,61,0.2);
}

/* ---------- filter pills & controls ---------- */
[data-tech-innovation] .bs-filter-row {
    display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 24px;
}
[data-tech-innovation] .bs-filter-pill {
    font-family: 'Outfit', sans-serif; font-size: 0.85rem; font-weight: 700;
    padding: 8px 18px; border-radius: var(--bs-radius-pill);
    background-color: var(--bs-surface); border: 1.5px solid var(--bs-border);
    color: var(--bs-muted); cursor: pointer; text-decoration: none;
    transition: all 0.22s ease;
}
[data-tech-innovation] .bs-filter-pill:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-1px);
}
[data-tech-innovation] .bs-filter-pill.active {
    background-color: var(--bs-primary); border-color: var(--bs-primary); color: #ffffff;
    box-shadow: 0 4px 14px rgba(30,74,95,.25);
}
html.dark [data-tech-innovation] .bs-filter-pill,
[data-theme="dark"] [data-tech-innovation] .bs-filter-pill {
    background-color: #123039; border-color: #21454F; color: #93B2BA;
}
html.dark [data-tech-innovation] .bs-filter-pill:hover,
[data-theme="dark"] [data-tech-innovation] .bs-filter-pill:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}
html.dark [data-tech-innovation] .bs-filter-pill.active,
[data-theme="dark"] [data-tech-innovation] .bs-filter-pill.active {
    background-color: rgba(232,170,61,0.18); border-color: var(--bs-gold);
    color: var(--bs-gold-lt); box-shadow: 0 4px 14px rgba(0,0,0,.4);
}

[data-tech-innovation] .bs-select {
    padding: 8px 16px; border-radius: var(--bs-radius-pill); border: 1.5px solid var(--bs-border);
    background: var(--bs-surface); color: var(--bs-text); font-family: 'Outfit', sans-serif;
    font-size: 0.85rem; font-weight: 600; outline: none; cursor: pointer;
}

/* ---------- featured article card ---------- */
[data-tech-innovation] .bs-feature-card {
    background: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-lg); overflow: hidden; box-shadow: var(--bs-shadow-md);
    display: grid; grid-template-columns: 1.1fr 0.9fr; text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
    margin-bottom: 48px;
}
@media (max-width: 900px) {
    [data-tech-innovation] .bs-feature-card { grid-template-columns: 1fr; }
}
[data-tech-innovation] .bs-feature-card:hover {
    transform: translateY(-4px); box-shadow: var(--bs-shadow-lg);
    border-color: rgba(232,170,61,0.45);
}
[data-tech-innovation] .bs-feature-media { height: 100%; min-height: 280px; position: relative; overflow: hidden; }
[data-tech-innovation] .bs-feature-media img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
[data-tech-innovation] .bs-feature-card:hover .bs-feature-media img { transform: scale(1.04); }
[data-tech-innovation] .bs-feature-body { padding: 40px 36px; display: flex; flex-direction: column; justify-content: center; }

/* ---------- news cards & grid ---------- */
[data-tech-innovation] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 0; overflow: hidden;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-tech-innovation] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-tech-innovation] .bs-card-media { height: 190px; position: relative; overflow: hidden; }
[data-tech-innovation] .bs-card-media img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
[data-tech-innovation] .bs-card:hover .bs-card-media img { transform: scale(1.05); }
[data-tech-innovation] .bs-card-body { padding: 22px 20px; display: flex; flex-direction: column; flex: 1; }

[data-tech-innovation] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 4px 10px; border-radius: var(--bs-radius-pill); width: fit-content;
}
[data-tech-innovation] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill); width: fit-content;
}
html.dark [data-tech-innovation] .bs-badge-outline,
[data-theme="dark"] [data-tech-innovation] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- sidebar items ---------- */
[data-tech-innovation] .bs-sidebar-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 24px 20px; box-shadow: var(--bs-shadow-sm);
}
[data-tech-innovation] .bs-sidebar-item {
    display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--bs-border);
    text-decoration: none; color: var(--bs-text); transition: color .2s;
}
[data-tech-innovation] .bs-sidebar-item:last-child { border-bottom: none; padding-bottom: 0; }
[data-tech-innovation] .bs-sidebar-item:first-child { padding-top: 0; }
[data-tech-innovation] .bs-sidebar-item:hover { color: var(--bs-gold); }
[data-tech-innovation] .bs-sidebar-item .num {
    width: 28px; height: 28px; border-radius: 6px; background: var(--bs-surface-alt);
    display: grid; place-items: center; font-family: 'Outfit', sans-serif;
    font-weight: 800; font-size: 0.78rem; color: var(--bs-primary); flex-shrink: 0;
}
html.dark [data-tech-innovation] .bs-sidebar-item .num,
[data-theme="dark"] [data-tech-innovation] .bs-sidebar-item .num {
    background: #163944; color: var(--bs-gold-lt);
}

/* ---------- FAQ Accordion ---------- */
[data-tech-innovation] .bs-faq-item {
    background: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); margin-bottom: 14px; overflow: hidden;
    transition: border-color .22s, box-shadow .22s;
}
[data-tech-innovation] .bs-faq-item.is-open {
    border-color: rgba(232,170,61,.5); box-shadow: var(--bs-shadow-sm);
}
[data-tech-innovation] .bs-faq-question {
    width: 100%; text-align: left; background: none; border: none;
    padding: 20px 24px; display: flex; align-items: center; justify-content: space-between;
    gap: 16px; cursor: pointer; font-family: 'Fraunces', serif;
    font-size: 1.12rem; font-weight: 600; color: var(--bs-text);
}
[data-tech-innovation] .bs-faq-question:hover { color: var(--bs-primary); }
html.dark [data-tech-innovation] .bs-faq-question:hover,
[data-theme="dark"] [data-tech-innovation] .bs-faq-question:hover { color: var(--bs-gold-lt); }
[data-tech-innovation] .bs-faq-icon {
    width: 28px; height: 28px; border-radius: 50%; background: var(--bs-surface-alt);
    display: grid; place-items: center; font-family: 'Outfit', sans-serif;
    font-size: 1.1rem; font-weight: 700; color: var(--bs-gold); flex-shrink: 0;
    transition: transform .26s ease;
}
[data-tech-innovation] .bs-faq-item.is-open .bs-faq-icon {
    transform: rotate(45deg); background: var(--bs-gold); color: #12242B;
}
[data-tech-innovation] .bs-faq-answer {
    max-height: 0; overflow: hidden; transition: max-height .32s cubic-bezier(0, 1, 0, 1);
    padding: 0 24px;
}
[data-tech-innovation] .bs-faq-item.is-open .bs-faq-answer {
    max-height: 500px; padding-bottom: 22px;
}
[data-tech-innovation] .bs-faq-answer p {
    margin: 0; font-size: .95rem; line-height: 1.75; color: var(--bs-muted);
}

/* ---------- CTA Banner ---------- */
[data-tech-innovation] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-tech-innovation] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-tech-innovation] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-tech-innovation] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-tech-innovation] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-tech-innovation] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-tech-innovation] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
}
[data-tech-innovation] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary);
}
html.dark [data-tech-innovation] .bs-btn-outline,
[data-theme="dark"] [data-tech-innovation] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-tech-innovation] .bs-btn-outline:hover,
[data-theme="dark"] [data-tech-innovation] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-tech-innovation] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-tech-innovation] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-tech-innovation>
    {{-- ── Marquee Strip ── --}}
    <div class="bs-marquee-strip" aria-hidden="true">
        <div class="bs-marquee-track">
            <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
            <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
        </div>
    </div>

    {{-- ── Breadcrumb ── --}}
    <div class="bs-container" style="padding-top: 1.5rem; padding-bottom: 0;">
        <nav class="bs-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <span class="current">Tech Innovation</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                Tech Talk
            </span>
            <h1>Technology News, Trends, And Future-Ready Signals</h1>
            <p class="lead">A centralized technology news hub bringing together the latest AI, software, cloud, cybersecurity, developer, and business technology news from trusted sources, updated automatically, all in one place.</p>

            <form method="GET" action="{{ route('tech-innovation.index') }}" class="bs-search-form">
                @if(!empty($filters['category']))<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
                @if(!empty($filters['source']))<input type="hidden" name="source" value="{{ $filters['source'] }}">@endif
                @if(!empty($filters['sort']))<input type="hidden" name="sort" value="{{ $filters['sort'] }}">@endif
                <input class="bs-search-input" type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search technology news by title, keyword, or category...">
                <button class="bs-btn-gold" type="submit">Search</button>
            </form>
        </div>
    </section>

    {{-- ── Featured Article ── --}}
    @if($featured && empty($filters['q']) && empty($filters['category']) && empty($filters['source']) && $news->currentPage() === 1)
        <section style="padding-bottom: 24px;">
            <div class="bs-container">
                <span class="bs-eyebrow" style="margin-bottom: 16px;"><span class="dot"></span> Featured Story</span>
                <a href="{{ route('tech-innovation.show', $featured->slug) }}" class="bs-feature-card reveal">
                    <div class="bs-feature-media">
                        <img src="{{ $featured->image }}" alt="{{ $featured->title }}" loading="lazy">
                    </div>
                    <div class="bs-feature-body">
                        <span class="bs-badge-tag" style="margin-bottom: 14px;">{{ $featured->category?->name ?? 'Technology' }}</span>
                        <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.6rem, 2.5vw, 2.1rem); font-weight: 600; line-height: 1.25; margin: 0 0 12px; color: var(--bs-text);">{{ $featured->title }}</h2>
                        @if($featured->description)
                            <p style="font-size: 0.98rem; line-height: 1.7; color: var(--bs-muted); margin-bottom: 18px;">{{ Str::limit($featured->description, 180) }}</p>
                        @endif
                        <p style="font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: var(--bs-muted); margin: 0;">
                            {{ $featured->source?->name }} &middot; <time datetime="{{ $featured->published_at?->toIso8601String() }}">{{ $featured->published_at?->diffForHumans() }}</time>
                        </p>
                    </div>
                </a>
            </div>
        </section>
    @endif

    {{-- ── Main Feed & Sidebar ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            {{-- Category Filter Pills --}}
            <div class="bs-filter-row">
                <a href="{{ request()->fullUrlWithQuery(['category' => null, 'page' => null]) }}" class="bs-filter-pill {{ empty($filters['category']) ? 'active' : '' }}">All</a>
                @foreach($categories as $category)
                    <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'page' => null]) }}" class="bs-filter-pill {{ ($filters['category'] ?? null) === $category->slug ? 'active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </div>

            {{-- Controls Form --}}
            <form method="GET" action="{{ route('tech-innovation.index') }}" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center; margin-bottom: 32px;">
                @if(!empty($filters['q']))<input type="hidden" name="q" value="{{ $filters['q'] }}">@endif
                @if(!empty($filters['category']))<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
                <label style="font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: var(--bs-muted); display: flex; align-items: center; gap: 8px;">
                    Source
                    <select class="bs-select" name="source" onchange="this.form.submit()">
                        <option value="">All Sources</option>
                        @foreach($sources as $source)
                            <option value="{{ $source->slug }}" @selected(($filters['source'] ?? null) === $source->slug)>{{ $source->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label style="font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: var(--bs-muted); display: flex; align-items: center; gap: 8px;">
                    Sort
                    <select class="bs-select" name="sort" onchange="this.form.submit()">
                        <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Latest</option>
                        <option value="oldest" @selected(($filters['sort'] ?? '') === 'oldest')>Oldest</option>
                        <option value="trending" @selected(($filters['sort'] ?? '') === 'trending')>Trending</option>
                        <option value="most-viewed" @selected(($filters['sort'] ?? '') === 'most-viewed')>Most Viewed</option>
                    </select>
                </label>
            </form>

            {{-- 2-Column Grid: Articles + Sidebar --}}
            <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(280px, 320px); gap: 36px; align-items: start;">
                <div>
                    @if($news->isEmpty())
                        <div class="bs-card" style="padding: 40px; text-align: center; font-weight: 700; color: var(--bs-muted);">
                            No articles found. Try a different search or filter.
                        </div>
                    @else
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 20px;">
                            @foreach($news as $article)
                                @include('partials.tech-news-card', ['article' => $article])
                            @endforeach
                        </div>
                        <div style="margin-top: 36px;">{{ $news->links() }}</div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside style="display: grid; gap: 24px;">
                    @if($trending->isNotEmpty())
                        <div class="bs-sidebar-card reveal">
                            <span class="bs-eyebrow" style="margin-bottom: 12px;"><span class="dot"></span> Trending</span>
                            <h3 style="font-family: 'Fraunces', serif; font-size: 1.25rem; font-weight: 600; margin: 0 0 16px; color: var(--bs-text);">Trending This Week</h3>
                            <div>
                                @foreach($trending as $item)
                                    <a href="{{ route('tech-innovation.show', $item->slug) }}" class="bs-sidebar-item">
                                        <span class="num">0{{ $loop->iteration }}</span>
                                        <span style="font-size: 0.88rem; font-weight: 700; line-height: 1.5;">{{ Str::limit($item->title, 70) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($mostViewed->isNotEmpty())
                        <div class="bs-sidebar-card reveal">
                            <span class="bs-eyebrow" style="margin-bottom: 12px;"><span class="dot"></span> Popular</span>
                            <h3 style="font-family: 'Fraunces', serif; font-size: 1.25rem; font-weight: 600; margin: 0 0 16px; color: var(--bs-text);">Most Viewed</h3>
                            <div>
                                @foreach($mostViewed as $item)
                                    <a href="{{ route('tech-innovation.show', $item->slug) }}" class="bs-sidebar-item" style="justify-content: space-between;">
                                        <span style="font-size: 0.88rem; font-weight: 700; line-height: 1.5; flex: 1; padding-right: 8px;">{{ Str::limit($item->title, 60) }}</span>
                                        <span class="bs-badge-outline" style="font-size: 0.68rem; align-self: flex-start;">{{ number_format($item->views_count) }} views</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

    {{-- ── Tech Innovation FAQ Accordion ── --}}
    @php
        $bihTechFaqs = [
            ['What is Bengal IT Hub\'s Tech Innovation hub?', 'A centralized technology news hub that aggregates the latest AI, software, cloud, cybersecurity, and business technology news from multiple trusted sources, organized into '.$categories->count().' categories.'],
            ['How often is Tech Innovation updated?', 'New articles sync automatically roughly every 15 minutes, so the hub stays current without manual publishing.'],
            ['How many sources does Bengal IT Hub aggregate from?', $sources->count().' curated RSS sources feed into the hub.'],
            ['How many articles are in the Tech Innovation archive?', number_format($news->total()).' articles and counting, searchable and filterable by category and source.'],
        ];
    @endphp
    <section class="bs-section">
        <div class="bs-container" style="max-width: 820px;">
            <div style="text-align: center; margin-bottom: 40px;">
                <span class="bs-eyebrow"><span class="dot"></span> FAQ</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 600; color: var(--bs-text); margin: 6px 0 12px;">Tech Innovation FAQ</h2>
                <p style="color: var(--bs-muted); font-size: 1rem; margin: 0;">Everything you need to know about our aggregated technology radar.</p>
            </div>

            <div>
                @foreach($bihTechFaqs as [$question, $answer])
                    <div class="bs-faq-item {{ $loop->first ? 'is-open' : '' }} reveal">
                        <button type="button" class="bs-faq-question" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            <span>{{ $question }}</span>
                            <span class="bs-faq-icon">+</span>
                        </button>
                        <div class="bs-faq-answer">
                            <p>{{ $answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Stay Ahead of the Curve</h2>
                <p>Get curated technology insights, AI frameworks, and engineering updates delivered directly to you.</p>
                <a href="{{ route('contact') }}" class="bs-btn-gold">Connect With Our Team</a>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    // Accordion functionality
    var faqButtons = document.querySelectorAll('[data-tech-innovation] .bs-faq-question');
    faqButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.bs-faq-item');
            var isOpen = item.classList.contains('is-open');

            // Close others
            document.querySelectorAll('[data-tech-innovation] .bs-faq-item').forEach(function (other) {
                other.classList.remove('is-open');
                var otherBtn = other.querySelector('.bs-faq-question');
                if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                item.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Reveal animations
    var els = document.querySelectorAll('[data-tech-innovation] .reveal');
    if (!els.length) return;
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) {
                e.target.classList.add('in-view');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    els.forEach(function (el) { io.observe(el); });
})();
</script>

@endsection
