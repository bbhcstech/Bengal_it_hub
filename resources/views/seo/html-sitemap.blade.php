@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container">
        <p class="bih-eyebrow">Every Page, One Place</p>
        <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">Sitemap</h1>
        <p class="mt-5 max-w-2xl text-xl leading-9 text-slate-600">A complete map of Bengal IT Hub's website. Looking for the machine-readable version instead? <a class="bih-link" href="/sitemap.xml">View sitemap.xml</a>.</p>

        <div class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Company</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/">Home</a>
                    <a class="bih-link" href="/vision-2030">Vision 2030</a>
                    <a class="bih-link" href="/about-us">About Us</a>
                    <a class="bih-link" href="/our-clients">Our Clients</a>
                    <a class="bih-link" href="/awards-recognition">Awards &amp; Recognition</a>
                    <a class="bih-link" href="/our-partners">Our Partners</a>
                    <a class="bih-link" href="/blog">Blog</a>
                    <a class="bih-link" href="/contact">Contact</a>
                    @foreach($fallbackPages as $slug => $page)
                        @continue(in_array($slug, ['vision-2030', 'about-us']))
                        <a class="bih-link" href="/{{ $slug }}">{{ $page[0] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Services</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/services">All Services</a>
                    @foreach($services as $slug => $service)
                        <a class="bih-link" href="/{{ $slug }}">{{ $service['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Products</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/products">All Products</a>
                    @foreach($products as $product)
                        <a class="bih-link" href="/products/{{ $product['slug'] }}">{{ $product['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Industries</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/industries">All Industries</a>
                    @foreach($industries as $slug => $industry)
                        <a class="bih-link" href="/industries/{{ $slug }}">{{ $industry['name'] }}</a>
                        @foreach($industry['subBranches'] ?? [] as $branchSlug => $branch)
                            <a class="bih-link pl-4 text-slate-600" href="/industries/{{ $slug }}/{{ $branchSlug }}">{{ $branch['name'] }}</a>
                        @endforeach
                    @endforeach
                </div>
            </div>

            @if($partners->isNotEmpty())
                <div>
                    <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Partners</h2>
                    <div class="mt-4 grid gap-2 text-sm">
                        <a class="bih-link" href="/our-partners">All Partners</a>
                        @foreach($partners as $partner)
                            <a class="bih-link" href="/our-partners/{{ $partner->slug }}">{{ $partner->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">TechBiz &amp; Tech Innovation</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/tech-biz">TechBiz</a>
                    <a class="bih-link" href="/tech-innovation">Tech Innovation Hub</a>
                    @foreach($techArticles as $article)
                        <a class="bih-link pl-4 text-slate-600" href="/tech-innovation/{{ $article->slug }}">{{ Str::limit($article->title, 78) }}</a>
                    @endforeach
                </div>
            </div>

            @if($blogPosts->isNotEmpty())
                <div>
                    <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Blog Posts</h2>
                    <div class="mt-4 grid gap-2 text-sm">
                        <a class="bih-link" href="/blog">All Blog Posts</a>
                        @foreach($blogPosts as $post)
                            <a class="bih-link" href="/blog/{{ $post->slug }}">{{ Str::limit($post->title, 78) }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">Case Studies &amp; Proof</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    @foreach($caseStudies as $caseStudy)
                        <a class="bih-link" href="{{ $caseStudy['url'] }}">{{ $caseStudy['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-lg font-black uppercase tracking-wide text-teal-700">The Bengal HackFest PRAGATI 2026</h2>
                <div class="mt-4 grid gap-2 text-sm">
                    <a class="bih-link" href="/hackfest-2026">Event Overview</a>
                    <a class="bih-link" href="/hackfest-2026/chief-guest">Chief Guest</a>
                    <a class="bih-link" href="/hackfest-2026/chief-adviser">Chief Adviser</a>
                    <a class="bih-link" href="/hackfest-2026/speakers">Speakers &amp; Panelists</a>
                    <a class="bih-link" href="/hackfest-2026/venue">Venue</a>
                    <a class="bih-link" href="/hackfest-2026/faq">Event FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
