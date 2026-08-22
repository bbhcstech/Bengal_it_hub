@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Contact & Lead Capture Forms
     Light & Dark Mode Support
     Scoped strictly under [data-contact]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-contact] {
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
html.dark [data-contact],
[data-theme="dark"] [data-contact] {
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

[data-contact] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-contact] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-contact] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsContactMarquee 32s linear infinite;
}
[data-contact] .bs-marquee-track span {
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
[data-contact] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsContactMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-contact] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-contact] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-contact] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-contact] .bs-breadcrumb .sep { opacity: .5; }
[data-contact] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- hero blobs ---------- */
[data-contact] .bs-hero-blobs {
    position: absolute; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;
}
[data-contact] .bs-hero-blobs .blob {
    position: absolute; border-radius: 50%; filter: blur(60px); animation: bsContactBlobFloat 16s ease-in-out infinite;
}
[data-contact] .bs-hero-blobs .blob-1 {
    width: 420px; height: 420px; top: -120px; left: -100px;
    background: rgba(30, 74, 95, 0.15);
}
[data-contact] .bs-hero-blobs .blob-2 {
    width: 340px; height: 340px; top: 40px; right: -80px;
    background: rgba(232, 170, 61, 0.12);
    animation-delay: -6s;
}
[data-contact] .bs-hero-blobs .blob-3 {
    width: 280px; height: 280px; bottom: -80px; left: 40%;
    background: rgba(46, 112, 137, 0.1);
    animation-delay: -11s;
}

html.dark [data-contact] .bs-hero-blobs .blob-1,
[data-theme="dark"] [data-contact] .bs-hero-blobs .blob-1 {
    background: rgba(79, 155, 184, 0.22);
}
html.dark [data-contact] .bs-hero-blobs .blob-2,
[data-theme="dark"] [data-contact] .bs-hero-blobs .blob-2 {
    background: rgba(232, 170, 61, 0.18);
}
html.dark [data-contact] .bs-hero-blobs .blob-3,
[data-theme="dark"] [data-contact] .bs-hero-blobs .blob-3 {
    background: rgba(111, 182, 208, 0.15);
}

@keyframes bsContactBlobFloat {
    0%, 100% { transform: translate(0,0) scale(1); }
    33% { transform: translate(30px, -20px) scale(1.08); }
    66% { transform: translate(-20px, 20px) scale(0.95); }
}

/* ---------- page-hero ---------- */
[data-contact] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-contact] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-contact] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-contact] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-contact] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-contact] .bs-eyebrow,
[data-theme="dark"] [data-contact] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-contact] .bs-eyebrow .dot,
[data-theme="dark"] [data-contact] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & section ---------- */
[data-contact] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-contact] .bs-section { padding: 40px 0 90px; position: relative; }

/* ---------- grid ---------- */
[data-contact] .bs-grid-2 {
    display: grid; gap: 40px; align-items: start;
}
@media (min-width: 1024px) {
    [data-contact] .bs-grid-2 { grid-template-columns: 1.25fr 0.75fr; }
}

/* ---------- card ---------- */
[data-contact] .bs-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 36px 32px;
    box-shadow: var(--bs-shadow-sm);
}
@media (max-width: 640px) {
    [data-contact] .bs-card { padding: 24px 20px; }
}

[data-contact] .bs-card h2,
[data-contact] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.35rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .75rem; letter-spacing: -.01em;
}
[data-contact] .bs-card p {
    font-size: .94rem; line-height: 1.7; color: var(--bs-muted); margin: 0 0 1rem;
}
[data-contact] .bs-card p:last-child { margin-bottom: 0; }
[data-contact] .bs-card a { color: var(--bs-primary); font-weight: 600; text-decoration: none; transition: color .2s; }
[data-contact] .bs-card a:hover { color: var(--bs-gold); }

/* ---------- form fields ---------- */
[data-contact] .bs-form-group {
    display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px;
}
[data-contact] .bs-form-group label {
    font-family: 'Outfit', sans-serif;
    font-size: .88rem; font-weight: 700; color: var(--bs-text);
}
[data-contact] .bs-form-row {
    display: grid; gap: 16px;
}
@media (min-width: 640px) {
    [data-contact] .bs-form-row { grid-template-columns: 1fr 1fr; }
}

[data-contact] .bs-field {
    width: 100%;
    padding: 13px 16px;
    border-radius: var(--bs-radius-sm);
    border: 1.5px solid var(--bs-border);
    background-color: var(--bs-surface);
    font-family: 'Inter', sans-serif;
    font-size: .92rem;
    color: var(--bs-text);
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    box-sizing: border-box;
}
[data-contact] .bs-field::placeholder {
    color: var(--bs-muted);
    opacity: 0.75;
}
[data-contact] .bs-field:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3.5px rgba(30, 74, 95, 0.16);
}

html.dark [data-contact] .bs-field,
[data-theme="dark"] [data-contact] .bs-field {
    background-color: #0E262F;
    border-color: #21454F;
    color: #EAF4F6;
}
html.dark [data-contact] .bs-field::placeholder,
[data-theme="dark"] [data-contact] .bs-field::placeholder {
    color: #62828B;
    opacity: 1;
}
html.dark [data-contact] .bs-field:focus,
[data-theme="dark"] [data-contact] .bs-field:focus {
    border-color: #4F9BB8;
    box-shadow: 0 0 0 3.5px rgba(79, 155, 184, 0.25);
    background-color: #123039;
}

[data-contact] select.bs-field {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2352707A' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 38px;
}
html.dark [data-contact] select.bs-field,
[data-theme="dark"] [data-contact] select.bs-field {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2393B2BA' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
}
[data-contact] select.bs-field option {
    background-color: var(--bs-surface);
    color: var(--bs-text);
}
html.dark [data-contact] select.bs-field option,
[data-theme="dark"] [data-contact] select.bs-field option {
    background-color: #0E262F;
    color: #EAF4F6;
}

[data-contact] textarea.bs-field {
    min-height: 120px; resize: vertical;
}

/* ---------- buttons ---------- */
[data-contact] .bs-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: #1E4A5F; color: #ffffff;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .96rem;
    padding: 15px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    width: 100%;
    box-shadow: 0 4px 14px rgba(30,74,95,.2);
}
[data-contact] .bs-btn-primary:hover {
    background-color: #2E7089;
    box-shadow: 0 10px 28px rgba(30,74,95,.35);
    transform: translateY(-2px);
}
html.dark [data-contact] .bs-btn-primary,
[data-theme="dark"] [data-contact] .bs-btn-primary {
    background-color: #1E4A5F;
    color: #ffffff;
}
html.dark [data-contact] .bs-btn-primary:hover,
[data-theme="dark"] [data-contact] .bs-btn-primary:hover {
    background-color: #2E7089;
    box-shadow: 0 0 0 1px rgba(232,170,61,0.3), 0 20px 50px rgba(79,155,184,0.3);
}

[data-contact] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 14px 28px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-contact] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt);
    box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

/* ---------- social media icons ---------- */
[data-contact] .bs-social-grid {
    display: flex; gap: 10px; flex-wrap: wrap; margin-top: 14px;
}
[data-contact] .bs-social-link {
    width: 42px; height: 42px; border-radius: 10px;
    background-color: var(--bs-surface-alt);
    border: 1px solid var(--bs-border);
    color: var(--bs-primary);
    display: grid; place-items: center;
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: .88rem;
    text-decoration: none;
    transition: all .22s ease;
}
[data-contact] .bs-social-link:hover {
    background-color: var(--bs-primary); color: #ffffff;
    border-color: var(--bs-primary);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(30,74,95,.18);
}
html.dark [data-contact] .bs-social-link,
[data-theme="dark"] [data-contact] .bs-social-link {
    background-color: rgba(255,255,255,0.06);
    border-color: #21454F;
    color: #93B2BA;
}
html.dark [data-contact] .bs-social-link:hover,
[data-theme="dark"] [data-contact] .bs-social-link:hover {
    background-color: #E8AA3D;
    border-color: #E8AA3D;
    color: #12242B;
    box-shadow: 0 8px 20px rgba(232, 170, 61, 0.3);
}

/* ---------- alert / status boxes ---------- */
[data-contact] .bs-alert-success {
    background-color: rgba(15, 118, 110, 0.1);
    border: 1px solid rgba(15, 118, 110, 0.3);
    color: #0f766e;
    padding: 14px 18px;
    border-radius: var(--bs-radius-sm);
    font-weight: 600;
    margin-bottom: 20px;
}
html.dark [data-contact] .bs-alert-success,
[data-theme="dark"] [data-contact] .bs-alert-success {
    background-color: rgba(31, 157, 108, 0.15);
    border-color: rgba(31, 157, 108, 0.4);
    color: #4ade80;
}
[data-contact] .bs-alert-error {
    color: #dc2626; font-size: .82rem; margin-top: 4px; font-weight: 600;
}
html.dark [data-contact] .bs-alert-error,
[data-theme="dark"] [data-contact] .bs-alert-error {
    color: #f87171;
}

/* ---------- reveal animation ---------- */
[data-contact] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-contact] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-contact>
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
            <span class="current">{{ $title }}</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-hero-blobs" aria-hidden="true">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                {{ $type === 'contact' ? "Let's Connect" : 'Lead Capture' }}
            </span>
            <h1>{{ $type === 'contact' ? 'Ready to Grow Your Business?' : $title }}</h1>
            <p class="lead">{{ $type === 'contact' ? 'Share your business goal and the team can guide you toward the right product, service, partnership, or event pathway.' : $intro }}</p>
        </div>
    </section>

    {{-- ── Form & Contact Info Section ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-grid-2">
                {{-- Form Card --}}
                <div class="bs-card reveal">
                    @if($type === 'participant')
                        <div style="text-align: center; padding: 12px 0;">
                            <span class="bs-eyebrow" style="margin-bottom: 12px;"><span class="dot"></span> Registrations Closed</span>
                            <h2 style="font-family: 'Fraunces', serif; font-size: 1.8rem; font-weight: 600; margin: 0 0 .75rem;">The Bengal HackFest PRAGATI 2026 Has Concluded</h2>
                            <p style="line-height: 1.75; margin-bottom: 24px;">Participant registrations closed on 30 April 2026, and the event has now been held. Thank you to everyone who took part. Registration for the next HackFest is not open yet — follow our channels or reach out below to be notified as soon as it is.</p>
                            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
                                <a class="bs-btn-gold" href="/contact?interest=Next+HackFest+Notification">Get Notified for the Next HackFest</a>
                                <a class="bs-btn-primary" style="width: auto;" href="/hackfest-2026">Back to Event Overview</a>
                            </div>
                        </div>
                    @else
                        <form method="POST" action="{{ route('leads.store') }}">
                            @csrf
                            <input type="hidden" name="form_type" value="{{ $type === 'sponsor' ? 'hackfest_sponsor' : $type }}">
                            <input class="hidden" tabindex="-1" autocomplete="off" name="website" style="display: none;">

                            @if(session('status'))
                                <div class="bs-alert-success">{{ session('status') }}</div>
                            @endif

                            {{-- Topic / Interest Dropdown --}}
                            @if($type === 'contact')
                                <div class="bs-form-group">
                                    <label for="subject">What are you looking for?</label>
                                    <select class="bs-field" id="subject" name="subject">
                                        <option value="Software / Web / App Development" {{ old('subject', request('interest')) === 'Software / Web / App Development' ? 'selected' : '' }}>Software / Web / App Development</option>
                                        <option value="Staff Augmentation" {{ old('subject', request('interest')) === 'Staff Augmentation' ? 'selected' : '' }}>Staff Augmentation</option>
                                        <option value="AI Marketing" {{ old('subject', request('interest')) === 'AI Marketing' ? 'selected' : '' }}>AI Marketing</option>
                                        <option value="Business Consultation" {{ old('subject', request('interest')) === 'Business Consultation' ? 'selected' : '' }}>Business Consultation</option>
                                        <option value="Partnership" {{ old('subject', request('interest')) === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                        <option value="HackFest PRAGATI 2026" {{ old('subject', request('interest')) === 'HackFest PRAGATI 2026' ? 'selected' : '' }}>HackFest PRAGATI 2026</option>
                                        <option value="Awards & Recognition" {{ old('subject', request('interest')) === 'Awards & Recognition' ? 'selected' : '' }}>Awards & Recognition</option>
                                        <option value="Something Else" {{ old('subject', request('interest')) === 'Something Else' ? 'selected' : '' }}>Something Else</option>
                                    </select>
                                </div>
                            @endif

                            {{-- Name & Email Row --}}
                            <div class="bs-form-row">
                                <div class="bs-form-group">
                                    <label for="name">Full Name</label>
                                    <input class="bs-field" id="name" name="name" required placeholder="Your name" value="{{ old('name') }}" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                                    @error('name')<p id="name-error" class="bs-alert-error" role="alert">{{ $message }}</p>@enderror
                                </div>
                                <div class="bs-form-group">
                                    <label for="email">Email Address</label>
                                    <input class="bs-field" id="email" name="email" type="email" placeholder="you@company.com" value="{{ old('email') }}" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                                    @error('email')<p id="email-error" class="bs-alert-error" role="alert">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            {{-- Phone & Company Row --}}
                            <div class="bs-form-row">
                                <div class="bs-form-group">
                                    <label for="phone">Phone</label>
                                    <input class="bs-field" id="phone" name="phone" placeholder="+91 ..." value="{{ old('phone') }}">
                                </div>
                                <div class="bs-form-group">
                                    <label for="{{ $type === 'academic' ? 'college' : 'company' }}">
                                        {{ $type === 'academic' ? 'College / Institution' : 'Company / Organization' }}
                                    </label>
                                    <input class="bs-field" id="{{ $type === 'academic' ? 'college' : 'company' }}" name="{{ $type === 'academic' ? 'college' : 'company' }}" placeholder="{{ $type === 'academic' ? 'Institution name' : 'Company name' }}" value="{{ old($type === 'academic' ? 'college' : 'company') }}">
                                </div>
                            </div>

                            @if($type !== 'contact')
                                <div class="bs-form-group">
                                    <label for="subject">Subject / Interest</label>
                                    <input class="bs-field" id="subject" name="subject" value="{{ old('subject', request('interest')) }}">
                                </div>
                            @endif

                            {{-- Message Textarea --}}
                            <div class="bs-form-group">
                                <label for="message">Tell us more</label>
                                <textarea class="bs-field" id="message" name="message" placeholder="What are you trying to achieve?">{{ old('message') }}</textarea>
                            </div>

                            {{-- Google reCAPTCHA Security Check --}}
                            <div class="bs-form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 0.82rem; font-weight: 700; color: var(--bs-muted); display: inline-flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    Security Verification
                                </label>
                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                @error('g-recaptcha-response')
                                    <p class="bs-alert-error" role="alert" style="margin-top: 6px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="bs-btn-primary" type="submit">Get Your Place</button>
                        </form>
                    @endif
                </div>

                {{-- Side Cards (Office & Follow Along) --}}
                <div class="reveal" style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="bs-card">
                        <h3>Office</h3>
                        <p>{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
                        <p>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteBrand['phone'] ?? config('bengalhub.brand.phone')) }}">
                                {{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}
                            </a>
                        </p>
                        <p style="margin-top: 4px;">
                            <a href="mailto:{{ config('bengalhub.brand.email') }}">
                                {{ config('bengalhub.brand.email') }}
                            </a>
                        </p>
                    </div>

                    <div class="bs-card">
                        <h3>Follow Along</h3>
                        <p>Connect with Bengal IT Hub across our active channels for announcements, updates, and tech discussions.</p>
                        <div class="bs-social-grid">
                            <a class="bs-social-link" href="https://www.linkedin.com/company/bengal-it-hub" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
                            <a class="bs-social-link" href="https://www.facebook.com/profile.php?id=61585519843303" target="_blank" rel="noopener" aria-label="Facebook">f</a>
                            <a class="bs-social-link" href="https://www.instagram.com/bengalithub/" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
                            <a class="bs-social-link" href="https://x.com/bengalithub" target="_blank" rel="noopener" aria-label="X (Twitter)">x</a>
                            <a class="bs-social-link" href="https://www.youtube.com/@bengalithub" target="_blank" rel="noopener" aria-label="YouTube">yt</a>
                        </div>
                    </div>

                    <div class="bs-card">
                        <h3>Office Map</h3>
                        <p style="font-size: 0.86rem; margin-bottom: 12px;">3rd Floor, Satavisha Bldg, 11 Hospital Link Road, Santoshpur, Kolkata 700075</p>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=11+Hospital+Link+Road,+Santoshpur,+Kolkata,+West+Bengal+700075" target="_blank" rel="noopener" class="bs-btn-gold" style="display: inline-flex; width: 100%; justify-content: center; margin-bottom: 14px; font-size: 0.85rem; padding: 10px 18px;">
                            <span>Get Directions on Google Maps &rarr;</span>
                        </a>
                        <div style="width: 100%; height: 200px; border-radius: 10px; overflow: hidden; border: 1px solid var(--bs-border);">
                            <iframe
                                title="Bengal IT Hub Office Location Map"
                                src="https://maps.google.com/maps?q=11+Hospital+Link+Road,+Santoshpur,+Kolkata,+West+Bengal+700075&t=&z=16&ie=UTF8&iwloc=&output=embed"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    var els = document.querySelectorAll('[data-contact] .reveal');
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
