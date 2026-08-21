@extends('layouts.app')

@section('content')

{{-- ======================================================
     Page-scoped CSS — Bengal Signal Design System
     Partner Show Page (Light & Dark Mode Support)
     Scoped strictly under [data-partner-show]
     ====================================================== --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap');

/* ---------- Light mode (default) ---------- */
[data-partner-show] {
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
html.dark [data-partner-show],
[data-theme="dark"] [data-partner-show] {
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

[data-partner-show] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

/* ---------- breadcrumb ---------- */
[data-partner-show] .bs-breadcrumb {
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Outfit', sans-serif;
    font-size: .82rem; color: var(--bs-muted);
    margin-bottom: 1.5rem; flex-wrap: wrap;
}
[data-partner-show] .bs-breadcrumb a { color: var(--bs-muted); transition: color .2s; text-decoration: none; }
[data-partner-show] .bs-breadcrumb a:hover { color: var(--bs-gold); }
[data-partner-show] .bs-breadcrumb .sep { opacity: .5; }
[data-partner-show] .bs-breadcrumb .current { color: var(--bs-text); font-weight: 700; }

/* ---------- cards & badges ---------- */
[data-partner-show] .bs-card {
    background-color: var(--bs-surface); border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md); padding: 32px 28px;
    box-shadow: var(--bs-shadow-sm);
}
[data-partner-show] .bs-badge-outline {
    display: inline-block; background: transparent;
    border: 1.5px solid var(--bs-border); color: var(--bs-muted);
    font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 700;
    padding: 4px 11px; border-radius: var(--bs-radius-pill);
}
html.dark [data-partner-show] .bs-badge-outline,
[data-theme="dark"] [data-partner-show] .bs-badge-outline {
    border-color: var(--bs-border); color: var(--bs-muted);
}

[data-partner-show] .bs-btn-gold {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background-color: var(--bs-gold); color: #12242B;
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .94rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill);
    border: 1.5px solid transparent; text-decoration: none; cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .22s;
}
[data-partner-show] .bs-btn-gold:hover {
    background-color: var(--bs-gold-lt); box-shadow: 0 14px 34px rgba(232,170,61,.35);
    transform: translateY(-2px);
}

[data-partner-show] .bs-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    background: transparent; border: 1.5px solid var(--bs-border); color: var(--bs-text);
    font-family: 'Outfit', sans-serif; font-weight: 700; font-size: .92rem;
    padding: 13px 26px; border-radius: var(--bs-radius-pill); text-decoration: none;
    transition: border-color .22s, color .22s, transform .22s;
}
[data-partner-show] .bs-btn-outline:hover {
    border-color: var(--bs-primary); color: var(--bs-primary); transform: translateY(-2px);
}
html.dark [data-partner-show] .bs-btn-outline,
[data-theme="dark"] [data-partner-show] .bs-btn-outline {
    border-color: var(--bs-border); color: var(--bs-text);
}
html.dark [data-partner-show] .bs-btn-outline:hover,
[data-theme="dark"] [data-partner-show] .bs-btn-outline:hover {
    border-color: var(--bs-gold-lt); color: var(--bs-gold-lt);
}

[data-partner-show] .bs-section { padding: 60px 0; }
[data-partner-show] .bs-section-alt { background-color: var(--bs-surface-alt); padding: 60px 0; }
</style>

<div data-partner-show>
    <div class="bih-container" style="padding-top: 1.5rem; padding-bottom: 0;">
        <nav class="bs-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('our-partners.index') }}">Our Partners</a>
            <span class="sep">/</span>
            <span class="current">{{ $partner->name }}</span>
        </nav>
    </div>

    <section class="bs-section" style="padding-top: 20px;">
        <div class="bih-container grid gap-12 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
            <div>
                <div style="display: flex; align-items: center; gap: 14px;">
                    @if($partner->logo)
                        <img src="{{ $partner->logo }}" alt="{{ $partner->name }} logo" style="width: 56px; height: 56px; border-radius: 12px; object-fit: contain; background: var(--bs-surface); border: 1px solid var(--bs-border); padding: 4px;">
                    @else
                        <span style="display: grid; place-items: center; width: 56px; height: 56px; border-radius: 12px; background: var(--bs-surface-alt); font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.2rem; color: var(--bs-primary); border: 1px solid var(--bs-border);">
                            {{ Str::substr($partner->name, 0, 2) }}
                        </span>
                    @endif
                    <span class="bs-badge-outline" style="font-size: 0.78rem; text-transform: uppercase;">{{ ucfirst($partner->scope) }} Partner</span>
                </div>

                <h1 style="font-family: 'Fraunces', serif; font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; margin: 18px 0 14px; line-height: 1.15; color: var(--bs-text);">{{ $partner->name }}</h1>
                <p style="font-size: 1.08rem; line-height: 1.8; color: var(--bs-muted); max-width: 640px;">{{ $partner->description ?: 'Full profile details for this partner are coming soon.' }}</p>

                @if($partner->address)
                    <p style="margin-top: 16px; display: flex; align-items: center; gap: 8px; font-size: 0.92rem; color: var(--bs-muted);">
                        <span style="color: var(--bs-primary);">@include('partials.icon', ['name' => 'globe', 'size' => 'h-4 w-4'])</span>
                        {{ $partner->address }}
                    </p>
                @endif

                <div style="margin-top: 28px; display: flex; flex-wrap: wrap; gap: 12px;">
                    @if($partner->link_url)
                        <a href="{{ $partner->link_url }}" target="_blank" rel="noopener" class="bs-btn-gold">Visit Website</a>
                    @endif
                    <a href="{{ route('our-partners.index') }}" class="bs-btn-outline">Back to Our Partners</a>
                </div>
            </div>

            @if($partner->clients_count || $partner->employees_count)
                <div class="bs-card" style="padding: 0; overflow: hidden;">
                    <div style="background: linear-gradient(120deg, var(--bs-primary), #123544); padding: 16px 24px; color: #fff;">
                        <p style="font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; margin: 0; color: #fff;">At a Glance</p>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; padding: 28px 24px; text-align: center;">
                        @if($partner->clients_count)
                            <div>
                                <p style="font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 600; color: var(--bs-primary); margin: 0;">{{ $partner->clients_count }}</p>
                                <p style="font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 700; text-transform: uppercase; color: var(--bs-muted); margin-top: 4px;">Total Clients</p>
                            </div>
                        @endif
                        @if($partner->employees_count)
                            <div>
                                <p style="font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 600; color: var(--bs-primary); margin: 0;">{{ $partner->employees_count }}</p>
                                <p style="font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 700; text-transform: uppercase; color: var(--bs-muted); margin-top: 4px;">Total Employees</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if(!empty($partner->products))
        <section class="bs-section-alt">
            <div class="bih-container">
                <span class="bs-badge-outline" style="margin-bottom: 8px;">Products</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: 1.8rem; font-weight: 600; color: var(--bs-text); margin: 0 0 24px;">What {{ $partner->name }} Builds</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    @foreach($partner->products as $product)
                        <div class="bs-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 12px;">
                            <span style="color: var(--bs-primary);">@include('partials.icon', ['name' => 'chip', 'size' => 'h-5 w-5'])</span>
                            <p style="margin: 0; font-weight: 600; color: var(--bs-text);">{{ $product }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(!empty($partner->projects))
        <section class="bs-section">
            <div class="bih-container">
                <span class="bs-badge-outline" style="margin-bottom: 8px;">Projects</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: 1.8rem; font-weight: 600; color: var(--bs-text); margin: 0 0 24px;">What We've Worked On Together</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    @foreach($partner->projects as $project)
                        <div class="bs-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 12px;">
                            <span style="color: var(--bs-gold);">@include('partials.icon', ['name' => 'target', 'size' => 'h-5 w-5'])</span>
                            <p style="margin: 0; font-weight: 600; color: var(--bs-text);">{{ $project }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($related->isNotEmpty())
        <section class="bs-section-alt">
            <div class="bih-container">
                <span class="bs-badge-outline" style="margin-bottom: 8px;">More Partners</span>
                <h2 style="font-family: 'Fraunces', serif; font-size: 1.8rem; font-weight: 600; color: var(--bs-text); margin: 0 0 24px;">Other {{ ucfirst($partner->scope) }} Partners</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    @foreach($related as $other)
                        <a href="{{ route('our-partners.show', $other->slug) }}" class="bs-card" style="padding: 18px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; color: inherit;">
                            @if($other->logo)
                                <img src="{{ $other->logo }}" alt="{{ $other->name }} logo" style="width: 40px; height: 40px; border-radius: 8px; object-fit: contain; background: var(--bs-surface-alt); padding: 3px; border: 1px solid var(--bs-border);">
                            @else
                                <span style="display: grid; place-items: center; width: 40px; height: 40px; border-radius: 8px; background: var(--bs-surface-alt); font-weight: 800; font-size: 0.95rem; color: var(--bs-primary); border: 1px solid var(--bs-border);">{{ Str::substr($other->name, 0, 2) }}</span>
                            @endif
                            <span style="font-weight: 700; color: var(--bs-text); font-family: 'Outfit', sans-serif;">{{ $other->name }}</span>
                            <span style="margin-left: auto; color: var(--bs-primary); font-size: 1.1rem;">&rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $partner->name,
            'description' => $partner->description,
            'url' => $partner->link_url,
            'address' => $partner->address,
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Our Partners', 'url' => route('our-partners.index')],
        ['name' => $partner->name, 'url' => url()->current()],
    ]])
@endpush
@endsection
