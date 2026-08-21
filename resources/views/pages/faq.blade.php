@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     FAQ Page (Light & Dark Mode Support)
     Scoped strictly under [data-faq]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-faq] {
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
html.dark [data-faq],
[data-theme="dark"] [data-faq] {
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

[data-faq] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-faq] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-faq] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsFaqMarquee 32s linear infinite;
}
[data-faq] .bs-marquee-track span {
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
[data-faq] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsFaqMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-faq] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-faq] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-faq] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-faq] .bs-breadcrumb .sep { opacity: .5; }
[data-faq] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-faq] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-faq] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-faq] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-faq] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-faq] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-faq] .bs-eyebrow,
[data-theme="dark"] [data-faq] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-faq] .bs-eyebrow .dot,
[data-theme="dark"] [data-faq] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-faq] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-faq] .bs-section { padding: 40px 0 90px; position: relative; }
[data-faq] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

/* ---------- FAQ Accordion ---------- */
[data-faq] .bs-faq-wrapper {
    max-width: 860px;
    margin: 0 auto;
}

[data-faq] .bs-faq-item {
    border-bottom: 1px solid var(--bs-border);
}
[data-faq] .bs-faq-question {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 4px;
    cursor: pointer;
    font-family: 'Outfit', sans-serif;
    font-size: 1.08rem;
    font-weight: 700;
    color: var(--bs-text);
    min-height: 44px;
    user-select: none;
    transition: color .2s ease;
}
[data-faq] .bs-faq-question:hover {
    color: var(--bs-primary);
}
html.dark [data-faq] .bs-faq-question:hover,
[data-theme="dark"] [data-faq] .bs-faq-question:hover {
    color: var(--bs-gold-lt);
}

[data-faq] .bs-faq-icon {
    transition: transform 240ms cubic-bezier(.4,0,.2,1);
    color: var(--bs-gold);
    font-family: 'Outfit', sans-serif;
    font-size: 1.4rem;
    font-weight: 800;
    flex-shrink: 0;
    margin-left: 16px;
    line-height: 1;
}
[data-faq] .bs-faq-item.open .bs-faq-icon {
    transform: rotate(45deg);
}

[data-faq] .bs-faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 320ms cubic-bezier(.4,0,.2,1), opacity 320ms ease;
    opacity: 0;
}
[data-faq] .bs-faq-item.open .bs-faq-answer {
    max-height: 600px;
    opacity: 1;
}
[data-faq] .bs-faq-answer p {
    padding-bottom: 22px;
    padding-top: 2px;
    font-size: .98rem;
    line-height: 1.8;
    color: var(--bs-muted);
    margin: 0;
}

/* ---------- CTA Banner ---------- */
[data-faq] .bs-cta-banner {
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
[data-faq] .bs-cta-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-faq] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600;
    color: #ffffff;
    margin: 0 0 10px;
    letter-spacing: -.01em;
    position: relative; z-index: 1;
}
[data-faq] .bs-cta-banner p {
    color: rgba(255,255,255,.82);
    font-size: 1.05rem;
    line-height: 1.7;
    max-width: 580px;
    margin: 0 auto 24px;
    position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-faq] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-faq] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt);
    box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

/* ---------- Reveal Animation ---------- */
[data-faq] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-faq] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-faq>
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
            <span class="current">FAQ</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                Questions &amp; Answers
            </span>
            <h1>Common Questions Before You Explore Deeper</h1>
            <p class="lead">Quick answers about products, industries, partners, Tech Innovation, recognition, and how visitors should move from the landing page to the right main section.</p>
        </div>
    </section>

    {{-- ── FAQ Accordion Section ── --}}
    <section class="bs-section" style="padding-top: 0;">
        <div class="bs-container">
            <div class="bs-faq-wrapper">
                @foreach($faqs as $index => [$question, $answer])
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
    <section class="bs-section-alt">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Still Have Questions?</h2>
                <p>Reach out directly and the team will get back to you within one business day.</p>
                <a href="{{ route('contact') }}" class="bs-btn-gold">Contact Us</a>
            </div>
        </div>
    </section>
</div>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqs)->map(fn ($faq) => [
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
    document.querySelectorAll('[data-faq] .bs-faq-question').forEach(function (q) {
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
    var els = document.querySelectorAll('[data-faq] .reveal');
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
