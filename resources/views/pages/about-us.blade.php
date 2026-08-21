@extends('layouts.app')

@php
    $heroImage = 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1500&q=88';
    $officeImage = 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1200&q=88';
    $teamImage = 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=88';
    $strategyImage = 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=900&q=88';

    $stats = [
        ['value' => '500+', 'label' => 'Projects delivered'],
        ['value' => '98%', 'label' => 'Client satisfaction'],
        ['value' => '24/7', 'label' => 'Support mindset'],
        ['value' => '10+', 'label' => 'Core specialists'],
    ];

    $capabilities = [
        ['icon' => 'chip', 'title' => 'Custom Software', 'body' => 'Business websites, SaaS platforms, dashboards, portals, automations, and secure web applications.'],
        ['icon' => 'globe', 'title' => 'Cloud & Digital Systems', 'body' => 'Cloud-ready architecture, integrations, hosting support, analytics, and scalable operational platforms.'],
        ['icon' => 'target', 'title' => 'AI & Growth Strategy', 'body' => 'AI marketing, business intelligence, digital campaigns, workflow automation, and customer growth systems.'],
        ['icon' => 'graduation', 'title' => 'Talent & Innovation', 'body' => 'Industry-aligned skilling, internships, HackFest programs, staff augmentation, and future-ready talent pathways.'],
    ];

    $buildServices = [
        [
            'title' => 'Software Development',
            'body' => 'Custom business software, CRM tools, admin panels, automation systems, SaaS platforms, and secure internal applications.',
            'image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=900&q=88',
            'icon' => 'chip',
        ],
        [
            'title' => 'Web Development',
            'body' => 'Fast, responsive, SEO-ready websites, Laravel applications, company portals, landing pages, and high-converting digital experiences.',
            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=900&q=88',
            'icon' => 'globe',
        ],
        [
            'title' => 'App Development',
            'body' => 'Mobile-first product planning, customer apps, business apps, dashboards, booking systems, and connected digital workflows.',
            'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=900&q=88',
            'icon' => 'rocket',
        ],
        [
            'title' => 'IoT Product Build',
            'body' => 'Connected device concepts, sensor dashboards, monitoring systems, automation prototypes, and data-driven IoT product workflows.',
            'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=88',
            'icon' => 'flask',
        ],
        [
            'title' => 'Digital Marketing',
            'body' => 'Performance marketing, SEO, social campaigns, brand content, analytics, lead generation, and AI-assisted growth strategy.',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=88',
            'icon' => 'target',
        ],
        [
            'title' => 'Personal Product Build',
            'body' => 'Founder MVPs, portfolio products, creator platforms, personal brand websites, learning products, and launch-ready prototypes.',
            'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=900&q=88',
            'icon' => 'briefcase',
        ],
        [
            'title' => 'Generative AI',
            'body' => 'AI content tools, chat interfaces, workflow assistants, document automation, knowledge systems, and business AI integrations.',
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=88',
            'icon' => 'chip',
        ],
        [
            'title' => 'Agentic AI',
            'body' => 'AI agents that can plan, call tools, support operations, automate tasks, qualify leads, and assist teams with repeatable workflows.',
            'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=900&q=88',
            'icon' => 'target',
        ],
    ];

    $values = [
        ['title' => 'Business-first thinking', 'body' => 'We begin with goals, users, workflows, and measurable outcomes before choosing technology.'],
        ['title' => 'Clean execution', 'body' => 'We keep designs usable, builds maintainable, communication clear, and delivery focused.'],
        ['title' => 'Future-ready capability', 'body' => 'We help clients and learners adopt AI, cloud, automation, and modern digital practices with confidence.'],
    ];

    $process = [
        ['step' => '01', 'title' => 'Discover', 'body' => 'Understand the client, users, market, workflows, and practical success metrics.'],
        ['step' => '02', 'title' => 'Design', 'body' => 'Plan the product flow, content structure, UI direction, architecture, and delivery roadmap.'],
        ['step' => '03', 'title' => 'Build', 'body' => 'Develop secure, responsive, scalable systems with clean implementation and regular reviews.'],
        ['step' => '04', 'title' => 'Scale', 'body' => 'Launch, support, improve, automate, train teams, and help the solution grow with the business.'],
    ];

    $whyChoose = [
        'End-to-end support from idea to launch',
        'Practical technology consulting for real business needs',
        'Modern UI, secure development, and scalable delivery',
        'AI, SaaS, cloud, automation, and digital growth expertise',
        'Strong connection between technology services and talent development',
        'A Bengal-based team building for national and global opportunities',
    ];

    $teamRoles = [
        ['icon' => 'chip', 'title' => 'Software & Product Engineering', 'body' => 'Builds and maintains the web, app, and IoT platforms behind Bengal IT Hub\'s software and web development work.'],
        ['icon' => 'target', 'title' => 'AI & Data Specialists', 'body' => 'Works on Generative AI, Agentic AI, and AI-Marketing — the applied AI capability behind our products and campaigns.'],
        ['icon' => 'globe', 'title' => 'Design & User Experience', 'body' => 'Shapes the interfaces, UI systems, and product flows across every client build and internal platform.'],
        ['icon' => 'briefcase', 'title' => 'Business Consulting & Growth', 'body' => 'Leads Biz-Consultation, Biz-Enablement, and Corporate Operations Outsourcing engagements with clients.'],
        ['icon' => 'graduation', 'title' => 'Talent, Training & Education', 'body' => 'Runs Tech Ed/Fest, Educamp, Eduverse, Groomify, and Staff Augmentation — our skilling and talent pathways.'],
        ['icon' => 'check', 'title' => 'Client Success & Delivery Operations', 'body' => 'Keeps projects, partnerships, and day-to-day operations running smoothly from kickoff to launch.'],
    ];

    $officeAddress = $siteBrand['address'] ?? config('bengalhub.brand.address');
    $officePhone = $siteBrand['phone'] ?? config('bengalhub.brand.phone');
    $officeMapEmbedUrl = 'https://www.google.com/maps?q='.urlencode($officeAddress).'&output=embed';
    $officeMapDirectionsUrl = 'https://www.google.com/maps/search/?api=1&query='.urlencode($officeAddress);
    $officeWhatsAppShareUrl = 'https://wa.me/?text='.urlencode("Bengal IT Hub office location:\n".$officeAddress."\n".$officeMapDirectionsUrl);

    $exploreSections = [
        ['eyebrow' => 'Services', 'title' => 'Services', 'body' => '10 services spanning technology education, talent development, AI-driven marketing, business consulting, and operations support.', 'icon' => 'chip', 'cta' => 'Explore Services', 'href' => route('services.index')],
        ['eyebrow' => 'Products', 'title' => 'Products', 'body' => '8 product lines across software, web, app, IoT, personal products, and generative and agentic AI.', 'icon' => 'rocket', 'cta' => 'Explore Products', 'href' => route('products.index')],
        ['eyebrow' => 'Industries', 'title' => 'Industries', 'body' => '10 industries with 64 specialized focus areas, from real estate and healthcare to banking, logistics, and retail.', 'icon' => 'globe', 'cta' => 'Explore Industries', 'href' => route('industries.index')],
        ['eyebrow' => 'Our Partners', 'title' => 'Our Partners', 'body' => 'Industry, academic, innovation, hiring, technology, and community partners working alongside us.', 'icon' => 'partners', 'cta' => 'Explore Partners', 'href' => route('our-partners.index')],
    ];
@endphp

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     About Us Page (Light & Dark Mode Support)
     Scoped strictly under [data-about]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-about] {
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
html.dark [data-about],
[data-theme="dark"] [data-about] {
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

[data-about] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- marquee strip ---------- */
[data-about] .bs-marquee-strip {
    background-color: var(--bs-ink, #0A1F28);
    overflow: hidden;
    padding: 14px 0;
    border-bottom: 1px solid var(--bs-border, #DCE6E8);
}
[data-about] .bs-marquee-track {
    display: flex;
    width: max-content;
    animation: bsAboutMarquee 32s linear infinite;
}
[data-about] .bs-marquee-track span {
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
[data-about] .bs-marquee-track span::after {
    content: '✦';
    color: var(--bs-gold, #E8AA3D);
}
@keyframes bsAboutMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* ---------- breadcrumb ---------- */
[data-about] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-about] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-about] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-about] .bs-breadcrumb .sep { opacity: .5; }
[data-about] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- page-hero ---------- */
[data-about] .bs-page-hero {
    padding: 64px 0 52px;
    position: relative; overflow: hidden;
    background: var(--bs-bg);
}
[data-about] .bs-page-hero h1 {
    font-family: 'Fraunces', serif;
    font-size: clamp(2.1rem, 4.2vw, 3.2rem); font-weight: 600; line-height: 1.15;
    letter-spacing: -.01em; max-width: 820px;
    color: var(--bs-text); margin: 0 0 .5em;
    position: relative; z-index: 1;
}
[data-about] .bs-page-hero p.lead {
    max-width: 680px; margin-top: .875rem;
    font-size: 1.1rem; line-height: 1.75; color: var(--bs-muted);
    position: relative; z-index: 1;
}

/* ---------- eyebrow ---------- */
[data-about] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 20px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
    position: relative; z-index: 1;
}
[data-about] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}

html.dark [data-about] .bs-eyebrow,
[data-theme="dark"] [data-about] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-about] .bs-eyebrow .dot,
[data-theme="dark"] [data-about] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

/* ---------- container & sections ---------- */
[data-about] .bs-container {
    width: 100%; max-width: 1240px; margin: 0 auto; padding: 0 24px;
}
[data-about] .bs-section { padding: 60px 0 90px; position: relative; }
[data-about] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 80px 0; }

[data-about] .bs-section-head {
    max-width: 680px; margin: 0 auto 48px; text-align: center;
}
[data-about] .bs-section-head.left {
    margin-left: 0; text-align: left;
}
[data-about] .bs-section-head h2 {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.85rem,3.3vw,2.5rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 .5em; line-height: 1.15; letter-spacing: -.01em;
}
[data-about] .bs-section-head p {
    color: var(--bs-muted); font-size: 1.05rem; line-height: 1.7; margin: 0;
}

/* ---------- grid layouts ---------- */
[data-about] .bs-grid { display: grid; gap: 20px; }
[data-about] .bs-grid-2 { grid-template-columns: repeat(2, 1fr); }
[data-about] .bs-grid-3 { grid-template-columns: repeat(3, 1fr); }
[data-about] .bs-grid-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 1024px) {
    [data-about] .bs-grid-4 { grid-template-columns: repeat(2, 1fr); }
    [data-about] .bs-grid-3 { grid-template-columns: repeat(2, 1fr); }
    [data-about] .bs-grid-2 { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    [data-about] .bs-grid-4,
    [data-about] .bs-grid-3,
    [data-about] .bs-grid-2 { grid-template-columns: 1fr; }
}

/* ---------- cards ---------- */
[data-about] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 30px 24px;
    box-shadow: var(--bs-shadow-sm); display: flex; flex-direction: column;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-about] .bs-card:hover {
    box-shadow: var(--bs-shadow-md); transform: translateY(-4px);
    border-color: rgba(232, 170, 61, 0.45);
}
[data-about] .bs-card h3 {
    font-family: 'Fraunces', serif;
    font-size: 1.22rem; font-weight: 600; color: var(--bs-text);
    margin: 0 0 .5em; letter-spacing: -.01em; line-height: 1.25;
}
[data-about] .bs-card p {
    font-size: .92rem; line-height: 1.75; color: var(--bs-muted); margin: 0; flex: 1;
}

/* ---------- icon badge ---------- */
[data-about] .bs-icon-badge {
    width: 52px; height: 52px; border-radius: var(--bs-radius-sm);
    background: linear-gradient(135deg, rgba(30,74,95,.14), rgba(232,170,61,.14));
    color: var(--bs-primary);
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
}
html.dark [data-about] .bs-icon-badge,
[data-theme="dark"] [data-about] .bs-icon-badge {
    background: linear-gradient(135deg, rgba(79, 155, 184, 0.2), rgba(232, 170, 61, 0.2));
    color: var(--bs-gold-lt);
}
[data-about] .bs-icon-badge svg { width: 22px; height: 22px; }

/* ---------- badge tags ---------- */
[data-about] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 12px;
    width: fit-content;
}
[data-about] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
    width: fit-content;
}
html.dark [data-about] .bs-badge-outline,
[data-theme="dark"] [data-about] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

/* ---------- step cards ---------- */
[data-about] .bs-step-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 26px 22px;
    box-shadow: var(--bs-shadow-sm);
    transition: transform .26s ease, box-shadow .26s ease;
}
[data-about] .bs-step-card:hover {
    transform: translateY(-3px); box-shadow: var(--bs-shadow-md);
}
[data-about] .bs-step-num {
    font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 2rem;
    color: rgba(30,74,95,0.25); line-height: 1; margin-bottom: 12px;
    display: block;
}
html.dark [data-about] .bs-step-num,
[data-theme="dark"] [data-about] .bs-step-num {
    color: rgba(232,170,61,0.3);
}
[data-about] .bs-step-card h4 {
    font-family: 'Fraunces', serif; font-size: 1.15rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 8px; line-height: 1.25;
}
[data-about] .bs-step-card p {
    font-size: 0.9rem; line-height: 1.7; color: var(--bs-muted); margin: 0;
}

/* ---------- CTA Banner ---------- */
[data-about] .bs-cta-banner {
    background: linear-gradient(120deg, var(--bs-primary), #123544);
    border-radius: var(--bs-radius-lg); padding: 56px 40px;
    text-align: center; color: #ffffff; position: relative;
    overflow: hidden; box-shadow: var(--bs-shadow-md);
    max-width: 960px; margin: 0 auto;
}
[data-about] .bs-cta-banner::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, rgba(232,170,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
[data-about] .bs-cta-banner h2 {
    font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 600; color: #ffffff; margin: 0 0 10px;
    letter-spacing: -.01em; position: relative; z-index: 1;
}
[data-about] .bs-cta-banner p {
    color: rgba(255,255,255,.82); font-size: 1.05rem; line-height: 1.7;
    max-width: 620px; margin: 0 auto 24px; position: relative; z-index: 1;
}

/* ---------- Buttons ---------- */
[data-about] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 14px 30px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
    position: relative; z-index: 1;
}
[data-about] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}
[data-about] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-about] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-about] .bs-btn-outline,
[data-theme="dark"] [data-about] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-about] .bs-btn-outline:hover,
[data-theme="dark"] [data-about] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

/* ---------- Reveal Animation ---------- */
[data-about] .reveal {
    opacity: 0; transform: translateY(22px);
    transition: opacity 700ms cubic-bezier(.2,.7,.3,1), transform 700ms cubic-bezier(.2,.7,.3,1);
}
[data-about] .reveal.in-view { opacity: 1; transform: translateY(0); }
</style>

<div data-about>
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
            <span class="current">About Us</span>
        </nav>
    </div>

    {{-- ── Page Hero ── --}}
    <section class="bs-page-hero">
        <div class="bs-container">
            <span class="bs-eyebrow">
                <span class="dot"></span>
                Company
            </span>
            <h1>About Bengal IT Hub</h1>
            <p class="lead">A technology-driven innovation center transforming businesses through advanced IT solutions, digital engineering, and talent empowerment.</p>
        </div>
    </section>

    {{-- ── Who We Are (2-Column Demo Style) ── --}}
    <section class="bs-section" style="padding-top: 0;">
        <div class="bs-container">
            <div class="bs-grid bs-grid-2 reveal" style="align-items: center; margin-bottom: 56px;">
                <div>
                    <span class="bs-eyebrow"><span class="dot"></span> Who We Are</span>
                    <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.85rem,3.2vw,2.5rem); font-weight: 600; color: var(--bs-text); margin: 8px 0 16px; line-height: 1.2;">An IT partner built for practical business impact</h2>
                    <p style="font-size: 1.05rem; line-height: 1.75; color: var(--bs-muted); margin-bottom: 16px;">
                        Bengal IT Hub is a technology-driven innovation center transforming businesses through advanced IT solutions, digital engineering, and talent empowerment &mdash; bridging global opportunities with Bengal's capabilities to innovate and succeed worldwide.
                    </p>
                    <p style="font-size: 1rem; line-height: 1.75; color: var(--bs-muted); margin-bottom: 24px;">
                        We combine digital engineering, business consulting, product thinking, and AI-first talent development so clients get more than a website or software build. They get a technology partner that understands growth.
                    </p>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <a href="{{ route('contact') }}" class="bs-btn-gold">Start a Conversation</a>
                        <a href="{{ route('services.index') }}" class="bs-btn-outline">Explore Services</a>
                    </div>
                </div>
                <div>
                    <img src="{{ $teamImage }}" alt="Bengal IT Hub team" style="width: 100%; height: 380px; object-fit: cover; border-radius: var(--bs-radius-lg); box-shadow: var(--bs-shadow-md); border: 1px solid var(--bs-border);" loading="lazy">
                </div>
            </div>

            {{-- Mission, Vision, Positioning 3-Card Bento --}}
            <div class="bs-grid bs-grid-3 reveal">
                <div class="bs-card">
                    <span class="bs-badge-tag">Mission</span>
                    <h3 style="font-size: 1.2rem; margin-top: 6px;">Empowering Business Talent</h3>
                    <p style="font-weight: 600; color: var(--bs-text);">To help businesses adopt useful technology while creating a stronger bridge between regional talent and global digital opportunity.</p>
                </div>
                <div class="bs-card">
                    <span class="bs-badge-tag">Vision</span>
                    <h3 style="font-size: 1.2rem; margin-top: 6px;">Global Tech Hub From Bengal</h3>
                    <p style="font-weight: 600; color: var(--bs-text);">To build a global technology hub from Eastern India, driving India's first AI Gigafactory ecosystem by 2030.</p>
                </div>
                <div class="bs-card">
                    <span class="bs-badge-tag">Positioning</span>
                    <h3 style="font-size: 1.2rem; margin-top: 6px;">Strategic IT Powerhouse</h3>
                    <p style="font-weight: 600; color: var(--bs-text);">A strategic IT powerhouse delivering dependable execution, modern UI, scalable software, and job-ready talent.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Core Capabilities ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Core Capabilities</span>
                <h2>What Sets Our Capability Apart</h2>
                <p>From custom web platforms and SaaS to AI marketing and talent development programs.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($capabilities as $capability)
                    <div class="bs-card reveal">
                        <div class="bs-icon-badge">
                            @include('partials.icon', ['name' => $capability['icon']])
                        </div>
                        <h3>{{ $capability['title'] }}</h3>
                        <p>{{ $capability['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── What We Build ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> What We Build</span>
                <h2>Complete Technology Services for Modern Businesses</h2>
                <p>From software platforms to AI agents, Bengal IT Hub helps clients plan, design, build, market, and improve digital products.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($buildServices as $service)
                    <div class="bs-card reveal" style="padding: 0; overflow: hidden;">
                        <div style="height: 180px; overflow: hidden; position: relative;">
                            <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease;" loading="lazy">
                        </div>
                        <div style="padding: 22px 20px; display: flex; flex-direction: column; flex: 1;">
                            <span class="bs-badge-outline" style="font-size: 0.68rem; margin-bottom: 8px;">{{ $service['title'] }}</span>
                            <h3 style="font-size: 1.12rem; margin-bottom: 8px;">{{ $service['title'] }}</h3>
                            <p style="font-size: 0.88rem; line-height: 1.65;">{{ $service['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Roles That Power Bengal IT Hub ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> Our People</span>
                <h2>Roles That Power Bengal IT Hub</h2>
                <p>Our team is organized around the work our clients and learners actually need — reflecting real capability behind our services.</p>
            </div>

            <div class="bs-grid bs-grid-3">
                @foreach($teamRoles as $role)
                    <div class="bs-card reveal">
                        <div class="bs-icon-badge">
                            @include('partials.icon', ['name' => $role['icon']])
                        </div>
                        <h3>{{ $role['title'] }}</h3>
                        <p>{{ $role['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── How We Work (Process) ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-section-head reveal">
                <span class="bs-eyebrow"><span class="dot"></span> How We Work</span>
                <h2>A Clear Delivery Process from Idea to Scale</h2>
                <p>Every project needs clarity, pace, and ownership. Our process keeps business teams and technical teams aligned.</p>
            </div>

            <div class="bs-grid bs-grid-4">
                @foreach($process as $item)
                    <div class="bs-step-card reveal">
                        <span class="bs-step-num">{{ $item['step'] }}</span>
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Why Choose Us & Office Location ── --}}
    <section class="bs-section bs-section-alt">
        <div class="bs-container">
            <div class="bs-grid bs-grid-2 reveal" style="align-items: center; margin-bottom: 56px;">
                <div>
                    <span class="bs-eyebrow"><span class="dot"></span> Why Choose Us</span>
                    <h2 style="font-family: 'Fraunces', serif; font-size: clamp(1.85rem,3.2vw,2.5rem); font-weight: 600; color: var(--bs-text); margin: 8px 0 16px; line-height: 1.2;">A compact team with a broad technology ecosystem</h2>
                    <p style="font-size: 1.05rem; line-height: 1.75; color: var(--bs-muted); margin-bottom: 24px;">Bengal IT Hub is built for clients who need dependable execution, useful ideas, and a partner who can connect technology, marketing, operations, and talent.</p>
                    <div style="display: grid; gap: 12px;">
                        @foreach($whyChoose as $point)
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 0.94rem; font-weight: 600; color: var(--bs-text);">
                                <span style="color: var(--bs-gold); font-weight: 800;">✦</span>
                                {{ $point }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="bs-card" style="padding: 0; overflow: hidden;">
                        <iframe class="h-80 w-full sm:h-96" src="{{ $officeMapEmbedUrl }}" title="Bengal IT Hub office location on Google Maps" style="border: 0; width: 100%; height: 340px;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div style="padding: 20px 24px; background: var(--bs-surface);">
                            <div style="font-weight: 700; font-family: 'Outfit', sans-serif; font-size: 1rem; color: var(--bs-text);">{{ $officeAddress }}</div>
                            <div style="font-size: 0.88rem; color: var(--bs-muted); margin-top: 4px;">{{ $officePhone }}</div>
                            <div style="margin-top: 14px; display: flex; gap: 12px;">
                                <a href="{{ $officeMapDirectionsUrl }}" target="_blank" rel="noopener" class="bs-btn-gold" style="padding: 10px 20px; font-size: 0.84rem;">Get Directions</a>
                                <a href="{{ $officeWhatsAppShareUrl }}" target="_blank" rel="noopener" class="bs-btn-outline" style="padding: 10px 20px; font-size: 0.84rem;">Share WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA Banner ── --}}
    <section class="bs-section">
        <div class="bs-container">
            <div class="bs-cta-banner reveal">
                <h2>Let's Build Together</h2>
                <p>Have an idea, business challenge, or digital growth target? Tell us about your project and see how Bengal IT Hub can accelerate it.</p>
                <a href="{{ route('contact') }}" class="bs-btn-gold">Contact Us Today</a>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    // Reveal animations
    var els = document.querySelectorAll('[data-about] .reveal');
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
