@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Industry Sub-Branch Show View (Light & Dark Mode Support)
     Scoped strictly under [data-industry-sub]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-industry-sub] {
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
html.dark [data-industry-sub],
[data-theme="dark"] [data-industry-sub] {
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

[data-industry-sub] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- breadcrumb ---------- */
[data-industry-sub] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-industry-sub] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-industry-sub] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-industry-sub] .bs-breadcrumb .sep { opacity: .5; }
[data-industry-sub] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- cards & badges ---------- */
[data-industry-sub] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 24px 20px;
    box-shadow: var(--bs-shadow-sm); text-decoration: none; color: inherit;
    transition: transform .26s ease, box-shadow .26s ease, border-color .26s ease;
}
[data-industry-sub] .bs-card:hover {
    transform: translateY(-3px); box-shadow: var(--bs-shadow-md);
    border-color: rgba(232,170,61,0.45);
}
[data-industry-sub] .bs-badge-tag {
    display: inline-block; background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800;
    padding: 5px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 14px;
    width: fit-content;
}
[data-industry-sub] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
}
html.dark [data-industry-sub] .bs-badge-outline,
[data-theme="dark"] [data-industry-sub] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

[data-industry-sub] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-industry-sub] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

[data-industry-sub] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-industry-sub] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-industry-sub] .bs-btn-outline,
[data-theme="dark"] [data-industry-sub] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-industry-sub] .bs-btn-outline:hover,
[data-theme="dark"] [data-industry-sub] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

[data-industry-sub] .bs-section { padding: 40px 0 80px; }
[data-industry-sub] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 60px 0; }
</style>

<div data-industry-sub>
    <div class="bih-container" style="padding-top: 1.5rem; padding-bottom: 0;">
        <nav class="bs-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('industries.index') }}">Industries</a>
            <span class="sep">/</span>
            <a href="{{ route('industries.show', $industrySlug) }}">{{ $industry['name'] }}</a>
            <span class="sep">/</span>
            <span class="current">{{ $branch['name'] }}</span>
        </nav>
    </div>

    <section class="bs-section" style="padding-top: 16px;">
        <div class="bih-container grid gap-12 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span style="width: 48px; height: 48px; border-radius: 12px; background: var(--bs-surface-alt); border: 1px solid var(--bs-border); display: grid; place-items: center; color: var(--bs-primary);">
                        @include('partials.icon', ['name' => $branch['icon'] ?? 'target', 'size' => 'h-6 w-6'])
                    </span>
                    <span class="bs-badge-outline">{{ $industry['name'] }}</span>
                </div>

                <h1 style="font-family: 'Fraunces', serif; font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; line-height: 1.15; color: var(--bs-text); margin: 0 0 16px;">{{ $branch['name'] }}</h1>
                <p style="font-size: 1.1rem; line-height: 1.75; color: var(--bs-text); font-weight: 500; margin-bottom: 14px;">{{ $branch['summary'] }}</p>
                <p style="font-size: 1rem; line-height: 1.8; color: var(--bs-muted); margin-bottom: 28px;">{{ $branch['body'] }}</p>

                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    <a href="/contact?interest={{ urlencode($branch['name']) }}" class="bs-btn-gold">Discuss This Requirement</a>
                    <a href="{{ route('industries.show', $industrySlug) }}" class="bs-btn-outline">Back to {{ $industry['name'] }}</a>
                </div>
            </div>

            <div>
                <img src="{{ $branch['image'] }}" alt="{{ $branch['name'] }}" style="width: 100%; height: 380px; object-fit: cover; border-radius: var(--bs-radius-lg); box-shadow: var(--bs-shadow-md); border: 1px solid var(--bs-border);" loading="lazy">
            </div>
        </div>
    </section>

    @if(count($industry['subBranches']) > 1)
        <section class="bs-section-alt">
            <div class="bih-container">
                <span class="bs-badge-outline" style="margin-bottom: 8px;">More In {{ $industry['name'] }}</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: 1.8rem; font-weight: 600; color: var(--bs-text); margin: 0 0 24px;">Other Focus Areas</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    @foreach($industry['subBranches'] as $otherSlug => $other)
                        @continue($other['name'] === $branch['name'])
                        <a href="{{ route('industries.sub-show', [$industrySlug, $otherSlug]) }}" class="bs-card" style="display: flex; gap: 14px; align-items: flex-start;">
                            <span style="width: 40px; height: 40px; border-radius: 8px; background: var(--bs-surface-alt); border: 1px solid var(--bs-border); display: grid; place-items: center; color: var(--bs-primary); flex-shrink: 0;">
                                @include('partials.icon', ['name' => $other['icon'] ?? 'target'])
                            </span>
                            <div>
                                <h3 style="font-family: 'Fraunces', serif; font-size: 1.08rem; font-weight: 600; color: var(--bs-text); margin: 0 0 6px;">{{ $other['name'] }}</h3>
                                <p style="font-size: 0.86rem; line-height: 1.6; color: var(--bs-muted); margin: 0;">{{ Str::limit($other['summary'], 85) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.internal-links', [
        'links' => $internalLinks ?? [],
        'title' => 'Explore More Around '.$branch['name'],
        'intro' => 'Continue through connected Bengal IT Hub services, product capabilities, related articles, and proof pages.',
    ])
</div>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $branch['name'],
            'description' => $branch['summary'],
            'url' => url()->current(),
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
            'serviceType' => $industry['name'],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Industries', 'url' => route('industries.index')],
        ['name' => $industry['name'], 'url' => route('industries.show', $industrySlug)],
        ['name' => $branch['name'], 'url' => url()->current()],
    ]])
@endpush
@endsection
