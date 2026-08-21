@extends('layouts.app')

@php
    $serviceImages = [
        'tech-ed-fest' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80',
        'educamp' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
        'eduverse-2' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=900&q=80',
        'groomify' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=80',
        'ai-marketing' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80',
        'biz-consultation' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80',
        'biz-enablement' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=900&q=80',
        'e-collab-2' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=900&q=80',
        'staff-augmentation' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80',
        'corporate-operations-outsourcing' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=900&q=80',
    ];

    $impactCards = [
        ['Scalable Cloud Solutions', 'Custom cloud-ready platforms designed for speed, security, and measurable business growth.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=80'],
        ['Tailored Software Platforms', 'SaaS products, web systems, and automation workflows aligned with real business operations.', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=900&q=80'],
        ['Driving Digital Growth', 'AI-led marketing, analytics, and digital strategy that helps brands scale with clarity.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80'],
        ['Technology from Bengal', 'Global innovation powered by Bengal talent, industry collaboration, and future-ready execution.', 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80'],
    ];

    $industries = ['IT & Digital Services', 'SaaS & Cloud Solutions', 'FinTech', 'Healthcare', 'EdTech', 'Manufacturing', 'E-Commerce', 'Corporate Operations'];
    $stats = ['500+|Projects Done', '98%|Client Satisfaction', '24/7|Support', '10+|Team Members'];
    $hackfestImages = [
        ['Tech Hackathon', 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80'],
        ['Hackathon Fest', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=900&q=80'],
        ['Hackathon India', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80'],
        ['Hackathon Kolkata', 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=900&q=80'],
    ];

    $ecosystemImages = [
        ['Innovation Lab', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=900&q=85'],
        ['Corporate Strategy', 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=900&q=85'],
        ['Talent Development', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=85'],
    ];

    $deliverySteps = [
        ['Discover', 'We map goals, business needs, users, and growth opportunities before any build starts.', 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=900&q=85'],
        ['Design', 'Clean product flows, UI planning, brand systems, and clear digital experiences for real users.', 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=900&q=85'],
        ['Develop', 'Secure Laravel, SaaS, cloud, automation, and analytics systems built for performance.', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=85'],
        ['Scale', 'Launch support, training, reporting, and growth campaigns that keep improving outcomes.', 'https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&w=900&q=85'],
    ];

    $productCatalog = collect(config('bengalhub.products.items', []))->take(4);
    $clientCatalog = collect(config('bengalhub.clients.items', []));
    $industryCatalog = collect(config('bengalhub.industries', []))->take(6);
    $partnerPage = config('bengalhub.partnersPage', []);
    $partnerCategories = collect($partnerPage['categories'] ?? [])->take(4);
    $awards = config('bengalhub.awards', []);
    $awardCategories = collect($awards['categories'] ?? [])->take(4);
    $homeFaqs = collect($faqs ?? [])->merge([
        ['Which product lines can Bengal IT Hub build?', 'We build software, web, app, IoT, digital marketing, generative AI, and agentic AI product lines for startups, institutions, MSMEs, and growing businesses.'],
        ['Can I see all Bengal IT Hub products from the homepage?', 'Yes. The product preview section links to the full Products page where every product line has a dedicated detail path.'],
        ['Which industries does Bengal IT Hub support?', 'We support industries such as real estate, healthcare, education, manufacturing, logistics, travel, retail, banking, insurance, telecom, public services, energy, and information services.'],
        ['How do I explore industry-specific solutions?', 'Use the Industries section on the landing page to open the full industry directory, then choose the industry or focus area that matches your business.'],
        ['What is the Our Partners section for?', 'It introduces the academic, industry, innovation, hiring, technology, and community partners that collaborate with Bengal IT Hub.'],
        ['Can my company become a partner?', 'Yes. Companies, colleges, communities, mentors, and technology providers can start through the Our Partners page or the contact form.'],
        ['What is Tech Innovation?', 'Tech Innovation is Bengal IT Hub\'s technology news and insight hub covering AI, cloud, cybersecurity, software, developer tools, and business technology.'],
        ['How often is Tech Innovation updated?', 'The Tech Innovation hub is designed as a continuously updated feed, with articles organized by category, source, trend, and search.'],
        ['What does Awards & Recognition include?', 'Awards & Recognition tracks industry awards, media recognition, certifications, partner recognition, and milestone slots as they are earned.'],
        ['Why are these sections added to the landing page?', 'They help visitors quickly understand what Bengal IT Hub builds, where it works, who it collaborates with, and how to explore deeper pages.'],
        ['Will these landing-page sections replace the main pages?', 'No. Each section is only a compact preview with a View More button that redirects visitors to the full main page.'],
        ['How do I start a project with Bengal IT Hub?', 'Open the contact page, share your business goal, and the team can guide you toward the right product, service, partnership, or event pathway.'],
    ]);

    $landingPageDefaults = [
        'vision' => [
            'title' => 'Vision',
            'blocks' => [
                'eyebrow' => 'Vision Section',
                'intro' => 'Two focused pathways introduce the long-term Bengal IT Hub direction and the company behind it.',
                'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1200&q=88',
                'image_alt' => 'Bengal IT Hub innovation workspace',
                'cta_label' => 'Explore the vision',
                'cta_url' => '/vision-2030',
                'stat_value' => '2030',
                'stat_label' => 'Future roadmap',
                'cards' => [
                    'Editable cards powered from the Pages admin panel',
                    'Image links, headings, body copy, CTA, and proof points can change anytime',
                    'Landing page updates as soon as the page content is saved',
                ],
            ],
        ],
        'vision-2030' => [
            'title' => 'Vision 2030',
            'blocks' => [
                'eyebrow' => 'AI Powered Bengal',
                'intro' => 'Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.',
                'image' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&w=900&q=88',
                'image_alt' => 'Digital technology lab representing Vision 2030',
                'cta_label' => 'Open Vision 2030',
                'cta_url' => '/vision-2030',
                'stat_value' => '100K+',
                'stat_label' => 'AI-ready professionals',
                'cards' => [
                    '100,000 AI-ready professionals in 5 years',
                    'Eastern India as a global technology hub',
                    'Enterprise-ready execution from strategy to delivery',
                ],
            ],
        ],
        'about-us' => [
            'title' => 'About Us',
            'blocks' => [
                'eyebrow' => 'About Bengal IT Hub',
                'intro' => 'Bengal IT Hub delivers globally deployable AI and technology talent through industry-aligned skilling, real-world experience, and enterprise-ready execution.',
                'image' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=900&q=88',
                'image_alt' => 'Modern IT workspace for Bengal IT Hub',
                'cta_label' => 'Read About Us',
                'cta_url' => '/about-us',
                'stat_value' => '500+',
                'stat_label' => 'Projects delivered',
                'cards' => [
                    'Custom software, web platforms, SaaS, and AI-enabled growth systems',
                    'Industry-aligned skilling, internships, events, and talent pathways',
                    'A Bengal-based team building for national and global opportunities',
                ],
            ],
        ],
    ];

    $landingPages = $landingPages ?? collect();
    $landingPage = function (string $slug) use ($landingPages, $landingPageDefaults) {
        $model = $landingPages->get($slug);
        $fallback = $landingPageDefaults[$slug];

        return [
            'title' => $model?->title ?: $fallback['title'],
            'blocks' => array_replace($fallback['blocks'], $model?->blocks ?? []),
        ];
    };

    $visionSection = $landingPage('vision');
    $visionCards = collect(['vision-2030', 'about-us'])->map(fn ($slug) => $landingPage($slug));
@endphp

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     1. MARQUEE TICKER STRIP
     ═══════════════════════════════════════════════════════════ --}}
<div class="bih-marquee-strip" aria-hidden="true">
    <div class="bih-marquee-track">
        @foreach(range(1, 2) as $repeat)
            <span>AI Hackathon PRAGATI 2026</span>
            <span>SaaS &amp; Cloud</span>
            <span>Staff Augmentation</span>
            <span>AI Marketing</span>
            <span>Business Consultation</span>
            <span>Corporate Operations</span>
            <span>Bengal IT Hub</span>
            <span>Vision 2030</span>
            <span>HackFest PRAGATI 2026</span>
            <span>Tech Innovation</span>
            <span>Kolkata, India</span>
        @endforeach
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     2. HERO V2 — ORBIT EMBLEM
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hero-v2" aria-label="Homepage hero">
    <div class="bih-hp-container">
        <div class="bih-hero-v2-grid">

            {{-- Left: copy --}}
            <div>
                <p class="bih-hp-eyebrow"><span class="bih-dot"></span>AI Hackathon | Bengal HackFest PRAGATI 2026</p>
                <h1 class="bih-page-title">
                    Future Ready<br>
                    <em>Bengal</em> — Built<br>
                    For The World
                </h1>
                <p class="bih-lead mt-4">Bengal IT Hub ignites Zen X innovation in Eastern India. We bridge fresh ideas to market reality, exploring, incubating, and accelerating your future through technology, talent, and enterprise execution.</p>
                <div class="bih-hero-cta">
                    <a class="bih-hp-btn bih-hp-btn-primary" href="{{ route('contact') }}">
                        Start a Conversation
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="/hackfest-2026">HackFest PRAGATI 2026</a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="{{ route('services.index') }}">View Services</a>
                </div>
            </div>

            {{-- Right: orbit emblem --}}
            <div class="bih-orbit-wrap" aria-hidden="true">
                <div class="bih-orbit-ring"></div>
                <div class="bih-orbit-ring r2"></div>
                <div class="bih-orbit-ring r3"></div>
                <div class="bih-orbit-core">
                    <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="40" cy="40" r="28" stroke="currentColor" stroke-width="2.5" stroke-dasharray="6 4"/>
                        <circle cx="40" cy="40" r="14" fill="currentColor" opacity="0.3"/>
                        <path d="M26 40 Q40 22 54 40 Q40 58 26 40Z" fill="currentColor" opacity="0.7"/>
                        <circle cx="40" cy="40" r="5" fill="currentColor"/>
                        <path d="M14 40 h52 M40 14 v52" stroke="currentColor" stroke-width="1.5" opacity="0.4"/>
                    </svg>
                </div>
                <div class="bih-orbit-dot d1"></div>
                <div class="bih-orbit-dot d2"></div>
                <div class="bih-orbit-dot d3"></div>
                <div class="bih-orbit-chip">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    @php([$val0, $lbl0] = explode('|', $stats[0]))
                    <span>{{ $val0 }} {{ $lbl0 }}</span>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Stats band (dark) ── --}}
    <div class="bih-stats-band" role="region" aria-label="Key figures">
        <div class="bih-hp-container">
            <div class="bih-stats-band-inner">
                @foreach($stats as $stat)
                    @php([$value, $label] = explode('|', $stat))
                    <div class="bih-stats-band-item">
                        <div class="bih-sbi-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        </div>
                        <div class="bih-sbi-num" data-counter>{{ $value }}</div>
                        <div class="bih-sbi-lbl">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     3. WHO WE ARE — STATEMENT BAND
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt" id="about">
    <div class="bih-hp-container">
        <div class="bih-statement-band bih-reveal">
            <p>"Bengal IT Hub is a technology-driven innovation centre transforming businesses through advanced IT solutions, digital engineering, and talent empowerment — <span>bridging global opportunities with Bengal's capabilities</span> to innovate and succeed worldwide."</p>
        </div>
        <div class="bih-hp-section-head" style="margin-top: 60px;">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Who We Are</div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     4. ZIG-ZAG — MISSION / VISION
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section">
    <div class="bih-hp-container" style="display: grid; gap: 80px;">

        {{-- Row 1: Mission --}}
        <div class="bih-zigzag-row bih-reveal">
            <div class="bih-zigzag-media">
                <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=85"
                     alt="Bengal IT Hub mission — technology workspace"
                     width="900" height="675" loading="lazy" decoding="async">
            </div>
            <div>
                <p class="bih-zigzag-num">01</p>
                <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Mission</div>
                <h2 style="font-family: var(--bih-font-display); font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight:600; color:var(--bih-text-primary); margin:0 0 .5em; line-height:1.2;">Where Technology Creates Real Impact</h2>
                <p style="color: var(--bih-text-secondary); line-height:1.75; font-family: var(--bih-font-body); font-size:1rem;">We are growth enablers, bridging regional talent with global opportunity. Through enterprise expertise, customer-centric agility, and innovation-driven delivery, we help businesses scale efficiently from strategy to execution.</p>
                <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a class="bih-hp-btn bih-hp-btn-primary" href="/about-us">About Us</a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="{{ route('contact') }}">Start a Conversation</a>
                </div>
            </div>
        </div>

        {{-- Row 2: Vision (reversed) --}}
        <div class="bih-zigzag-row bih-reverse bih-reveal">
            <div class="bih-zigzag-media">
                <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&w=900&q=85"
                     alt="Vision 2030 — digital technology lab"
                     width="900" height="675" loading="lazy" decoding="async">
            </div>
            <div>
                <p class="bih-zigzag-num">02</p>
                <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Vision 2030</div>
                <h2 style="font-family: var(--bih-font-display); font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight:600; color:var(--bih-text-primary); margin:0 0 .5em; line-height:1.2;">Bengal AI Gigafactory — 100K+ AI Professionals</h2>
                <p style="color: var(--bih-text-secondary); line-height:1.75; font-family: var(--bih-font-body); font-size:1rem;">Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.</p>
                <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a class="bih-hp-btn bih-hp-btn-primary" href="/vision-2030">Open Vision 2030</a>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     5. SERVICES — HORIZONTAL CAROUSEL
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt" id="services">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Our Services</div>
            <h2>We Deliver End-to-End Digital Services for Business Growth</h2>
            <p>Custom software, SaaS products, cloud services, and AI-driven insights — faster delivery, lower costs, and measurable results.</p>
        </div>

        <div class="bih-svc-carousel bih-reveal">
            @foreach($services as $slug => $service)
                <a href="/{{ $slug }}" class="bih-svc-card" style="text-decoration: none;">
                    <div class="bih-num-tag">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['summary'] }}</p>
                    <span style="font-family: var(--bih-font-heading); font-size: 0.82rem; font-weight: 700; color: var(--bih-brand); display: inline-flex; align-items: center; gap: 6px;">
                        Learn more
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </a>
            @endforeach
        </div>
        <p class="bih-carousel-hint">← Scroll to explore more services →</p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     6. VISION 2030 DARK BAND — RING STATS
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" style="background-color: var(--bih-ink); overflow: hidden;" id="vision">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal" style="margin-bottom: 48px;">
            <div class="bih-hp-eyebrow" style="background:rgba(232,170,61,0.1); border-color: rgba(232,170,61,0.25); color: var(--bih-gold-light);"><span class="bih-dot"></span>{{ $visionSection['blocks']['eyebrow'] }}</div>
            <h2 style="color:#fff;">{{ $visionSection['title'] }}</h2>
            <p style="color:#A9C7CE;">{{ $visionSection['blocks']['intro'] }}</p>
            <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a class="bih-hp-btn bih-hp-btn-gold" href="{{ $visionSection['blocks']['cta_url'] ?: '/vision-2030' }}">{{ $visionSection['blocks']['cta_label'] ?: 'Explore Vision' }}</a>
                <a class="bih-hp-btn bih-hp-btn-outline" style="border-color: rgba(255,255,255,0.2); color:#fff;" href="/about-us">About Us</a>
            </div>
        </div>

        {{-- Ring stats row --}}
        <div class="bih-hp-grid-4 bih-reveal">
            @foreach([['100K+', 'AI-ready professionals'], ['500+', 'Projects delivered'], ['2030', 'Vision horizon'], ['24/7', 'Enterprise support']] as [$num, $lbl])
                <div class="bih-ring-stat">
                    <svg viewBox="0 0 120 120" fill="none" aria-hidden="true">
                        <circle cx="60" cy="60" r="50" stroke="rgba(255,255,255,0.08)" stroke-width="8"/>
                        <circle cx="60" cy="60" r="50" stroke="var(--bih-gold)" stroke-width="8"
                            stroke-dasharray="314" stroke-dashoffset="{{ 314 - ($loop->index * 52) }}"
                            stroke-linecap="round" transform="rotate(-90 60 60)"/>
                        <text x="60" y="64" text-anchor="middle" font-family="var(--bih-font-display)" font-size="20" fill="white" font-weight="600" font-style="italic">{{ $num }}</text>
                    </svg>
                    <div class="bih-ring-label">{{ $lbl }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="bih-angle-divider flip">
    <div class="bih-angle-fill" style="background-color: var(--bih-surface-alt);"></div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     7. CLIENT MARQUEE STRIP
     ═══════════════════════════════════════════════════════════ --}}
<div class="bih-client-marquee" aria-label="Client organisations">
    <div class="bih-client-marquee-track">
        @foreach(array_merge($clientCatalog->toArray(), $clientCatalog->toArray()) as $client)
            <div class="bih-cm-item">
                <div class="bih-cm-dot" aria-hidden="true">{{ strtoupper(substr($client['name'], 0, 1)) }}</div>
                <span>{{ $client['name'] }}</span>
            </div>
        @endforeach
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     8. OUR CLIENTS
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt" id="clients">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal" style="display: flex; flex-direction: column; align-items: center;">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Our Clients</div>
            <h2>Companies Building Real Products With Bengal IT Hub</h2>
            <p>A client preview from healthcare, education, real estate, commerce, logistics, hospitality, services, energy, and manufacturing.</p>
            <a class="bih-hp-btn bih-hp-btn-primary" style="margin-top: 12px;" href="{{ route('clients.index') }}">View All Clients</a>
        </div>

        <div class="bih-hp-grid-3 bih-reveal">
            @foreach($clientCatalog->take(3) as $client)
                <article class="bih-hp-card">
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px;">
                        <img src="{{ $client['logo'] }}" alt="{{ $client['name'] }} logo" width="56" height="56"
                             style="width:56px; height:56px; border-radius: 10px; object-fit:cover; box-shadow: var(--bih-shadow-sm);"
                             loading="lazy" decoding="async">
                        <div>
                            <strong style="display:block; font-family: var(--bih-font-heading); color: var(--bih-text-primary); font-size: 0.95rem;">{{ $client['name'] }}</strong>
                            <span style="font-size: 0.75rem; color: var(--bih-text-secondary); font-family: var(--bih-font-heading); text-transform: uppercase; letter-spacing: 0.06em;">{{ $client['industry'] }}</span>
                        </div>
                    </div>
                    <div class="bih-badge-tag">{{ $client['deal'] }}</div>
                    <p>{{ $client['product'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     9. PRODUCTS
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" id="products">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal" style="display: flex; flex-direction: column; align-items: center;">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Products</div>
            <h2>Product Lines Built For Real Business Use</h2>
            <p>Platforms, apps, automation tools, and AI-enabled systems Bengal IT Hub can plan, build, launch, and improve.</p>
            <a class="bih-hp-btn bih-hp-btn-primary" style="margin-top: 12px;" href="{{ route('products.index') }}">View All Products</a>
        </div>

        <div class="bih-hp-grid-4 bih-reveal">
            @foreach($productCatalog as $product)
                <a href="{{ route('products.show', $product['slug']) }}" class="bih-hp-card" style="display:block; text-decoration:none;">
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }} product"
                         style="width:100%; height:140px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:14px; display:block;"
                         width="900" height="600" loading="lazy" decoding="async">
                    <div class="bih-badge-tag-outline">{{ $product['category'] ?? 'Product' }}</div>
                    <h3 style="font-family: var(--bih-font-display); font-size: 1.05rem; font-weight: 600; color: var(--bih-text-primary); margin: 0 0 0.4em;">{{ $product['title'] }}</h3>
                    <p style="font-family: var(--bih-font-body); font-size: 0.88rem; color: var(--bih-text-secondary); line-height: 1.65; margin:0;">{{ $product['summary'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     10. ECOSYSTEM TABS — Partners / Awards / Tech Innovation
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt" id="ecosystem">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Our Ecosystem</div>
            <h2>Partners, Recognition &amp; Technology Innovation</h2>
            <p>Explore the collaboration network, awards milestones, and technology insights that power Bengal IT Hub's growth ecosystem.</p>
        </div>

        <div class="bih-eco-tabs bih-reveal">
            <button class="bih-eco-tab-btn bih-active" data-bih-eco-tab="partners" type="button">Our Partners</button>
            <button class="bih-eco-tab-btn" data-bih-eco-tab="awards" type="button">Awards &amp; Recognition</button>
            <button class="bih-eco-tab-btn" data-bih-eco-tab="tech" type="button">Tech Innovation</button>
        </div>

        {{-- Partners panel --}}
        <div class="bih-eco-panel bih-active bih-hp-grid-4" data-bih-eco-panel="partners">
            @if($partners->isNotEmpty())
                @foreach($partners->take(4) as $partner)
                    <a href="{{ route('our-partners.show', $partner->slug) }}" class="bih-hp-card" style="display:block; text-decoration:none;">
                        <div class="bih-hp-icon-badge" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="bih-badge-tag-outline">{{ ucfirst($partner->scope) }} Partner</div>
                        <h3>{{ $partner->name }}</h3>
                        <p>{{ $partner->description ? Str::limit($partner->description, 110) : 'Partner profile details coming soon.' }}</p>
                    </a>
                @endforeach
            @else
                @foreach($partnerCategories as $category)
                    <article class="bih-hp-card">
                        <div class="bih-hp-icon-badge" aria-hidden="true">
                            @include('partials.icon', ['name' => $category['icon']])
                        </div>
                        <h3>{{ $category['name'] }}</h3>
                        <p>{{ $category['body'] }}</p>
                    </article>
                @endforeach
            @endif
        </div>

        {{-- Awards panel --}}
        <div class="bih-eco-panel bih-hp-grid-4" data-bih-eco-panel="awards">
            @foreach($awardCategories as $category)
                <article class="bih-hp-card">
                    <img src="{{ $category['image'] }}" alt="{{ $category['title'] }}"
                         style="width:100%; height:120px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:14px; display:block;"
                         width="900" height="600" loading="lazy" decoding="async">
                    <div class="bih-badge-tag-outline">Recognition</div>
                    <h3>{{ $category['title'] }}</h3>
                    <p>{{ $category['body'] }}</p>
                </article>
            @endforeach
        </div>

        {{-- Tech Innovation panel --}}
        <div class="bih-eco-panel bih-hp-grid-3" data-bih-eco-panel="tech">
            @foreach([
                ['AI & Automation', 'Track practical AI, automation workflows, and new product ideas shaping business growth.', 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=85'],
                ['Cloud & Software', 'Read updates on scalable platforms, SaaS architecture, developer tools, and modern engineering practices.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=85'],
                ['Security & Digital Growth', 'Stay close to cybersecurity, analytics, digital strategy, and operational technology trends.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=85'],
            ] as [$title, $body, $img])
                <a href="{{ route('tech-innovation.index') }}" class="bih-hp-card" style="display:block; text-decoration:none;">
                    <img src="{{ $img }}" alt="{{ $title }}"
                         style="width:100%; height:150px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:14px; display:block;"
                         width="900" height="600" loading="lazy" decoding="async">
                    <h3>{{ $title }}</h3>
                    <p>{{ $body }}</p>
                </a>
            @endforeach
        </div>

        <div style="text-align:center; margin-top: 32px;" class="bih-reveal">
            <a class="bih-hp-btn bih-hp-btn-outline" href="{{ route('our-partners.index') }}">View All Partners</a>
            <a class="bih-hp-btn bih-hp-btn-outline" style="margin-left: 12px;" href="{{ route('awards-recognition') }}">View All Awards</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     11. INDUSTRIES — FILTER PILLS
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" id="industries" style="background-color: var(--bih-ink);">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal" style="margin-bottom:40px;">
            <div class="bih-hp-eyebrow" style="background:rgba(232,170,61,0.1); border-color: rgba(232,170,61,0.25); color: var(--bih-gold-light);"><span class="bih-dot"></span>Industries</div>
            <h2 style="color:#fff;">Leading Experts Across Global Technology Industries</h2>
            <p style="color:#A9C7CE;">From patient systems to manufacturing dashboards and property platforms, each industry page maps the real workflows Bengal IT Hub can digitise.</p>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; margin-bottom: 36px;" class="bih-reveal">
            @foreach($industries as $industry)
                <span class="bih-filter-pill" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.12); color: #A9C7CE;">{{ $industry }}</span>
            @endforeach
        </div>

        <div class="bih-hp-grid-3 bih-reveal">
            @foreach($industryCatalog as $slug => $industry)
                <a href="{{ route('industries.show', $slug) }}" class="bih-hp-card" style="display:flex; flex-direction:column; text-decoration:none; background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1);">
                    <img src="{{ $industry['image'] }}" alt="{{ $industry['name'] }} solutions"
                         style="width:100%; height:160px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:14px; display:block;"
                         width="900" height="600" loading="lazy" decoding="async">
                    <div class="bih-badge-tag-outline" style="border-color: rgba(255,255,255,0.15); color:#A9C7CE;">{{ $industry['kicker'] ?? 'Industry' }}</div>
                    <h3 style="color:#fff;">{{ $industry['name'] }}</h3>
                    <p style="color:#A9C7CE;">{{ $industry['summary'] }}</p>
                    <span style="margin-top: auto; font-family: var(--bih-font-heading); font-size:0.82rem; font-weight:700; color: var(--bih-gold-light); display:inline-flex; align-items:center; gap:5px;">
                        Explore industry →
                    </span>
                </a>
            @endforeach
        </div>

        <div style="text-align:center; margin-top:36px;" class="bih-reveal">
            <a class="bih-hp-btn bih-hp-btn-gold" href="{{ route('industries.index') }}">View All Industries</a>
            <a class="bih-hp-btn bih-hp-btn-outline" style="margin-left: 12px; border-color:rgba(255,255,255,0.2); color:#fff;" href="/pricing">Check Pricing</a>
        </div>
    </div>
</section>

<div class="bih-angle-divider">
    <div class="bih-angle-fill"></div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     12. HACKFEST SECTION
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" id="hackfest">
    <div class="bih-hp-container">
        <div class="bih-zigzag-row bih-reveal">
            {{-- Left: copy --}}
            <div>
                <div class="bih-hp-eyebrow"><span class="bih-dot"></span>HackFest</div>
                <h2 style="font-family: var(--bih-font-display); font-size: clamp(2rem,4vw,3rem); font-weight:600; color:var(--bih-text-primary); margin:0 0 0.4em; line-height:1.15;">{{ $event['name'] }}</h2>
                <p style="color: var(--bih-text-secondary); font-family:var(--bih-font-body); font-size:1.05rem; line-height:1.75;">{{ $event['tagline'] }}</p>
                <p style="margin-top:10px; font-family:var(--bih-font-heading); font-weight:700; color: var(--bih-text-primary);">{{ $event['venue'] }}. Grand Finale: {{ $event['finale'] }}.</p>

                <div class="bih-mini-stats" style="margin-top: 28px; grid-template-columns: repeat(2,1fr); background: none;">
                    @foreach($event['counters'] as $label => $value)
                        <div style="text-align:center; padding:18px 12px; background: var(--bih-surface); border: 1px solid var(--bih-border); border-radius: var(--bih-radius-md);">
                            <div style="font-family:var(--bih-font-display); font-style:italic; font-weight:600; font-size:1.8rem; color:var(--bih-brand);">{{ $value }}</div>
                            <div style="font-family:var(--bih-font-heading); font-size:0.78rem; color:var(--bih-text-secondary);">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 28px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a class="bih-hp-btn bih-hp-btn-primary" href="/hackfest-2026/register">Register for HackFest 2026</a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="/sponsor-hackfest-2026">Partner With Us</a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="/sponsor-form-hackfest-2026">Sponsors Request Meeting</a>
                </div>
            </div>

            {{-- Right: image grid --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                @foreach($hackfestImages as $index => [$alt, $src])
                    <img src="{{ $src }}" alt="{{ $alt }} — Bengal HackFest PRAGATI"
                         style="width:100%; height: {{ $index === 0 ? '240px' : '160px' }}; object-fit:cover; border-radius: var(--bih-radius-md); box-shadow: var(--bih-shadow-md); {{ $index === 0 ? 'grid-column: 1 / -1;' : '' }}"
                         width="900" height="600" loading="lazy" decoding="async">
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     13. TECH TALK — TechBiz & Tech-Innovation
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt" id="tech-talk">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Tech Talk</div>
            <h2>TechBiz and Tech-Innovation Channels</h2>
            <p>Follow business technology stories, innovation updates, AI, cloud, and future-ready ideas through Bengal IT Hub technology media pathways.</p>
        </div>

        <div class="bih-hp-grid-2 bih-reveal">
            <a class="bih-hp-card" href="/tech-biz" style="display:block; text-decoration:none; overflow:hidden;">
                <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=900&q=80"
                     alt="TechBiz — business technology news" width="900" height="600"
                     style="width:100%; height:200px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:18px; display:block;"
                     loading="lazy" decoding="async">
                <div class="bih-badge-tag">TechBiz</div>
                <h3>Business Technology Stories</h3>
                <p>Business technology stories, innovation, and ecosystem updates from Bengal IT Hub's media channel.</p>
            </a>
            <a class="bih-hp-card" href="{{ route('tech-innovation.index') }}" style="display:block; text-decoration:none; overflow:hidden;">
                <img src="https://images.unsplash.com/photo-1535223289827-42f1e9919769?auto=format&fit=crop&w=900&q=80"
                     alt="Tech Innovation — future technology insights" width="900" height="600"
                     style="width:100%; height:200px; object-fit:cover; border-radius: var(--bih-radius-sm); margin-bottom:18px; display:block;"
                     loading="lazy" decoding="async">
                <div class="bih-badge-tag">Tech Innovation</div>
                <h3>Emerging Technology & AI Insights</h3>
                <p>Emerging technology, AI, cloud, cybersecurity, and future-ready ideas continuously updated.</p>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     14. EXPLORE MORE — Quick Links
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" id="visitor-links">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Explore More</div>
            <h2>Everything Visitors Need in One Place</h2>
            <p>Explore company details, partners, FAQs, blogs, and contact pathways directly from the landing page.</p>
        </div>

        <div class="bih-hp-grid-4 bih-reveal">
            @foreach([
                ['About Us', '/about-us', 'About our AI talent platform and digital execution model.'],
                ['Our Partners', route('our-partners.index'), 'Industry, academic, innovation, hiring, and community partners.'],
                ['FAQ', '/faq', 'Answers about services, events, partnerships, and contact options.'],
                ['Blogs', route('blog.index'), 'Insights, announcements, and future Bengal IT Hub stories.'],
            ] as [$title, $href, $body])
                <a href="{{ $href }}" class="bih-hp-card" style="display:block; text-decoration:none;">
                    <h3>{{ $title }}</h3>
                    <p>{{ $body }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     15. CONTACT CTA — Zig-zag
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section bih-hp-section-alt">
    <div class="bih-hp-container">
        <div class="bih-zigzag-row bih-reveal">
            <div>
                <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Let's Connect</div>
                <h2 style="font-family: var(--bih-font-display); font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight:600; color:var(--bih-text-primary); margin:0 0 0.5em; line-height:1.2;">Ready to Grow Your Business?</h2>
                <p style="color: var(--bih-text-secondary); font-family:var(--bih-font-body); line-height:1.75;">{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
                <p style="margin-top: 12px; font-family:var(--bih-font-heading); font-weight:800; color: var(--bih-text-primary); font-size: 1.1rem;">{{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}</p>
                <div style="margin-top: 24px; display:flex; gap:12px; flex-wrap:wrap;">
                    <a class="bih-hp-btn bih-hp-btn-primary" href="{{ route('contact') }}">Contact Us Today</a>
                    <a class="bih-hp-btn bih-hp-btn-outline" href="tel:{{ preg_replace('/[^0-9+]/', '', $siteBrand['phone'] ?? config('bengalhub.brand.phone')) }}">Call Now</a>
                </div>
            </div>
            <div class="bih-zigzag-media">
                <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=900&q=85"
                     alt="Contact Bengal IT Hub team" width="900" height="675" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     16. FAQ ACCORDION
     ═══════════════════════════════════════════════════════════ --}}
<section class="bih-hp-section" id="qa">
    <div class="bih-hp-container">
        <div class="bih-hp-section-head bih-reveal">
            <div class="bih-hp-eyebrow"><span class="bih-dot"></span>Questions &amp; Answers</div>
            <h2>Common Questions Before You Explore Deeper</h2>
            <p>Quick answers about products, industries, partners, Tech Innovation, recognition, and how visitors should move from the landing page to the right main section.</p>
        </div>

        <div style="max-width: 800px; margin: 0 auto;" class="bih-reveal">
            @foreach($homeFaqs as $faq)
                <div class="bih-hp-faq-item">
                    <div class="bih-hp-faq-q" role="button" tabindex="0" aria-expanded="false">
                        <span>{{ $faq[0] }}</span>
                        <span class="bih-hp-faq-icon" aria-hidden="true">+</span>
                    </div>
                    <div class="bih-hp-faq-a">
                        <p>{{ $faq[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



@endsection

