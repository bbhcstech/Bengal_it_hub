@extends('layouts.app')

@section('content')
@php
    $storySections = collect($blog['storySections'] ?? []);
    $configuredSectionSlugs = $storySections->pluck('slug');
    $extraSections = $categories->reject(fn ($category) => $configuredSectionSlugs->contains($category->slug));
@endphp

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Mirrors resources/views/bengal-demo/assets/css/site.css
     Scoped strictly under [data-blog]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

[data-blog] {
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
}

/* ---------- marquee strip ---------- */
[data-blog] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-blog] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsBlogMarquee 32s linear infinite;
}
[data-blog] .bs-marquee-track span {
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
[data-blog] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsBlogMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-blog] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-blog] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; }
[data-blog] .bs-breadcrumb a:hover { color: var(--bs-primary); }
[data-blog] .bs-breadcrumb .sep { opacity: .5; }
[data-blog] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-blog] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-blog] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
}
[data-blog] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
}

/* ---------- hero side panel ---------- */
[data-blog] .bs-hero-panel {
    background: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 24px 26px;
    box-shadow: var(--bs-shadow-sm);
    display: flex; flex-direction: column; gap: 14px;
}
[data-blog] .bs-hero-panel-title {
    font-family: 'Outfit', sans-serif;
    font-size: .76rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase;
    color: var(--bs-gold); margin-bottom: 4px;
}
[data-blog] .bs-hero-panel-item {
    display: flex; gap: 12px; align-items: flex-start;
    font-size: .88rem; line-height: 1.6; color: var(--bs-text);
}
[data-blog] .bs-hero-panel-num {
    font-family: 'Fraunces', serif; font-style: italic; font-weight: 700; font-size: 1.15rem;
    color: var(--bs-primary); flex-shrink: 0; line-height: 1; margin-top: 2px;
}

/* ---------- filter pills row ---------- */
[data-blog] .bs-filter-row {
    display: flex; gap: 8px; flex-wrap: wrap; margin-top: 28px;
}
[data-blog] .bs-filter-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid var(--bs-border); background-color: var(--bs-surface);
    font-family: 'Outfit', sans-serif; font-weight: 600; font-size: .84rem;
    color: var(--bs-muted); text-decoration: none;
    transition: all .2s ease;
}
[data-blog] .bs-filter-pill:hover,
[data-blog] .bs-filter-pill.active {
    border-color: var(--bs-primary); color: var(--bs-primary);
    background-color: rgba(30,74,95,.06); transform: translateY(-1px);
}

/* ---------- eyebrow ---------- */
[data-blog] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
}
[data-blog] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

/* ---------- container & sections ---------- */
[data-blog] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-blog] .bs-section { padding: 90px 0; position: relative; scroll-margin-top: 80px; }
[data-blog] .bs-section-alt { background-color: var(--bs-surface-alt); }
@media (max-width: 767px) { [data-blog] .bs-section { padding: 56px 0; } }

/* ---------- section head ---------- */
[data-blog] .bs-section-head { max-width: 680px; margin: 0 auto 52px; text-align: center; }
[data-blog] .bs-section-head.left { margin-left: 0; text-align: left; max-width: 100%; }
[data-blog] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-blog] .bs-section-head p {
    color: var(--bs-muted); font-size: 1rem; line-height: 1.75; margin: 0;
}

/* ---------- grid system ---------- */
[data-blog] .bs-grid { display: grid; gap: 22px; }
[data-blog] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-blog] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
[data-blog] .bs-grid-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 991px) {
    [data-blog] .bs-grid-3,
    [data-blog] .bs-grid-4 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    [data-blog] .bs-grid-2,
    [data-blog] .bs-grid-3,
    [data-blog] .bs-grid-4 { grid-template-columns: 1fr; }
}

/* ---------- blog post card ---------- */
[data-blog] .bs-blog-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    overflow: hidden;
    box-shadow: var(--bs-shadow-sm);
    display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
    position: relative;
}
[data-blog] .bs-blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(30,74,95,.12);
    border-color: rgba(232,170,61,.45);
}
[data-blog] .bs-blog-card .thumb-box {
    position: relative; overflow: hidden; height: 200px;
    background: linear-gradient(135deg, var(--bs-primary), var(--bs-ink));
}
[data-blog] .bs-blog-card .thumb-box img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .5s ease;
}
[data-blog] .bs-blog-card:hover .thumb-box img { transform: scale(1.06); }
[data-blog] .bs-blog-card .thumb-placeholder {
    width: 100%; height: 100%; display: grid; place-items: center;
    font-family: 'Fraunces', serif; font-weight: 700; font-size: 2.2rem;
    color: #ffffff;
}
[data-blog] .bs-blog-card .body {
    padding: 22px 24px;
    display: flex; flex-direction: column; flex: 1;
}
[data-blog] .bs-blog-card h3 {
    font-family: 'Fraunces', serif; font-size: 1.18rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.3;
    letter-spacing: -.01em; transition: color .2s ease;
}
[data-blog] .bs-blog-card:hover h3 { color: var(--bs-primary); }
[data-blog] .bs-blog-card p {
    font-size: .88rem; line-height: 1.7; color: var(--bs-muted);
    margin: 0; flex: 1;
}
[data-blog] .bs-blog-card .meta-row {
    margin-top: 18px; padding-top: 14px;
    border-top: 1px solid var(--bs-border);
    display: flex; align-items: center; justify-content: space-between;
    font-family: 'Outfit', sans-serif; font-size: .75rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase; color: var(--bs-muted);
}

/* ---------- badge tags ---------- */
[data-blog] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif;
    font-size: .7rem; font-weight: 700; padding: 3px 11px;
    border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-blog] .bs-badge-gold {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif;
    font-size: .7rem; font-weight: 800; padding: 4px 11px;
    border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}

/* ---------- event photo card ---------- */
[data-blog] .bs-event-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    overflow: hidden;
    box-shadow: var(--bs-shadow-sm);
    display: flex; flex-direction: column;
    text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-blog] .bs-event-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(30,74,95,.12);
    border-color: rgba(232,170,61,.45);
}
[data-blog] .bs-event-card .thumb {
    position: relative; overflow: hidden; height: 160px;
}
[data-blog] .bs-event-card .thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .5s ease;
}
[data-blog] .bs-event-card:hover .thumb img { transform: scale(1.06); }
[data-blog] .bs-event-card .thumb::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,31,40,.6) 0%, transparent 70%);
}
[data-blog] .bs-event-card .body {
    padding: 18px 20px;
    display: flex; flex-direction: column; flex: 1;
}
[data-blog] .bs-event-card h3 {
    font-family: 'Fraunces', serif; font-size: 1.05rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 .4em; line-height: 1.3;
    letter-spacing: -.01em; transition: color .2s ease;
}
[data-blog] .bs-event-card:hover h3 { color: var(--bs-primary); }
[data-blog] .bs-event-card p {
    font-size: .84rem; line-height: 1.65; color: var(--bs-muted);
    margin: 0; flex: 1;
}
[data-blog] .bs-event-card .cta-link {
    margin-top: 14px; font-family: 'Outfit', sans-serif;
    font-size: .78rem; font-weight: 800; letter-spacing: .06em;
    text-transform: uppercase; color: var(--bs-primary);
    display: inline-flex; align-items: center; gap: 4px;
    transition: gap .2s ease, color .2s ease;
}
[data-blog] .bs-event-card:hover .cta-link { color: var(--bs-gold); gap: 7px; }

/* ---------- culture moment card ---------- */
[data-blog] .bs-culture-card {
    position: relative; overflow: hidden;
    border-radius: var(--bs-radius-md);
    height: 240px;
    box-shadow: var(--bs-shadow-sm);
    transition: transform .26s ease, box-shadow .26s ease;
}
[data-blog] .bs-culture-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,.35);
}
[data-blog] .bs-culture-card img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform .5s ease;
}
[data-blog] .bs-culture-card:hover img { transform: scale(1.06); }
[data-blog] .bs-culture-card .overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,31,40,.92) 0%, rgba(10,31,40,.2) 60%, transparent 100%);
    padding: 18px 20px;
    display: flex; flex-direction: column; justify-content: flex-end;
}
[data-blog] .bs-culture-card h3 {
    font-family: 'Fraunces', serif; font-size: 1.05rem; font-weight: 600;
    color: #ffffff; margin: 0 0 4px; line-height: 1.25;
}
[data-blog] .bs-culture-card p {
    font-size: .78rem; line-height: 1.5; color: rgba(255,255,255,.8);
    margin: 0;
}

/* ---------- icon badge ---------- */
[data-blog] .bs-icon-badge {
    width: 52px; height: 52px; border-radius: var(--bs-radius-sm);
    background: linear-gradient(135deg, rgba(30,74,95,.14), rgba(232,170,61,.14));
    color: var(--bs-primary);
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
    transition: transform .22s ease, background .22s ease;
}
[data-blog] .bs-icon-badge svg { width: 22px; height: 22px; }
[data-blog] .bs-card:hover .bs-icon-badge {
    transform: scale(1.08);
    background: linear-gradient(135deg, rgba(30,74,95,.22), rgba(232,170,61,.28));
}

/* ---------- bento card for opportunities ---------- */
[data-blog] .bs-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 28px 24px;
    box-shadow: var(--bs-shadow-sm);
    display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-blog] .bs-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--bs-shadow-md);
    border-color: rgba(232,170,61,.45);
}
[data-blog] .bs-card h3 {
    font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 .4em; letter-spacing: -.01em;
}
[data-blog] .bs-card p {
    font-size: .88rem; line-height: 1.7; color: var(--bs-muted);
    margin: 0; flex: 1;
}

/* ---------- spotlight box (Awards Feature) ---------- */
[data-blog] .bs-spotlight {
    background: linear-gradient(135deg, #0a1f28 0%, #123544 55%, #1e4a5f 100%);
    border-radius: 20px; overflow: hidden;
    border: 1px solid rgba(255,255,255,.1);
    box-shadow: 0 20px 50px rgba(10,31,40,.2); color: #fff;
    display: grid; gap: 0;
}
@media (min-width: 1024px) { [data-blog] .bs-spotlight { grid-template-columns: 1fr 1fr; } }
[data-blog] .bs-spotlight .copy { padding: 52px 46px; }
@media (max-width: 767px) { [data-blog] .bs-spotlight .copy { padding: 32px 24px; } }
[data-blog] .bs-spotlight h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.8rem,3.5vw,2.5rem); font-weight: 600; color: #fff;
    margin: .75rem 0 1rem; line-height: 1.15; letter-spacing: -.01em;
}
[data-blog] .bs-spotlight .bs-eyebrow { color: var(--bs-gold-lt); background: rgba(232,170,61,.12); border-color: rgba(232,170,61,.3); }
[data-blog] .bs-spotlight p { color: rgba(255,255,255,.78); font-size: 1.02rem; line-height: 1.75; margin-bottom: 0; }
[data-blog] .bs-spotlight .actions { display: flex; gap: .875rem; flex-wrap: wrap; margin-top: 1.75rem; }
[data-blog] .bs-spotlight .visual {
    position: relative; min-height: 280px; overflow: hidden;
}
[data-blog] .bs-spotlight .visual img { width: 100%; height: 100%; object-fit: cover; display: block; }
[data-blog] .bs-spotlight .visual::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,31,40,.55), transparent 60%);
}
@media (min-width: 1024px) {
    [data-blog] .bs-spotlight .visual::after {
        background: linear-gradient(to right, rgba(10,31,40,.5) 0%, transparent 55%);
    }
}

/* ---------- cta-banner ---------- */
[data-blog] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 60px;
    text-align: center; color: #fff;
    position: relative; overflow: hidden;
}
[data-blog] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.15) 0%, transparent 68%);
    pointer-events: none;
}
[data-blog] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.7rem,3vw,2.4rem); font-weight: 600; color: #fff;
    margin: .5rem 0 1rem; letter-spacing: -.01em;
}
[data-blog] .bs-cta-banner p { color: rgba(255,255,255,.78); max-width: 560px; margin: 0 auto 1.75rem; }
[data-blog] .bs-cta-banner .actions { display: flex; gap: .875rem; flex-wrap: wrap; justify-content: center; }
@media (max-width: 640px) { [data-blog] .bs-cta-banner { padding: 40px 24px; } }

/* ---------- buttons ---------- */
[data-blog] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 14px 28px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-blog] .bs-btn-gold:hover { background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35); transform: translateY(-2px); }
[data-blog] .bs-btn-outline-white {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid rgba(255,255,255,.38); color: #fff;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 14px 28px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, background .22s, transform .22s;
}
[data-blog] .bs-btn-outline-white:hover { border-color: #fff; background: rgba(255,255,255,.1); transform: translateY(-2px); }

/* ---------- Dark mode (when html.dark or [data-theme="dark"]) ---------- */
html.dark [data-blog],
[data-theme="dark"] [data-blog] {
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

[data-blog] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* Dark mode specific component refinements */
html.dark [data-blog] .bs-page-hero,
[data-theme="dark"] [data-blog] .bs-page-hero {
    background: #0A1F28;
}

html.dark [data-blog] .bs-page-hero h1,
[data-theme="dark"] [data-blog] .bs-page-hero h1 {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-page-hero p.lead,
[data-theme="dark"] [data-blog] .bs-page-hero p.lead {
    color: #93B2BA;
}

html.dark [data-blog] .bs-eyebrow,
[data-theme="dark"] [data-blog] .bs-eyebrow {
    color: #F5C978;
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}

html.dark [data-blog] .bs-eyebrow .dot,
[data-theme="dark"] [data-blog] .bs-eyebrow .dot {
    background-color: #E8AA3D;
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

html.dark [data-blog] .bs-hero-panel,
[data-theme="dark"] [data-blog] .bs-hero-panel {
    background: #123039;
    border-color: #21454F;
    box-shadow: 0 12px 32px rgba(0,0,0,0.4);
}

html.dark [data-blog] .bs-hero-panel-item,
[data-theme="dark"] [data-blog] .bs-hero-panel-item {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-hero-panel-num,
[data-theme="dark"] [data-blog] .bs-hero-panel-num {
    color: #4F9BB8;
}

html.dark [data-blog] .bs-filter-pill,
[data-theme="dark"] [data-blog] .bs-filter-pill {
    background-color: #123039;
    border-color: #21454F;
    color: #93B2BA;
}

html.dark [data-blog] .bs-filter-pill:hover,
html.dark [data-blog] .bs-filter-pill.active,
[data-theme="dark"] [data-blog] .bs-filter-pill:hover,
[data-theme="dark"] [data-blog] .bs-filter-pill.active {
    border-color: #F5C978;
    color: #F5C978;
    background-color: rgba(232, 170, 61, 0.12);
}

html.dark [data-blog] .bs-section-head h2,
[data-theme="dark"] [data-blog] .bs-section-head h2 {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-section-head p,
[data-theme="dark"] [data-blog] .bs-section-head p {
    color: #93B2BA;
}

html.dark [data-blog] .bs-blog-card,
[data-theme="dark"] [data-blog] .bs-blog-card {
    background-color: #123039;
    border-color: #21454F;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

html.dark [data-blog] .bs-blog-card:hover,
[data-theme="dark"] [data-blog] .bs-blog-card:hover {
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}

html.dark [data-blog] .bs-blog-card h3,
[data-theme="dark"] [data-blog] .bs-blog-card h3 {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-blog-card:hover h3,
[data-theme="dark"] [data-blog] .bs-blog-card:hover h3 {
    color: #F5C978;
}

html.dark [data-blog] .bs-blog-card p,
[data-theme="dark"] [data-blog] .bs-blog-card p {
    color: #93B2BA;
}

html.dark [data-blog] .bs-blog-card .meta-row,
[data-theme="dark"] [data-blog] .bs-blog-card .meta-row {
    border-color: #21454F;
    color: #93B2BA;
}

html.dark [data-blog] .bs-event-card,
[data-theme="dark"] [data-blog] .bs-event-card {
    background-color: #123039;
    border-color: #21454F;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

html.dark [data-blog] .bs-event-card:hover,
[data-theme="dark"] [data-blog] .bs-event-card:hover {
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}

html.dark [data-blog] .bs-event-card h3,
[data-theme="dark"] [data-blog] .bs-event-card h3 {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-event-card:hover h3,
[data-theme="dark"] [data-blog] .bs-event-card:hover h3 {
    color: #F5C978;
}

html.dark [data-blog] .bs-event-card p,
[data-theme="dark"] [data-blog] .bs-event-card p {
    color: #93B2BA;
}

html.dark [data-blog] .bs-event-card .cta-link,
[data-theme="dark"] [data-blog] .bs-event-card .cta-link {
    color: #4F9BB8;
}

html.dark [data-blog] .bs-event-card:hover .cta-link,
[data-theme="dark"] [data-blog] .bs-event-card:hover .cta-link {
    color: #F5C978;
}

html.dark [data-blog] .bs-culture-card,
[data-theme="dark"] [data-blog] .bs-culture-card {
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

html.dark [data-blog] .bs-card,
[data-theme="dark"] [data-blog] .bs-card {
    background-color: #123039;
    border-color: #21454F;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

html.dark [data-blog] .bs-card:hover,
[data-theme="dark"] [data-blog] .bs-card:hover {
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: 0 16px 36px rgba(0,0,0,0.45);
}

html.dark [data-blog] .bs-card h3,
[data-theme="dark"] [data-blog] .bs-card h3 {
    color: #EAF4F6;
}

html.dark [data-blog] .bs-card:hover h3,
[data-theme="dark"] [data-blog] .bs-card:hover h3 {
    color: #F5C978;
}

html.dark [data-blog] .bs-card p,
[data-theme="dark"] [data-blog] .bs-card p {
    color: #93B2BA;
}

html.dark [data-blog] .bs-icon-badge,
[data-theme="dark"] [data-blog] .bs-icon-badge {
    background: linear-gradient(135deg, rgba(79, 155, 184, 0.2), rgba(232, 170, 61, 0.2));
    color: #F5C978;
}

html.dark [data-blog] .bs-badge-outline,
[data-theme="dark"] [data-blog] .bs-badge-outline {
    border-color: #21454F;
    color: #93B2BA;
}

html.dark [data-blog] .bs-badge-gold,
[data-theme="dark"] [data-blog] .bs-badge-gold {
    background-color: #E8AA3D;
    color: #12242B;
}

html.dark [data-blog] .bs-spotlight,
[data-theme="dark"] [data-blog] .bs-spotlight {
    background: linear-gradient(135deg, #07171e 0%, #0c2631 55%, #163944 100%);
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark [data-blog] .bs-cta-banner,
[data-theme="dark"] [data-blog] .bs-cta-banner {
    background: linear-gradient(120deg, #123544, #0a1f28);
    border: 1px solid #21454F;
}

html.dark [data-blog] .bs-breadcrumb a,
[data-theme="dark"] [data-blog] .bs-breadcrumb a {
    color: #93B2BA;
}

html.dark [data-blog] .bs-breadcrumb a:hover,
[data-theme="dark"] [data-blog] .bs-breadcrumb a:hover {
    color: #F5C978;
}

html.dark [data-blog] .bs-breadcrumb .current,
[data-theme="dark"] [data-blog] .bs-breadcrumb .current {
    color: #EAF4F6;
}

/* ---------- reveal animation ---------- */
[data-blog] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-blog] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-blog>
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
            <span class="current">Blog</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <div style="display: grid; gap: 2rem; align-items: flex-end;" class="lg:grid-cols-[1fr_.44fr]">
                <div>
                    <span class="bs-eyebrow"><span class="dot"></span> {{ $blog['intro']['eyebrow'] }}</span>
                    <h1>{{ $blog['intro']['title'] }}</h1>
                    @foreach($blog['intro']['body'] as $paragraph)
                        <p class="lead">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <div class="bs-hero-panel reveal">
                    <p class="bs-hero-panel-title">Publish Anything</p>
                    <div class="bs-hero-panel-item">
                        <span class="bs-hero-panel-num">01</span>
                        <span>Birthday, interview, new joiner, function, event, culture, and company posts.</span>
                    </div>
                    <div class="bs-hero-panel-item">
                        <span class="bs-hero-panel-num">02</span>
                        <span>Admin-managed sections with featured images, status, dates, and SEO fields.</span>
                    </div>
                </div>
            </div>

            <div class="bs-filter-row">
                <a href="#latest" class="bs-filter-pill">Latest Posts</a>
                @foreach($storySections as $section)
                    <a href="#{{ $section['slug'] }}" class="bs-filter-pill">{{ $section['title'] }}</a>
                @endforeach
                @foreach($extraSections as $category)
                    <a href="#{{ $category->slug }}" class="bs-filter-pill">{{ $category->name }}</a>
                @endforeach
                <a href="#events" class="bs-filter-pill">Events</a>
                <a href="#culture" class="bs-filter-pill">Life at Bengal IT Hub</a>
                <a href="#awards" class="bs-filter-pill">Awards</a>
                <a href="#opportunities" class="bs-filter-pill">Opportunities</a>
            </div>
        </div>
    </section>

    {{-- ── Latest From the Blog ── --}}
    <section id="latest" class="bs-section" style="background: var(--bs-bg, #F5F8F8); padding-top: 0;">
        <div class="bs-container">
            <div class="bs-section-head left reveal" style="margin-bottom: 36px;">
                <span class="bs-eyebrow"><span class="dot"></span> Latest From the Blog</span>
                <h2>Latest stories, updates, and people moments</h2>
                <p>Every published admin post appears here first, then also flows into its matching section below.</p>
            </div>

            @if($posts->isNotEmpty())
                <div class="bs-grid bs-grid-3">
                    @foreach($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="bs-blog-card reveal">
                            <div class="thumb-box">
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" decoding="async">
                                @else
                                    <div class="thumb-placeholder">{{ Str::substr($post->title, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="body">
                                @if($post->category)
                                    <span class="bs-badge-outline">{{ $post->category->name }}</span>
                                @endif
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->body), 120) }}</p>
                                <div class="meta-row">
                                    <span>{{ $post->published_at?->format('d M Y') }}</span>
                                    <span style="color: var(--bs-primary); font-weight: 800;">Read &rarr;</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bs-grid bs-grid-2 reveal">
                    <div class="bs-card" style="padding: 36px;">
                        <span class="bs-badge-gold">Coming Soon</span>
                        <h3 style="font-size: 1.4rem;">Our First Posts Are In The Works</h3>
                        <p style="margin-top: 8px;">We're preparing our first round of blog posts on technology, hiring, events, and company updates. Check back soon, or explore what's already live below.</p>
                        <div style="margin-top: 24px;">
                            <a class="bs-btn-gold" href="/contact">Get Notified</a>
                        </div>
                    </div>
                    @if($categories->isNotEmpty())
                        <div class="bs-card" style="padding: 36px;">
                            <span class="bs-badge-outline">Topics Coming Soon</span>
                            <h3 style="font-size: 1.4rem;">Categories In Queue</h3>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px;">
                                @foreach($categories as $category)
                                    <span class="bs-badge-outline" style="margin-bottom: 0;">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- ── Admin-Managed Blog Sections ── --}}
    @foreach($storySections as $section)
        @php($items = $sectionPosts->get($section['slug'], collect()))
        <section id="{{ $section['slug'] }}" class="bs-section {{ $loop->odd ? 'bs-section-alt' : '' }}">
            <div class="bs-container">
                <div style="display: grid; gap: 2.5rem; align-items: flex-start;" class="lg:grid-cols-[.42fr_1fr]">
                    <div class="reveal">
                        <span class="bs-eyebrow"><span class="dot"></span> {{ $section['eyebrow'] }}</span>
                        <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3vw, 2.3rem); font-weight: 600; color: var(--bs-text); margin: 0 0 .5em; line-height: 1.2;">{{ $section['title'] }}</h2>
                        <p style="color: var(--bs-muted); font-size: .98rem; line-height: 1.75; margin: 0;">{{ $section['intro'] }}</p>
                    </div>

                    <div class="bs-grid bs-grid-2">
                        @if($items->isNotEmpty())
                            @foreach($items->take(4) as $post)
                                <a href="{{ route('blog.show', $post->slug) }}" class="bs-blog-card reveal">
                                    <div class="thumb-box" style="height: 180px;">
                                        @if($post->featured_image)
                                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" decoding="async">
                                        @else
                                            <div class="thumb-placeholder">{{ Str::substr($post->title, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <div class="body">
                                        @if($post->category)
                                            <span class="bs-badge-outline">{{ $post->category->name }}</span>
                                        @endif
                                        <h3 style="font-size: 1.05rem;">{{ $post->title }}</h3>
                                        <p style="font-size: .84rem;">{{ Str::limit(strip_tags($post->body), 110) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            @foreach($section['fallback'] as $fallback)
                                <div class="bs-blog-card reveal">
                                    <div class="thumb-box" style="height: 180px;">
                                        <img src="{{ $fallback['image'] }}" alt="{{ $fallback['title'] }} at Bengal IT Hub" loading="lazy" decoding="async">
                                    </div>
                                    <div class="body">
                                        <span class="bs-badge-outline">Ready For Posts</span>
                                        <h3 style="font-size: 1.05rem;">{{ $fallback['title'] }}</h3>
                                        <p style="font-size: .84rem;">{{ $fallback['body'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    @foreach($extraSections as $category)
        @php($items = $sectionPosts->get($category->slug, collect()))
        <section id="{{ $category->slug }}" class="bs-section">
            <div class="bs-container">
                <div class="bs-section-head left reveal">
                    <span class="bs-eyebrow"><span class="dot"></span> Custom Section</span>
                    <h2>{{ $category->name }}</h2>
                    <p>This section is controlled from the blog admin panel. Add posts with images under this category to fill it.</p>
                </div>

                <div class="bs-grid bs-grid-3">
                    @forelse($items->take(6) as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="bs-blog-card reveal">
                            <div class="thumb-box" style="height: 180px;">
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" decoding="async">
                                @else
                                    <div class="thumb-placeholder">{{ Str::substr($post->title, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="body">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->body), 110) }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="bs-card reveal" style="grid-column: 1 / -1; max-width: 600px;">
                            <span class="bs-badge-outline">Empty Section</span>
                            <h3>Ready for {{ $category->name }} posts</h3>
                            <p>Create a post in the admin panel, assign it to this section, add a featured image, and publish it.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endforeach

    {{-- ── Company Events ── --}}
    <section id="events" class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Events</span>
                <h2>What We Host &amp; Show Up For</h2>
                <p>From our flagship hackathon to partner showcases, here's where Bengal IT Hub shows up in person.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($blog['events'] as $event)
                    <a href="{{ $event['href'] }}" class="bs-event-card reveal">
                        <div class="thumb">
                            <img src="{{ $event['image'] }}" alt="{{ $event['title'] }} at Bengal IT Hub" loading="lazy" decoding="async">
                        </div>
                        <div class="body">
                            <h3>{{ $event['title'] }}</h3>
                            <p>{{ $event['body'] }}</p>
                            <span class="cta-link">{{ $event['cta'] }} &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Life at Bengal IT Hub / Culture ── --}}
    <section id="culture" class="bs-section" style="background: linear-gradient(135deg, #0a1f28 0%, #102d3b 50%, #1e4a5f 100%); color: #ffffff;">
        <div class="bs-container">
            <div class="bs-section-head reveal" style="color: #ffffff;">
                <span class="bs-eyebrow" style="color: var(--bs-gold-lt); background: rgba(232,170,61,.12); border-color: rgba(232,170,61,.3);">
                    <span class="dot"></span> Life at Bengal IT Hub
                </span>
                <h2 style="color: #ffffff;">More Than Just Work</h2>
                <p style="color: rgba(255,255,255,.78);">Celebrations, festivals, milestones, and time spent together outside the sprint board.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($blog['culture'] as $moment)
                    <div class="bs-culture-card reveal">
                        <img src="{{ $moment['image'] }}" alt="{{ $moment['title'] }} at Bengal IT Hub" loading="lazy" decoding="async">
                        <div class="overlay">
                            <h3>{{ $moment['title'] }}</h3>
                            <p>{{ $moment['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Awards & Recognition Spotlight ── --}}
    <section id="awards" class="bs-section" style="background: var(--bs-bg, #F5F8F8);">
        <div class="bs-container">
            <div class="bs-spotlight reveal">
                <div class="copy">
                    <span class="bs-eyebrow"><span class="dot"></span> Awards &amp; Recognition</span>
                    <h2>{{ $blog['awards']['title'] }}</h2>
                    <p>{{ $blog['awards']['body'] }}</p>
                    <div class="actions">
                        <a class="bs-btn-gold" href="{{ $blog['awards']['href'] }}">
                            View Awards &amp; Recognition
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="15" height="15" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                <div class="visual">
                    <img src="{{ $blog['awards']['image'] }}" alt="Awards and recognition at Bengal IT Hub" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    {{-- ── Opportunities ── --}}
    <section id="opportunities" class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Opportunities</span>
                <h2>Grow With Bengal IT Hub</h2>
                <p>Ways to learn, work, and partner with us as we build.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($blog['opportunities'] as $opportunity)
                    <article class="bs-card reveal">
                        <div class="bs-icon-badge">
                            @include('partials.icon', ['name' => $opportunity['icon']])
                        </div>
                        <h3>{{ $opportunity['title'] }}</h3>
                        <p>{{ $opportunity['body'] }}</p>
                    </article>
                @endforeach
            </div>

            <div style="margin-top: 40px; display: flex; justify-content: center;" class="reveal">
                <a class="bs-btn-gold" href="/contact?interest=Careers">Get In Touch About Opportunities</a>
            </div>
        </div>
    </section>

    {{-- ── Stay Connected CTA Banner ── --}}
    <section class="bs-section" style="background: var(--bs-bg, #F5F8F8);">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <span class="bs-eyebrow" style="color: var(--bs-gold-lt); background: rgba(232,170,61,.12); border-color: rgba(232,170,61,.3);">
                    <span class="dot"></span> Stay Connected
                </span>
                <h2>Never miss what's happening at Bengal IT Hub</h2>
                <p>Newsletter sign-up is coming soon. Until then, this page is the best place to catch new posts, events, and updates.</p>
                <div class="actions">
                    <a class="bs-btn-gold" href="{{ route('contact', ['interest' => 'Newsletter & Updates']) }}">
                        Get In Touch
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="15" height="15" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    var els = document.querySelectorAll('[data-blog] .reveal');
    if (!els.length) return;
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('in-view'); io.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
    els.forEach(function (el) { io.observe(el); });
})();
</script>

@endsection
