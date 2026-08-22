@php
    /**
     * Canonical/og:url must be self-referential per unique URL (e.g. each
     * /tech-innovation?page=N or ?category=... is genuinely different
     * content), but tracking parameters that don't change content must be
     * stripped so they don't create duplicate canonical targets.
     */
    $bihTrackingParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid', 'msclkid', 'mc_cid', 'mc_eid', 'ref'];
    $bihCanonicalQuery = collect(request()->query())->except($bihTrackingParams)->sortKeys();
    $bihSeoRootUrl = rtrim((string) (app()->environment('local') ? config('app.url') : config('bengalhub.public_url')), '/');
    $bihCanonicalPath = request()->path() === '/' ? '' : '/'.ltrim(request()->path(), '/');
    $bihCanonicalUrl = $bihCanonicalQuery->isEmpty()
        ? $bihSeoRootUrl.$bihCanonicalPath
        : $bihSeoRootUrl.$bihCanonicalPath.'?'.http_build_query($bihCanonicalQuery->all());
    /**
     * Cache-busted so a browser that ever cached a broken/old response for
     * this exact static asset URL can't keep serving it forever — the
     * query string changes automatically whenever the file on disk changes.
     */
    $bihLogoUrl = asset('logo_bengal_it_hub.svg').'?v='.(is_file(public_path('logo_bengal_it_hub.svg')) ? filemtime(public_path('logo_bengal_it_hub.svg')) : 1);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo['title'] ?? 'Bengal IT Hub' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Bengal IT Hub corporate website and HackFest platform.' }}">
    <link rel="canonical" href="{{ $bihCanonicalUrl }}">
    <meta name="robots" content="{{ $seo['robots'] ?? config('bengalhub.seo.robots') }}">
    {{-- Meta keywords carries no ranking weight per Google Search Essentials
         and is intentionally not rendered; target keywords are tracked
         internally per section in SEO_PROGRESS.md instead. --}}

    <meta property="og:site_name" content="Bengal IT Hub">
    <meta property="og:locale" content="en_IN">
    <meta property="og:title" content="{{ $seo['title'] ?? 'Bengal IT Hub' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? 'Bengal IT Hub corporate website and HackFest platform.' }}">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $bihCanonicalUrl }}">
    <meta property="og:image" content="{{ $seo['image'] ?? $bihLogoUrl }}">
    <meta property="og:image:alt" content="{{ $seo['title'] ?? 'Bengal IT Hub' }}">
    @if(($seo['type'] ?? 'website') === 'article')
        @if(!empty($seo['publishedTime']))
            <meta property="article:published_time" content="{{ $seo['publishedTime'] }}">
        @endif
        @if(!empty($seo['author']))
            <meta property="article:author" content="{{ $seo['author'] }}">
        @endif
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@bengalithub">
    <meta name="twitter:creator" content="@bengalithub">
    <meta name="twitter:title" content="{{ $seo['title'] ?? 'Bengal IT Hub' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? 'Bengal IT Hub corporate website and HackFest platform.' }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? $bihLogoUrl }}">
    <meta name="twitter:image:alt" content="{{ $seo['title'] ?? 'Bengal IT Hub' }}">
    @if(!empty($seoSettings['google_search_console']))
        <meta name="google-site-verification" content="{{ $seoSettings['google_search_console'] }}">
    @endif
    <link rel="icon" type="image/svg+xml" href="{{ $bihLogoUrl }}">
    <link rel="shortcut icon" type="image/svg+xml" href="{{ $bihLogoUrl }}">
    <link rel="apple-touch-icon" href="{{ $bihLogoUrl }}">
    @php
        /**
         * One @graph bundles the site's standing entities (who we are, what
         * the site is, what this specific page is) instead of three
         * competing top-level nodes. @id references link them together so
         * Google resolves them as one connected entity graph, not three
         * unrelated ones.
         */
        $bihOrgId = $bihSeoRootUrl.'/#organization';
        $bihWebsiteId = $bihSeoRootUrl.'/#website';
        $bihWebpageId = $bihCanonicalUrl.'#webpage';
        /**
         * knowsAbout is built from the real service and product catalog
         * (not a hand-picked marketing list) so it can never drift out of
         * sync with what the site actually offers.
         */
        $bihKnowsAbout = collect(config('bengalhub.services', []))->pluck('title')
            ->merge(collect(config('bengalhub.products.items', []))->pluck('title'))
            ->unique()->values()->all();
        $bihPreloadImage = $seo['preloadImage'] ?? $seo['image'] ?? null;
        $bihShouldPreloadImage = $bihPreloadImage && ! Str::contains($bihPreloadImage, 'logo_bengal_it_hub.svg');
    @endphp
    @if($bihShouldPreloadImage)
        <link rel="preload" as="image" href="{{ $bihPreloadImage }}" fetchpriority="high">
    @endif
    <link rel="prefetch" href="{{ route('contact') }}" as="document">
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => ['Organization', 'LocalBusiness'],
                    '@id' => $bihOrgId,
                    'name' => 'Bengal IT Hub',
                    'legalName' => $siteBrand['company'] ?? config('bengalhub.brand.company'),
                    'description' => 'Bengal IT Hub is a Kolkata-based technology company delivering software, cloud, and AI-enabled services — including staff augmentation, AI marketing, business consultation and enablement, and corporate operations outsourcing — and organizes The Bengal HackFest PRAGATI, an AI hackathon held at Jadavpur University, Kolkata.',
                    'slogan' => $siteBrand['tagline'] ?? config('bengalhub.brand.tagline'),
                    'url' => $bihSeoRootUrl,
                    'logo' => ['@type' => 'ImageObject', 'url' => $bihLogoUrl],
                    'image' => $bihLogoUrl,
                    'telephone' => $siteBrand['phone'] ?? config('bengalhub.brand.phone'),
                    'email' => config('bengalhub.brand.email'),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => '3rd Floor, Satavisha Bldg, 11 Hospital Link Road, Eastern Park, Santoshpur',
                        'addressLocality' => 'Kolkata',
                        'addressRegion' => 'West Bengal',
                        'postalCode' => '700075',
                        'addressCountry' => 'IN',
                    ],
                    'areaServed' => [
                        ['@type' => 'City', 'name' => 'Kolkata'],
                        ['@type' => 'Country', 'name' => 'India'],
                    ],
                    'knowsAbout' => $bihKnowsAbout,
                    'sameAs' => array_values($siteBrand['socials'] ?? config('bengalhub.brand.socials')),
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => $bihWebsiteId,
                    'url' => $bihSeoRootUrl,
                    'name' => 'Bengal IT Hub',
                    'inLanguage' => 'en-IN',
                    'publisher' => ['@id' => $bihOrgId],
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => [
                            '@type' => 'EntryPoint',
                            'urlTemplate' => $bihSeoRootUrl.'/tech-innovation?q={search_term_string}',
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $bihWebpageId,
                    'url' => $bihCanonicalUrl,
                    'name' => $seo['title'] ?? 'Bengal IT Hub',
                    'description' => $seo['description'] ?? null,
                    'inLanguage' => 'en-IN',
                    'isPartOf' => ['@id' => $bihWebsiteId],
                    'about' => ['@id' => $bihOrgId],
                    'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $seo['image'] ?? $bihLogoUrl],
                    'speakable' => [
                        '@type' => 'SpeakableSpecification',
                        'cssSelector' => ['.bih-page-title', '.bih-page-intro'],
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @stack('schema')
    @if(!empty($seoSettings['google_analytics_id']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSettings['google_analytics_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seoSettings['google_analytics_id'] }}');
        </script>
    @endif
    <script>
        (function() {
            const stored = localStorage.getItem('bith-theme');
            if (stored === 'dark' || (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/site.js'])
</head>
<body class="bih-shell min-h-screen">
<a href="#main-content" class="bih-skip-link">Skip to main content</a>
<header class="bih-header-sticky sticky top-0 z-50 backdrop-blur-md relative transition-colors duration-300 shadow-md">
    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#d4af37]/70 to-transparent pointer-events-none"></div>
    <div class="bih-container bih-header-main">
        @php
            $bihServiceMegaMenu = [
                'Learn & Grow' => [
                    ['label' => 'Tech Ed/Fest', 'href' => '/tech-ed-fest', 'icon' => 'zap'],
                    ['label' => 'Educamp', 'href' => '/educamp', 'icon' => 'book'],
                    ['label' => 'Eduverse', 'href' => '/eduverse-2', 'icon' => 'layers'],
                    ['label' => 'Groomify', 'href' => '/groomify', 'icon' => 'admin'],
                ],
                'Grow The Business' => [
                    ['label' => 'AI-Marketing', 'href' => '/ai-marketing', 'icon' => 'trending'],
                    ['label' => 'Biz-Consultation', 'href' => '/biz-consultation', 'icon' => 'compass'],
                    ['label' => 'Biz-Enablement', 'href' => '/biz-enablement', 'icon' => 'leaf'],
                    ['label' => 'E-Collab', 'href' => '/e-collab-2', 'icon' => 'users'],
                ],
                'Operate & Scale' => [
                    ['label' => 'Staff Augmentation', 'href' => '/staff-augmentation', 'icon' => 'admin'],
                    ['label' => 'Corporate Ops Outsourcing', 'href' => '/corporate-operations-outsourcing', 'icon' => 'briefcase'],
                ],
            ];
            $bihIndustriesMegaMenu = [
                'Property & Health' => [
                    ['label' => 'Real Estate', 'href' => '/industries/real-estate', 'icon' => 'briefcase'],
                    ['label' => 'Health Care', 'href' => '/industries/health-care', 'icon' => 'flask'],
                ],
                'Learning & Industry' => [
                    ['label' => 'Edu Tech', 'href' => '/industries/edu-tech', 'icon' => 'graduation'],
                    ['label' => 'Manufacturing', 'href' => '/industries/manufacturing', 'icon' => 'chip'],
                ],
                'Movement & Trade' => [
                    ['label' => 'Logistics', 'href' => '/industries/logistics', 'icon' => 'adapt'],
                    ['label' => 'Travel & Hospitality', 'href' => '/industries/travel-hospitality', 'icon' => 'globe'],
                ],
            ];
            $bihInsightsMegaMenu = [
                'Updates' => [
                    ['label' => 'Blog', 'href' => '/blog', 'icon' => 'chat'],
                ],
                'Proof' => [
                    ['label' => 'Awards & Recognition', 'href' => '/awards-recognition', 'icon' => 'trophy'],
                    ['label' => 'Our Partners', 'href' => '/our-partners', 'icon' => 'partners'],
                ],
                'Company' => [
                    ['label' => 'FAQ', 'href' => '/faq', 'icon' => 'check'],
                    ['label' => 'Contact', 'href' => '/contact', 'icon' => 'chat'],
                ],
            ];
            $bihDropdownIcons = [
                'Vision 2030' => 'target',
                'About Us' => 'leadership',
                'Software Development' => 'chip',
                'Web Development' => 'globe',
                'App Development' => 'layers',
                'IoT Product Build' => 'target',
                'TechBiz' => 'chat',
                'Tech Innovation Hub' => 'chip',
                'Our Clients' => 'partners',
                'Blog' => 'chat',
                'Awards & Recognition' => 'trophy',
                'Our Partners' => 'partners',
                'FAQ' => 'check',
                'Contact' => 'chat',
                'HackFest 2026' => 'rocket',
            ];
        @endphp
        <div class="bih-header-brand">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="Bengal IT Hub home" style="height: 68px;">
                <img class="shrink-0 object-contain" src="{{ asset('assets/images/logo-square.jpg') }}" alt="Bengal IT Hub logo" style="height: 60px; max-height: 62px; width: auto; max-width: 240px; border-radius: 12px; box-shadow: 0 4px 14px rgba(0,0,0,0.12); transition: transform 0.2s ease;" height="60" decoding="async" fetchpriority="high">
            </a>
        </div>
        <nav class="bih-header-nav" aria-label="Primary">
            @foreach($siteNav as $label => $item)
                @if(is_array($item))
                    <div class="group relative" data-dropdown>
                        <button type="button" class="bih-header-nav-link flex items-center gap-1" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">
                            <span>{{ $label }}</span>
                            <svg class="h-3.5 w-3.5 transition-transform group-hover:rotate-180 opacity-70" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        @if($label === 'Services')
                            <div class="bih-services-mega invisible fixed left-1/2 top-[76px] z-[60] w-[min(860px,calc(100vw-48px))] -translate-x-1/2 translate-y-2 rounded-[1.35rem] border border-[#21454f] bg-[#123941] p-7 opacity-0 shadow-2xl shadow-black/45 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <div class="grid gap-7 lg:grid-cols-3">
                                    @foreach($bihServiceMegaMenu as $group => $services)
                                        <div>
                                            <p class="bih-services-mega-heading mb-5 flex items-center gap-3 text-xs font-black uppercase tracking-[0.18em] text-[#f2aa36]">
                                                <span class="h-px w-5 bg-[#f2aa36]"></span>
                                                <span>{{ $group }}</span>
                                            </p>
                                            <div class="grid gap-3">
                                                @foreach($services as $service)
                                                    <a class="bih-services-mega-link group/item flex items-center gap-3 rounded-xl px-2 py-2 text-[0.98rem] font-black text-slate-100 transition-colors hover:text-[#f5c978]" href="{{ $service['href'] }}">
                                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#164650] text-[#f5c342] transition-colors group-hover/item:bg-[#1d5661]">
                                                            @include('partials.icon', ['name' => $service['icon'], 'size' => 'h-5 w-5'])
                                                        </span>
                                                        <span>{{ $service['label'] }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 flex items-center justify-between gap-5 border-t border-[#2a5660] pt-5">
                                    <p class="font-serif text-base font-black italic text-slate-100">Not sure where to start? <a class="text-[#f5c978] hover:text-white" href="{{ route('contact') }}">Talk to the team &rarr;</a></p>
                                    <a class="inline-flex min-h-11 items-center justify-center rounded-full border border-[#2a5660] px-7 text-sm font-black text-slate-100 transition hover:border-[#f5c978] hover:text-[#f5c978]" href="/services">All Services</a>
                                </div>
                            </div>
                        @elseif($label === 'Products')
                            <div class="bih-products-mega invisible fixed left-1/2 top-[76px] z-[60] w-[min(540px,calc(100vw-48px))] -translate-x-1/2 translate-y-2 rounded-[1.35rem] border border-[#21454f] bg-[#123941] p-7 opacity-0 shadow-2xl shadow-black/45 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <p class="bih-products-mega-heading mb-5 flex items-center gap-3 text-xs font-black uppercase tracking-[0.18em] text-[#f2aa36]">
                                    <span class="h-px w-5 bg-[#f2aa36]"></span>
                                    <span>Product Suite</span>
                                </p>
                                <div class="grid gap-3 sm:grid-cols-2">
                                    @foreach($item as $child => $href)
                                        <a class="bih-products-mega-link flex items-center gap-3 rounded-xl px-2 py-2 text-[0.98rem] font-black text-slate-100 transition-colors hover:text-[#f5c978]" href="{{ $href }}">
                                            <span class="bih-mega-icon">
                                                @include('partials.icon', ['name' => $bihDropdownIcons[$child] ?? 'target', 'size' => 'h-4 w-4'])
                                            </span>
                                            <span>{{ $child }}</span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="mt-6 flex items-center justify-end border-t border-[#2a5660] pt-5">
                                    <a class="bih-products-mega-all inline-flex min-h-11 items-center justify-center rounded-full border border-[#2a5660] px-7 text-sm font-black text-slate-100 transition hover:border-[#f5c978] hover:text-[#f5c978]" href="/products">All Products</a>
                                </div>
                            </div>
                        @elseif($label === 'Tech Talk')
                            <div class="bih-tech-talk-mega invisible fixed left-1/2 top-[76px] z-[60] w-[min(500px,calc(100vw-48px))] -translate-x-1/2 translate-y-2 rounded-[1.35rem] border border-[#21454f] bg-[#123941] p-7 opacity-0 shadow-2xl shadow-black/45 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <p class="bih-tech-talk-mega-heading mb-5 flex items-center gap-3 text-xs font-black uppercase tracking-[0.18em] text-[#f2aa36]">
                                    <span class="h-px w-5 bg-[#f2aa36]"></span>
                                    <span>Tech Talk</span>
                                </p>
                                <div class="grid gap-3">
                                    @foreach($item as $child => $href)
                                        <a class="bih-tech-talk-mega-link flex items-center gap-3 rounded-xl px-2 py-2 text-[0.98rem] font-black text-slate-100 transition-colors hover:text-[#f5c978]" href="{{ $href }}">
                                            <span class="bih-mega-icon">
                                                @include('partials.icon', ['name' => $bihDropdownIcons[$child] ?? 'target', 'size' => 'h-4 w-4'])
                                            </span>
                                            <span>{{ $child }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($label === 'Industries')
                            <div class="bih-industries-mega invisible fixed left-1/2 top-[76px] z-[60] w-[min(760px,calc(100vw-48px))] -translate-x-1/2 translate-y-2 rounded-[1.35rem] border border-[#21454f] bg-[#123941] p-7 opacity-0 shadow-2xl shadow-black/45 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <div class="grid gap-7 lg:grid-cols-3">
                                    @foreach($bihIndustriesMegaMenu as $group => $industries)
                                        <div>
                                            <p class="bih-industries-mega-heading mb-5 flex items-center gap-3 text-xs font-black uppercase tracking-[0.18em] text-[#f2aa36]">
                                                <span class="h-px w-5 bg-[#f2aa36]"></span>
                                                <span>{{ $group }}</span>
                                            </p>
                                            <div class="grid gap-3">
                                                @foreach($industries as $industry)
                                                    <a class="bih-industries-mega-link flex items-center gap-3 rounded-xl px-2 py-2 text-[0.98rem] font-black text-slate-100 transition-colors hover:text-[#f5c978]" href="{{ $industry['href'] }}">
                                                        <span class="bih-mega-icon">
                                                            @include('partials.icon', ['name' => $industry['icon'], 'size' => 'h-4 w-4'])
                                                        </span>
                                                        <span>{{ $industry['label'] }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 flex items-center justify-between gap-5 border-t border-[#2a5660] pt-5">
                                    <p class="font-serif text-base font-black italic text-slate-100">Don't see your sector? <a class="text-[#f5c978] hover:text-white" href="{{ route('contact') }}">Tell us about it &rarr;</a></p>
                                    <a class="inline-flex min-h-11 items-center justify-center rounded-full border border-[#2a5660] px-7 text-sm font-black text-slate-100 transition hover:border-[#f5c978] hover:text-[#f5c978]" href="/industries">All Industries</a>
                                </div>
                            </div>
                        @elseif($label === 'Insights')
                            <div class="bih-insights-mega invisible fixed left-1/2 top-[76px] z-[60] w-[min(640px,calc(100vw-48px))] -translate-x-1/2 translate-y-2 rounded-[1.35rem] border border-[#21454f] bg-[#123941] p-7 opacity-0 shadow-2xl shadow-black/45 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <div class="grid gap-6 lg:grid-cols-3">
                                    @foreach($bihInsightsMegaMenu as $group => $links)
                                        <div>
                                            <p class="bih-insights-mega-heading mb-5 flex items-center gap-3 text-xs font-black uppercase tracking-[0.18em] text-[#f2aa36]">
                                                <span class="h-px w-5 bg-[#f2aa36]"></span>
                                                <span>{{ $group }}</span>
                                            </p>
                                            <div class="grid gap-3">
                                                @foreach($links as $link)
                                                    <a class="bih-insights-mega-link flex items-center gap-3 rounded-xl px-2 py-2 text-[0.98rem] font-black text-slate-100 transition-colors hover:text-[#f5c978]" href="{{ $link['href'] }}">
                                                        <span class="bih-mega-icon">
                                                            @include('partials.icon', ['name' => $link['icon'], 'size' => 'h-4 w-4'])
                                                        </span>
                                                        <span>{{ $link['label'] }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="invisible absolute left-0 top-full min-w-60 translate-y-2 rounded-2xl border border-slate-200/80 dark:border-[#d4af37]/35 bg-white dark:bg-[#0b1b2b] p-3 opacity-0 shadow-2xl shadow-slate-900/15 dark:shadow-black/85 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                                <div class="flex flex-col gap-1">
                                    @foreach($item as $child => $href)
                                        <a class="bih-compact-dropdown-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-[0.95rem] font-bold text-slate-800 dark:text-slate-100 hover:bg-teal-50 dark:hover:bg-[#15283a] hover:text-teal-800 dark:hover:text-[#f3e5ab] transition-colors" href="{{ $href }}">
                                            <span class="bih-dropdown-icon">
                                                @include('partials.icon', ['name' => $bihDropdownIcons[$child] ?? 'target', 'size' => 'h-4 w-4'])
                                            </span>
                                            <span>{{ $child }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <a class="bih-header-nav-link" href="{{ $item }}">{{ $label }}</a>
                @endif
            @endforeach
        </nav>
        <div class="bih-header-actions">
            <button type="button" class="theme-toggle" data-theme-toggle aria-label="Toggle dark mode" aria-pressed="false" title="Toggle theme">
                <span class="knob">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/>
                        <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>
                    </svg>
                </span>
            </button>
            <a class="bih-header-cta hidden sm:inline-flex" href="{{ route('contact') }}">Get in Touch</a>
            <a class="bih-admin-nav-link" href="{{ route('admin.login') }}" aria-label="Admin login" title="Admin login">
                @include('partials.icon', ['name' => 'admin', 'size' => 'h-5 w-5'])
            </a>
            <button data-menu-button class="bih-menu-button" aria-label="Open menu" aria-expanded="false">Menu</button>
        </div>
    </div>
    <nav data-mobile-menu class="bih-container hidden pb-5 xl:hidden border-t border-slate-200 dark:border-[#d4af37]/20 bg-white dark:bg-[#0b1724]" aria-label="Mobile">
        @foreach($siteNav as $label => $item)
            <div class="border-t border-slate-200 dark:border-[#d4af37]/15 py-3">
                @if(is_array($item))
                    <p class="font-extrabold text-teal-800 dark:text-[#f3e5ab] text-sm tracking-wide uppercase px-2">{{ $label }}</p>
                    <div class="mt-2 grid gap-1.5 pl-3">
                        @foreach($item as $child => $href)
                            <a class="py-1.5 px-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-teal-700 dark:hover:text-[#f3e5ab] transition-colors" href="{{ $href }}">{{ $child }}</a>
                        @endforeach
                    </div>
                @else
                    <a class="px-2 font-extrabold text-slate-800 dark:text-slate-100 hover:text-teal-700 dark:hover:text-[#f3e5ab] transition-colors block text-base" href="{{ $item }}">{{ $label }}</a>
                @endif
            </div>
        @endforeach
        <div class="border-t border-slate-200 dark:border-[#d4af37]/20 pt-3 pb-1 flex items-center justify-between">
            <a class="inline-flex items-center gap-2 font-extrabold text-teal-800 dark:text-[#f3e5ab] hover:text-teal-900 dark:hover:text-white px-2 py-1 transition-colors" href="{{ route('admin.login') }}">
                @include('partials.icon', ['name' => 'admin', 'size' => 'h-5 w-5'])
                <span>Admin Login</span>
            </a>
            <a class="inline-flex items-center gap-2 text-sm font-bold text-slate-700 dark:text-slate-300 px-2" href="tel:+919230653975">
                <span>+91 92306 53975</span>
            </a>
        </div>
    </nav>
</header>

<main id="main-content" tabindex="-1">
    @yield('content')
</main>

<div class="fixed left-5 z-40" style="position: fixed; top: 165px; left: 20px; z-index: 9999;">
    <button data-back-button class="bih-scroll-button" type="button" aria-label="Go back to previous page" title="Go back">&larr;</button>
</div>

<div class="fixed bottom-5 right-5 z-50 grid gap-2">
    <button data-scroll-top class="bih-scroll-button" type="button" aria-label="Scroll to top" title="Scroll to top">&uarr;</button>
    <button data-scroll-bottom class="bih-scroll-button" type="button" aria-label="Scroll to bottom" title="Scroll to bottom">&darr;</button>
</div>

<footer class="bih-footer border-t border-slate-800 bg-slate-950 py-14" style="background-color: #050b14; color: #cbd5e1;">
    <div class="bih-container bih-footer-grid">
        {{-- Brand Column --}}
        <div class="bih-footer-brand">
            <a href="{{ route('home') }}" class="bih-footer-brand-link flex items-center gap-3" aria-label="Bengal IT Hub home">
                <img class="bih-footer-logo" src="{{ asset('assets/images/logo-square.jpg') }}" alt="Bengal IT Hub logo" style="height: 52px; width: auto; max-width: 180px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); object-fit: contain;" height="52" loading="lazy" decoding="async">
                <div class="bih-footer-wordmark">
                    <div class="text-xl font-black text-white" style="font-family: 'Outfit', sans-serif;">Bengal IT Hub</div>
                    <div class="text-xs font-extrabold uppercase text-amber-400" style="letter-spacing: 0.05em;">{{ $siteBrand['tagline'] ?? config('bengalhub.brand.tagline') }}</div>
                </div>
            </a>
            <p class="mt-4 text-xs text-slate-400" style="line-height: 1.6;">{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
            <div class="mt-4">
                <h3 class="text-xs font-bold uppercase text-slate-400" style="letter-spacing: 0.08em; margin-bottom: 8px;">Let's Connect</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(($siteBrand['socials'] ?? config('bengalhub.brand.socials')) as $label => $href)
                        <a class="bih-social-icon" href="{{ $href }}" target="_blank" rel="noopener" aria-label="{{ $label }}" title="{{ $label }}">
                            @switch($label)
                                @case('LinkedIn')
                                    <span aria-hidden="true">in</span>
                                    @break
                                @case('Facebook')
                                    <span aria-hidden="true">f</span>
                                    @break
                                @case('Instagram')
                                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                        <rect x="5" y="5" width="14" height="14" rx="4" stroke="currentColor" stroke-width="2"></rect>
                                        <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="2"></circle>
                                        <circle cx="16.5" cy="7.5" r="1" fill="currentColor"></circle>
                                    </svg>
                                    @break
                                @case('X')
                                    <span aria-hidden="true">X</span>
                                    @break
                                @case('YouTube')
                                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                        <rect x="3.5" y="6.5" width="17" height="11" rx="3" stroke="currentColor" stroke-width="2"></rect>
                                        <path d="M10 9.5L15 12L10 14.5V9.5Z" fill="currentColor"></path>
                                    </svg>
                                    @break
                                @default
                                    <span aria-hidden="true">{{ Str::substr($label, 0, 1) }}</span>
                            @endswitch
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Column 1: Company & Ecosystem --}}
        <div>
            <h2 class="font-extrabold text-white text-sm uppercase tracking-wider mb-3">Company</h2>
            <div class="grid gap-2 text-xs" style="color: #94a3b8;">
                <a href="/" class="hover:text-amber-400 transition-colors">Home</a>
                <a href="/vision-2030" class="hover:text-amber-400 transition-colors">Vision 2030</a>
                <a href="/about-us" class="hover:text-amber-400 transition-colors">About Us</a>
                <a href="/tech-biz" class="hover:text-amber-400 transition-colors">TechBiz Newsroom</a>
                <a href="/tech-innovation" class="hover:text-amber-400 transition-colors">Tech Innovation Hub</a>
                <a href="/our-clients" class="hover:text-amber-400 transition-colors">Our Clients</a>
                <a href="/our-partners" class="hover:text-amber-400 transition-colors">Our Partners</a>
                <a href="/awards-recognition" class="hover:text-amber-400 transition-colors">Awards & Recognition</a>
                <a href="/faq" class="hover:text-amber-400 transition-colors">FAQ</a>
                <a href="/contact" class="hover:text-amber-400 transition-colors">Contact Us</a>
            </div>
        </div>

        {{-- Column 2: Services & Solutions --}}
        <div>
            <h2 class="font-extrabold text-white text-sm uppercase tracking-wider mb-3">Services</h2>
            <div class="grid gap-2 text-xs" style="color: #94a3b8;">
                <a href="/services" class="font-bold text-amber-400 hover:underline">All Services &rarr;</a>
                <a href="/software-development" class="hover:text-amber-400 transition-colors">Software Development</a>
                <a href="/web-development" class="hover:text-amber-400 transition-colors">Web Development</a>
                <a href="/app-development" class="hover:text-amber-400 transition-colors">App Development</a>
                <a href="/iot-product-build" class="hover:text-amber-400 transition-colors">IoT Product Build</a>
                <a href="/ai-marketing" class="hover:text-amber-400 transition-colors">AI Marketing</a>
                <a href="/groomify" class="hover:text-amber-400 transition-colors">Groomify Skilling</a>
                <a href="/eduverse" class="hover:text-amber-400 transition-colors">Eduverse Ecosystem</a>
                <a href="/biz-consultation" class="hover:text-amber-400 transition-colors">Biz Consultation</a>
            </div>
        </div>

        {{-- Column 3: Industries & Products --}}
        <div>
            <h2 class="font-extrabold text-white text-sm uppercase tracking-wider mb-3">Industries</h2>
            <div class="grid gap-2 text-xs" style="color: #94a3b8;">
                <a href="/industries" class="font-bold text-amber-400 hover:underline">All Industries &rarr;</a>
                <a href="/industries/real-estate" class="hover:text-amber-400 transition-colors">Real Estate</a>
                <a href="/industries/health-care" class="hover:text-amber-400 transition-colors">Health Care</a>
                <a href="/industries/edu-tech" class="hover:text-amber-400 transition-colors">EdTech</a>
                <a href="/industries/manufacturing" class="hover:text-amber-400 transition-colors">Manufacturing</a>
                <a href="/industries/logistics" class="hover:text-amber-400 transition-colors">Logistics</a>
                <a href="/industries/travel-hospitality" class="hover:text-amber-400 transition-colors">Travel & Hospitality</a>
                <a href="/industries/retail" class="hover:text-amber-400 transition-colors">Retail</a>
                <a href="/products" class="font-bold text-amber-400 hover:underline mt-1">Our Products &rarr;</a>
            </div>
        </div>

        {{-- Column 4: Events, SEO & Legal --}}
        <div>
            <h2 class="font-extrabold text-white text-sm uppercase tracking-wider mb-3">Events & SEO</h2>
            <div class="grid gap-2 text-xs" style="color: #94a3b8;">
                <a href="/hackfest-2026" class="hover:text-amber-400 transition-colors font-semibold text-white">HackFest 2026</a>
                <a href="/academic-partnership" class="hover:text-amber-400 transition-colors">Academic Partnership</a>
                <a href="/blog" class="hover:text-amber-400 transition-colors">Blog Insights</a>
                <a href="{{ route('sitemap.html') }}" class="hover:text-amber-400 transition-colors">HTML Sitemap</a>
                <a href="{{ route('sitemap') }}" target="_blank" class="hover:text-amber-400 transition-colors font-medium text-teal-300">XML Sitemap (SEO)</a>
                <a href="{{ route('robots') }}" target="_blank" class="hover:text-amber-400 transition-colors">Robots.txt</a>
                <a href="/terms-conditions" class="hover:text-amber-400 transition-colors mt-1">Terms & Conditions</a>
                <a href="/privacy-policy" class="hover:text-amber-400 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </div>
    <div class="bih-container mt-12 pt-6 border-t border-slate-800/80 flex flex-wrap justify-between items-center text-xs text-slate-400">
        <div>Copyright &copy; 2026 Bengal IT Hub | {{ $siteBrand['company'] ?? config('bengalhub.brand.company') }} All rights reserved.</div>
        <div class="flex gap-4 mt-2 sm:mt-0">
            <a href="/privacy-policy" class="hover:text-amber-400 transition-colors">Privacy</a>
            <a href="/terms-conditions" class="hover:text-amber-400 transition-colors">Terms</a>
            <a href="{{ route('sitemap.html') }}" class="hover:text-amber-400 transition-colors">Sitemap</a>
        </div>
    </div>
</footer>

<script>
    // Universal Frontend AJAX Form Interceptor & Automatic Fresh Refresh System
    (function () {
        if (!document.getElementById('bih-spin-style-fe')) {
            var style = document.createElement('style');
            style.id = 'bih-spin-style-fe';
            style.innerHTML = '@keyframes bihSpinFE { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
            document.head.appendChild(style);
        }

        document.addEventListener('submit', function (e) {
            var form = e.target;

            // Bypass AJAX if explicitly disabled or CSV/sitemap export
            if (form.getAttribute('data-ajax') === 'false' || form.action.includes('/export') || form.action.includes('/sitemap')) {
                return;
            }

            e.preventDefault();

            var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.75';
                submitBtn.innerHTML = '<span style="display:inline-flex;align-items:center;gap:6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="animation:bihSpinFE 0.75s linear infinite;"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg> Submitting...</span>';
            }

            var formData = new FormData(form);
            var fetchUrl = form.action || window.location.href;
            var fetchMethod = (form.method || 'POST').toUpperCase();

            fetch(fetchUrl, {
                method: fetchMethod,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token') || ''
                }
            })
            .then(function (response) {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    // Smooth reload page so fresh success state and data render cleanly without old state
                    window.location.reload();
                }
            })
            .catch(function () {
                window.location.reload();
            });
        });
    })();
</script>
</body>
</html>
