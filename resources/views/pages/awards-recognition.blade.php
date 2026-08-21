@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — mirrors the Bengal Signal design
     system from resources/views/bengal-demo/assets/css/site.css
     Scoped under [data-awards] so it never bleeds to other pages.
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

[data-awards] {
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
[data-awards] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-awards] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsAwardsMarquee 32s linear infinite;
}
[data-awards] .bs-marquee-track span {
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
[data-awards] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsAwardsMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-awards] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-awards] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; }
[data-awards] .bs-breadcrumb a:hover { color: var(--bs-primary); }
[data-awards] .bs-breadcrumb .sep { opacity: .5; }
[data-awards] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-awards] .bs-page-hero {
    padding: 64px 0 56px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-awards] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 780px;
    color: var(--bs-text); margin: 0 0 .5em;
}
[data-awards] .bs-page-hero p.lead {
    max-width: 620px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
}

/* ---------- eyebrow ---------- */
[data-awards] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
}
[data-awards] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

/* ---------- container ---------- */
[data-awards] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}

/* ---------- section ---------- */
[data-awards] .bs-section { padding: 100px 0; position: relative; }
[data-awards] .bs-section-alt { background-color: var(--bs-surface-alt); }
@media (max-width: 767px) { [data-awards] .bs-section { padding: 60px 0; } }

/* ---------- section head ---------- */
[data-awards] .bs-section-head { max-width: 680px; margin: 0 auto 56px; text-align: center; }
[data-awards] .bs-section-head.left { margin-left: 0; text-align: left; }
[data-awards] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}

/* ---------- grid ---------- */
[data-awards] .bs-grid { display: grid; gap: 22px; }
[data-awards] .bs-grid-2 { grid-template-columns: repeat(2,1fr); }
[data-awards] .bs-grid-3 { grid-template-columns: repeat(3,1fr); }
[data-awards] .bs-grid-4 { grid-template-columns: repeat(4,1fr); }
@media (max-width: 991px) {
    [data-awards] .bs-grid-3,
    [data-awards] .bs-grid-4 { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 640px) {
    [data-awards] .bs-grid-2,
    [data-awards] .bs-grid-3,
    [data-awards] .bs-grid-4 { grid-template-columns: 1fr; }
}

/* ---------- photo-card ---------- */
[data-awards] .bs-photo-card {
    border-radius: var(--bs-radius-md); overflow: hidden;
    border: 1px solid var(--bs-border); background-color: var(--bs-surface);
    box-shadow: var(--bs-shadow-sm);
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-awards] .bs-photo-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(30,74,95,.12);
    border-color: rgba(232,170,61,.45);
}
[data-awards] .bs-photo-card img {
    width: 100%; height: 190px; object-fit: cover; display: block;
    transition: transform .5s ease;
}
[data-awards] .bs-photo-card:hover img { transform: scale(1.06); }
[data-awards] .bs-photo-card .body { padding: 18px 20px; }

/* ---------- badge tags ---------- */
[data-awards] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif;
    font-size: .7rem; font-weight: 700; padding: 4px 11px;
    border-radius: var(--bs-radius-pill); margin-bottom: 12px;
}
[data-awards] .bs-badge-gold {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif;
    font-size: .7rem; font-weight: 800; padding: 5px 12px;
    border-radius: var(--bs-radius-pill); margin-bottom: 12px;
}

/* ---------- card (bento) ---------- */
[data-awards] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 30px 24px;
    box-shadow: var(--bs-shadow-sm); transition: transform .26s ease, box-shadow .26s ease;
    display: flex; flex-direction: column;
}
[data-awards] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
}
[data-awards] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.2rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .5em; letter-spacing: -.01em;
}
[data-awards] .bs-card p {
    font-size: .92rem; line-height: 1.75; color: var(--bs-muted); margin: 0; flex: 1;
}
[data-awards] .bs-card a.cta-link {
    display: inline-flex; align-items: center; gap: .35rem;
    margin-top: 1.25rem; font-family: 'Outfit', sans-serif;
    font-weight: 700; font-size: .88rem; color: var(--bs-primary);
    transition: color .2s, gap .2s;
}
[data-awards] .bs-card a.cta-link:hover { color: var(--bs-gold); gap: .6rem; }

/* ---------- icon badge ---------- */
[data-awards] .bs-icon-badge {
    width: 52px; height: 52px; border-radius: var(--bs-radius-sm);
    background: linear-gradient(135deg, rgba(30,74,95,.14), rgba(232,170,61,.14));
    color: var(--bs-primary);
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
}
[data-awards] .bs-icon-badge svg { width: 22px; height: 22px; }

/* ---------- placeholder slot ---------- */
[data-awards] .bs-slot {
    display: flex; align-items: center; gap: 1rem;
    border-radius: 14px; border: 2px dashed var(--bs-border);
    background: rgba(248,250,252,.8); padding: 1.25rem 1.5rem;
    transition: border-color .22s, background .22s, transform .22s, box-shadow .22s;
}
[data-awards] .bs-slot:hover {
    border-color: rgba(30,74,95,.4);
    background: rgba(216,233,236,.4);
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(30,74,95,.06);
}
[data-awards] .bs-slot .slot-icon {
    width: 46px; height: 46px; flex-shrink: 0; border-radius: 10px;
    background: var(--bs-surface); border: 1px solid var(--bs-border);
    display: flex; align-items: center; justify-content: center; color: var(--bs-primary);
    transition: border-color .22s;
}
[data-awards] .bs-slot:hover .slot-icon { border-color: rgba(30,74,95,.4); }
[data-awards] .bs-slot .slot-label { font-weight: 700; color: var(--bs-text); font-size: .95rem; font-family: 'Outfit', sans-serif; }
[data-awards] .bs-slot .slot-status {
    display: inline-block; margin-top: 3px;
    font-family: 'Outfit', sans-serif;
    font-size: .68rem; font-weight: 700; letter-spacing: .09em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 2px 10px; border-radius: 999px; border: 1px solid rgba(30,74,95,.18);
}

/* ---------- spotlight (Vision 2030) ---------- */
[data-awards] .bs-spotlight {
    background: linear-gradient(135deg, #0a1f28 0%, #123544 55%, #1e4a5f 100%);
    border-radius: 20px; overflow: hidden;
    border: 1px solid rgba(255,255,255,.1);
    box-shadow: 0 20px 50px rgba(10,31,40,.2); color: #fff;
    display: grid; gap: 0;
}
@media (min-width: 1024px) { [data-awards] .bs-spotlight { grid-template-columns: 1fr 1fr; } }

[data-awards] .bs-spotlight .copy { padding: 56px 48px; }
@media (max-width: 767px) { [data-awards] .bs-spotlight .copy { padding: 36px 24px; } }
[data-awards] .bs-spotlight h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight: 600; color: #fff;
    margin: .75rem 0 1rem; line-height: 1.15; letter-spacing: -.01em;
}
[data-awards] .bs-spotlight .bs-eyebrow { color: var(--bs-gold-lt); background: rgba(232,170,61,.12); border-color: rgba(232,170,61,.3); }
[data-awards] .bs-spotlight p { color: rgba(255,255,255,.78); font-size: 1.05rem; line-height: 1.75; margin-bottom: 0; }
[data-awards] .bs-spotlight .actions { display: flex; gap: .875rem; flex-wrap: wrap; margin-top: 2rem; }
[data-awards] .bs-spotlight .visual {
    position: relative; min-height: 280px; overflow: hidden;
}
[data-awards] .bs-spotlight .visual img { width: 100%; height: 100%; object-fit: cover; display: block; }
[data-awards] .bs-spotlight .visual::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,31,40,.55), transparent 60%);
}
@media (min-width: 1024px) {
    [data-awards] .bs-spotlight .visual::after {
        background: linear-gradient(to right, rgba(10,31,40,.5) 0%, transparent 55%);
    }
}

/* ---------- cta-banner ---------- */
[data-awards] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 60px;
    text-align: center; color: #fff;
    position: relative; overflow: hidden;
}
[data-awards] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.15) 0%, transparent 68%);
    pointer-events: none;
}
[data-awards] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.7rem,3vw,2.4rem); font-weight: 600; color: #fff;
    margin: .5rem 0 1rem; letter-spacing: -.01em;
}
[data-awards] .bs-cta-banner p { color: rgba(255,255,255,.78); max-width: 560px; margin: 0 auto 1.75rem; }
[data-awards] .bs-cta-banner .actions { display: flex; gap: .875rem; flex-wrap: wrap; justify-content: center; }
@media (max-width: 640px) { [data-awards] .bs-cta-banner { padding: 40px 24px; } }

/* ---------- buttons ---------- */
[data-awards] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 15px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-awards] .bs-btn-gold:hover { background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35); transform: translateY(-2px); }
[data-awards] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 15px 30px; border-radius: var(--bs-radius-pill);
    transition: border-color .22s, color .22s, transform .22s;
}
[data-awards] .bs-btn-outline:hover { border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px); }
[data-awards] .bs-btn-outline-white {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid rgba(255,255,255,.38); color: #fff;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 15px 30px; border-radius: var(--bs-radius-pill);
    transition: border-color .22s, background .22s, transform .22s;
}
[data-awards] .bs-btn-outline-white:hover { border-color: #fff; background: rgba(255,255,255,.1); transform: translateY(-2px); }

/* ---------- Dark mode (when html.dark or [data-theme="dark"]) ---------- */
html.dark [data-awards],
[data-theme="dark"] [data-awards] {
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

[data-awards] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* Dark mode specific component refinements */
html.dark [data-awards] .bs-page-hero,
[data-theme="dark"] [data-awards] .bs-page-hero {
    background: #0A1F28;
}

html.dark [data-awards] .bs-page-hero h1,
[data-theme="dark"] [data-awards] .bs-page-hero h1 {
    color: #EAF4F6;
}

html.dark [data-awards] .bs-page-hero p.lead,
[data-theme="dark"] [data-awards] .bs-page-hero p.lead {
    color: #93B2BA;
}

html.dark [data-awards] .bs-eyebrow,
[data-theme="dark"] [data-awards] .bs-eyebrow {
    color: #F5C978;
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}

html.dark [data-awards] .bs-eyebrow .dot,
[data-theme="dark"] [data-awards] .bs-eyebrow .dot {
    background-color: #E8AA3D;
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

html.dark [data-awards] .bs-section-alt,
[data-theme="dark"] [data-awards] .bs-section-alt {
    background-color: #163944;
}

html.dark [data-awards] .bs-section-head h2,
[data-theme="dark"] [data-awards] .bs-section-head h2 {
    color: #EAF4F6;
}

html.dark [data-awards] .bs-section-head p,
[data-theme="dark"] [data-awards] .bs-section-head p {
    color: #93B2BA;
}

html.dark [data-awards] .bs-photo-card,
[data-theme="dark"] [data-awards] .bs-photo-card {
    background-color: #123039;
    border-color: #21454F;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

html.dark [data-awards] .bs-photo-card:hover,
[data-theme="dark"] [data-awards] .bs-photo-card:hover {
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}

html.dark [data-awards] .bs-photo-card h3,
[data-theme="dark"] [data-awards] .bs-photo-card h3 {
    color: #EAF4F6;
}

html.dark [data-awards] .bs-photo-card:hover h3,
[data-theme="dark"] [data-awards] .bs-photo-card:hover h3 {
    color: #F5C978;
}

html.dark [data-awards] .bs-photo-card p,
[data-theme="dark"] [data-awards] .bs-photo-card p {
    color: #93B2BA;
}

html.dark [data-awards] .bs-card,
[data-theme="dark"] [data-awards] .bs-card {
    background-color: #123039;
    border-color: #21454F;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

html.dark [data-awards] .bs-card:hover,
[data-theme="dark"] [data-awards] .bs-card:hover {
    border-color: rgba(232, 170, 61, 0.45);
    box-shadow: 0 16px 36px rgba(0,0,0,0.45);
}

html.dark [data-awards] .bs-card h3,
[data-theme="dark"] [data-awards] .bs-card h3 {
    color: #EAF4F6;
}

html.dark [data-awards] .bs-card:hover h3,
[data-theme="dark"] [data-awards] .bs-card:hover h3 {
    color: #F5C978;
}

html.dark [data-awards] .bs-card p,
[data-theme="dark"] [data-awards] .bs-card p {
    color: #93B2BA;
}

html.dark [data-awards] .bs-card a.cta-link,
[data-theme="dark"] [data-awards] .bs-card a.cta-link {
    color: #4F9BB8;
}

html.dark [data-awards] .bs-card a.cta-link:hover,
[data-theme="dark"] [data-awards] .bs-card a.cta-link:hover {
    color: #F5C978;
}

html.dark [data-awards] .bs-icon-badge,
[data-theme="dark"] [data-awards] .bs-icon-badge {
    background: linear-gradient(135deg, rgba(79, 155, 184, 0.2), rgba(232, 170, 61, 0.2));
    color: #F5C978;
}

html.dark [data-awards] .bs-badge-outline,
[data-theme="dark"] [data-awards] .bs-badge-outline {
    border-color: #21454F;
    color: #93B2BA;
}

html.dark [data-awards] .bs-badge-gold,
[data-theme="dark"] [data-awards] .bs-badge-gold {
    background-color: #E8AA3D;
    color: #12242B;
}

html.dark [data-awards] .bs-slot,
[data-theme="dark"] [data-awards] .bs-slot {
    border-color: #21454F;
    background: rgba(18, 48, 57, 0.7);
}

html.dark [data-awards] .bs-slot:hover,
[data-theme="dark"] [data-awards] .bs-slot:hover {
    border-color: rgba(232, 170, 61, 0.4);
    background: rgba(22, 57, 68, 0.9);
    box-shadow: 0 10px 24px rgba(0,0,0,0.3);
}

html.dark [data-awards] .bs-slot .slot-icon,
[data-theme="dark"] [data-awards] .bs-slot .slot-icon {
    background: #163944;
    border-color: #21454F;
    color: #4F9BB8;
}

html.dark [data-awards] .bs-slot:hover .slot-icon,
[data-theme="dark"] [data-awards] .bs-slot:hover .slot-icon {
    border-color: rgba(232, 170, 61, 0.4);
    color: #F5C978;
}

html.dark [data-awards] .bs-slot .slot-label,
[data-theme="dark"] [data-awards] .bs-slot .slot-label {
    color: #EAF4F6;
}

html.dark [data-awards] .bs-slot .slot-status,
[data-theme="dark"] [data-awards] .bs-slot .slot-status {
    color: #4F9BB8;
    background: rgba(79, 155, 184, 0.12);
    border-color: rgba(79, 155, 184, 0.25);
}

html.dark [data-awards] .bs-spotlight,
[data-theme="dark"] [data-awards] .bs-spotlight {
    background: linear-gradient(135deg, #07171e 0%, #0c2631 55%, #163944 100%);
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark [data-awards] .bs-cta-banner,
[data-theme="dark"] [data-awards] .bs-cta-banner {
    background: linear-gradient(120deg, #123544, #0a1f28);
    border: 1px solid #21454F;
}

html.dark [data-awards] .bs-btn-outline,
[data-theme="dark"] [data-awards] .bs-btn-outline {
    border-color: #21454F;
    color: #EAF4F6;
}

html.dark [data-awards] .bs-btn-outline:hover,
[data-theme="dark"] [data-awards] .bs-btn-outline:hover {
    border-color: #4F9BB8;
    color: #4F9BB8;
}

html.dark [data-awards] .bs-breadcrumb a,
[data-theme="dark"] [data-awards] .bs-breadcrumb a {
    color: #93B2BA;
}

html.dark [data-awards] .bs-breadcrumb a:hover,
[data-theme="dark"] [data-awards] .bs-breadcrumb a:hover {
    color: #F5C978;
}

html.dark [data-awards] .bs-breadcrumb .current,
[data-theme="dark"] [data-awards] .bs-breadcrumb .current {
    color: #EAF4F6;
}

/* ---------- reveal animation ---------- */
[data-awards] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-awards] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

@php
    $demoImages = [
        'Industry Awards' => asset('assets/images/award-industry.jpg'),
        'Media Recognition' => asset('assets/images/award-media.jpg'),
        'Certifications & Milestones' => asset('assets/images/award-cert.jpg'),
        'Partner & Client Recognition' => asset('assets/images/award-partner.jpg'),
    ];
@endphp

<div data-awards>
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
            <span class="current">Awards &amp; Recognition</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow"><span class="dot"></span> {{ $awards['intro']['eyebrow'] }}</span>
            <h1>{{ $awards['intro']['title'] }}</h1>
            @foreach($awards['intro']['body'] as $para)
                <p class="lead">{{ $para }}</p>
            @endforeach
        </div>
    </section>

    {{-- ── 4-column Photo Cards (Categories) ── --}}
    <section class="bs-section" style="padding-top: 0; background: var(--bs-bg, #F5F8F8);">
        <div class="bs-container">
            <div class="bs-grid bs-grid-4">
                @foreach($awards['categories'] as $category)
                    @php
                        $categoryImg = $demoImages[$category['title']] ?? $category['image'];
                    @endphp
                    <div class="bs-photo-card reveal">
                        <img src="{{ $categoryImg }}" alt="{{ $category['title'] }}" loading="lazy" decoding="async">
                        <div class="body">
                            <span class="bs-badge-outline">Recognition</span>
                            <h4 style="margin: 0; font-family: 'Fraunces', serif; font-weight: 600; font-size: 1.05rem; color: #0F262E; letter-spacing: -.01em;">{{ $category['title'] }}</h4>
                            <p style="margin-top: .5rem; font-size: .88rem; line-height: 1.7; color: #52707A;">{{ $category['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Journey / Bigger Picture ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> The Bigger Picture</span>
                <h2>What Recognition Is Building Toward</h2>
                <p style="color: #52707A; margin: 0; font-size: 1rem; line-height: 1.75;">Awards and mentions matter most when they add up to something. Here's the throughline connecting our present milestones to where we're headed.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($awards['journey'] as $item)
                    <div class="bs-card reveal">
                        <div class="bs-icon-badge">
                            @include('partials.icon', ['name' => $item['icon']])
                        </div>
                        <span class="bs-badge-gold">{{ $item['tag'] }}</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['body'] }}</p>
                        <a class="cta-link" href="{{ $item['href'] }}">
                            {{ $item['cta'] }}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Reserved & In-Progress Showcase ── --}}
    <section class="bs-section" style="background: var(--bs-bg, #F5F8F8);">
        <div class="bs-container">
            <div class="bs-section-head left reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Reserved &amp; In Progress</span>
                <h2>The Showcase We're Filling In</h2>
                <p style="color: #52707A; margin: 0; font-size: 1rem; line-height: 1.75;">We'd rather show you an honest, growing wall than a fabricated one. Each slot below is reserved for a real, upcoming milestone as it's earned.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($awards['placeholders'] as $slot)
                    <div class="bs-slot reveal">
                        <span class="slot-icon">
                            @include('partials.icon', ['name' => $slot['icon']])
                        </span>
                        <div>
                            <p class="slot-label">{{ $slot['label'] }}</p>
                            <span class="slot-status">Reserved &middot; Coming Soon</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Vision 2030 Spotlight ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-spotlight reveal">
                <div class="copy">
                    <span class="bs-eyebrow"><span class="dot"></span> Where This Is Headed</span>
                    <h2>Every Milestone Feeds Vision 2030</h2>
                    <p>Every award, certification, and mention we work toward supports the same goal: positioning Bengal as India's AI Innovation Hub, and building a track record the whole ecosystem can point to.</p>
                    <div class="actions">
                        <a class="bs-btn-gold" href="/vision-2030">
                            Explore Vision 2030
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="15" height="15" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a class="bs-btn-outline-white" href="{{ route('our-partners.index') }}">Meet Our Partners</a>
                    </div>
                </div>
                <div class="visual">
                    <img src="{{ $awards['intro']['image'] }}" alt="Bengal IT Hub working toward Vision 2030 recognition" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA Banner ── --}}
    <section class="bs-section" style="background: var(--bs-bg, #F5F8F8);">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <span class="bs-eyebrow" style="color: var(--bs-gold-lt, #F5C978); background: rgba(232,170,61,.12); border-color: rgba(232,170,61,.3);">
                    <span class="dot"></span> Have Something to Share?
                </span>
                <h2>Won an award, got featured, or partnered with us?</h2>
                <p>If Bengal IT Hub has been recognised somewhere and you'd like it featured on this page, let us know.</p>
                <div class="actions">
                    <a class="bs-btn-gold" href="{{ route('contact', ['interest' => 'Awards & Recognition']) }}">
                        Get In Touch
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="15" height="15" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a class="bs-btn-outline-white" href="{{ route('blog.index') }}">See Our Story So Far</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    var els = document.querySelectorAll('[data-awards] .reveal');
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
