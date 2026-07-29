@php
    $links = $links ?? [];
    $breadcrumbs = collect($breadcrumbs ?? [])->filter(fn ($crumb) => !empty($crumb['url']) && !empty($crumb['name']));
    $services = collect($links['services'] ?? []);
    $products = collect($links['products'] ?? []);
    $blogs = collect($links['blogs'] ?? []);
    $articles = collect($links['articles'] ?? []);
    $caseStudies = collect($links['caseStudies'] ?? []);
@endphp

@if($breadcrumbs->isNotEmpty())
    <section class="bg-white pt-8 pb-4">
        <div class="bih-container">
            <nav class="flex flex-wrap items-center gap-2 text-xs font-bold text-slate-500" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $crumb)
                    @if(! $loop->last)
                        <a class="transition hover:text-teal-700" href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
                        <span class="text-slate-300">/</span>
                    @else
                        <span class="text-slate-500">{{ Str::limit($crumb['name'], 70) }}</span>
                    @endif
                @endforeach
            </nav>
        </div>
    </section>
@endif

@if($services->isNotEmpty() || $products->isNotEmpty() || $blogs->isNotEmpty() || $articles->isNotEmpty() || $caseStudies->isNotEmpty())
    <section class="bih-section bg-slate-50">
        <div class="bih-container">
            <div class="max-w-3xl">
                <p class="bih-eyebrow">{{ $eyebrow ?? 'Internal Links' }}</p>
                <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">{{ $title ?? 'Keep Exploring Bengal IT Hub' }}</h2>
                <p class="bih-page-intro mt-5">{{ $intro ?? 'Follow these related services, articles, and proof pages to explore the topic in more depth.' }}</p>
            </div>

            <div class="mt-10 grid gap-5 lg:grid-cols-2">
                @if($services->isNotEmpty())
                    <div class="bih-card p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Services</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($services as $item)
                                <a class="group block rounded-md border border-slate-100 bg-white p-4 transition hover:border-teal-600/40 hover:shadow-sm" href="{{ $item['url'] }}">
                                    <span class="font-black text-slate-950 transition group-hover:text-teal-700">{{ $item['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-slate-600">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($products->isNotEmpty())
                    <div class="bih-card p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Products</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($products as $item)
                                <a class="group block rounded-md border border-slate-100 bg-white p-4 transition hover:border-sky-600/40 hover:shadow-sm" href="{{ $item['url'] }}">
                                    <span class="font-black text-slate-950 transition group-hover:text-sky-700">{{ $item['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-slate-600">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($blogs->isNotEmpty())
                    <div class="bih-card p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Blogs</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($blogs as $item)
                                <a class="group block rounded-md border border-slate-100 bg-white p-4 transition hover:border-teal-600/40 hover:shadow-sm" href="{{ $item['url'] }}">
                                    <span class="font-black text-slate-950 transition group-hover:text-teal-700">{{ $item['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-slate-600">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($articles->isNotEmpty())
                    <div class="bih-card p-6">
                        <h3 class="text-lg font-black text-slate-950">Related Articles</h3>
                        <div class="mt-4 grid gap-3">
                            @foreach($articles as $item)
                                <a class="group block rounded-md border border-slate-100 bg-white p-4 transition hover:border-amber-500/50 hover:shadow-sm" href="{{ $item['url'] }}">
                                    <span class="font-black text-slate-950 transition group-hover:text-amber-700">{{ $item['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-slate-600">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($caseStudies->isNotEmpty())
                    <div class="bih-card p-6 lg:col-span-2">
                        <h3 class="text-lg font-black text-slate-950">Related Case Studies</h3>
                        <div class="mt-4 grid gap-3 md:grid-cols-3">
                            @foreach($caseStudies as $item)
                                <a class="group block rounded-md border border-slate-100 bg-white p-4 transition hover:border-teal-600/40 hover:shadow-sm" href="{{ $item['url'] }}">
                                    <span class="font-black text-slate-950 transition group-hover:text-teal-700">{{ $item['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-slate-600">{{ $item['summary'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
