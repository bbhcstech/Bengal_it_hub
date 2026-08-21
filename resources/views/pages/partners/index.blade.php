@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Our Partners Page (Light & Dark Mode Support)
     Scoped strictly under [data-partners]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-partners] {
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
html.dark [data-partners],
[data-theme="dark"] [data-partners] {
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

[data-partners] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-partners] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-partners] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsPartnersMarquee 32s linear infinite;
}
[data-partners] .bs-marquee-track span {
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
[data-partners] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsPartnersMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-partners] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-partners] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-partners] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-partners] .bs-breadcrumb .sep { opacity: .5; }
[data-partners] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-partners] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-partners] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-partners] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-partners] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-partners] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-partners] .bs-eyebrow,
[data-theme="dark"] [data-partners] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-partners] .bs-eyebrow .dot,
[data-theme="dark"] [data-partners] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-partners] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-partners] .bs-section { padding: 60px 0 90px; position: relative; }
[data-partners] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-partners] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-partners] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-partners] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-partners] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-partners] .bs-grid { display: grid; gap: 20px; }
[data-partners] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-partners] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
[data-partners] .bs-grid-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 1024px) {
    [data-partners] .bs-grid-4 { grid-template-columns: repeat(2, 1fr); }
    [data-partners] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    [data-partners] .bs-grid-4,
    [data-partners] .bs-grid-3,
    [data-partners] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- cards ---------- */
[data-partners] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 30px 24px;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-partners] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-partners] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.22rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .5em; letter-spacing: -.01em; line-height: 1.25;
}
[data-partners] .bs-card p {
    font-size: .92rem; line-height: 1.75; color: var(--bs-muted); margin: 0; flex: 1;
}
[data-partners] .bs-card a.cta-link {
    display: inline-flex; align-items: center; gap: .35rem;
    margin-top: 1.25rem; font-family: 'Outfit', sans-serif;
    font-weight: 700; font-size: .88rem; color: var(--bs-primary);
    text-decoration: none; transition: color .2s, gap .2s;
}
[data-partners] .bs-card a.cta-link:hover { color: var(--bs-gold); gap: .6rem; }
html.dark [data-partners] .bs-card a.cta-link,
[data-theme="dark"] [data-partners] .bs-card a.cta-link {
    color: var(--bs-primary);
}
html.dark [data-partners] .bs-card a.cta-link:hover,
[data-theme="dark"] [data-partners] .bs-card a.cta-link:hover {
    color: var(--bs-gold-lt);
}

/* ---------- icon badge ---------- */
[data-partners] .bs-icon-badge {
    width: 52px; height: 52px; border-radius: var(--bs-radius-sm);
    background: linear-gradient(135deg, rgba(30,74,95,.14), rgba(232,170,61,.14));
    color: var(--bs-primary);
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
}
html.dark [data-partners] .bs-icon-badge,
[data-theme="dark"] [data-partners] .bs-icon-badge {
    background: linear-gradient(135deg, rgba(79, 155, 184, 0.2), rgba(232, 170, 61, 0.2));
    color: var(--bs-gold-lt);
}
[data-partners] .bs-icon-badge svg { width: 22px; height: 22px; }

/* ---------- badge tags ---------- */
[data-partners] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-partners] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
    width: fit-content;
}
html.dark [data-partners] .bs-badge-outline,
[data-theme="dark"] [data-partners] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- step cards ---------- */
[data-partners] .bs-step-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 26px 22px;
    box-shadow: var(--bs-shadow-sm);
    transition: transform .26s ease, box-shadow .26s ease;
}
[data-partners] .bs-step-card:hover {
    transform: translateY(-3px); box-shadow: var(--bs-shadow-md);
}
[data-partners] .bs-step-num {
    font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 2rem;
    color: rgba(30,74,95,0.25); line-height: 1; margin-bottom: 12px;
    display: block;
}
html.dark [data-partners] .bs-step-num,
[data-theme="dark"] [data-partners] .bs-step-num {
    color: rgba(232,170,61,0.3);
}
[data-partners] .bs-step-card h4 {
    font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 8px; line-height: 1.25;
}
[data-partners] .bs-step-card p {
    font-size: 0.9rem; line-height: 1.7; color: var(--bs-muted); margin: 0;
}

/* ---------- FAQ Accordion ---------- */
[data-partners] .bs-faq-wrapper { max-width: 860px; margin: 0 auto; }
[data-partners] .bs-faq-item { border-bottom: 1px solid var(--bs-border); }
[data-partners] .bs-faq-question {
    display: flex; align-items: center; justify-content: space-between;
    padding: 22px 4px; cursor: pointer; font-family: 'Outfit', sans-serif;
    font-size: 1.05rem; font-weight: 700; color: var(--bs-text);
    min-height: 44px; user-select: none; transition: color .2s ease;
}
[data-partners] .bs-faq-question:hover { color: var(--bs-primary); }
html.dark [data-partners] .bs-faq-question:hover,
[data-theme="dark"] [data-partners] .bs-faq-question:hover { color: var(--bs-gold-lt); }

[data-partners] .bs-faq-icon {
    transition: transform 240ms cubic-bezier(.4,0,.2,1); color: var(--bs-gold);
    font-family: 'Outfit', sans-serif; font-size: 1.4rem; font-weight: 800;
    flex-shrink: 0; margin-left: 16px; line-height: 1;
}
[data-partners] .bs-faq-item.open .bs-faq-icon { transform: rotate(45deg); }
[data-partners] .bs-faq-answer {
    max-height: 0; overflow: hidden;
    transition: max-height 320ms cubic-bezier(.4,0,.2,1), opacity 320ms ease;
    opacity: 0;
}
[data-partners] .bs-faq-item.open .bs-faq-answer { max-height: 600px; opacity: 1; }
[data-partners] .bs-faq-answer p {
    padding-bottom: 22px; padding-top: 2px; font-size: .96rem;
    line-height: 1.8; color: var(--bs-muted); margin: 0;
}

/* ---------- CTA Banner ---------- */
[data-partners] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-partners] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-partners] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-partners] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-partners] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-partners] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-partners] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-partners] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-partners] .bs-btn-outline,
[data-theme="dark"] [data-partners] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-partners] .bs-btn-outline:hover,
[data-theme="dark"] [data-partners] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-partners] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-partners] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-partners>
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
            <span class="current">Our Partners</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                Our Partners
            </span>
            <h1>Collaboration Across Industry, Academia, And Community</h1>
            <p class="lead">The partner ecosystem behind Bengal IT Hub, including academic, hiring, innovation, technology, and community pathways.</p>
        </div>
    </section>

    {{-- ── 4-Column Overview Bento Grid (Demo Style) ── --}}
    <section class="bs-section" style="padding-top: 0;">
        <div class="bs-container">
            <div class="bs-grid bs-grid-4">
                <div class="bs-card reveal text-center" style="align-items: center; text-align: center;">
                    <div class="bs-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 6px;">Industry Experts</h3>
                    <p style="font-size: 0.88rem;">Practitioners, consultants, and leaders shaping technology architecture.</p>
                </div>
                <div class="bs-card reveal text-center" style="align-items: center; text-align: center;">
                    <div class="bs-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 6px;">Academic Partners</h3>
                    <p style="font-size: 0.88rem;">Colleges, universities, and institutions driving curriculum innovation.</p>
                </div>
                <div class="bs-card reveal text-center" style="align-items: center; text-align: center;">
                    <div class="bs-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 6px;">Innovation Partners</h3>
                    <p style="font-size: 0.88rem;">Incubators, research labs, and open tech collectives building together.</p>
                </div>
                <div class="bs-card reveal text-center" style="align-items: center; text-align: center;">
                    <div class="bs-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 6px;">Hiring Partners</h3>
                    <p style="font-size: 0.88rem;">Enterprises and startups actively sourcing job-ready talent.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Why Partner With Us (Benefits) ── --}}
    @if(!empty($content['benefits']))
        <section class="bs-section bs-section-alt">
            <div class="bs-container">
                <div class="bs-section-head reveal">
                    <span class="bs-eyebrow"><span class="dot"></span> Why Partner With Us</span>
                    <h2>What Working With Bengal IT Hub Looks Like</h2>
                    <p>Every partnership is built the same way: clear scope, shared visibility, and room to grow as trust builds up.</p>
                </div>

                <div class="bs-grid bs-grid-4">
                    @foreach($content['benefits'] as $benefit)
                        <div class="bs-card reveal">
                            <div class="bs-icon-badge">
                                @include('partials.icon', ['name' => $benefit['icon']])
                            </div>
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── Six Ways We Collaborate (Categories) ── --}}
    @if(!empty($content['categories']))
        <section class="bs-section">
            <div class="bs-container">
                <div class="bs-section-head reveal">
                    <span class="bs-eyebrow"><span class="dot"></span> Six Ways We Collaborate</span>
                    <h2>Partnership Categories</h2>
                    <p>Every partner fits into one of these categories. Explore the directory below to see the companies and collaborators in each.</p>
                </div>

                <div class="bs-grid bs-grid-3">
                    @foreach($content['categories'] as $category)
                        <div class="bs-card reveal" style="flex-direction: row; gap: 16px; align-items: flex-start;">
                            <div class="bs-icon-badge" style="flex-shrink: 0; margin-bottom: 0;">
                                @include('partials.icon', ['name' => $category['icon']])
                            </div>
                            <div>
                                <h3 style="font-size: 1.12rem; margin-bottom: 6px;">{{ $category['name'] }}</h3>
                                <p style="font-size: 0.88rem;">{{ $category['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── The Directory (Live Partners) ── --}}
    <section id="directory" class="bs-section bs-section-alt" style="scroll-margin-top: 100px;">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> The Directory</span>
                <h2>Meet Our Partners</h2>
                <p>Open a profile to see what each partner does, the projects and products they bring, and how to reach them.</p>
            </div>

            @if($partners->isEmpty())
                <div class="bs-card reveal text-center" style="max-width: 620px; margin: 0 auto; padding: 48px 24px; align-items: center;">
                    <div class="bs-icon-badge" style="margin: 0 auto 16px;">
                        @include('partials.icon', ['name' => 'partners'])
                    </div>
                    <h3>Partner Profiles Expanding</h3>
                    <p>New partner profiles are being added. Check back soon or apply to become a partner below.</p>
                    <a href="#become-a-partner" class="bs-btn-gold" style="margin-top: 16px;">Become a Partner</a>
                </div>
            @else
                <div class="bs-grid bs-grid-3">
                    @foreach($partners as $partner)
                        <a href="{{ route('our-partners.show', $partner->slug) }}" class="bs-card reveal" style="text-decoration: none; color: inherit;">
                            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 14px;">
                                @if($partner->logo)
                                    <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" style="width: 48px; height: 48px; border-radius: 10px; object-fit: contain; background: var(--bs-surface-alt); padding: 4px; border: 1px solid var(--bs-border);" loading="lazy" decoding="async">
                                @else
                                    <div class="bs-icon-badge" style="width: 48px; height: 48px; margin-bottom: 0; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.1rem;">
                                        {{ Str::substr($partner->name, 0, 2) }}
                                    </div>
                                @endif
                                <div style="min-width: 0;">
                                    <span class="bs-badge-outline" style="font-size: 0.68rem; padding: 2px 8px; margin-bottom: 4px;">{{ ucfirst($partner->scope) }} Partner</span>
                                    <h3 style="font-size: 1.12rem; margin: 0;">{{ $partner->name }}</h3>
                                </div>
                            </div>

                            <p style="font-size: 0.9rem; margin-bottom: 14px;">
                                {{ $partner->description ? Str::limit($partner->description, 120) : 'Profile details coming soon.' }}
                            </p>

                            @if($partner->address)
                                <div style="font-size: 0.78rem; color: var(--bs-muted); display: flex; align-items: center; gap: 6px; margin-bottom: 10px;">
                                    <span style="color: var(--bs-primary);">@include('partials.icon', ['name' => 'globe', 'size' => 'h-3.5 w-3.5'])</span>
                                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $partner->address }}</span>
                                </div>
                            @endif

                            @if($partner->clients_count || $partner->employees_count)
                                <div style="display: flex; gap: 16px; margin-top: auto; padding-top: 12px; border-top: 1px solid var(--bs-border);">
                                    @if($partner->clients_count)
                                        <div style="font-size: 0.8rem; font-weight: 700; color: var(--bs-primary);">
                                            {{ $partner->clients_count }} <span style="color: var(--bs-muted); font-size: 0.72rem; text-transform: uppercase;">Clients</span>
                                        </div>
                                    @endif
                                    @if($partner->employees_count)
                                        <div style="font-size: 0.8rem; font-weight: 700; color: var(--bs-primary);">
                                            {{ $partner->employees_count }} <span style="color: var(--bs-muted); font-size: 0.72rem; text-transform: uppercase;">Employees</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div style="margin-top: 14px; display: flex; align-items: center; justify-content: flex-end;">
                                <span class="cta-link" style="margin-top: 0;">View Profile &rarr;</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ── How Partnership Works (Process) ── --}}
    @if(!empty($content['process']))
        <section id="become-a-partner" class="bs-section" style="scroll-margin-top: 100px;">
            <div class="bs-container">
                <div class="bs-section-head reveal">
                    <span class="bs-eyebrow"><span class="dot"></span> Become A Partner</span>
                    <h2>How Partnership Works</h2>
                    <p>A straightforward path from first conversation to a working, growing partnership.</p>
                </div>

                <div class="bs-grid bs-grid-4">
                    @foreach($content['process'] as $step)
                        <div class="bs-step-card reveal">
                            <span class="bs-step-num">{{ $step['step'] }}</span>
                            <h4>{{ $step['title'] }}</h4>
                            <p>{{ $step['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ── Partners FAQ ── --}}
    @php
        $bihPartnerFaqs = [
            ['Who are Bengal IT Hub\'s partners?', 'Bengal IT Hub partners across ' . (!empty($content['categories']) ? count($content['categories']) : 6) . ' categories: Industry Experts, Academic Institutions, Innovation Labs, Hiring Companies, Tech Ecosystems, and Community Networks.'],
            ['How does partnership with Bengal IT Hub work?', !empty($content['process']) ? collect($content['process'])->pluck('title')->join(' → ') : 'Discovery & Alignment → Scope Definition → Joint Execution → Ongoing Scale.'],
            ['How can my organization become a partner?', 'Start a conversation through our contact page with a Partnership interest, and our leadership team will follow up within one business day.'],
        ];
    @endphp
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Common Questions</span>
                <h2>Partners FAQ</h2>
                <p>Quick answers about partnership criteria, collaboration pathways, and mutual benefits.</p>
            </div>

            <div class="bs-faq-wrapper">
                @foreach($bihPartnerFaqs as $index => [$question, $answer])
                    <div class="bs-faq-item {{ $index === 0 ? 'open' : '' }} reveal">
                        <div class="bs-faq-question" role="button" tabindex="0" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $question }}
                            <span class="bs-faq-icon">+</span>
                        </div>
                        <div class="bs-faq-answer">
                            <p>{{ $answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Become a Partner</h2>
                <p>Companies, colleges, communities, mentors, and technology providers can start here. Tell us what you're working on and where a partnership with Bengal IT Hub can accelerate it.</p>
                <a href="{{ route('contact', ['interest' => 'Partnership']) }}" class="bs-btn-gold">Start the Conversation</a>
            </div>
        </div>
    </section>
</div>

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

<script>
(function () {
    // FAQ Accordion Toggle
    document.querySelectorAll('[data-partners] .bs-faq-question').forEach(function (q) {
        function toggle() {
            var item = q.closest('.bs-faq-item');
            var isOpen = item.classList.contains('open');
            item.classList.toggle('open', !isOpen);
            q.setAttribute('aria-expanded', String(!isOpen));
        }

        q.addEventListener('click', toggle);
        q.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle();
            }
        });
    });

    // Reveal animations
    var els = document.querySelectorAll('[data-partners] .reveal');
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
