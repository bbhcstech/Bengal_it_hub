<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] ?? 'Bengal IT Hub' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Bengal IT Hub corporate website and HackFest platform.' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo['title'] ?? 'Bengal IT Hub' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? 'Bengal IT Hub corporate website and HackFest platform.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $seo['image'] ?? asset('logo_bengal_it_hub.svg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ $seo['image'] ?? asset('logo_bengal_it_hub.svg') }}">
    <meta name="robots" content="{{ $seo['robots'] ?? config('bengalhub.seo.robots') }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? config('bengalhub.seo.keywords') }}">
    @if(!empty($seoSettings['google_search_console']))
        <meta name="google-site-verification" content="{{ $seoSettings['google_search_console'] }}">
    @endif
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    <link rel="shortcut icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo_bengal_it_hub.svg') }}">
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Bengal IT Hub',
            'url' => url('/'),
            'telephone' => $siteBrand['phone'] ?? config('bengalhub.brand.phone'),
            'address' => $siteBrand['address'] ?? config('bengalhub.brand.address'),
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bih-shell min-h-screen">
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/94 shadow-sm backdrop-blur">
    <div class="bih-container flex min-h-20 items-center justify-between gap-3">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="Bengal IT Hub home">
            <img class="h-20 w-auto max-w-[220px] shrink-0 object-contain sm:max-w-[260px]" src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub logo">
        </a>
        <nav class="hidden items-center gap-0 text-xs font-bold text-slate-700 xl:text-sm lg:flex">
            @foreach($siteNav as $label => $item)
                @if(is_array($item))
                    <div class="group relative">
                        <button class="px-2 py-7 hover:text-teal-800 xl:px-3">{{ $label }}</button>
                        <div class="invisible absolute left-0 top-full w-72 translate-y-2 rounded-md border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                            @foreach($item as $child => $href)
                                <a class="block rounded px-3 py-2 hover:bg-teal-50 hover:text-teal-800" href="{{ $href }}">{{ $child }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a class="px-2 py-7 hover:text-teal-800 xl:px-3" href="{{ $item }}">{{ $label }}</a>
                @endif
            @endforeach
        </nav>
        <div class="flex items-center gap-2">
            <a class="bih-button hidden sm:inline-flex" href="{{ route('contact') }}">Get in Touch</a>
            <button data-menu-button class="grid h-11 w-11 place-items-center rounded-md border border-slate-200 lg:hidden" aria-label="Open menu" aria-expanded="false">Menu</button>
        </div>
    </div>
    <div data-mobile-menu class="bih-container hidden pb-4 lg:hidden">
        @foreach($siteNav as $label => $item)
            <div class="border-t border-slate-200 py-2">
                <a class="font-extrabold" href="{{ is_array($item) ? '#' : $item }}">{{ $label }}</a>
                @if(is_array($item))
                    <div class="mt-2 grid gap-1 pl-3">
                        @foreach($item as $child => $href)
                            <a class="py-1 text-sm font-semibold text-slate-800" href="{{ $href }}">{{ $child }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</header>

<main>
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
    <div class="bih-container grid gap-8 md:grid-cols-4">
        <div>
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Bengal IT Hub home">
                <img class="h-24 w-auto max-w-[260px] object-contain" src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub logo">
                <div>
                    <div class="text-xl font-black">Bengal IT Hub</div>
                    <div class="text-xs font-extrabold uppercase text-teal-300">{{ $siteBrand['tagline'] ?? config('bengalhub.brand.tagline') }}</div>
                </div>
            </a>
            <p class="mt-3 text-sm text-slate-300">{{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}</p>
        </div>
        <div>
            <h2 class="font-extrabold">About</h2>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="/">Home</a><a href="/about-us">About Us</a><a href="/contact">Contact</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Important Links</h2>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="/terms-conditions">Terms & Conditions</a><a href="/privacy-policy">Privacy Policy</a><a href="/our-partners">Partners</a><a href="/sitemap.xml">Sitemap</a>
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
