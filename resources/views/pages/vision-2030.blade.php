@extends('layouts.app')

@php
    $heroImage = '/assets/images/partners/img_2839c3b186.jpg';
    $labImage = '/assets/images/about/img_fc813def9f.jpg';
    $talentImage = '/assets/images/services/img_1980b63e07.jpg';
    $startupImage = '/assets/images/services/img_38cfcd2839.jpg';

    $goals = [
        ['icon' => 'graduation', 'value' => '100,000+', 'label' => 'AI-ready professionals', 'note' => 'Students, graduates, and working professionals trained for real industry roles.'],
        ['icon' => 'university', 'value' => '500+', 'label' => 'Academic institutions', 'note' => 'Colleges and universities connected through skilling, labs, and career pathways.'],
        ['icon' => 'partners', 'value' => '300+', 'label' => 'Industry partners', 'note' => 'Companies, hiring partners, mentors, and enterprise collaborators.'],
        ['icon' => 'rocket', 'value' => '1,000+', 'label' => 'AI startups enabled', 'note' => 'Founder support, product mentoring, market access, and innovation programs.'],
    ];

    $pillars = [
        ['icon' => 'graduation', 'title' => 'AI Talent Pipeline', 'body' => 'Hands-on learning pathways for AI, data, cloud, cybersecurity, automation, and emerging technology careers.'],
        ['icon' => 'flask', 'title' => 'Innovation Labs', 'body' => 'Campus and industry labs where teams prototype AI products, automation workflows, and research-led solutions.'],
        ['icon' => 'partners', 'title' => 'Industry Collaboration', 'body' => 'A stronger bridge between employers, institutions, mentors, startups, government bodies, and communities.'],
        ['icon' => 'briefcase', 'title' => 'Employment Engine', 'body' => 'Job readiness, staff augmentation, internships, project exposure, and placement-connected programs.'],
    ];

    $roadmap = [
        ['phase' => '2026', 'title' => 'Foundation', 'body' => 'Launch structured AI learning tracks, mentor networks, partner onboarding, and pilot innovation labs.'],
        ['phase' => '2027-28', 'title' => 'Expansion', 'body' => 'Scale across districts, connect institutions with industry projects, and build startup incubation cohorts.'],
        ['phase' => '2029', 'title' => 'Acceleration', 'body' => 'Move from training to deployment through staff augmentation, enterprise AI projects, and talent exports.'],
        ['phase' => '2030', 'title' => 'Global Hub', 'body' => 'Position Bengal as a recognized AI innovation and talent hub serving national and international markets.'],
    ];

    $focusAreas = [
        ['title' => 'Artificial Intelligence', 'body' => 'Intelligent systems that help businesses predict, automate, personalize, and make better decisions.', 'image' => '/assets/images/products/img_492dbbb829.jpg'],
        ['title' => 'Machine Learning', 'body' => 'Model-driven solutions for classification, forecasting, recommendations, analytics, and pattern discovery.', 'image' => '/assets/images/services/img_08aed8e613.jpg'],
        ['title' => 'Generative AI', 'body' => 'AI content systems, copilots, chat interfaces, document automation, and knowledge-driven workflows.', 'image' => '/assets/images/services/img_a071cf3d6d.jpg'],
        ['title' => 'Data Science', 'body' => 'Dashboards, data pipelines, insights, analytics models, and business intelligence for practical decisions.', 'image' => '/assets/images/services/img_06107bce75.jpg'],
        ['title' => 'Cloud Computing', 'body' => 'Cloud-ready architecture, scalable hosting, integrations, APIs, deployment support, and secure operations.', 'image' => '/assets/images/products/img_5a8c80620d.jpg'],
        ['title' => 'Cybersecurity', 'body' => 'Security awareness, secure development practices, risk reduction, monitoring, and protection-first systems.', 'image' => '/assets/images/services/img_6ca91fafdb.jpg'],
        ['title' => 'Robotics', 'body' => 'Automation concepts, robotics learning, prototyping pathways, and intelligent machine interaction.', 'image' => '/assets/images/services/img_483c3c1480.jpg'],
        ['title' => 'IoT', 'body' => 'Connected devices, sensors, data dashboards, monitoring products, and automation workflows.', 'image' => '/assets/images/services/img_434e697d1d.jpg'],
        ['title' => 'Quantum Computing', 'body' => 'Foundational learning, emerging research awareness, future computing readiness, and experimentation culture.', 'image' => '/assets/images/services/img_00e22fc1f0.jpg'],
        ['title' => 'AR/VR', 'body' => 'Immersive learning, virtual experiences, simulations, product visualization, and interactive digital environments.', 'image' => '/assets/images/services/img_94f7583cb7.jpg'],
        ['title' => 'Product Engineering', 'body' => 'MVP planning, UX flows, software architecture, build cycles, testing, and launch-ready product systems.', 'image' => '/assets/images/services/img_4e2b1a575e.jpg'],
        ['title' => 'Digital Transformation', 'body' => 'Modern tools, business process automation, digital strategy, operational platforms, and growth systems.', 'image' => '/assets/images/partners/img_5a330f6608.jpg'],
    ];

    $outcomes = [
        'Future-ready curriculum with real project practice',
        'Industry mentors, internships, and hiring pathways',
        'Startup support from idea validation to market launch',
        'AI adoption support for MSMEs and enterprises',
        'Research, labs, events, and innovation communities',
        'A stronger Bengal technology brand for global work',
    ];
@endphp

@section('content')
<div class="bih-v2030-marquee" aria-hidden="true">
    <div class="bih-v2030-marquee-track">
        <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
        <span>AI Hackathon PRAGATI 2026</span><span>SaaS &amp; Cloud</span><span>Staff Augmentation</span><span>AI Marketing</span><span>Business Enablement</span><span>Vision 2030</span>
    </div>
</div>

<div class="bih-v2030-breadcrumb-wrap">
    <div class="bih-container">
        <nav class="bih-v2030-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <span class="current">Vision 2030</span>
        </nav>
    </div>
</div>

<section class="bih-v2030-hero relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-38" src="{{ $heroImage }}" alt="AI innovation workspace for Bengal IT Hub Vision 2030">
    <div class="bih-v2030-hero-overlay absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/88 to-teal-950/55"></div>
    <div class="bih-container relative grid min-h-[76vh] gap-10 py-16 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div>
            <p class="bih-v2030-eyebrow text-sm font-black uppercase text-amber-300">AI Powered Bengal</p>
            <h1 class="mt-4 max-w-4xl text-5xl font-black leading-tight text-white md:text-7xl">Vision 2030</h1>
            <p class="mt-5 max-w-3xl text-2xl font-extrabold leading-snug text-white md:text-4xl">Building India's first AI Gigafactory from Bengal.</p>
            <p class="bih-page-intro bih-on-dark mt-6">Bengal IT Hub's Vision 2030 is a mission to transform West Bengal into a high-trust ecosystem for AI talent, innovation, startups, research, and employment.</p>
            <p class="mt-4 max-w-3xl leading-8 text-white/82">We connect students, professionals, institutions, industry, entrepreneurs, and government-facing initiatives through practical AI skilling, innovation labs, enterprise collaboration, and globally deployable talent programs.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="{{ route('contact') }}">Join the Movement</a>
                <a class="bih-button bih-button-light" href="#roadmap">View Roadmap</a>
            </div>
        </div>

        <div class="relative">
            <div class="bih-v2030-hero-card overflow-hidden rounded-md border border-white/14 bg-white/10 shadow-2xl backdrop-blur">
                <img class="h-80 w-full object-cover sm:h-[32rem]" src="{{ $labImage }}" alt="Digital technology lab representing Bengal's AI future">
                <div class="grid gap-3 bg-white p-5 text-slate-950 sm:grid-cols-3">
                    <div>
                        <p class="text-3xl font-black text-teal-700">AI</p>
                        <p class="text-xs font-black uppercase text-slate-500">Skilling</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-sky-700">Labs</p>
                        <p class="text-xs font-black uppercase text-slate-500">Innovation</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-amber-600">Jobs</p>
                        <p class="text-xs font-black uppercase text-slate-500">Deployment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bih-v2030-bento-band bg-white py-14">
    <div class="bih-container">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach($goals as $goal)
                <article class="bih-card bih-v2030-bento p-6">
                    <span class="bih-v2030-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="grid h-12 w-12 place-items-center rounded-md bg-teal-50 text-teal-700">
                        @include('partials.icon', ['name' => $goal['icon']])
                    </span>
                    <p class="mt-5 text-3xl font-black leading-tight text-slate-950">{{ $goal['value'] }}</p>
                    <h2 class="mt-1 text-lg font-black leading-snug text-slate-900">{{ $goal['label'] }}</h2>
                    <p class="bih-copy mt-3 text-sm">{{ $goal['note'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bih-v2030-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[.88fr_1.12fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">The Big Mission</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">A practical AI ecosystem, not just a slogan</h2>
            <p class="bih-page-intro mt-5">Vision 2030 is designed around measurable outcomes: skilled people, working labs, employable portfolios, startup creation, business adoption, and partnerships that keep talent connected to opportunity.</p>
            <p class="bih-copy mt-4">The goal is to make Bengal a destination where AI capability is learned, built, tested, hired, and scaled through one connected platform.</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($pillars as $pillar)
                <article class="bih-card bih-v2030-bento p-6">
                    <span class="bih-v2030-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="grid h-11 w-11 place-items-center rounded-md bg-slate-100 text-teal-700">
                        @include('partials.icon', ['name' => $pillar['icon']])
                    </span>
                    <h3 class="bih-section-title mt-4 text-2xl">{{ $pillar['title'] }}</h3>
                    <p class="bih-copy mt-3">{{ $pillar['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="roadmap" class="bih-v2030-roadmap bg-slate-950 py-16 text-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-v2030-eyebrow text-sm font-black uppercase text-amber-300">Roadmap</p>
            <h2 class="mt-3 text-4xl font-black leading-tight text-white md:text-5xl">From learning programs to global deployment by 2030</h2>
            <p class="mt-5 leading-8 text-white/82">The roadmap keeps the vision grounded: build the base, expand access, accelerate industry outcomes, and establish Bengal as a global AI talent hub.</p>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($roadmap as $item)
                <article class="bih-v2030-dark-card rounded-md border border-white/12 bg-white/8 p-6 shadow-xl">
                    <p class="text-3xl font-black text-teal-300">{{ $item['phase'] }}</p>
                    <h3 class="mt-4 text-2xl font-black text-white">{{ $item['title'] }}</h3>
                    <p class="mt-3 leading-7 text-white/78">{{ $item['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="focus-areas" class="bih-section bih-v2030-section bg-white">
    <div class="bih-container">
        <div class="grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
            <div class="grid gap-4 sm:grid-cols-2">
                <img class="h-64 w-full rounded-md object-cover shadow-xl sm:h-80" src="{{ $talentImage }}" alt="Students collaborating on technology learning">
                <img class="h-64 w-full rounded-md object-cover shadow-xl sm:mt-12 sm:h-80" src="{{ $startupImage }}" alt="Startup team building technology products">
            </div>
            <div>
                <p class="bih-eyebrow">Focus Areas</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Skills and technologies aligned with the next decade</h2>
                <p class="bih-page-intro mt-5">The program focuses on high-demand technology domains where Bengal's talent can serve startups, enterprises, research teams, and global digital businesses.</p>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($focusAreas as $area)
                <article class="bih-card bih-image-card bih-v2030-image-card group overflow-hidden">
                    <div class="relative h-48 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $area['image'] }}" alt="{{ $area['title'] }} focus area for Vision 2030">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/82 via-slate-950/18 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 grid h-11 w-11 place-items-center rounded-md bg-white text-teal-700 shadow-lg">
                            @include('partials.icon', ['name' => 'chip'])
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="bih-section-title text-xl">{{ $area['title'] }}</h3>
                        <p class="bih-copy mt-3 text-sm">{{ $area['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bih-v2030-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
        <div>
            <p class="bih-eyebrow">Expected Outcomes</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">What Vision 2030 creates for Bengal</h2>
            <p class="bih-page-intro mt-5">The impact is designed to be visible across classrooms, companies, founders, local communities, and global hiring markets.</p>
            <a class="bih-button mt-8" href="{{ route('contact') }}">Partner With Vision 2030</a>
        </div>
        <div class="bih-card bih-v2030-outcome-card p-6">
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($outcomes as $outcome)
                    <div class="bih-v2030-outcome flex items-start gap-3 rounded-md bg-slate-50 p-4">
                        <span class="mt-0.5 grid h-6 w-6 flex-none place-items-center rounded-full bg-teal-700 text-white">
                            @include('partials.icon', ['name' => 'check', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold leading-7 text-slate-800">{{ $outcome }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-v2030-final bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
            <p class="bih-v2030-eyebrow text-sm font-black uppercase text-amber-300">Together by 2030</p>
            <h2 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white md:text-5xl">Bengal can become a place where AI talent is built, trusted, and hired worldwide.</h2>
            <p class="mt-5 max-w-3xl leading-8 text-white/82">Students, colleges, founders, companies, mentors, and partners can all take part in shaping this ecosystem.</p>
        </div>
        <a class="bih-button" href="{{ route('contact') }}">Start a Conversation</a>
    </div>
</section>
@endsection
