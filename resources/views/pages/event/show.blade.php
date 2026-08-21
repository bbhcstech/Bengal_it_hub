@extends('layouts.app')

@php
    $chiefGuest = collect($event['people'])->first(fn ($p) => $p[0] === 'Chief Guest');
    $chiefAdviser = collect($event['people'])->first(fn ($p) => $p[0] === 'Chief Adviser');
    $speakers = collect($event['people'])->filter(fn ($p) => $p[0] === 'Speakers & Panelists')->values();
    $hackFestPath = 'HackFest/';
    $hackFestImage = fn ($file) => asset($hackFestPath.rawurlencode($file));
    $personImages = [
        'Dr. Mahuya Hom Choudhury' => 'Dr.Mahuya Hom Choudhury.png',
        'Mr. Debashis Sen' => 'Debasish_Sen.png',
        'Dr. Pallabi Sengupta' => 'pallabi sengupta image.jpg',
        'Dr. Swastik Nandi' => 'Dr. Swastik.jpeg',
        'Mr. Monoj K. Nath' => 'Monoj Nath.jpeg',
        'Dr. Tanushyam Chattopadhyay' => 'Tanushyam Chattopadhyay.jpg',
        'Adv. Tapojit Dey' => 'Tapojit Dey.jpeg',
        'Mr. Hemanta Ghosh' => 'HEMANTA GHOSH.jpg.jpeg',
        'Dr. Ranjan Ghosh' => 'Dr Ranjan Ghosh.jpeg',
        'Mr. Souvik Das' => 'Souvik Das.jpeg',
    ];
    $personPhoto = fn ($name) => !empty($personImages[$name]) ? $hackFestImage($personImages[$name]) : null;
    $eventLogo = $hackFestImage('Hackathon_Logo_B&W.png');
    $heroTitle = trim(str_replace('PRAGATI 2026', '', $event['name']));
@endphp

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     The Bengal HackFest PRAGATI 2026 (Light & Dark Mode Support)
     Scoped strictly under [data-hackfest]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode tokens ---------- */
[data-hackfest] {
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

/* ---------- Dark mode tokens ---------- */
html.dark [data-hackfest],
[data-theme="dark"] [data-hackfest] {
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

[data-hackfest] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- Marquee Strip ---------- */
[data-hackfest] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-hackfest] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsHackMarquee 32s linear infinite;
}
[data-hackfest] .bs-marquee-track span {
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
[data-hackfest] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsHackMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- Breadcrumb ---------- */
[data-hackfest] .bs-breadcrumb {
    padding: 20px 0 0;
    font-size: 0.88rem;
    color: var(--bs-muted);
}
[data-hackfest] .bs-breadcrumb a {
    color: var(--bs-primary);
    text-decoration: none;
    font-weight: 600;
}
[data-hackfest] .bs-breadcrumb a:hover {
    text-decoration: underline;
}
[data-hackfest] .bs-breadcrumb .sep {
    margin: 0 10px;
    opacity: 0.5;
}
[data-hackfest] .bs-breadcrumb .current {
    font-weight: 600;
    color: var(--bs-text);
}

/* ---------- Page Hero ---------- */
[data-hackfest] .bs-hero {
    position: relative;
    overflow: hidden;
    background: radial-gradient(circle at 20% 15%, #2E7089 0%, #123544 55%, #0A1F28 100%);
    color: #fff;
    padding: 72px 0 88px;
    margin-top: 14px;
    border-radius: var(--bs-radius-lg);
    box-shadow: var(--bs-shadow-lg);
}
[data-hackfest] .bs-hero .blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.5;
    pointer-events: none;
    animation: bsHackBlob 18s ease-in-out infinite;
}
[data-hackfest] .bs-hero .blob-1 {
    width: 420px; height: 420px;
    top: -120px; right: -100px;
    background-color: #F2A93B;
    animation-delay: 0s;
}
[data-hackfest] .bs-hero .blob-2 {
    width: 380px; height: 380px;
    bottom: -150px; left: -100px;
    background-color: #2E7089;
    animation-delay: -7s;
}
@keyframes bsHackBlob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(24px, -18px) scale(1.08); }
}

[data-hackfest] .bs-hero-inner {
    position: relative;
    z-index: 2;
    display: grid;
    gap: 48px;
    align-items: center;
}
@media (min-width: 1024px) {
    [data-hackfest] .bs-hero-inner {
        grid-template-columns: 1.1fr 0.9fr;
    }
}

[data-hackfest] .bs-eyebrow-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: 0.76rem;
    font-weight: 700;
    letter-spacing: 0.10em;
    text-transform: uppercase;
    color: #F5C978;
    background-color: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 7px 16px;
    border-radius: var(--bs-radius-pill);
    margin-bottom: 22px;
}
[data-hackfest] .bs-eyebrow-pill .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #F2A93B;
    box-shadow: 0 0 0 3px rgba(242, 169, 59, 0.25);
}

[data-hackfest] .bs-hero h1 {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-style: italic;
    font-size: clamp(2.2rem, 4.5vw, 3.6rem);
    line-height: 1.15;
    margin: 0 0 20px;
    color: #fff;
}
[data-hackfest] .bs-hero h1 strong {
    display: block;
    font-family: 'Outfit', sans-serif;
    font-style: normal;
    font-weight: 900;
    letter-spacing: -0.01em;
    color: #F5C978;
    font-size: clamp(2rem, 4.2vw, 3.4rem);
    margin-top: 4px;
}
[data-hackfest] .bs-hero .lead-text {
    font-size: 1.12rem;
    line-height: 1.7;
    color: #CDE2E6;
    margin: 0 0 24px;
    max-width: 620px;
}

[data-hackfest] .bs-hero-meta-box {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 16px 20px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--bs-radius-md);
    margin-bottom: 28px;
    font-size: 0.95rem;
    color: #E2F0F3;
}
[data-hackfest] .bs-hero-meta-box span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
[data-hackfest] .bs-hero-meta-box span strong {
    color: #F5C978;
}

[data-hackfest] .bs-hero-cta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
}

/* Buttons */
[data-hackfest] .bs-btn-gold {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: var(--bs-radius-pill);
    background: linear-gradient(135deg, #E8AA3D, #F5C978);
    color: #0A1F28;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 0.92rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(232, 170, 61, 0.35);
    transition: transform 180ms ease, box-shadow 180ms ease;
    border: none;
    cursor: pointer;
}
[data-hackfest] .bs-btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(232, 170, 61, 0.45);
}

[data-hackfest] .bs-btn-outline-light {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: var(--bs-radius-pill);
    background: rgba(255, 255, 255, 0.08);
    border: 1.5px solid rgba(255, 255, 255, 0.28);
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: 0.90rem;
    text-decoration: none;
    transition: background-color 180ms ease, border-color 180ms ease, transform 180ms ease;
}
[data-hackfest] .bs-btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.16);
    border-color: #fff;
    transform: translateY(-2px);
}

[data-hackfest] .bs-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: var(--bs-radius-pill);
    background: linear-gradient(135deg, var(--bs-primary), var(--bs-primary-lt));
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 0.92rem;
    text-decoration: none;
    box-shadow: var(--bs-shadow-md);
    transition: transform 180ms ease, box-shadow 180ms ease;
    border: none;
    cursor: pointer;
}
[data-hackfest] .bs-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--bs-shadow-lg);
}

[data-hackfest] .bs-btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: var(--bs-radius-pill);
    background: transparent;
    border: 1.5px solid var(--bs-border);
    color: var(--bs-primary);
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: 0.90rem;
    text-decoration: none;
    transition: all 180ms ease;
}
[data-hackfest] .bs-btn-outline:hover {
    background: var(--bs-surface-alt);
    border-color: var(--bs-primary);
    transform: translateY(-2px);
}

/* Stats counters in Hero */
[data-hackfest] .bs-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
[data-hackfest] .bs-stat-card {
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--bs-radius-md);
    padding: 24px 20px;
    text-align: center;
    transition: transform 200ms ease, background-color 200ms ease;
}
[data-hackfest] .bs-stat-card:hover {
    transform: translateY(-4px);
    background: rgba(255, 255, 255, 0.10);
}
[data-hackfest] .bs-stat-card .num {
    font-family: 'Fraunces', serif;
    font-weight: 700;
    font-size: clamp(2rem, 3.2vw, 2.6rem);
    color: #F5C978;
    line-height: 1;
    margin-bottom: 6px;
}
[data-hackfest] .bs-stat-card .lbl {
    font-family: 'Outfit', sans-serif;
    font-size: 0.84rem;
    color: #C2DBDF;
    font-weight: 600;
    letter-spacing: 0.02em;
}

/* Section Containers & Headings */
[data-hackfest] .bs-section {
    padding: 72px 0;
}
[data-hackfest] .bs-section-alt {
    background-color: var(--bs-surface-alt);
}
[data-hackfest] .bs-section-head {
    max-width: 720px;
    margin-bottom: 48px;
}
[data-hackfest] .bs-section-head.center {
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}
[data-hackfest] .bs-section-head .eyebrow {
    font-family: 'Outfit', sans-serif;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.10em;
    text-transform: uppercase;
    color: var(--bs-gold);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}
[data-hackfest] .bs-section-head .eyebrow .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: var(--bs-gold);
}
[data-hackfest] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.9rem, 3.2vw, 2.7rem);
    font-weight: 600;
    color: var(--bs-text);
    line-height: 1.22;
    margin: 0 0 14px;
}
[data-hackfest] .bs-section-head p {
    font-size: 1.05rem;
    color: var(--bs-muted);
    line-height: 1.68;
    margin: 0;
}

/* General Cards */
[data-hackfest] .bs-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 32px;
    box-shadow: var(--bs-shadow-sm);
    transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
    display: flex;
    flex-direction: column;
}
[data-hackfest] .bs-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--bs-shadow-md);
    border-color: var(--bs-primary-lt);
}

/* Key People Feature Cards (Chief Guest & Chief Adviser) */
[data-hackfest] .bs-person-feature-grid {
    display: grid;
    gap: 28px;
}
@media (min-width: 900px) {
    [data-hackfest] .bs-person-feature-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
[data-hackfest] .bs-person-feature-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 32px;
    display: grid;
    gap: 24px;
    box-shadow: var(--bs-shadow-sm);
}
@media (min-width: 600px) {
    [data-hackfest] .bs-person-feature-card {
        grid-template-columns: 140px 1fr;
    }
}
[data-hackfest] .bs-person-avatar {
    width: 140px;
    height: 140px;
    border-radius: var(--bs-radius-md);
    object-fit: cover;
    border: 2px solid var(--bs-gold);
    box-shadow: var(--bs-shadow-sm);
}
[data-hackfest] .bs-badge-tag {
    display: inline-block;
    font-family: 'Outfit', sans-serif;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--bs-gold);
    background: rgba(232, 170, 61, 0.12);
    border: 1px solid rgba(232, 170, 61, 0.3);
    padding: 4px 12px;
    border-radius: var(--bs-radius-pill);
    margin-bottom: 12px;
    width: fit-content;
}
[data-hackfest] .bs-person-feature-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.45rem;
    font-weight: 600;
    color: var(--bs-text);
    margin: 0 0 10px;
}
[data-hackfest] .bs-person-feature-card p {
    font-size: 0.92rem;
    color: var(--bs-muted);
    line-height: 1.6;
    margin: 0 0 12px;
}
[data-hackfest] .bs-person-feature-card a.linkedin-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--bs-primary);
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    margin-top: 6px;
}
[data-hackfest] .bs-person-feature-card a.linkedin-link:hover {
    text-decoration: underline;
}

/* Speakers Grid */
[data-hackfest] .bs-speakers-grid {
    display: grid;
    gap: 24px;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}
[data-hackfest] .bs-speaker-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 24px;
    text-align: center;
    box-shadow: var(--bs-shadow-sm);
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 200ms ease, box-shadow 200ms ease;
}
[data-hackfest] .bs-speaker-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--bs-shadow-md);
}
[data-hackfest] .bs-speaker-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 16px;
    border: 2.5px solid var(--bs-gold);
    box-shadow: var(--bs-shadow-sm);
}
[data-hackfest] .bs-speaker-fallback {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 16px;
    background: linear-gradient(135deg, var(--bs-primary), var(--bs-primary-lt));
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--bs-shadow-sm);
}
[data-hackfest] .bs-speaker-card .role {
    font-family: 'Outfit', sans-serif;
    font-size: 0.74rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--bs-gold);
    margin-bottom: 6px;
}
[data-hackfest] .bs-speaker-card h4 {
    font-family: 'Fraunces', serif;
    font-size: 1.18rem;
    font-weight: 600;
    color: var(--bs-text);
    margin: 0 0 10px;
}
[data-hackfest] .bs-speaker-card p {
    font-size: 0.86rem;
    color: var(--bs-muted);
    line-height: 1.55;
    margin: 0 0 14px;
    flex-grow: 1;
}

/* Timeline Cards */
[data-hackfest] .bs-timeline-grid {
    display: grid;
    gap: 16px;
}
[data-hackfest] .bs-timeline-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px 24px;
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    box-shadow: var(--bs-shadow-sm);
    transition: transform 180ms ease;
}
[data-hackfest] .bs-timeline-card:hover {
    transform: translateX(4px);
    border-color: var(--bs-primary);
}
[data-hackfest] .bs-timeline-num {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--bs-surface-alt);
    border: 1.5px solid var(--bs-border);
    color: var(--bs-primary);
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 1.05rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
[data-hackfest] .bs-timeline-info {
    flex-grow: 1;
}
[data-hackfest] .bs-timeline-info p {
    margin: 0 0 4px;
    font-size: 0.90rem;
    color: var(--bs-muted);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
[data-hackfest] .bs-timeline-info p em {
    font-style: normal;
    font-size: 0.70rem;
    text-transform: uppercase;
    font-weight: 800;
    background: #10B981;
    color: #fff;
    padding: 2px 8px;
    border-radius: var(--bs-radius-pill);
}
[data-hackfest] .bs-timeline-info strong {
    font-size: 1.08rem;
    color: var(--bs-text);
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
}

/* Participation Tracks */
[data-hackfest] .bs-tracks-grid {
    display: grid;
    gap: 24px;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}
[data-hackfest] .bs-track-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 32px;
    display: flex;
    flex-direction: column;
    box-shadow: var(--bs-shadow-sm);
    transition: transform 220ms ease, box-shadow 220ms ease;
}
[data-hackfest] .bs-track-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--bs-shadow-md);
}
[data-hackfest] .bs-track-card .track-num {
    font-family: 'Fraunces', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--bs-gold);
    line-height: 1;
    margin-bottom: 12px;
}
[data-hackfest] .bs-track-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--bs-text);
    margin: 0 0 16px;
}
[data-hackfest] .bs-track-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    flex-grow: 1;
}
[data-hackfest] .bs-track-card ul li {
    font-size: 0.92rem;
    color: var(--bs-muted);
    line-height: 1.55;
    padding-left: 22px;
    position: relative;
}
[data-hackfest] .bs-track-card ul li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--bs-gold);
    font-weight: 900;
}
[data-hackfest] .bs-track-card a.track-link {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    color: var(--bs-primary);
    text-decoration: none;
    font-size: 0.90rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
[data-hackfest] .bs-track-card a.track-link:hover {
    text-decoration: underline;
}

/* Sponsorship Tiers Grid */
[data-hackfest] .bs-sponsor-grid {
    display: grid;
    gap: 24px;
}
@media (min-width: 960px) {
    [data-hackfest] .bs-sponsor-grid {
        grid-template-columns: 1.2fr 0.8fr;
        align-items: center;
    }
}
[data-hackfest] .bs-sponsor-pill-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 14px;
    margin-bottom: 24px;
}
[data-hackfest] .bs-sponsor-pill {
    display: inline-flex;
    align-items: center;
    padding: 8px 18px;
    border-radius: var(--bs-radius-pill);
    background-color: var(--bs-surface);
    border: 1.5px solid var(--bs-border);
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 0.86rem;
    color: var(--bs-text);
    box-shadow: var(--bs-shadow-sm);
}
[data-hackfest] .bs-sponsor-pill.is-gold {
    border-color: var(--bs-gold);
    color: var(--bs-gold);
    background: rgba(232, 170, 61, 0.08);
}

/* Venue Section (Dedicated Full Card) */
[data-hackfest] .bs-venue-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 40px;
    box-shadow: var(--bs-shadow-sm);
    max-width: 960px;
    margin: 0 auto;
}
[data-hackfest] .bs-venue-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.9rem;
    font-weight: 600;
    color: var(--bs-text);
    margin: 14px 0 8px;
}
[data-hackfest] .bs-venue-card .finale-tag {
    font-family: 'Outfit', sans-serif;
    font-size: 0.92rem;
    color: var(--bs-gold);
    font-weight: 700;
    margin-bottom: 20px;
    display: block;
}
[data-hackfest] .bs-venue-card p {
    font-size: 1rem;
    color: var(--bs-muted);
    line-height: 1.7;
    margin: 0 0 16px;
}

/* FAQ Accordion (Dedicated Vertical Section) */
[data-hackfest] .bs-faq-wrapper {
    max-width: 860px;
    margin: 0 auto;
}
[data-hackfest] .bs-faq-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
[data-hackfest] .bs-faq-item {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    overflow: hidden;
    box-shadow: var(--bs-shadow-sm);
}
[data-hackfest] .bs-faq-item summary {
    padding: 22px 26px;
    cursor: pointer;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 1.02rem;
    color: var(--bs-text);
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    user-select: none;
}
[data-hackfest] .bs-faq-item summary::-webkit-details-marker {
    display: none;
}
[data-hackfest] .bs-faq-item summary::after {
    content: '+';
    font-size: 1.5rem;
    line-height: 1;
    color: var(--bs-primary);
    transition: transform 200ms ease;
}
[data-hackfest] .bs-faq-item[open] summary::after {
    content: '−';
    transform: rotate(180deg);
}
[data-hackfest] .bs-faq-item .faq-body {
    padding: 0 26px 24px;
    color: var(--bs-muted);
    font-size: 0.95rem;
    line-height: 1.7;
    border-top: 1px solid var(--bs-border);
    padding-top: 18px;
}

/* Teaser / Media Gallery Banner */
[data-hackfest] .bs-teaser-banner {
    background: radial-gradient(circle at 10% 20%, #2E7089 0%, #123544 60%, #0A1F28 100%);
    color: #fff;
    border-radius: var(--bs-radius-md);
    padding: 44px 40px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    box-shadow: var(--bs-shadow-md);
}
[data-hackfest] .bs-teaser-banner h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.8rem;
    font-weight: 600;
    margin: 6px 0 8px;
    color: #fff;
}
[data-hackfest] .bs-teaser-banner p {
    color: #C2DBDF;
    margin: 0;
    max-width: 540px;
    font-size: 0.98rem;
}

/* Contact / Support Card */
[data-hackfest] .bs-contact-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 40px;
    display: grid;
    gap: 32px;
    align-items: center;
    box-shadow: var(--bs-shadow-sm);
}
@media (min-width: 768px) {
    [data-hackfest] .bs-contact-card {
        grid-template-columns: 140px 1fr;
    }
}
[data-hackfest] .bs-contact-logo {
    width: 130px;
    height: auto;
    max-height: 110px;
    object-fit: contain;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.1));
}
[data-hackfest] .bs-contact-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--bs-text);
    margin: 0 0 10px;
}
[data-hackfest] .bs-contact-card p {
    font-size: 0.95rem;
    color: var(--bs-muted);
    line-height: 1.6;
    margin: 0 0 6px;
}
</style>

<div data-hackfest>
    {{-- ── Marquee Strip ── --}}
    <div class="bs-marquee-strip" aria-hidden="true">
        <div class="bs-marquee-track">
            <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
            <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
        </div>
    </div>

    <div class="bih-container">
        {{-- ── Breadcrumb ── --}}
        <div class="bs-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="/hackfest-2026">News &amp; Events</a>
            <span class="sep">/</span>
            <span class="current">{{ $event['name'] }}</span>
        </div>

        {{-- ── Hero Section ── --}}
        <section class="bs-hero">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="bih-container bs-hero-inner">
                <div>
                    <span class="bs-eyebrow-pill">
                        <span class="dot"></span> {{ $event['badge'] ?? "East India's Premier HackFest" }}
                    </span>
                    <h1>
                        {{ $heroTitle }}
                        <strong>PRAGATI 2026</strong>
                    </h1>
                    <p class="lead-text">{{ $event['tagline'] }}</p>

                    <div class="bs-hero-meta-box">
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <strong>Venue:</strong> {{ $event['venue'] }}
                        </span>
                        <span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <strong>Grand Finale:</strong> {{ $event['finale'] }}
                        </span>
                    </div>

                    <div class="bs-hero-cta">
                        <a class="bs-btn-gold" href="/hackfest-2026/register">
                            Register as Participant
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a class="bs-btn-outline-light" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                        <a class="bs-btn-outline-light" href="/academic-partnership">Academic Partnership</a>
                    </div>
                </div>

                <div>
                    <div class="bs-stats-grid">
                        @foreach($event['counters'] as $label => $value)
                            <div class="bs-stat-card">
                                <div class="num">{{ $value }}</div>
                                <div class="lbl">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- ── Chief Guest & Chief Adviser Section ── --}}
    @if($chiefGuest || $chiefAdviser)
    <section class="bs-section" id="guest">
        <div class="bih-container">
            <div class="bs-section-head">
                <span class="eyebrow"><span class="dot"></span> Distinguished Leadership</span>
                <h2>Event Leadership &amp; Keynotes</h2>
                <p>Guided by visionary leaders across science, administration, and technology.</p>
            </div>

            <div class="bs-person-feature-grid">
                @if($chiefGuest)
                    <article class="bs-person-feature-card">
                        @if($personPhoto($chiefGuest[1]))
                            <img class="bs-person-avatar" src="{{ $personPhoto($chiefGuest[1]) }}" alt="{{ $chiefGuest[1] }}">
                        @else
                            <div class="bs-speaker-fallback">{{ collect(explode(' ', $chiefGuest[1]))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}</div>
                        @endif
                        <div>
                            <span class="bs-badge-tag">Chief Guest</span>
                            <h3>{{ $chiefGuest[1] }}</h3>
                            <p>As the distinguished Chief Guest of honor, she will deliver the keynote address, represent the event's highest office, and engage with attendees on strategic themes.</p>
                            <p>{{ $chiefGuest[2] }}</p>
                            @if(!empty($chiefGuest[3]))
                                <a class="linkedin-link" href="{{ $chiefGuest[3] }}" target="_blank" rel="noopener">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    Connect on LinkedIn &rarr;
                                </a>
                            @endif
                        </div>
                    </article>
                @endif

                @if($chiefAdviser)
                    <article class="bs-person-feature-card" id="adviser">
                        @if($personPhoto($chiefAdviser[1]))
                            <img class="bs-person-avatar" src="{{ $personPhoto($chiefAdviser[1]) }}" alt="{{ $chiefAdviser[1] }}">
                        @else
                            <div class="bs-speaker-fallback">{{ collect(explode(' ', $chiefAdviser[1]))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}</div>
                        @endif
                        <div>
                            <span class="bs-badge-tag">Chief Adviser</span>
                            <h3>{{ $chiefAdviser[1] }}</h3>
                            <p>As the Chief Adviser, he is providing strategic guidance on program direction, partnerships, and high-level decision-making, ensuring alignment with the event's goals.</p>
                            <p>{{ $chiefAdviser[2] }}</p>
                            @if(!empty($chiefAdviser[3]))
                                <a class="linkedin-link" href="{{ $chiefAdviser[3] }}" target="_blank" rel="noopener">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    Connect on LinkedIn &rarr;
                                </a>
                            @endif
                        </div>
                    </article>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ── Speakers & Panelists Section ── --}}
    @if($speakers->isNotEmpty())
    <section class="bs-section bs-section-alt" id="panelists">
        <div class="bih-container">
            <div class="bs-section-head center">
                <span class="eyebrow"><span class="dot"></span> Expert Mentors</span>
                <h2>Speakers &amp; Panelists</h2>
                <p>A polished showcase of the event's expert speakers, panelists, and industry leaders.</p>
            </div>

            <div class="bs-speakers-grid">
                @foreach($speakers as [$role, $name, $bio, $linkedin])
                    <article class="bs-speaker-card">
                        @if($personPhoto($name))
                            <img class="bs-speaker-img" src="{{ $personPhoto($name) }}" alt="{{ $name }}">
                        @else
                            <div class="bs-speaker-fallback">{{ collect(explode(' ', $name))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}</div>
                        @endif
                        <span class="role">{{ $role }}</span>
                        <h4>{{ $name }}</h4>
                        <p>{{ $bio }}</p>
                        @if(!empty($linkedin))
                            <a class="linkedin-link" href="{{ $linkedin }}" target="_blank" rel="noopener">LinkedIn &rarr;</a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── About Section ── --}}
    @if(!empty($event['about']))
    <section class="bs-section">
        <div class="bih-container">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                <div class="bs-card" style="background: radial-gradient(circle at 10% 10%, #2E7089 0%, #123544 60%, #0A1F28 100%); color: #fff; border-color: rgba(255,255,255,0.1); padding: 48px; text-align: center;">
                    <img src="{{ $eventLogo }}" alt="The Bengal HackFest PRAGATI 2026" style="max-height: 180px; width: auto; margin: 0 auto 24px; filter: drop-shadow(0 10px 24px rgba(0,0,0,0.3));">
                    <span class="bs-eyebrow-pill" style="margin: 0 auto 16px;"><span class="dot"></span> Grand Finale: {{ $event['finale'] }}</span>
                    <h3 style="font-family: 'Fraunces', serif; font-size: 1.6rem; color: #fff; margin: 0 0 10px;">{{ $event['name'] }}</h3>
                    <p style="color: #C2DBDF; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $event['tagline'] }}</p>
                </div>

                <div>
                    <div class="bs-section-head" style="margin-bottom: 28px;">
                        <span class="eyebrow"><span class="dot"></span> {{ $event['about']['eyebrow'] }}</span>
                        <h2>{{ $event['about']['title'] }}</h2>
                        <p>{{ $event['about']['intro'] }}</p>
                    </div>

                    <div style="display: grid; gap: 14px; margin-bottom: 24px;">
                        @foreach($event['about']['bullets'] as $bullet)
                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background: var(--bs-gold); color: #0A1F28; font-size: 0.76rem; font-weight: 900; flex-shrink: 0; margin-top: 2px;">✓</span>
                                <p style="margin: 0; font-size: 0.95rem; color: var(--bs-text); line-height: 1.6;">{{ $bullet }}</p>
                            </div>
                        @endforeach
                    </div>

                    <p style="font-size: 0.96rem; color: var(--bs-muted); line-height: 1.7; margin-bottom: 28px;">{{ $event['about']['closing'] }}</p>
                    <a class="bs-btn-primary" href="/hackfest-2026/register">Join The Fest</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ── Participation Tracks ── --}}
    @if(!empty($event['participation']))
    <section class="bs-section bs-section-alt">
        <div class="bih-container">
            <div class="bs-section-head center">
                <span class="eyebrow"><span class="dot"></span> Let's Understand</span>
                <h2>Why to Participate?</h2>
                <p>Three clear tracks for students, institutes, and corporates to build real value from one innovation platform.</p>
            </div>

            <div class="bs-tracks-grid">
                @foreach($event['participation'] as $card)
                    <article class="bs-track-card">
                        <div class="track-num">{{ $card['number'] }}</div>
                        <h3>{{ $card['title'] }}</h3>
                        <ul>
                            @foreach($card['bullets'] as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                        <a class="track-link" href="/contact">Learn More &rarr;</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── Timeline Section ── --}}
    <section class="bs-section">
        <div class="bih-container">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-start">
                <div>
                    <div class="bs-section-head">
                        <span class="eyebrow"><span class="dot"></span> The Bengal HackFest PRAGATI 2026</span>
                        <h2>Event Timeline</h2>
                        <p>Track important milestones leading up to Demo Day and the Grand Finale.</p>
                    </div>

                    <div class="bs-timeline-grid">
                        @foreach($event['timeline'] as [$label, $date, $isOpen])
                            <div class="bs-timeline-card">
                                <div class="bs-timeline-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="bs-timeline-info">
                                    <p>{{ $label }} @if($isOpen)<em>Open</em>@endif</p>
                                    <strong>{{ $date }}</strong>
                                </div>
                            </div>
                        @endforeach
                        <div class="bs-timeline-card">
                            <div class="bs-timeline-num">05</div>
                            <div class="bs-timeline-info">
                                <p>Venue</p>
                                <strong>{{ $event['venue'] }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sponsorship Tiers Panel --}}
                @if(!empty($event['sponsorship']))
                <div class="bs-card" style="background-color: var(--bs-surface); border: 1.5px solid var(--bs-border);">
                    <span class="bs-badge-tag">Sponsorship &amp; Partnership</span>
                    <h3 style="font-family: 'Fraunces', serif; font-size: 1.6rem; color: var(--bs-text); margin: 0 0 10px;">Partner with East India's student innovation stage.</h3>
                    <p style="color: var(--bs-muted); font-size: 0.95rem; line-height: 1.65; margin: 0 0 18px;">Connect your brand with 1000+ top student innovators, prestigious universities, and industry decision-makers.</p>

                    <strong style="font-family: 'Outfit', sans-serif; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.06em; color: var(--bs-text);">Sponsorship Categories:</strong>
                    <div class="bs-sponsor-pill-wrap">
                        @foreach($event['sponsorship']['tiers'] as $tier)
                            <span class="bs-sponsor-pill is-gold">{{ $tier }}</span>
                        @endforeach
                    </div>

                    <strong style="font-family: 'Outfit', sans-serif; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.06em; color: var(--bs-text);">Partnership Categories:</strong>
                    <div class="bs-sponsor-pill-wrap">
                        @foreach($event['sponsorship']['partnerTiers'] as $tier)
                            <span class="bs-sponsor-pill">{{ $tier }}</span>
                        @endforeach
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 10px;">
                        <a class="bs-btn-primary" href="{{ $event['sponsorship']['brochureUrl'] }}">Download Brochure</a>
                        <a class="bs-btn-outline" href="{{ $event['sponsorship']['scheduleUrl'] }}">Schedule Discussion</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ── Who Should Join & Why This Matters ── --}}
    @if(!empty($event['whoShouldJoin']) || !empty($event['whyMatters']))
    <section class="bs-section bs-section-alt">
        <div class="bih-container">
            <div class="grid gap-12 lg:grid-cols-2">
                <div>
                    <div class="bs-section-head">
                        <span class="eyebrow"><span class="dot"></span> Ecosystem</span>
                        <h2>Who Should Join?</h2>
                    </div>

                    <div style="display: grid; gap: 18px;">
                        @foreach($event['whoShouldJoin'] as $card)
                            <div class="bs-card" style="padding: 24px;">
                                <h3 style="font-family: 'Fraunces', serif; font-size: 1.3rem; margin: 0 0 8px; color: var(--bs-text);">{{ $card['title'] }}</h3>
                                @if($card['description'])
                                    <p style="font-size: 0.92rem; color: var(--bs-muted); line-height: 1.6; margin: 0 0 14px;">{{ $card['description'] }}</p>
                                @endif
                                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                    @foreach($card['tags'] as $tag)
                                        <span style="font-size: 0.76rem; font-weight: 700; background: var(--bs-surface-alt); border: 1px solid var(--bs-border); padding: 4px 12px; border-radius: var(--bs-radius-pill); color: var(--bs-text);">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="bs-section-head">
                        <span class="eyebrow"><span class="dot"></span> Bigger Picture</span>
                        <h2>Why This Matters?</h2>
                    </div>

                    <div class="bs-card" style="padding: 32px; gap: 16px;">
                        @foreach($event['whyMatters'] as $paragraph)
                            <p style="font-size: 0.96rem; color: var(--bs-muted); line-height: 1.75; margin: 0;">{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ── Register to Participate Section ── --}}
    @if(!empty($event['registerCtas']))
    <section class="bs-section" id="register">
        <div class="bih-container">
            <div class="bs-section-head center">
                <span class="eyebrow"><span class="dot"></span> Get Involved</span>
                <h2>Register to Participate</h2>
                <p>Select your track and secure your spot at Eastern India's flagship AI hackathon.</p>
            </div>

            <div class="bs-tracks-grid">
                @foreach($event['registerCtas'] as $cta)
                    <article class="bs-track-card">
                        <div class="track-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3>{{ $cta['role'] }}</h3>
                        <p style="font-size: 0.94rem; color: var(--bs-muted); line-height: 1.6; margin: 0 0 20px; flex-grow: 1;">{{ $cta['description'] }}</p>
                        <a class="bs-btn-gold" href="{{ $cta['href'] }}" @if(str_starts_with($cta['href'], 'http')) target="_blank" rel="noopener" @endif style="width: fit-content;">Register Now</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── 1. Event Venue Section (Vertical Position) ── --}}
    <section class="bs-section bs-section-alt" id="venue">
        <div class="bih-container">
            <div class="bs-section-head center">
                <span class="eyebrow"><span class="dot"></span> Event Location</span>
                <h2>Event Venue</h2>
                <p>Where students, universities, and industry gather for the Grand Finale.</p>
            </div>

            <div class="bs-venue-card">
                <span class="bs-badge-tag">Hosted at</span>
                <h3>{{ $event['venueDetails']['name'] ?? $event['venue'] }}</h3>
                <span class="finale-tag">Grand Finale: {{ $event['finale'] }}</span>

                @if(!empty($event['venueDetails']))
                    <p><strong>Campus &amp; Address:</strong> {{ $event['venueDetails']['campus'] }}, {{ $event['venueDetails']['address'] }}</p>
                    <p>{{ $event['venueDetails']['description'] }}</p>
                @endif

                @if(!empty($event['venueDetails']['tags']))
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px;">
                        @foreach($event['venueDetails']['tags'] as $tag)
                            <span style="font-size: 0.76rem; font-weight: 700; background: var(--bs-surface-alt); border: 1px solid var(--bs-border); padding: 4px 12px; border-radius: var(--bs-radius-pill); color: var(--bs-text);">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    <a class="bs-btn-primary" href="/hackfest-2026/register">Register as Participant</a>
                    <a class="bs-btn-outline" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ── 2. FAQ Section (Vertical Position, One After Another) ── --}}
    <section class="bs-section" id="faq">
        <div class="bih-container">
            <div class="bs-faq-wrapper">
                <div class="bs-section-head center">
                    <span class="eyebrow"><span class="dot"></span> FAQ</span>
                    <h2>HackFest Questions</h2>
                    <p>Everything you need to know about participating, attending, and partnering with PRAGATI 2026.</p>
                </div>

                <div class="bs-faq-list">
                    @foreach($event['faqs'] as [$question, $answer])
                        <details class="bs-faq-item" @if($loop->first) open @endif>
                            <summary>{{ $question }}</summary>
                            <div class="faq-body">
                                <p style="margin: 0;">{{ $answer }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── Gallery & Teaser Banner ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bih-container">
            <div class="bs-teaser-banner">
                <div>
                    <span class="bs-eyebrow-pill" style="margin-bottom: 12px;"><span class="dot"></span> Photos &amp; Videos</span>
                    <h3>See More From PRAGATI 2026</h3>
                    <p>Photos and videos from the event, added as real media becomes available.</p>
                </div>
                <a class="bs-btn-gold" href="{{ route('event.gallery') }}">Show More About HackFest &rarr;</a>
            </div>
        </div>
    </section>

    {{-- ── Supporting Partners Grid ── --}}
    @if($partners->isNotEmpty())
    <section class="bs-section">
        <div class="bih-container">
            <div class="bs-section-head center">
                <span class="eyebrow"><span class="dot"></span> Supporting Network</span>
                <h2>People Who Are Supporting Us</h2>
                @if(!empty($event['supportersNote']))
                    <p>{{ $event['supportersNote'] }}</p>
                @endif
            </div>

            <div style="display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                @foreach($partners as $partner)
                    <div class="bs-card" style="padding: 24px; text-align: center; font-weight: 800; font-family: 'Outfit', sans-serif;">
                        {{ $partner->name }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── Contact & Support Card ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bih-container">
            <div class="bs-contact-card">
                <img class="bs-contact-logo" src="{{ $eventLogo }}" alt="The Bengal HackFest PRAGATI 2026">
                <div>
                    <span class="bs-badge-tag">Support &amp; Inquiries</span>
                    <h3>Still Have Questions?</h3>
                    <p><strong>Email:</strong> {{ $siteBrand['email'] ?? config('bengalhub.brand.email') }}</p>
                    <p><strong>Call / WhatsApp:</strong> {{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}</p>
                    <p>Or reach out directly, and our team will get back to you promptly.</p>
                    <div style="margin-top: 16px;">
                        <a class="bs-btn-primary" href="/contact">Contact Now &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $event['name'],
            'description' => $event['tagline'],
            'startDate' => \Carbon\Carbon::parse($event['finale'])->toDateString(),
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'eventStatus' => 'https://schema.org/EventScheduled',
            'location' => [
                '@type' => 'Place',
                'name' => $event['venueDetails']['name'] ?? $event['venue'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $event['venueDetails']['campus'] ?? $event['venue'],
                    'addressLocality' => 'Kolkata',
                    'addressRegion' => 'West Bengal',
                    'addressCountry' => 'IN',
                ],
            ],
            'organizer' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => $event['name'], 'url' => url()->current()],
    ]])
    @if(!empty($event['faqs']))
        <script type="application/ld+json">
            {!! json_encode([
                '@'.'context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => collect($event['faqs'])->map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq[0],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
                ])->all(),
            ], JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endif
@endpush
