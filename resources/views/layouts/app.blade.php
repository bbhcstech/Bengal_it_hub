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
    <link rel="dns-prefetch" href="//images.unsplash.com">
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
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
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"></noscript>
    @vite(['resources/css/app.css', 'resources/js/site.js'])
</head>
<body class="bih-shell min-h-screen">
<a href="#main-content" class="bih-skip-link">Skip to main content</a>
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/94 shadow-sm backdrop-blur">
    <div class="bih-container bih-header-main">
        <div class="bih-header-brand">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="Bengal IT Hub home">
                <img class="bih-site-logo shrink-0" src="{{ $bihLogoUrl }}" alt="Bengal IT Hub logo" width="260" height="80" decoding="async" fetchpriority="high">
            </a>
            <a class="bih-header-call" href="tel:+919230653975" aria-label="Call Bengal IT Hub at +91 92306 53975">
                <svg class="bih-header-call-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6.8 4.5 9.2 4c.5-.1 1 .2 1.2.7l1 2.4c.2.5.1 1-.3 1.3L9.8 9.6c.9 1.9 2.4 3.4 4.4 4.5l1.2-1.4c.3-.4.9-.5 1.3-.3l2.5 1.1c.5.2.8.7.7 1.2l-.4 2.4c-.1.5-.5.9-1 .9C11.4 18.1 5.9 12.6 5.9 5.5c0-.5.4-.9.9-1Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="bih-header-call-text">+91 92306 53975</span>
            </a>
        </div>
        <nav class="bih-header-nav" aria-label="Primary">
            @foreach($siteNav as $label => $item)
                @if(is_array($item))
                    <div class="group relative" data-dropdown>
                        <button type="button" class="bih-header-nav-link" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">{{ $label }}</button>
                        <div class="invisible absolute left-0 top-full w-72 translate-y-2 rounded-md border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100" data-dropdown-panel>
                            @foreach($item as $child => $href)
                                <a class="block rounded px-3 py-2 hover:bg-teal-50 hover:text-teal-800" href="{{ $href }}">{{ $child }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a class="bih-header-nav-link" href="{{ $item }}">{{ $label }}</a>
                @endif
            @endforeach
        </nav>
        <div class="bih-header-actions">
            <a class="bih-button hidden sm:inline-flex" href="{{ route('contact') }}">Get in Touch</a>
            <button data-menu-button class="bih-menu-button" aria-label="Open menu" aria-expanded="false">Menu</button>
        </div>
    </div>
    <nav data-mobile-menu class="bih-container hidden pb-4 xl:hidden" aria-label="Mobile">
        @foreach($siteNav as $label => $item)
            <div class="border-t border-slate-200 py-2">
                @if(is_array($item))
                    <p class="font-extrabold">{{ $label }}</p>
                    <div class="mt-2 grid gap-1 pl-3">
                        @foreach($item as $child => $href)
                            <a class="py-1 text-sm font-semibold text-slate-800" href="{{ $href }}">{{ $child }}</a>
                        @endforeach
                    </div>
                @else
                    <a class="font-extrabold" href="{{ $item }}">{{ $label }}</a>
                @endif
            </div>
        @endforeach
    </nav>
</header>

<main id="main-content" tabindex="-1">
    @yield('content')
</main>

<div class="fixed top-24 left-5 z-40">
    <button data-back-button class="bih-scroll-button" type="button" aria-label="Go back to previous page" title="Go back">&larr;</button>
</div>

<div class="fixed bottom-5 right-5 z-50 grid gap-2">
    <button data-scroll-top class="bih-scroll-button" type="button" aria-label="Scroll to top" title="Scroll to top">&uarr;</button>
    <button data-scroll-bottom class="bih-scroll-button" type="button" aria-label="Scroll to bottom" title="Scroll to bottom">&darr;</button>
</div>

<footer class="bih-footer border-t border-slate-800 bg-slate-950 py-12">
    <div class="bih-container bih-footer-grid">
        <div class="bih-footer-brand">
            <a href="{{ route('home') }}" class="bih-footer-brand-link" aria-label="Bengal IT Hub home">
                <img class="bih-footer-logo" src="{{ $bihLogoUrl }}" alt="Bengal IT Hub logo" width="260" height="96" loading="lazy" decoding="async">
                <div class="bih-footer-wordmark">
                    <div class="text-xl font-black">Bengal IT Hub</div>
                    <div class="text-xs font-extrabold uppercase text-teal-300">{{ $siteBrand['tagline'] ?? config('bengalhub.brand.tagline') }}</div>
                </div>
            </a>
            <p class="mt-3 text-sm text-slate-300">{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
        </div>
        <div>
            <h2 class="font-extrabold">About</h2>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="/">Home</a><a href="/vision-2030">Vision 2030</a><a href="/about-us">About Us</a><a href="/faq">FAQ</a><a href="/contact">Contact</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Solutions</h2>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="/services">Services</a><a href="/products">Products</a><a href="/industries">Industries</a><a href="/tech-innovation">Tech Innovation</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Important Links</h2>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="/blog">Blog</a><a href="/tech-biz">TechBiz</a><a href="/our-clients">Our Clients</a><a href="/our-partners">Partners</a><a href="/awards-recognition">Awards & Recognition</a><a href="/hackfest-2026">HackFest PRAGATI 2026</a><a href="/academic-partnership">Academic Partnership</a><a href="/terms-conditions">Terms & Conditions</a><a href="/privacy-policy">Privacy Policy</a><a href="/sitemap">HTML Sitemap</a><a href="/sitemap.xml">XML Sitemap</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Let's Connect</h2>
            <div class="mt-3 flex flex-wrap gap-2">
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
    <div class="bih-container mt-10 text-sm text-white/70">Copyright 2026 Bengal IT Hub | {{ $siteBrand['company'] ?? config('bengalhub.brand.company') }} All rights reserved.</div>
</footer>
</body>
</html>
