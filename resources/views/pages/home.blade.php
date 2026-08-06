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
<section class="bih-landing-hero">
    <div class="bih-container grid min-h-[82vh] gap-10 py-16 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div class="relative z-10">
            <p class="text-sm font-black uppercase text-amber-300">AI Hackathon | The Bengal HackFest PRAGATI 2026</p>
            <h1 class="mt-5 max-w-3xl text-5xl font-black leading-tight text-white md:text-7xl">Future Ready <span class="text-sky-300">Bengal</span></h1>
            <p class="bih-page-intro bih-on-dark mt-6 max-w-2xl">Bengal IT Hub ignites Zen X innovation in Eastern India. We're the bridge from fresh ideas to market reality, exploring, incubating, and accelerating your future.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026">Learn More</a>
                <a class="bih-button bih-button-secondary" href="/contact">Get Your Place</a>
                <a class="bih-button bih-button-light" href="/services">View Services</a>
            </div>
        </div>
        <div class="bih-hero-showcase">
            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85" alt="Professional digital business workspace with website analytics" width="1200" height="800" decoding="async" fetchpriority="high">
            <div class="absolute inset-x-5 bottom-5 grid gap-3 rounded-md bg-white/92 p-4 shadow-xl backdrop-blur sm:grid-cols-4">
                @foreach($stats as $stat)
                    @php([$value, $label] = explode('|', $stat))
                    <div class="text-center">
                        <div class="text-2xl font-black leading-tight text-slate-950">{{ $value }}</div>
                        <div class="text-xs font-extrabold uppercase text-slate-500">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="about" class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">Who We Are</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-6xl">Where Technology Creates Real Impact</h2>
            <p class="bih-page-intro mt-5">Bengal IT Hub is a technology-driven innovation center transforming businesses through advanced IT solutions, digital engineering, and talent empowerment, bridging global opportunities with Bengal's capabilities to innovate and succeed worldwide.</p>
            <p class="bih-copy mt-4">We are growth enablers, bridging regional talent with global opportunity. Through enterprise expertise, customer-centric agility, and innovation-driven delivery, we help businesses scale efficiently from strategy to execution.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/about-us">About Us</a>
                <a class="bih-button bih-button-secondary" href="/contact">Start a Conversation</a>
            </div>
        </div>
        <div class="grid gap-4 sm:grid-cols-3">
            @foreach(['Mission' => 'Empowering businesses talent through future-ready digital innovation.', 'Vision' => 'To build a global technology hub from Eastern India.', 'Positioning' => 'A strategic IT powerhouse delivering impactful digital solutions globally.'] as $label => $text)
                <article class="bih-card p-6">
                    <p class="text-sm font-black uppercase text-teal-700">{{ $label }}</p>
                    <p class="mt-4 font-bold leading-7 text-slate-800">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-photo-band py-16">
    <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">Innovation Ecosystem</p>
            <h2 class="bih-section-title mt-3 text-4xl text-white md:text-5xl">Built With Real Teams, Real Businesses, And Real Results</h2>
            <p class="bih-page-intro bih-on-dark mt-5">From training rooms to boardrooms, Bengal IT Hub connects technology services, business consulting, events, and talent programs into one practical growth ecosystem.</p>
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach($ecosystemImages as [$label, $image])
                <figure class="bih-photo-panel">
                    <img src="{{ $image }}" alt="{{ $label }} at Bengal IT Hub" width="900" height="600" loading="lazy" decoding="async">
                    <span>{{ $label }}</span>
                </figure>
            @endforeach
        </div>
    </div>
</section>

<section id="vision" class="bih-vision-section">
    <div class="bih-container">
        <div class="bih-vision-shell">
            <div class="bih-vision-copy">
                <p class="bih-eyebrow">{{ $visionSection['blocks']['eyebrow'] }}</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-6xl">{{ $visionSection['title'] }}</h2>
                <p class="bih-page-intro mt-5">{{ $visionSection['blocks']['intro'] }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="bih-button" href="{{ $visionSection['blocks']['cta_url'] ?: '/vision-2030' }}">{{ $visionSection['blocks']['cta_label'] ?: 'Explore the vision' }}</a>
                    <a class="bih-button bih-button-secondary" href="/about-us">About Us</a>
                </div>
            </div>

            <figure class="bih-vision-feature">
                <img src="{{ $visionSection['blocks']['image'] }}" alt="{{ $visionSection['blocks']['image_alt'] ?: $visionSection['title'] }}" width="1200" height="800" loading="lazy" decoding="async">
                <figcaption>
                    <strong>{{ $visionSection['blocks']['stat_value'] }}</strong>
                    <span>{{ $visionSection['blocks']['stat_label'] }}</span>
                </figcaption>
            </figure>
        </div>

        <div class="bih-vision-card-grid">
            @foreach($visionCards as $card)
                @php($blocks = $card['blocks'])
                <article class="bih-vision-card">
                    <div class="bih-vision-card-media">
                        <img src="{{ $blocks['image'] }}" alt="{{ $blocks['image_alt'] ?: $card['title'] }}" width="900" height="600" loading="lazy" decoding="async">
                        <span>{{ $blocks['stat_value'] }}</span>
                    </div>
                    <div class="bih-vision-card-body">
                        <p class="bih-eyebrow">{{ $blocks['eyebrow'] }}</p>
                        <h3>{{ $card['title'] }}</h3>
                        <p>{{ $blocks['intro'] }}</p>
                        <ul>
                            @foreach(($blocks['cards'] ?? []) as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ $blocks['cta_url'] ?: '#' }}">{{ $blocks['cta_label'] ?: 'View More' }}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="bg-white py-16">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Our Services', 'title' => 'We Deliver End-to-End Digital Services for Business Growth', 'intro' => 'We transform ideas into impact with custom software, SaaS products, cloud services, and AI-driven insights. Our expertise ensures faster delivery, lower costs, and measurable results across enterprises worldwide.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $slug => $service)
                <a href="/{{ $slug }}" class="bih-card bih-image-card group block overflow-hidden">
                    <img class="h-48 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $service['image'] ?? $serviceImages[$slug] ?? 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $service['title'] }} service at Bengal IT Hub" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-6">
                        <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
                        <h3 class="bih-section-title mt-3 text-2xl">{{ $service['title'] }}</h3>
                        <p class="bih-copy mt-3">{{ $service['summary'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'How We Work', 'title' => 'A Clear Delivery Process From Idea To Scale', 'intro' => 'Every service follows a practical path so clients can see progress, understand decisions, and get a cleaner final result.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($deliverySteps as [$title, $body, $image])
                <article class="bih-card bih-image-card overflow-hidden">
                    <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $title }} phase at Bengal IT Hub" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-5">
                        <p class="bih-eyebrow">0{{ $loop->iteration }}</p>
                        <h3 class="bih-section-title mt-2 text-2xl">{{ $title }}</h3>
                        <p class="bih-copy mt-3">{{ $body }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Growth Engine', 'title' => 'Complete Web and Technology Solutions', 'intro' => 'Modern UI/UX layouts, fast and secure development, branding, analytics, SaaS, cloud, and AI-enabled business support for startups, companies, institutions, and enterprises.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($impactCards as [$title, $body, $image])
                <article class="bih-card bih-image-card overflow-hidden">
                    <img class="h-44 w-full object-cover" src="{{ $image }}" alt="{{ $title }}" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-5">
                        <h3 class="bih-section-title text-xl">{{ $title }}</h3>
                        <p class="bih-copy mt-3">{{ $body }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Our Clients', 'title' => 'Companies Building Real Products With Bengal IT Hub', 'intro' => 'A quick logo wall and client preview from healthcare, education, real estate, commerce, logistics, hospitality, services, energy, and manufacturing.'])
            <a class="bih-button" href="{{ route('clients.index') }}">View More Clients</a>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach($clientCatalog as $client)
                <a href="{{ route('clients.index') }}#client-{{ Str::slug($client['name']) }}" class="group rounded-md border border-slate-200 bg-slate-50 p-4 text-center shadow-sm transition hover:-translate-y-1 hover:border-teal-600/50 hover:bg-white hover:shadow-lg">
                    <img class="mx-auto h-16 w-16 rounded-md object-cover shadow-sm" src="{{ $client['logo'] }}" alt="{{ $client['name'] }} logo" width="160" height="160" loading="lazy" decoding="async">
                    <p class="mt-3 text-sm font-black leading-tight text-slate-950 transition group-hover:text-teal-700">{{ $client['name'] }}</p>
                    <p class="mt-1 text-xs font-bold uppercase text-slate-500">{{ $client['industry'] }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach($clientCatalog->take(3) as $client)
                <article class="bih-card p-6">
                    <p class="bih-eyebrow">{{ $client['industry'] }}</p>
                    <h3 class="bih-section-title mt-3 text-2xl">{{ $client['deal'] }}</h3>
                    <p class="bih-copy mt-3">{{ $client['product'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Products', 'title' => 'Product Lines Built For Real Business Use', 'intro' => 'Explore a compact preview of the platforms, apps, automation tools, and AI-enabled systems Bengal IT Hub can plan, build, launch, and improve.'])
            <a class="bih-button" href="{{ route('products.index') }}">View More Products</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($productCatalog as $product)
                <a href="{{ route('products.show', $product['slug']) }}" class="bih-card bih-image-card group block overflow-hidden">
                    <img class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $product['image'] }}" alt="{{ $product['title'] }} product line" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-5">
                        <p class="bih-eyebrow">{{ $product['category'] ?? 'Product' }}</p>
                        <h3 class="bih-section-title mt-2 text-xl">{{ $product['title'] }}</h3>
                        <p class="bih-copy mt-3">{{ $product['summary'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Industries', 'title' => 'Industry Solutions With Practical Technology Depth', 'intro' => 'From patient systems to manufacturing dashboards and property platforms, each industry page maps the real workflows Bengal IT Hub can digitize.'])
            <a class="bih-button" href="{{ route('industries.index') }}">View More Industries</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($industryCatalog as $slug => $industry)
                <a href="{{ route('industries.show', $slug) }}" class="bih-card bih-image-card group flex flex-col overflow-hidden">
                    <img class="h-48 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $industry['image'] }}" alt="{{ $industry['name'] }} technology solutions" width="900" height="600" loading="lazy" decoding="async">
                    <div class="flex flex-1 flex-col p-6">
                        <p class="bih-eyebrow">{{ $industry['kicker'] ?? 'Industry Solutions' }}</p>
                        <h3 class="bih-section-title mt-2 text-2xl">{{ $industry['name'] }}</h3>
                        <p class="bih-copy mt-3 flex-1">{{ $industry['summary'] }}</p>
                        <span class="mt-5 text-sm font-extrabold text-teal-700">Explore industry</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Our Partners', 'title' => 'Collaboration Across Industry, Academia, And Community', 'intro' => 'A quick look at the partner ecosystem behind Bengal IT Hub, including academic, hiring, innovation, technology, and community pathways.'])
            <a class="bih-button" href="{{ route('our-partners.index') }}">View More Partners</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @if($partners->isNotEmpty())
                @foreach($partners->take(4) as $partner)
                    <a href="{{ route('our-partners.show', $partner->slug) }}" class="bih-card block p-6 transition hover:-translate-y-1 hover:border-teal-500">
                        <p class="bih-eyebrow">{{ ucfirst($partner->scope) }} Partner</p>
                        <h3 class="bih-section-title mt-3 text-xl">{{ $partner->name }}</h3>
                        <p class="bih-copy mt-3">{{ $partner->description ? Str::limit($partner->description, 120) : 'Partner profile details are being added.' }}</p>
                    </a>
                @endforeach
            @else
                @foreach($partnerCategories as $category)
                    <article class="bih-card p-6">
                        <span class="grid h-12 w-12 place-items-center rounded-md bg-teal-50 text-teal-700">
                            @include('partials.icon', ['name' => $category['icon']])
                        </span>
                        <h3 class="bih-section-title mt-4 text-xl">{{ $category['name'] }}</h3>
                        <p class="bih-copy mt-3">{{ $category['body'] }}</p>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="bih-section bg-slate-950 text-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            <div class="max-w-3xl">
                <p class="text-sm font-black uppercase text-amber-300">Tech Innovation</p>
                <h2 class="bih-section-title mt-3 text-3xl text-white md:text-5xl">Technology News, Trends, And Future-Ready Signals</h2>
                <p class="bih-page-intro bih-on-dark mt-4">Follow AI, cloud, software, cybersecurity, and business technology updates through the full Tech Innovation hub.</p>
            </div>
            <a class="bih-button" href="{{ route('tech-innovation.index') }}">View More Tech Innovation</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach([
                ['AI & Automation', 'Track practical artificial intelligence, automation workflows, and new product ideas shaping business growth.', 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=85'],
                ['Cloud & Software', 'Read updates on scalable platforms, SaaS architecture, developer tools, and modern engineering practices.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=85'],
                ['Security & Digital Growth', 'Stay close to cybersecurity, analytics, digital strategy, and operational technology trends.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=85'],
            ] as [$title, $body, $image])
                <a href="{{ route('tech-innovation.index') }}" class="group overflow-hidden rounded-md border border-white/10 bg-white/8 transition hover:-translate-y-1 hover:border-teal-300/60">
                    <img class="h-48 w-full object-cover opacity-90 transition duration-500 group-hover:scale-105" src="{{ $image }}" alt="{{ $title }} in Tech Innovation" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-6">
                        <h3 class="text-2xl font-black text-white">{{ $title }}</h3>
                        <p class="mt-3 leading-7 text-white/72">{{ $body }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="flex flex-wrap items-end justify-between gap-5">
            @include('partials.section-heading', ['eyebrow' => 'Awards & Recognition', 'title' => 'Recognition Milestones, Media Mentions, And Proof Points', 'intro' => 'A concise preview of the recognition categories Bengal IT Hub is tracking as the company, HackFest platform, and Vision 2030 ecosystem grow.'])
            <a class="bih-button" href="{{ route('awards-recognition') }}">View More Recognition</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($awardCategories as $category)
                <article class="bih-card bih-image-card overflow-hidden">
                    <img class="h-36 w-full object-cover" src="{{ $category['image'] }}" alt="{{ $category['title'] }}" width="900" height="600" loading="lazy" decoding="async">
                    <div class="p-5">
                        <p class="bih-eyebrow">Recognition</p>
                        <h3 class="bih-section-title mt-2 text-xl">{{ $category['title'] }}</h3>
                        <p class="bih-copy mt-3">{{ $category['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">Industries</p>
            <h2 class="bih-section-title mt-3 text-4xl text-white md:text-5xl">Leading Experts Across Global Technology Industries</h2>
            <p class="bih-copy bih-on-dark mt-5">We deliver transformative technology solutions across IT, SaaS, cloud, FinTech, healthcare, EdTech, manufacturing, and e-commerce. With deep industry expertise and a client-focused approach, we empower businesses to innovate, scale, and achieve measurable growth.</p>
            <a class="bih-button mt-8" href="/pricing">Check Pricing</a>
        </div>
        <div class="grid gap-3 sm:grid-cols-2">
            @foreach($industries as $industry)
                <div class="rounded-md border border-white/10 bg-white/8 p-4 font-extrabold">{{ $industry }}</div>
            @endforeach
        </div>
    </div>
</section>

<section id="hackfest" class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_1fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">Hackfest</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">{{ $event['name'] }}</h2>
            <p class="bih-page-intro mt-5">{{ $event['tagline'] }}</p>
            <p class="mt-4 font-bold text-slate-800">{{ $event['venue'] }}. Grand Finale: {{ $event['finale'] }}.</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach($event['counters'] as $label => $value)
                    <div class="rounded-md bg-slate-950 p-5 text-white">
                        <div class="text-3xl font-black text-amber-300">{{ $value }}</div>
                        <div class="mt-1 text-sm font-bold text-white/70">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register With HackFest 2026</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-hackfest-2026">Partner With Us</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Sponsors Request Meeting</a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach($hackfestImages as [$alt, $src])
                <img class="h-44 w-full rounded-md object-cover shadow-lg {{ $loop->first ? 'col-span-2 h-64' : '' }}" src="{{ $src }}" alt="{{ $alt }} at Bengal IT Hub" width="900" height="600" loading="lazy" decoding="async">
            @endforeach
        </div>
    </div>
</section>

<section id="tech-talk" class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Tech Talk', 'title' => 'TechBiz and Tech-Innovation Channels', 'intro' => 'Follow business technology stories, innovation updates, AI, cloud, and future-ready ideas through Bengal IT Hub technology media pathways.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2">
            <a class="bih-card bih-image-card overflow-hidden" href="/tech-biz">
                <img class="h-64 w-full object-cover" src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=900&q=80" alt="TechBiz business technology news" width="900" height="600" loading="lazy" decoding="async">
                <div class="p-6"><h3 class="bih-section-title text-2xl">TechBiz</h3><p class="bih-copy mt-2">Business technology stories, innovation, and ecosystem updates.</p></div>
            </a>
            <a class="bih-card bih-image-card overflow-hidden" href="/tech-innovation">
                <img class="h-64 w-full object-cover" src="https://images.unsplash.com/photo-1535223289827-42f1e9919769?auto=format&fit=crop&w=900&q=80" alt="Tech innovation and future technology" width="900" height="600" loading="lazy" decoding="async">
                <div class="p-6"><h3 class="bih-section-title text-2xl">Tech-Innovation</h3><p class="bih-copy mt-2">Emerging technology, AI, cloud, and future-ready ideas.</p></div>
            </a>
        </div>
    </div>
</section>

<section id="visitor-links" class="bg-white py-16">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Explore More', 'title' => 'Everything Visitors Need in One Place', 'intro' => 'Explore company details, partners, FAQs, blogs, and contact pathways directly from the landing page.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach([
                ['About Us', '/about-us', 'About our AI talent platform and digital execution model.'],
                ['Our Partners', '/our-partners', 'Industry, academic, innovation, hiring, and community partners.'],
                ['FAQ', '/faq', 'Answers about services, events, partnerships, and contact options.'],
                ['Blogs', '/blog', 'Insights, announcements, and future Bengal IT Hub stories.'],
            ] as [$title, $href, $body])
                <a href="{{ $href }}" class="bih-card block p-6 transition hover:-translate-y-1 hover:border-teal-500">
                    <h3 class="bih-section-title text-2xl">{{ $title }}</h3>
                    <p class="bih-copy mt-3">{{ $body }}</p>
                </a>
            @endforeach
        </div>
        <div class="mt-10 grid gap-6 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
            <div class="bih-card p-6">
                <p class="bih-eyebrow">Let's Connect</p>
                <h3 class="bih-section-title mt-2 text-3xl">Ready to Grow Your Business?</h3>
                <p class="bih-copy mt-3">{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
                <p class="mt-3 font-black text-slate-950">{{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}</p>
                <a class="bih-button mt-5" href="/contact">Contact Us Today</a>
            </div>
            <img class="h-80 w-full rounded-md object-cover shadow-xl" src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=1100&q=85" alt="Contact Bengal IT Hub team" width="1100" height="733" loading="lazy" decoding="async">
        </div>
    </div>
</section>

<section id="qa" class="bih-section bg-slate-50">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Questions & Answers', 'title' => 'Common Questions Before You Explore Deeper', 'intro' => 'Quick answers about products, industries, partners, Tech Innovation, recognition, and how visitors should move from the landing page to the right main section.'])
        <div class="mt-10 grid gap-4 lg:grid-cols-2">
            @foreach($homeFaqs as $faq)
                <details class="bih-card group p-6">
                    <summary class="cursor-pointer list-none text-lg font-black leading-snug text-slate-950">
                        <span class="inline-flex w-full items-start justify-between gap-4">
                            <span>{{ $faq[0] }}</span>
                            <span class="text-teal-700 transition group-open:rotate-45">+</span>
                        </span>
                    </summary>
                    <p class="bih-copy mt-4">{{ $faq[1] }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endsection
