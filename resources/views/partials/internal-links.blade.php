@php
    $links = $links ?? [];
    $breadcrumbs = collect($breadcrumbs ?? [])->filter(fn ($crumb) => !empty($crumb['url']) && !empty($crumb['name']));
    $services = collect($links['services'] ?? []);
    $products = collect($links['products'] ?? []);
    $blogs = collect($links['blogs'] ?? []);
    $articles = collect($links['articles'] ?? []);
    $caseStudies = collect($links['caseStudies'] ?? []);
@endphp

<style>
/* ---------- Internal Links Scoped Design System ---------- */
[data-internal-links] {
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
    --bs-radius-sm:   8px;
    --bs-radius-md:   16px;
    --bs-radius-lg:   28px;
    --bs-radius-pill: 999px;
    --bs-shadow-sm:   0 1px 3px rgba(10,31,40,.08);
    --bs-shadow-md:   0 12px 32px rgba(10,31,40,.10);
    font-family: 'Inter', sans-serif;
    color: var(--bs-text);
    background-color: var(--bs-surface-alt);
    transition: background-color 260ms ease, color 260ms ease;
    padding: 70px 0 90px;
}

html.dark [data-internal-links],
[data-theme="dark"] [data-internal-links] {
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
    --bs-shadow-sm:   0 1px 3px rgba(0,0,0,0.4);
    --bs-shadow-md:   0 12px 32px rgba(0,0,0,0.5);
    color-scheme: dark;
}

[data-internal-links] * {
    transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease, box-shadow 260ms ease;
}

[data-internal-links] .bs-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: .74rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--bs-primary); background: rgba(30,74,95,.08);
    padding: 7px 16px 7px 12px; border-radius: var(--bs-radius-pill); margin-bottom: 16px;
    border: 1px solid rgba(30,74,95,.18);
    width: fit-content;
}
[data-internal-links] .bs-eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232,170,61,.28);
    display: inline-block; flex-shrink: 0;
}
html.dark [data-internal-links] .bs-eyebrow,
[data-theme="dark"] [data-internal-links] .bs-eyebrow {
    color: var(--bs-gold-lt);
    background: rgba(232, 170, 61, 0.1);
    border-color: rgba(232, 170, 61, 0.25);
}
html.dark [data-internal-links] .bs-eyebrow .dot,
[data-theme="dark"] [data-internal-links] .bs-eyebrow .dot {
    background-color: var(--bs-gold);
    box-shadow: 0 0 0 3px rgba(232, 170, 61, 0.25);
}

[data-internal-links] .bs-title {
    font-family: 'Fraunces', serif;
    font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 600;
    color: var(--bs-text); margin: 0 0 10px; line-height: 1.2;
}
[data-internal-links] .bs-intro {
    font-size: 1.05rem; line-height: 1.7; color: var(--bs-muted); margin: 0;
}

[data-internal-links] .bs-group-card {
    background-color: var(--bs-surface);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-md);
    padding: 28px 24px;
    box-shadow: var(--bs-shadow-sm);
}
[data-internal-links] .bs-group-title {
    font-family: 'Fraunces', serif;
    font-size: 1.25rem; font-weight: 600;
    color: var(--bs-text); margin: 0 0 18px; line-height: 1.25;
}

[data-internal-links] .bs-items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
}

[data-internal-links] .bs-link-item {
    display: flex;
    flex-direction: column;
    background-color: var(--bs-bg);
    border: 1px solid var(--bs-border);
    border-radius: var(--bs-radius-sm);
    padding: 18px 20px;
    text-decoration: none;
    color: inherit;
    height: 100%;
    transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease;
}
[data-internal-links] .bs-link-item:hover {
    transform: translateY(-2px);
    border-color: rgba(232, 170, 61, 0.5);
    box-shadow: var(--bs-shadow-sm);
}
[data-internal-links] .bs-item-title {
    display: block;
    font-family: 'Outfit', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--bs-text);
    transition: color .2s ease;
}
[data-internal-links] .bs-link-item:hover .bs-item-title {
    color: var(--bs-primary);
}
html.dark [data-internal-links] .bs-link-item:hover .bs-item-title,
[data-theme="dark"] [data-internal-links] .bs-link-item:hover .bs-item-title {
    color: var(--bs-gold-lt);
}
[data-internal-links] .bs-item-summary {
    display: block;
    font-size: 0.88rem;
    line-height: 1.6;
    color: var(--bs-muted);
    margin-top: 8px;
    flex: 1;
}
</style>

@if($breadcrumbs->isNotEmpty())
    <div class="bih-container" style="padding-top: 1.25rem; padding-bottom: 0.5rem;">
        <nav style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; font-family: 'Outfit', sans-serif; font-size: 0.82rem; color: var(--bs-muted, #52707A);" aria-label="Breadcrumb">
            @foreach($breadcrumbs as $crumb)
                @if(! $loop->last)
                    <a style="color: var(--bs-muted, #52707A); text-decoration: none; transition: color .2s;" href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
                    <span style="opacity: 0.5;">/</span>
                @else
                    <span style="color: var(--bs-text, #0F262E); font-weight: 700;">{{ Str::limit($crumb['name'], 70) }}</span>
                @endif
            @endforeach
        </nav>
    </div>
@endif

@if($services->isNotEmpty() || $products->isNotEmpty() || $blogs->isNotEmpty() || $articles->isNotEmpty() || $caseStudies->isNotEmpty())
    <section class="bih-section bih-related-links">
        <div class="bih-container">
            <div style="max-width: 720px; margin-bottom: 36px;">
                <span class="bs-eyebrow">
                    <span class="dot"></span>
                    {{ $eyebrow ?? 'Explore Further' }}
                </span>
                <h2 class="bs-title">{{ $title ?? 'Keep Exploring Bengal IT Hub' }}</h2>
                <p class="bs-intro">{{ $intro ?? 'Follow these related services, articles, and proof pages to explore the topic in more depth.' }}</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 28px;">
                @if($services->isNotEmpty())
                    <div class="bih-card bih-related-links-panel p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Services</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($services as $item)
                                <a class="bih-related-link group block p-4 transition" href="{{ $item['url'] }}">
                                    <span class="bih-related-link-title">{{ $item['title'] }}</span>
                                    <span class="bih-related-link-summary">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($products->isNotEmpty())
                    <div class="bih-card bih-related-links-panel p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Products</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($products as $item)
                                <a class="bih-related-link group block p-4 transition" href="{{ $item['url'] }}">
                                    <span class="bih-related-link-title">{{ $item['title'] }}</span>
                                    <span class="bih-related-link-summary">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($blogs->isNotEmpty())
                    <div class="bih-card bih-related-links-panel p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Blogs</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($blogs as $item)
                                <a class="bih-related-link group block p-4 transition" href="{{ $item['url'] }}">
                                    <span class="bih-related-link-title">{{ $item['title'] }}</span>
                                    <span class="bih-related-link-summary">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($articles->isNotEmpty())
                    <div class="bih-card bih-related-links-panel p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Articles</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($articles as $item)
                                <a class="bih-related-link group block p-4 transition" href="{{ $item['url'] }}">
                                    <span class="bih-related-link-title">{{ $item['title'] }}</span>
                                    <span class="bih-related-link-summary">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($caseStudies->isNotEmpty())
                    <div class="bih-card bih-related-links-panel p-6 lg:col-span-2">
                        <h3 class="text-lg font-black text-slate-950">Related Case Studies</h3>
                        <div class="mt-4 grid gap-3 md:grid-cols-3">
                            @foreach($caseStudies as $item)
                                <a class="bih-related-link group block p-4 transition" href="{{ $item['url'] }}">
                                    <span class="bih-related-link-title">{{ $item['title'] }}</span>
                                    <span class="bih-related-link-summary">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
