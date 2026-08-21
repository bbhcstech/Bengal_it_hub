@extends('layouts.app')

@section('content')
@php
    $focusAreaCount = collect($industries)->sum(fn ($industry) => count($industry['subBranches'] ?? []));
@endphp

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Industries Index Page (Light & Dark Mode Support)
     Scoped strictly under [data-industries]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-industries] {
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
html.dark [data-industries],
[data-theme="dark"] [data-industries] {
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

[data-industries] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-industries] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-industries] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsIndIdxMarquee 32s linear infinite;
}
[data-industries] .bs-marquee-track span {
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
[data-industries] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsIndIdxMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-industries] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-industries] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-industries] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-industries] .bs-breadcrumb .sep { opacity: .5; }
[data-industries] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-industries] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-industries] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-industries] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-industries] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-industries] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-industries] .bs-eyebrow,
[data-theme="dark"] [data-industries] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-industries] .bs-eyebrow .dot,
[data-theme="dark"] [data-industries] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-industries] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-industries] .bs-section { padding: 60px 0 90px; position: relative; }
[data-industries] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-industries] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-industries] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-industries] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-industries] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-industries] .bs-grid { display: grid; gap: 20px; }
[data-industries] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-industries] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
@media (max-width: 1024px) {
    [data-industries] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
    [data-industries] .bs-grid-2 { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    [data-industries] .bs-grid-3,
    [data-industries] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- hero side brief panel ---------- */
[data-industries] .bs-brief-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden; box-shadow: var(--bs-shadow-md);
}
[data-industries] .bs-brief-head {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    padding: 16px 20px; color: #fff;
}
[data-industries] .bs-brief-head p {
    font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 0; color: #fff;
}
[data-industries] .bs-brief-body { padding: 24px 20px; display: grid; gap: 16px; }
[data-industries] .bs-brief-stat {
    display: flex; align-items: center; gap: 14px;
}
[data-industries] .bs-brief-stat .stat-num {
    font-family: 'Fraunces', serif; font-size: 2rem; font-weight: 600;
    color: var(--bs-primary); line-height: 1; flex-shrink: 0; min-width: 48px;
}
html.dark [data-industries] .bs-brief-stat .stat-num,
[data-theme="dark"] [data-industries] .bs-brief-stat .stat-num {
    color: var(--bs-gold-lt);
}
[data-industries] .bs-brief-stat .stat-label {
    font-size: 0.88rem; font-weight: 700; color: var(--bs-text); line-height: 1.4;
}

/* ---------- industry cards ---------- */
[data-industries] .bs-ind-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); overflow: hidden;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-industries] .bs-ind-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-industries] .bs-ind-media {
    position: relative; height: 190px; overflow: hidden;
}
[data-industries] .bs-ind-media img {
    width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease;
}
[data-industries] .bs-ind-card:hover .bs-ind-media img {
    transform: scale(1.05);
}
[data-industries] .bs-ind-num {
    position: absolute; top: 12px; right: 12px;
    background: rgba(10,31,40,0.85); color: #fff; font-family: 'Outfit', sans-serif;
    font-weight: 800; font-size: 0.72rem; padding: 3px 10px; border-radius: var(--bs-radius-pill);
    backdrop-filter: blur(4px);
}
[data-industries] .bs-ind-icon {
    position: absolute; bottom: 12px; left: 12px;
    width: 38px; height: 38px; border-radius: 8px;
    background: var(--bs-surface); color: var(--bs-primary);
    display: grid; place-items: center; box-shadow: var(--bs-shadow-sm);
}
html.dark [data-industries] .bs-ind-icon,
[data-theme="dark"] [data-industries] .bs-ind-icon {
    background: #163944; color: var(--bs-gold-lt);
}
[data-industries] .bs-ind-body {
    padding: 22px 20px; display: flex; flex-direction: column; flex: 1;
}
[data-industries] .bs-ind-body h3 {
    font-family: 'Fraunces', serif; font-size: 1.25rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 8px; line-height: 1.25;
}
[data-industries] .bs-ind-body p {
    font-size: 0.9rem; line-height: 1.7; color: var(--bs-muted); margin: 0; flex: 1;
}
[data-industries] .bs-ind-meta {
    margin-top: 16px; padding-top: 14px; border-top: 1px solid var(--bs-border);
    display: flex; align-items: center; justify-content: space-between;
    font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 700;
}
[data-industries] .bs-ind-link {
    color: var(--bs-primary); display: inline-flex; align-items: center; gap: 4px;
}
html.dark [data-industries] .bs-ind-link,
[data-theme="dark"] [data-industries] .bs-ind-link {
    color: var(--bs-gold-lt);
}

/* ---------- badge tags ---------- */
[data-industries] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-industries] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
    width: fit-content;
}
html.dark [data-industries] .bs-badge-outline,
[data-theme="dark"] [data-industries] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- FAQ Accordion ---------- */
[data-industries] .bs-faq-item {
    background: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); margin-bottom: 14px; overflow: hidden;
    transition: border-color .22s, box-shadow .22s;
}
[data-industries] .bs-faq-item.is-open {
    border-color: rgba(232,170,61,.5); box-shadow: var(--bs-shadow-sm);
}
[data-industries] .bs-faq-question {
    width: 100%; text-align: left; background: none; border: none;
    padding: 20px 24px; display: flex; align-items: center; justify-content: space-between;
    gap: 16px; cursor: pointer; font-family: 'Fraunces', serif;
    font-size: 1.12rem; font-weight: 600; color: var(--bs-text);
}
[data-industries] .bs-faq-question:hover { color: var(--bs-primary); }
html.dark [data-industries] .bs-faq-question:hover,
[data-theme="dark"] [data-industries] .bs-faq-question:hover { color: var(--bs-gold-lt); }
[data-industries] .bs-faq-icon {
    width: 28px; height: 28px; border-radius: 50%; background: var(--bs-surface-alt);
    display: grid; place-items: center; font-family: 'Outfit', sans-serif;
    font-size: 1.1rem; font-weight: 700; color: var(--bs-gold); flex-shrink: 0;
    transition: transform .26s ease;
}
[data-industries] .bs-faq-item.is-open .bs-faq-icon {
    transform: rotate(45deg); background: var(--bs-gold); color: #12242B;
}
[data-industries] .bs-faq-answer {
    max-height: 0; overflow: hidden; transition: max-height .32s cubic-bezier(0, 1, 0, 1);
    padding: 0 24px;
}
[data-industries] .bs-faq-item.is-open .bs-faq-answer {
    max-height: 500px; padding-bottom: 22px;
}
[data-industries] .bs-faq-answer p {
    margin: 0; font-size: .95rem; line-height: 1.75; color: var(--bs-muted);
}

/* ---------- CTA Banner ---------- */
[data-industries] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-industries] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-industries] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-industries] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-industries] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-industries] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

/* ---------- Reveal Animation ---------- */
[data-industries] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-industries] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-industries>
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
            <span class="current">Industries</span>
        </nav>
    </div>

    {{-- ── Page Hero with Side Panel ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <div class="bs-grid bs-grid-2" style="align-items: center; grid-template-columns: 1.15fr .85fr; gap: 36px;">
                <div>
                    <span class="bs-eyebrow">
                        <span class="dot"></span>
                        Where We Work
                    </span>
                    <h1>Industries We Build For</h1>
                    <p class="lead">Bengal IT Hub designs practical technology for industries where operations, customer experience, data visibility, and speed matter every day.</p>
                    <p style="font-size: 1rem; line-height: 1.75; color: var(--bs-muted); margin-top: 14px;">From property and healthcare to logistics, finance, retail, manufacturing, education, and information services, we shape digital systems around the real workflows each sector depends on.</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px;">
                        <a href="/contact" class="bs-btn-gold">Start a Conversation</a>
                    </div>
                </div>

                <div>
                    <div class="bs-brief-card reveal">
                        <div class="bs-brief-head">
                            <p>Industry Coverage</p>
                        </div>
                        <div class="bs-brief-body">
                            <div class="bs-brief-stat">
                                <span class="stat-num">{{ str_pad(count($industries), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="stat-label">Core industries mapped with dedicated solution areas</span>
                            </div>
                            <div class="bs-brief-stat">
                                <span class="stat-num">{{ str_pad($focusAreaCount, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="stat-label">Focused capabilities across operations, growth, data, and automation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Industry Grid ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Industry Solutions</span>
                <h2>Choose Your Business Sector</h2>
                <p>Each industry opens into dedicated focus areas, with content tailored to the systems, users, and business priorities of that market.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($industries as $slug => $industry)
                    <a href="{{ route('industries.show', $slug) }}" class="bs-ind-card reveal">
                        <div class="bs-ind-media">
                            <img src="{{ $industry['image'] }}" alt="{{ $industry['name'] }}" loading="lazy" decoding="async">
                            <span class="bs-ind-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="bs-ind-icon">
                                @include('partials.icon', ['name' => $industry['icon'] ?? 'target'])
                            </span>
                        </div>
                        <div class="bs-ind-body">
                            <span class="bs-badge-outline" style="margin-bottom: 8px;">{{ $industry['kicker'] }}</span>
                            <h3>{{ $industry['name'] }}</h3>
                            <p>{{ $industry['summary'] }}</p>
                            <div class="bs-ind-meta">
                                <span class="bs-badge-outline" style="font-size: 0.7rem;">{{ count($industry['subBranches'] ?? []) }} focus areas</span>
                                <span class="bs-ind-link">
                                    Explore {{ $industry['name'] }} &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Industries FAQ Accordion ── --}}
    @php
        $bihIndustryFaqs = [
            ['Which industries does Bengal IT Hub build technology for?', 'Bengal IT Hub builds technology for '.count($industries).' industries: '.collect($industries)->pluck('name')->join(', ', ', and ').'.'],
            ['How many focus areas are covered across industries?', $focusAreaCount.' specialized focus areas span the '.count($industries).' industries, each tailored to a distinct workflow such as property management, patient management, core banking, or transportation management.'],
            ['Does Bengal IT Hub build banking and finance technology?', 'Yes. Banking and Finance is one of the industries Bengal IT Hub builds for, with dedicated focus areas covering core banking, lending, and financial data and AI systems.'],
            ['How is each industry page organized?', 'Each industry page opens into dedicated focus areas, tailored to the systems, users, and business priorities of that specific market.'],
        ];
    @endphp
    <section class="bs-section">
        <div class="bs-container" style="max-width: 820px;">
            <div style="text-align: center; margin-bottom: 40px;">
                <span class="bs-eyebrow"><span class="dot"></span> FAQ</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 600; color: var(--bs-text); margin: 6px 0 12px;">Industries FAQ</h2>
                <p style="color: var(--bs-muted); font-size: 1rem; margin: 0;">Common questions about our domain expertise and industry capabilities.</p>
            </div>

            <div>
                @foreach($bihIndustryFaqs as [$question, $answer])
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
                <h2>Need a sector-specific build?</h2>
                <p>Bring us your workflow, customer journey, or operational bottleneck. We will map the right platform, automation, dashboard, or digital product around the way your industry actually works.</p>
                <a href="/contact" class="bs-btn-gold">Start a Conversation</a>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    // Accordion functionality
    var faqButtons = document.querySelectorAll('[data-industries] .bs-faq-question');
    faqButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.bs-faq-item');
            var isOpen = item.classList.contains('is-open');

            // Close others
            document.querySelectorAll('[data-industries] .bs-faq-item').forEach(function (other) {
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
    var els = document.querySelectorAll('[data-industries] .reveal');
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
            '@type' => 'FAQPage',
            'mainEntity' => collect($bihIndustryFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
