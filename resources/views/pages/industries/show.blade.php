@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Industry Detail Page (Light & Dark Mode Support)
     Scoped strictly under [data-industry]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-industry] {
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
html.dark [data-industry],
[data-theme="dark"] [data-industry] {
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

[data-industry] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-industry] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-industry] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsIndMarquee 32s linear infinite;
}
[data-industry] .bs-marquee-track span {
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
[data-industry] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsIndMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-industry] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-industry] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-industry] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-industry] .bs-breadcrumb .sep { opacity: .5; }
[data-industry] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-industry] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-industry] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-industry] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-industry] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-industry] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-industry] .bs-eyebrow,
[data-theme="dark"] [data-industry] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-industry] .bs-eyebrow .dot,
[data-theme="dark"] [data-industry] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-industry] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-industry] .bs-section { padding: 60px 0 90px; position: relative; }
[data-industry] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-industry] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-industry] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-industry] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-industry] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-industry] .bs-grid { display: grid; gap: 20px; }
[data-industry] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-industry] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
@media (max-width: 1024px) {
    [data-industry] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
    [data-industry] .bs-grid-2 { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    [data-industry] .bs-grid-3,
    [data-industry] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- hero side brief panel ---------- */
[data-industry] .bs-brief-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden; box-shadow: var(--bs-shadow-md);
}
[data-industry] .bs-brief-head {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    padding: 16px 20px; color: #fff;
}
[data-industry] .bs-brief-head p {
    font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 0; color: #fff;
}
[data-industry] .bs-brief-body { padding: 24px 20px; display: grid; gap: 16px; }
[data-industry] .bs-brief-stat {
    display: flex; align-items: center; gap: 14px;
}
[data-industry] .bs-brief-stat .stat-num {
    font-family: 'Fraunces', serif; font-size: 2rem; font-weight: 600;
    color: var(--bs-primary); line-height: 1; flex-shrink: 0; min-width: 48px;
}
html.dark [data-industry] .bs-brief-stat .stat-num,
[data-theme="dark"] [data-industry] .bs-brief-stat .stat-num {
    color: var(--bs-gold-lt);
}
[data-industry] .bs-brief-stat .stat-label {
    font-size: 0.88rem; font-weight: 700; color: var(--bs-text); line-height: 1.4;
}

/* ---------- cards & branch cards ---------- */
[data-industry] .bs-branch-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-industry] .bs-branch-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-industry] .bs-branch-media {
    position: relative; height: 180px; overflow: hidden;
}
[data-industry] .bs-branch-media img {
    width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease;
}
[data-industry] .bs-branch-card:hover .bs-branch-media img {
    transform: scale(1.05);
}
[data-industry] .bs-branch-num {
    position: absolute; top: 12px; right: 12px;
    background: rgba(10,31,40,0.85); color: #fff; font-family: 'Outfit', sans-serif;
    font-weight: 800; font-size: 0.72rem; padding: 3px 10px; border-radius: var(--bs-radius-pill);
    backdrop-filter: blur(4px);
}
[data-industry] .bs-branch-icon {
    position: absolute; bottom: 12px; left: 12px;
    width: 38px; height: 38px; border-radius: 8px;
    background: var(--bs-surface); color: var(--bs-primary);
    display: grid; place-items: center; box-shadow: var(--bs-shadow-sm);
}
html.dark [data-industry] .bs-branch-icon,
[data-theme="dark"] [data-industry] .bs-branch-icon {
    background: #163944; color: var(--bs-gold-lt);
}
[data-industry] .bs-branch-body {
    padding: 22px 20px; display: flex; flex-direction: column; flex: 1;
}
[data-industry] .bs-branch-body h3 {
    font-family: 'Fraunces', serif; font-size: 1.18rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 8px; line-height: 1.25;
}
[data-industry] .bs-branch-body p {
    font-size: 0.9rem; line-height: 1.7; color: var(--bs-muted); margin: 0; flex: 1;
}
[data-industry] .bs-branch-link {
    margin-top: 16px; padding-top: 12px; border-top: 1px solid var(--bs-border);
    display: inline-flex; align-items: center; gap: 6px; font-family: 'Outfit', sans-serif;
    font-size: 0.84rem; font-weight: 800; color: var(--bs-primary);
}
html.dark [data-industry] .bs-branch-link,
[data-theme="dark"] [data-industry] .bs-branch-link {
    color: var(--bs-gold-lt);
}

/* ---------- badge tags ---------- */
[data-industry] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-industry] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
    width: fit-content;
}
html.dark [data-industry] .bs-badge-outline,
[data-theme="dark"] [data-industry] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- CTA Banner ---------- */
[data-industry] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-industry] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-industry] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-industry] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-industry] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-industry] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-industry] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-industry] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-industry] .bs-btn-outline,
[data-theme="dark"] [data-industry] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-industry] .bs-btn-outline:hover,
[data-theme="dark"] [data-industry] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-industry] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-industry] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-industry>
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
            <a href="{{ route('industries.index') }}">Industries</a>
            <span class="sep">/</span>
            <span class="current">{{ $industry['name'] }}</span>
        </nav>
    </div>

    {{-- ── Page Hero with Side Panel ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <div class="bs-grid bs-grid-2" style="align-items: center; grid-template-columns: 1.15fr .85fr; gap: 36px;">
                <div>
                    <span class="bs-eyebrow">
                        <span class="dot"></span>
                        {{ $industry['kicker'] ?? $industry['name'] }}
                    </span>
                    <h1>{{ $industry['name'] }}</h1>
                    <p class="lead">{{ $industry['summary'] }}</p>
                    @if(!empty($industry['body']))
                        <p style="font-size: 1rem; line-height: 1.75; color: var(--bs-muted); margin-top: 14px;">{{ $industry['body'] }}</p>
                    @endif
                    <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px;">
                        <a href="/contact?interest={{ urlencode($industry['name']) }}" class="bs-btn-gold">Discuss Your Requirement</a>
                        <a href="#focus-areas" class="bs-btn-outline">Explore Focus Areas</a>
                    </div>
                </div>

                <div>
                    <div class="bs-brief-card reveal">
                        <div class="bs-brief-head">
                            <p>Digital Operating Layer</p>
                        </div>
                        <div class="bs-brief-body">
                            <div class="bs-brief-stat">
                                <span class="stat-num">{{ count($industry['subBranches'] ?? []) }}</span>
                                <span class="stat-label">Focused {{ Str::lower($industry['name']) }} solution areas</span>
                            </div>
                            <div class="bs-brief-stat">
                                <span class="stat-num">01</span>
                                <span class="stat-label">Connected workflow from lead discovery to operations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Focus Areas / Sub-Branches Grid ── --}}
    <section id="focus-areas" class="bs-section bs-section-alt" style="scroll-margin-top: 100px;">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Focus Areas</span>
                <h2>What We Deliver in {{ $industry['name'] }}</h2>
                <p>Specialized systems for the moments that matter most: discovery, sales, operations, maintenance, analytics, and automation.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($industry['subBranches'] as $branchSlug => $branch)
                    <a href="{{ route('industries.sub-show', [$slug, $branchSlug]) }}" class="bs-branch-card reveal">
                        <div class="bs-branch-media">
                            <img src="{{ $branch['image'] }}" alt="{{ $branch['name'] }}" loading="lazy" decoding="async">
                            <span class="bs-branch-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="bs-branch-icon">
                                @include('partials.icon', ['name' => $branch['icon'] ?? 'target'])
                            </span>
                        </div>
                        <div class="bs-branch-body">
                            <h3>{{ $branch['name'] }}</h3>
                            <p>{{ $branch['summary'] }}</p>
                            <span class="bs-branch-link">
                                Explore Focus Area &rarr;
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Ready to bring better digital flow to your {{ Str::lower($industry['name']) }} business?</h2>
                <p>Tell us about your project, operational bottleneck, or tech requirements and see how Bengal IT Hub can accelerate it.</p>
                <a href="/contact?interest={{ urlencode($industry['name']) }}" class="bs-btn-gold">Discuss Your Requirement</a>
            </div>
        </div>
    </section>

    @include('partials.internal-links', [
        'links' => $internalLinks ?? [],
        'title' => 'Related Solutions For '.$industry['name'],
        'intro' => 'Explore adjacent services, product lines, articles, and proof pages connected to this industry.',
    ])
</div>

<script>
(function () {
    // Reveal animations
    var els = document.querySelectorAll('[data-industry] .reveal');
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

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $industry['name'].' Technology Solutions',
            'description' => $industry['summary'],
            'url' => url()->current(),
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Industries', 'url' => route('industries.index')],
        ['name' => $industry['name'], 'url' => url()->current()],
    ]])
@endpush
@endsection
