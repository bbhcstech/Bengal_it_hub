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
            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85" alt="Professional digital business workspace with website analytics">
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
                    <img src="{{ $image }}" alt="{{ $label }} at Bengal IT Hub">
                    <span>{{ $label }}</span>
                </figure>
            @endforeach
        </div>
    </div>
</section>

<section id="vision" class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Vision 2030', 'title' => 'AI Powered Bengal', 'intro' => 'Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.'])
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach(['100,000 AI-ready professionals in 5 years', 'Eastern India as a global technology hub', 'Enterprise-ready execution from strategy to delivery'] as $item)
                <div class="bih-card p-6">
                    <div class="text-3xl font-black text-teal-700">0{{ $loop->iteration }}</div>
                    <p class="mt-4 font-bold leading-7 text-slate-800">{{ $item }}</p>
                </div>
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
                    <img class="h-48 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $service['image'] ?? $serviceImages[$slug] ?? 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $service['title'] }} service at Bengal IT Hub">
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
                    <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $title }} phase at Bengal IT Hub">
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
                    <img class="h-44 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
                    <div class="p-5">
                        <h3 class="bih-section-title text-xl">{{ $title }}</h3>
                        <p class="bih-copy mt-3">{{ $body }}</p>
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
                <img class="h-44 w-full rounded-md object-cover shadow-lg {{ $loop->first ? 'col-span-2 h-64' : '' }}" src="{{ $src }}" alt="{{ $alt }} at Bengal IT Hub">
            @endforeach
        </div>
    </div>
</section>

<section id="tech-talk" class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Tech Talk', 'title' => 'TechBiz and Tech-Innovation Channels', 'intro' => 'Follow business technology stories, innovation updates, AI, cloud, and future-ready ideas through Bengal IT Hub technology media pathways.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2">
            <a class="bih-card bih-image-card overflow-hidden" href="https://test1.infoscience.co.in/" target="_blank" rel="noopener">
                <img class="h-64 w-full object-cover" src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=900&q=80" alt="TechBiz business technology news">
                <div class="p-6"><h3 class="bih-section-title text-2xl">TechBiz</h3><p class="bih-copy mt-2">Business technology stories, innovation, and ecosystem updates.</p></div>
            </a>
            <a class="bih-card bih-image-card overflow-hidden" href="https://test1.infoscience.co.in/" target="_blank" rel="noopener">
                <img class="h-64 w-full object-cover" src="https://images.unsplash.com/photo-1535223289827-42f1e9919769?auto=format&fit=crop&w=900&q=80" alt="Tech innovation and future technology">
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
            <img class="h-80 w-full rounded-md object-cover shadow-xl" src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=1100&q=85" alt="Contact Bengal IT Hub team">
        </div>
    </div>
</section>
@endsection
