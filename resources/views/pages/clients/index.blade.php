@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Our Clients Page (Light & Dark Mode Support)
     Scoped strictly under [data-clients]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-clients] {
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
html.dark [data-clients],
[data-theme="dark"] [data-clients] {
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

[data-clients] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-clients] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-clients] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsClientsMarquee 32s linear infinite;
}
[data-clients] .bs-marquee-track span {
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
[data-clients] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsClientsMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-clients] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-clients] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-clients] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-clients] .bs-breadcrumb .sep { opacity: .5; }
[data-clients] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-clients] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-clients] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-clients] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-clients] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-clients] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-clients] .bs-eyebrow,
[data-theme="dark"] [data-clients] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-clients] .bs-eyebrow .dot,
[data-theme="dark"] [data-clients] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-clients] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-clients] .bs-section { padding: 60px 0 90px; position: relative; }
[data-clients] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-clients] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-clients] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-clients] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-clients] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-clients] .bs-grid { display: grid; gap: 20px; }
[data-clients] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-clients] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
[data-clients] .bs-grid-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 1024px) {
    [data-clients] .bs-grid-4 { grid-template-columns: repeat(2, 1fr); }
    [data-clients] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    [data-clients] .bs-grid-4,
    [data-clients] .bs-grid-3,
    [data-clients] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- mini stats ---------- */
[data-clients] .bs-mini-stats {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 36px;
}
@media (max-width: 768px) { [data-clients] .bs-mini-stats { grid-template-columns: repeat(2, 1fr); } }
[data-clients] .bs-mini-stat {
    text-align: center; padding: 20px 14px;
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); box-shadow: var(--bs-shadow-sm);
}
[data-clients] .bs-mini-stat .num {
    font-family: 'Fraunces', serif; font-style: italic; font-weight: 600;
    font-size: 2rem; color: var(--bs-primary); line-height: 1.1; margin-bottom: 4px;
}
html.dark [data-clients] .bs-mini-stat .num,
[data-theme="dark"] [data-clients] .bs-mini-stat .num {
    color: var(--bs-gold-lt);
}
[data-clients] .bs-mini-stat .lbl {
    font-size: 0.78rem; color: var(--bs-muted); font-family: 'Outfit', sans-serif;
    font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
}

/* ---------- client chips (as in demo) ---------- */
[data-clients] .bs-client-chip {
    display: flex; align-items: center; gap: 14px; padding: 16px 18px;
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); box-shadow: var(--bs-shadow-sm);
    text-decoration: none; color: inherit;
    transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease;
}
[data-clients] .bs-client-chip:hover {
    transform: translateY(-3px);
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: var(--bs-shadow-md);
}
[data-clients] .bs-client-logo-fallback {
    width: 44px; height: 44px; border-radius: 10px;
    background-color: var(--bs-surface-alt);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.2rem;
    color: var(--bs-primary); flex-shrink: 0;
    overflow: hidden;
}
html.dark [data-clients] .bs-client-logo-fallback,
[data-theme="dark"] [data-clients] .bs-client-logo-fallback {
    color: var(--bs-gold-lt);
    background-color: #163944;
}
[data-clients] .bs-client-logo-fallback img {
    width: 100%; height: 100%; object-fit: cover;
}
[data-clients] .bs-client-meta strong {
    display: block; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 700;
    color: var(--bs-text); line-height: 1.25; margin-bottom: 2px;
}
[data-clients] .bs-client-meta span {
    font-size: 0.78rem; color: var(--bs-muted); font-family: 'Inter', sans-serif;
}

/* ---------- cards (featured work & directory) ---------- */
[data-clients] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 30px 24px;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-clients] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-clients] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.25rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .5em; letter-spacing: -.01em; line-height: 1.25;
}
[data-clients] .bs-card p {
    font-size: .92rem; line-height: 1.75; color: var(--bs-muted); margin: 0; flex: 1;
}
[data-clients] .bs-card a.cta-link {
    display: inline-flex; align-items: center; gap: .35rem;
    margin-top: 1.25rem; font-family: 'Outfit', sans-serif;
    font-weight: 700; font-size: .88rem; color: var(--bs-primary);
    text-decoration: none; transition: color .2s, gap .2s;
}
[data-clients] .bs-card a.cta-link:hover { color: var(--bs-gold); gap: .6rem; }
html.dark [data-clients] .bs-card a.cta-link,
[data-theme="dark"] [data-clients] .bs-card a.cta-link {
    color: var(--bs-primary);
}
html.dark [data-clients] .bs-card a.cta-link:hover,
[data-theme="dark"] [data-clients] .bs-card a.cta-link:hover {
    color: var(--bs-gold-lt);
}

/* ---------- badge tags ---------- */
[data-clients] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-clients] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
    width: fit-content;
}
html.dark [data-clients] .bs-badge-outline,
[data-theme="dark"] [data-clients] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- capability cards (What We Capture) ---------- */
[data-clients] .bs-capability-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 26px 22px;
    box-shadow: var(--bs-shadow-sm);
    transition: transform .26s ease, box-shadow .26s ease;
}
[data-clients] .bs-capability-card:hover {
    transform: translateY(-3px); box-shadow: var(--bs-shadow-md);
}
[data-clients] .bs-capability-num {
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 0.85rem;
    color: var(--bs-primary); letter-spacing: 0.08em; margin-bottom: 10px;
    display: inline-block;
}
html.dark [data-clients] .bs-capability-num,
[data-theme="dark"] [data-clients] .bs-capability-num {
    color: var(--bs-gold-lt);
}
[data-clients] .bs-capability-card h4 {
    font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 8px; line-height: 1.25;
}
[data-clients] .bs-capability-card p {
    font-size: 0.9rem; line-height: 1.7; color: var(--bs-muted); margin: 0;
}

/* ---------- CTA Banner ---------- */
[data-clients] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg);
    padding: 56px 40px;
    text-align: center;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: var(--bs-shadow-md);
    max-width: 960px;
    margin: 0 auto;
}
[data-clients] .bs-cta-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-clients] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600;
    color: #ffffff;
    margin: 0 0 10px;
    letter-spacing: -.01em;
    position: relative; z-index: 1;
}
[data-clients] .bs-cta-banner p {
    color: rgba(255,255,255,.82);
    font-size: 1.05rem;
    line-height: 1.7;
    max-width: 620px;
    margin: 0 auto 24px;
    position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-clients] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-clients] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt);
    box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-clients] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-clients] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-clients] .bs-btn-outline,
[data-theme="dark"] [data-clients] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-clients] .bs-btn-outline:hover,
[data-theme="dark"] [data-clients] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-clients] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-clients] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-clients>
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
            <span class="current">Our Clients</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                {{ $clients['intro']['eyebrow'] ?? 'Our Clients' }}
            </span>
            <h1>{{ $clients['intro']['title'] ?? 'Companies Building Real Products With Bengal IT Hub' }}</h1>
            <p class="lead">{{ $clients['intro']['body'] ?? 'Healthcare, education, real estate, commerce, logistics, hospitality, services, energy, and manufacturing.' }}</p>

            {{-- Mini Stats Bar --}}
            @if(!empty($clients['intro']['stats']))
                <div class="bs-mini-stats reveal">
                    @foreach($clients['intro']['stats'] as $stat)
                        <div class="bs-mini-stat">
                            <div class="num">{{ $stat['value'] }}</div>
                            <div class="lbl">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ── Client Chips Grid (Logo Wall / Client Directory) ── --}}
    <section class="bs-section" style="padding-top: 0;">
        <div class="bs-container">
            <div class="bs-grid bs-grid-4">
                @foreach($clients['items'] as $client)
                    <a href="#client-{{ Str::slug($client['name']) }}" class="bs-client-chip reveal">
                        <div class="bs-client-logo-fallback">
                            @if(!empty($client['logo']))
                                <img src="{{ $client['logo'] }}" alt="{{ $client['name'] }}" loading="lazy" decoding="async" onerror="this.style.display='none'; this.parentElement.textContent='{{ substr($client['name'], 0, 1) }}';">
                            @else
                                {{ substr($client['name'], 0, 1) }}
                            @endif
                        </div>
                        <div class="bs-client-meta">
                            <strong>{{ $client['name'] }}</strong>
                            <span>{{ $client['industry'] }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Featured Work / Recent Client Projects Section ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Featured Work</span>
                <h2>Recent Client Projects</h2>
                <p>Digital products, CRMs, web applications, and business enablement workflows delivered for client businesses.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach(array_slice($clients['items'], 0, 6) as $client)
                    <div class="bs-card reveal">
                        <span class="bs-badge-tag">{{ $client['industry'] }}</span>
                        <h3>{{ $client['deal'] }}</h3>
                        <p>{{ $client['product'] }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px; padding-top: 14px; border-top: 1px solid var(--bs-border);">
                            <span class="bs-badge-outline">{{ $client['status'] }}</span>
                            <a href="{{ route('contact', ['interest' => $client['name']]) }}" class="cta-link">
                                Discuss &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Capabilities / What We Capture ── --}}
    @if(!empty($clients['capabilities']))
        <section class="bs-section">
            <div class="bs-container">
                <div class="bs-section-head reveal">
                    <span class="bs-eyebrow"><span class="dot"></span> What We Capture</span>
                    <h2>Every Client Entry Shows The Useful Details</h2>
                    <p>The page is structured so visitors can understand company logo, industry, deal type, delivered product, and current collaboration status without hunting around.</p>
                </div>

                <div class="bs-grid bs-grid-4">
                    @foreach($clients['capabilities'] as $item)
                        <div class="bs-capability-card reveal">
                            <span class="bs-capability-num">0{{ $loop->iteration }}</span>
                            <h4>{{ $item['title'] }}</h4>
                            <p>{{ $item['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── Detailed Client Directory ── --}}
    <section id="client-directory" class="bs-section bs-section-alt" style="scroll-margin-top: 100px;">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Client Directory</span>
                <h2>Company Details, Deal Products, and Delivery Context</h2>
                <p>Browse the client directory to explore each company's industry, delivered system, and engagement focus.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($clients['items'] as $client)
                    <article id="client-{{ Str::slug($client['name']) }}" class="bs-card reveal" style="scroll-margin-top: 120px;">
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
                            <div class="bs-client-logo-fallback" style="width: 50px; height: 50px; border-radius: 12px;">
                                @if(!empty($client['logo']))
                                    <img src="{{ $client['logo'] }}" alt="{{ $client['name'] }}" loading="lazy" decoding="async" onerror="this.style.display='none'; this.parentElement.textContent='{{ substr($client['name'], 0, 1) }}';">
                                @else
                                    {{ substr($client['name'], 0, 1) }}
                                @endif
                            </div>
                            <div style="min-width: 0;">
                                <span style="font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; text-transform: uppercase; color: var(--bs-primary); letter-spacing: 0.06em;">{{ $client['industry'] }}</span>
                                <h3 style="font-size: 1.15rem; margin: 2px 0 0;">{{ $client['name'] }}</h3>
                            </div>
                        </div>

                        <div style="background-color: var(--bs-surface-alt); padding: 14px 16px; border-radius: var(--bs-radius-sm); margin-bottom: 14px; border: 1px solid var(--bs-border);">
                            <div style="font-size: 0.72rem; font-family: 'Outfit', sans-serif; font-weight: 700; text-transform: uppercase; color: var(--bs-muted); letter-spacing: 0.05em;">Deal Product</div>
                            <div style="font-weight: 700; font-size: 0.94rem; color: var(--bs-text); margin-top: 3px; font-family: 'Outfit', sans-serif;">{{ $client['deal'] }}</div>
                        </div>

                        <p style="margin-bottom: 18px;">{{ $client['product'] }}</p>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 14px; border-top: 1px solid var(--bs-border);">
                            <span class="bs-badge-outline">{{ $client['status'] }}</span>
                            <a href="{{ route('contact', ['interest' => $client['name']]) }}" class="cta-link">
                                Discuss Work &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Become The Next Client Story</h2>
                <p>Bring your product, platform, or business system to Bengal IT Hub. Share the business problem, workflow, or idea — our team will help shape it into an actionable build plan.</p>
                <a href="{{ route('contact', ['interest' => 'Client Project']) }}" class="bs-btn-gold">Contact Us Today</a>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    // Reveal animations
    var els = document.querySelectorAll('[data-clients] .reveal');
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
