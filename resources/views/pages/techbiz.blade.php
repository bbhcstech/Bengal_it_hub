@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     TechBiz Page (Light & Dark Mode Support)
     Scoped strictly under [data-techbiz]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-techbiz] {
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
html.dark [data-techbiz],
[data-theme="dark"] [data-techbiz] {
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

[data-techbiz] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-techbiz] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-techbiz] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsTechbizMarquee 32s linear infinite;
}
[data-techbiz] .bs-marquee-track span {
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
[data-techbiz] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsTechbizMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-techbiz] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-techbiz] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-techbiz] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-techbiz] .bs-breadcrumb .sep { opacity: .5; }
[data-techbiz] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-techbiz] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-techbiz] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-techbiz] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-techbiz] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-techbiz] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-techbiz] .bs-eyebrow,
[data-theme="dark"] [data-techbiz] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-techbiz] .bs-eyebrow .dot,
[data-theme="dark"] [data-techbiz] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-techbiz] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-techbiz] .bs-section { padding: 60px 0 90px; position: relative; }
[data-techbiz] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-techbiz] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-techbiz] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-techbiz] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-techbiz] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-techbiz] .bs-grid { display: grid; gap: 20px; }
[data-techbiz] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-techbiz] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
[data-techbiz] .bs-grid-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 1024px) {
    [data-techbiz] .bs-grid-4 { grid-template-columns: repeat(2, 1fr); }
    [data-techbiz] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
    [data-techbiz] .bs-grid-2 { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    [data-techbiz] .bs-grid-4,
    [data-techbiz] .bs-grid-3,
    [data-techbiz] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- hero side brief panel ---------- */
[data-techbiz] .bs-brief-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden; box-shadow: var(--bs-shadow-md);
}
[data-techbiz] .bs-brief-head {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    padding: 16px 20px; color: #fff;
}
[data-techbiz] .bs-brief-head p {
    font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 0; color: #fff;
}
[data-techbiz] .bs-brief-body { padding: 18px 20px; display: grid; gap: 12px; }
[data-techbiz] .bs-brief-item {
    display: flex; align-items: center; gap: 12px; font-family: 'Outfit', sans-serif;
    font-size: 0.9rem; font-weight: 700; color: var(--bs-text);
}
[data-techbiz] .bs-brief-item span.icon-wrap {
    width: 36px; height: 36px; border-radius: 8px; background: var(--bs-surface-alt);
    display: flex; align-items: center; justify-content: center; color: var(--bs-primary);
    flex-shrink: 0; border: 1px solid var(--bs-border);
}
html.dark [data-techbiz] .bs-brief-item span.icon-wrap,
[data-theme="dark"] [data-techbiz] .bs-brief-item span.icon-wrap {
    color: var(--bs-gold-lt); background: #163944;
}

/* ---------- cards ---------- */
[data-techbiz] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 30px 24px;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-techbiz] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-techbiz] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.22rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .5em; letter-spacing: -.01em; line-height: 1.25;
}
[data-techbiz] .bs-card p {
    font-size: .92rem; line-height: 1.75; color: var(--bs-muted); margin: 0; flex: 1;
}

/* ---------- icon badge ---------- */
[data-techbiz] .bs-icon-badge {
    width: 52px; height: 52px; border-radius: var(--bs-radius-sm);
    background: linear-gradient(135deg, rgba(30,74,95,.14), rgba(232,170,61,.14));
    color: var(--bs-primary);
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
}
html.dark [data-techbiz] .bs-icon-badge,
[data-theme="dark"] [data-techbiz] .bs-icon-badge {
    background: linear-gradient(135deg, rgba(79, 155, 184, 0.2), rgba(232, 170, 61, 0.2));
    color: var(--bs-gold-lt);
}
[data-techbiz] .bs-icon-badge svg { width: 22px; height: 22px; }

/* ---------- filter pills ---------- */
[data-techbiz] .bs-filter-row {
    display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-bottom: 36px;
}
[data-techbiz] .bs-filter-pill {
    font-family: 'Outfit', sans-serif; font-size: 0.85rem; font-weight: 700;
    padding: 9px 20px; border-radius: var(--bs-radius-pill);
    background-color: var(--bs-surface); border: 1.5px solid var(--bs-border);
    color: var(--bs-muted); cursor: pointer; text-decoration: none;
    transition: all 0.22s ease;
}
[data-techbiz] .bs-filter-pill:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-1px);
}
[data-techbiz] .bs-filter-pill.active {
    background-color: var(--bs-primary); border-color: var(--bs-primary); color: #ffffff;
    box-shadow: 0 4px 14px rgba(30,74,95,.25);
}
html.dark [data-techbiz] .bs-filter-pill,
[data-theme="dark"] [data-techbiz] .bs-filter-pill {
    background-color: #123039; border-color: #21454F; color: #93B2BA;
}
html.dark [data-techbiz] .bs-filter-pill:hover,
[data-theme="dark"] [data-techbiz] .bs-filter-pill:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}
html.dark [data-techbiz] .bs-filter-pill.active,
[data-theme="dark"] [data-techbiz] .bs-filter-pill.active {
    background-color: rgba(232,170,61,0.18); border-color: var(--bs-gold);
    color: var(--bs-gold-lt); box-shadow: 0 4px 14px rgba(0,0,0,.4);
}

/* ---------- update cards ---------- */
[data-techbiz] .bs-update-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-techbiz] .bs-update-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-techbiz] .bs-update-media {
    position: relative; height: 190px; overflow: hidden;
}
[data-techbiz] .bs-update-media img {
    width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease;
}
[data-techbiz] .bs-update-card:hover .bs-update-media img {
    transform: scale(1.05);
}
[data-techbiz] .bs-update-counter {
    position: absolute; top: 12px; right: 12px;
    background: rgba(10,31,40,0.85); color: #fff; font-family: 'Outfit', sans-serif;
    font-weight: 800; font-size: 0.72rem; padding: 3px 10px; border-radius: var(--bs-radius-pill);
    backdrop-filter: blur(4px);
}
[data-techbiz] .bs-update-body {
    padding: 22px 20px; display: flex; flex-direction: column; flex: 1;
}

/* ---------- badge tags ---------- */
[data-techbiz] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-techbiz] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill); margin-bottom: 10px;
    width: fit-content;
}
html.dark [data-techbiz] .bs-badge-outline,
[data-theme="dark"] [data-techbiz] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- CTA Banner ---------- */
[data-techbiz] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-techbiz] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-techbiz] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-techbiz] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-techbiz] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-techbiz] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-techbiz] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-techbiz] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-techbiz] .bs-btn-outline,
[data-theme="dark"] [data-techbiz] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-techbiz] .bs-btn-outline:hover,
[data-theme="dark"] [data-techbiz] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-techbiz] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-techbiz] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-techbiz>
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
            <a href="{{ route('tech-innovation.index') }}">Tech Innovation</a>
            <span class="sep">/</span>
            <span class="current">TechBiz</span>
        </nav>
    </div>

    {{-- ── Page Hero with Side Panel ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <div class="bs-grid bs-grid-2" style="align-items: center; grid-template-columns: 1.15fr .85fr; gap: 36px;">
                <div>
                    <span class="bs-eyebrow">
                        <span class="dot"></span>
                        {{ $techbiz['intro']['eyebrow'] ?? 'Tech Talk' }}
                    </span>
                    <h1>{{ $techbiz['intro']['title'] ?? 'TechBiz' }}</h1>
                    @foreach($techbiz['intro']['body'] as $paragraph)
                        <p class="lead" style="margin-bottom: 12px;">{{ $paragraph }}</p>
                    @endforeach
                    <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px;">
                        <a href="#conversations" class="bs-btn-gold">Explore Conversations</a>
                        <a href="{{ route('contact') }}" class="bs-btn-outline">Start a Conversation</a>
                    </div>
                </div>

                <div>
                    <div class="bs-brief-card reveal">
                        <div class="bs-brief-head">
                            <p>What This Page Covers</p>
                        </div>
                        <div class="bs-brief-body">
                            @foreach($techbiz['categories'] as $category)
                                <div class="bs-brief-item">
                                    <span class="icon-wrap">
                                        @include('partials.icon', ['name' => $category['icon']])
                                    </span>
                                    <span>{{ $category['title'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Four Kinds Of Conversations (What TechBiz Covers) ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> What TechBiz Covers</span>
                <h2>Four Kinds Of Conversations We Share</h2>
                <p>Every update here falls into one of these categories, so you can find what matters to you quickly.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($techbiz['categories'] as $category)
                    <div class="bs-card reveal">
                        <div class="bs-icon-badge">
                            @include('partials.icon', ['name' => $category['icon']])
                        </div>
                        <h3>{{ $category['title'] }}</h3>
                        <p>{{ $category['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── The Conversations Behind Our Work ── --}}
    <section id="conversations" class="bs-section" style="scroll-margin-top: 100px;">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> The Conversations Behind Our Work</span>
                <h2>Meetings, Milestones, and Collaboration</h2>
                <p>A look at the kind of work sessions, reviews, and partner conversations that shape Bengal IT Hub day to day.</p>
            </div>

            {{-- Filter Pills --}}
            <div class="bs-filter-row reveal">
                <button type="button" class="bs-filter-pill active" data-tb-filter="all">All Updates</button>
                @foreach($techbiz['categories'] as $category)
                    <button type="button" class="bs-filter-pill" data-tb-filter="{{ Str::slug($category['title']) }}">{{ $category['title'] }}</button>
                @endforeach
            </div>

            {{-- Update Cards Grid --}}
            <div class="bs-grid bs-grid-3">
                @foreach($techbiz['conversations'] as $item)
                    <article data-tb-card data-segment="{{ Str::slug($item['tag']) }}" class="bs-update-card reveal">
                        <div class="bs-update-media">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                            <span class="bs-update-counter">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="bs-update-body">
                            <span class="bs-badge-outline">{{ $item['tag'] }}</span>
                            <h3 style="font-size: 1.15rem; margin-bottom: 8px;">{{ $item['title'] }}</h3>
                            <p style="font-size: 0.9rem; line-height: 1.7;">{{ $item['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <p data-tb-empty class="text-center font-bold" style="display: none; margin-top: 32px; color: var(--bs-muted);">No updates found in this category yet.</p>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Have a partnership, project, or idea to discuss?</h2>
                <p>Whether it is a technology partnership, a product idea, or an academic collaboration, TechBiz starts with a conversation. Let's have it.</p>
                <a href="{{ route('contact') }}" class="bs-btn-gold">Start a Conversation</a>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    // Filter pills
    var filterBtns = document.querySelectorAll('[data-techbiz] [data-tb-filter]');
    var cards = document.querySelectorAll('[data-techbiz] [data-tb-card]');
    var emptyMsg = document.querySelector('[data-techbiz] [data-tb-empty]');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var filter = btn.getAttribute('data-tb-filter');
            var visibleCount = 0;

            cards.forEach(function (card) {
                var segment = card.getAttribute('data-segment');
                if (filter === 'all' || segment === filter) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (emptyMsg) {
                emptyMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });

    // Reveal animations
    var els = document.querySelectorAll('[data-techbiz] .reveal');
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
