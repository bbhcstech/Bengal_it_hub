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
<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-40" src="{{ $heroImage }}" alt="Bengal IT Hub team discussing IT strategy">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/90 to-teal-950/60"></div>
    <div class="bih-container relative grid min-h-[76vh] gap-10 py-16 lg:grid-cols-[1fr_.9fr] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">About Bengal IT Hub</p>
            <h1 class="mt-4 max-w-4xl text-5xl font-black leading-tight text-white md:text-7xl">Technology that helps businesses move forward</h1>
            <p class="bih-page-intro bih-on-dark mt-6">Bengal IT Hub is a future-focused IT company delivering software, cloud-ready platforms, AI-enabled growth, digital operations, and talent-driven innovation from Bengal.</p>
            <p class="mt-4 max-w-3xl leading-8 text-white/82">We work with startups, institutions, MSMEs, and growing enterprises to turn business ideas into useful digital products, efficient systems, stronger online presence, and practical technology capability.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="{{ route('contact') }}">Start a Project</a>
                <a class="bih-button bih-button-light" href="{{ route('services.index') }}">Explore Services</a>
            </div>
        </div>

        <div class="overflow-hidden rounded-md border border-white/14 bg-white/10 shadow-2xl backdrop-blur">
            <img class="h-80 w-full object-cover sm:h-[31rem]" src="{{ $officeImage }}" alt="Modern IT workspace for Bengal IT Hub">
            <div class="grid gap-3 bg-white p-5 text-slate-950 sm:grid-cols-2">
                @foreach($stats as $stat)
                    <div class="rounded-md bg-slate-50 p-4">
                        <p class="text-3xl font-black text-teal-700">{{ $stat['value'] }}</p>
                        <p class="text-xs font-black uppercase text-slate-500">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">Who We Are</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">An IT partner built for practical business impact</h2>
            <p class="bih-page-intro mt-5">We combine digital engineering, business consulting, product thinking, and AI-first talent development so clients get more than a website or software build. They get a technology partner that understands growth.</p>
            <p class="bih-copy mt-4">Our work spans custom web platforms, SaaS products, cloud systems, AI marketing, business enablement, corporate operations support, education technology programs, and innovation events such as The Bengal HackFest PRAGATI.</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($capabilities as $capability)
                <article class="bih-card p-6">
                    <span class="grid h-12 w-12 place-items-center rounded-md bg-teal-50 text-teal-700">
                        @include('partials.icon', ['name' => $capability['icon']])
                    </span>
                    <h3 class="bih-section-title mt-4 text-2xl">{{ $capability['title'] }}</h3>
                    <p class="bih-copy mt-3">{{ $capability['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container">
        <div class="max-w-4xl">
            <p class="bih-eyebrow">What We Build</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Complete technology services for modern businesses and creators</h2>
            <p class="bih-page-intro mt-5">From software platforms to AI agents, Bengal IT Hub helps clients plan, design, build, market, and improve digital products that are practical, scalable, and ready for real users.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($buildServices as $service)
                <article class="bih-card bih-image-card group overflow-hidden">
                    <div class="relative h-48 overflow-hidden">
                        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $service['image'] }}" alt="{{ $service['title'] }} service by Bengal IT Hub">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/76 via-slate-950/10 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 grid h-11 w-11 place-items-center rounded-md bg-white text-teal-700 shadow-lg">
                            @include('partials.icon', ['name' => $service['icon']])
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="bih-section-title text-xl">{{ $service['title'] }}</h3>
                        <p class="bih-copy mt-3 text-sm">{{ $service['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div class="grid gap-4 sm:grid-cols-2">
            <img class="h-72 w-full rounded-md object-cover shadow-xl sm:h-96" src="{{ $teamImage }}" alt="Technology team collaborating on software development">
            <img class="h-72 w-full rounded-md object-cover shadow-xl sm:mt-12 sm:h-96" src="{{ $strategyImage }}" alt="Business strategy discussion with technology partners">
        </div>
        <div>
            <p class="bih-eyebrow">Our Mission</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Build digital systems, talent, and opportunities from Bengal</h2>
            <p class="bih-page-intro mt-5">Our mission is to help businesses adopt useful technology while creating a stronger bridge between regional talent and global digital opportunity.</p>
            <div class="mt-7 grid gap-4">
                @foreach($values as $value)
                    <article class="rounded-md border border-slate-200 bg-white p-5 shadow-sm">
                        <h3 class="text-xl font-black text-slate-950">{{ $value['title'] }}</h3>
                        <p class="bih-copy mt-2">{{ $value['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Our People</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Roles That Power Bengal IT Hub</h2>
            <p class="bih-page-intro mt-5">Our team is organized around the work our clients and learners actually need — the roles below reflect the real capability behind our services, not just job titles.</p>
        </div>
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($teamRoles as $role)
                <article class="bih-card p-6">
                    <span class="grid h-12 w-12 place-items-center rounded-md bg-teal-50 text-teal-700">
                        @include('partials.icon', ['name' => $role['icon']])
                    </span>
                    <h3 class="mt-4 text-lg font-black leading-snug text-slate-950">{{ $role['title'] }}</h3>
                    <p class="bih-copy mt-3 text-sm">{{ $role['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="text-sm font-black uppercase text-amber-300">How We Work</p>
            <h2 class="mt-3 text-4xl font-black leading-tight text-white md:text-5xl">A clear delivery process from idea to scale</h2>
            <p class="mt-5 leading-8 text-white/82">Every project needs clarity, pace, and ownership. Our process keeps business teams and technical teams aligned from the first conversation to post-launch improvement.</p>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($process as $item)
                <article class="rounded-md border border-white/12 bg-white/8 p-6 shadow-xl">
                    <p class="text-3xl font-black text-teal-300">{{ $item['step'] }}</p>
                    <h3 class="mt-4 text-2xl font-black text-white">{{ $item['title'] }}</h3>
                    <p class="mt-3 leading-7 text-white/78">{{ $item['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.88fr_1.12fr] lg:items-start">
        <div>
            <p class="bih-eyebrow">Why Choose Us</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">A compact team with a broad technology ecosystem</h2>
            <p class="bih-page-intro mt-5">Bengal IT Hub is built for clients who need dependable execution, useful ideas, and a partner who can connect technology, marketing, operations, and talent.</p>
            <a class="bih-button mt-8" href="{{ route('contact') }}">Talk to the Team</a>
        </div>
        <div class="bih-card p-6">
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($whyChoose as $point)
                    <div class="flex items-start gap-3 rounded-md bg-slate-50 p-4">
                        <span class="mt-0.5 grid h-6 w-6 flex-none place-items-center rounded-full bg-teal-700 text-white">
                            @include('partials.icon', ['name' => 'check', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold leading-7 text-slate-800">{{ $point }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-section bg-slate-50">
    <div class="bih-container grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
        <div>
            <p class="bih-eyebrow">Visit Our Office</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Where To Find Bengal IT Hub</h2>
            <p class="bih-page-intro mt-5">{{ $officeAddress }}</p>
            <p class="mt-3 flex items-center gap-2 text-sm font-bold text-slate-600">
                @include('partials.icon', ['name' => 'chat', 'size' => 'h-4 w-4'])
                {{ $officePhone }}
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="{{ $officeMapDirectionsUrl }}" target="_blank" rel="noopener">Get Directions</a>
                <a class="inline-flex min-h-11 items-center justify-center gap-2 rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="{{ $officeWhatsAppShareUrl }}" target="_blank" rel="noopener">
                    Share via WhatsApp
                </a>
            </div>
        </div>
        <div class="overflow-hidden rounded-md border border-slate-200 shadow-xl">
            <iframe class="h-80 w-full sm:h-96" src="{{ $officeMapEmbedUrl }}" title="Bengal IT Hub office location on Google Maps" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<section class="bih-section">
    <div class="bih-container">
        <div class="grid gap-8 lg:grid-cols-[.8fr_1.2fr] lg:items-center">
            <div>
                <p class="bih-eyebrow">Ecosystem</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Built with partners, mentors, institutions, and industry</h2>
                <p class="bih-page-intro mt-5">Our ecosystem approach helps us serve both businesses and talent. That means more practical learning, better execution support, stronger hiring connections, and more opportunities for Bengal's technology community.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                @foreach($partners->isNotEmpty() ? $partners : collect(['Industry Experts', 'Academic Partners', 'Innovation Partners', 'Hiring Partners', 'Technology Partners', 'Community Partners']) as $partner)
                    <div class="rounded-md border border-slate-200 bg-white p-5 text-center font-extrabold shadow-sm">
                        {{ is_string($partner) ? $partner : $partner->name }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bih-section bg-white">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">Explore More</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Every Side of Bengal IT Hub</h2>
            <p class="bih-page-intro mt-5">Dive deeper into what we build, who we build it for, and who we build it with.</p>
        </div>
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($exploreSections as $item)
                <article class="group relative flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-teal-600/50 hover:shadow-xl">
                    <span class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-teal-600 via-sky-500 to-amber-400"></span>
                    <span class="grid h-12 w-12 place-items-center rounded-md bg-teal-700 text-white">
                        @include('partials.icon', ['name' => $item['icon']])
                    </span>
                    <p class="bih-eyebrow mt-4">{{ $item['eyebrow'] }}</p>
                    <h3 class="mt-1 text-lg font-black leading-snug text-slate-950">{{ $item['title'] }}</h3>
                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">{{ $item['body'] }}</p>
                    <a class="bih-button mt-5 inline-flex w-fit" href="{{ $item['href'] }}">{{ $item['cta'] }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white">
    <div class="bih-container grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">Let's Build</p>
            <h2 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white md:text-5xl">Have an idea, business challenge, or digital growth target?</h2>
            <p class="mt-5 max-w-3xl leading-8 text-white/82">Bengal IT Hub can help you plan, design, build, launch, and improve the technology behind it.</p>
        </div>
        <a class="bih-button" href="{{ route('contact') }}">Start a Conversation</a>
    </div>
</section>
@endsection
