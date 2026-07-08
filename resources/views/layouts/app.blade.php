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
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Bengal IT Hub',
            'url' => url('/'),
            'telephone' => config('bengalhub.brand.phone'),
            'address' => config('bengalhub.brand.address'),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bih-shell min-h-screen">
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/92 backdrop-blur">
    <div class="bih-container flex min-h-20 items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3 font-black text-slate-950">
            <span class="grid h-11 w-11 place-items-center rounded-md bg-teal-700 text-white">BIH</span>
            <span class="leading-tight">Bengal<br>IT Hub</span>
        </a>
        <nav class="hidden items-center gap-1 text-sm font-bold text-slate-700 lg:flex">
            @foreach(config('bengalhub.nav') as $label => $item)
                @if(is_array($item))
                    <div class="group relative">
                        <button class="px-3 py-7">{{ $label }}</button>
                        <div class="invisible absolute left-0 top-full w-72 translate-y-2 rounded-md border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                            @foreach($item as $child => $href)
                                <a class="block rounded px-3 py-2 hover:bg-teal-50 hover:text-teal-800" href="{{ $href }}">{{ $child }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a class="px-3 py-7 hover:text-teal-800" href="{{ $item }}">{{ $label }}</a>
                @endif
            @endforeach
        </nav>
        <div class="flex items-center gap-2">
            <a class="bih-button hidden sm:inline-flex" href="tel:{{ preg_replace('/\s+/', '', config('bengalhub.brand.phone')) }}">Call {{ config('bengalhub.brand.phone') }}</a>
            <button data-menu-button class="grid h-11 w-11 place-items-center rounded-md border border-slate-200 lg:hidden" aria-label="Open menu" aria-expanded="false">Menu</button>
        </div>
    </div>
    <div data-mobile-menu class="bih-container hidden pb-4 lg:hidden">
        @foreach(config('bengalhub.nav') as $label => $item)
            <div class="border-t border-slate-200 py-2">
                <a class="font-extrabold" href="{{ is_array($item) ? '#' : $item }}">{{ $label }}</a>
                @if(is_array($item))
                    <div class="mt-2 grid gap-1 pl-3">
                        @foreach($item as $child => $href)
                            <a class="py-1 text-sm text-slate-600" href="{{ $href }}">{{ $child }}</a>
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

<footer class="border-t border-slate-200 bg-slate-950 py-12 text-white">
    <div class="bih-container grid gap-8 md:grid-cols-4">
        <div>
            <div class="text-xl font-black">Bengal IT Hub</div>
            <p class="mt-3 text-sm text-slate-300">{{ config('bengalhub.brand.address') }}</p>
        </div>
        <div>
            <h2 class="font-extrabold">About</h2>
            <div class="mt-3 grid gap-2 text-sm text-slate-300">
                <a href="/">Home</a><a href="/about-us">About Us</a><a href="/contact">Contact</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Important Links</h2>
            <div class="mt-3 grid gap-2 text-sm text-slate-300">
                <a href="/terms-conditions">Terms & Conditions</a><a href="/privacy-policy">Privacy Policy</a><a href="/our-partners">Partners</a><a href="/sitemap.xml">Sitemap</a>
            </div>
        </div>
        <div>
            <h2 class="font-extrabold">Let's Connect</h2>
            <div class="mt-3 flex flex-wrap gap-2 text-sm">
                @foreach(config('bengalhub.brand.socials') as $label => $href)
                    <a class="rounded bg-white/10 px-3 py-2" href="{{ $href }}" target="_blank" rel="noopener">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bih-container mt-10 text-sm text-slate-400">Copyright 2026 Bengal IT Hub | {{ config('bengalhub.brand.company') }} All rights reserved.</div>
</footer>
</body>
</html>
