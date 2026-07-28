@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container">
        <div class="grid gap-8 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
            <div>
                <p class="bih-eyebrow">{{ $page[1] }}</p>
                <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">{{ $page[0] }}</h1>
                <p class="mt-5 text-xl leading-9 text-slate-600">{{ $page[2] }}</p>
                <a class="bih-button mt-8" href="/contact">Start a Conversation</a>
            </div>
            <div class="bih-card p-7">
                @if($slug === 'faq')
                    <h2 class="text-2xl font-black">Frequently Asked Questions</h2>
                    <div class="mt-5 grid gap-4">
                        @foreach($faqs as [$question, $answer])
                            <details class="rounded-md border border-slate-200 p-4">
                                <summary class="cursor-pointer font-extrabold">{{ $question }}</summary>
                                <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                            </details>
                        @endforeach
                    </div>
                    @push('schema')
                        <script type="application/ld+json">
                            {!! json_encode([
                                '@'.'context' => 'https://schema.org',
                                '@type' => 'FAQPage',
                                'mainEntity' => collect($faqs)->map(fn ($faq) => [
                                    '@type' => 'Question',
                                    'name' => $faq[0],
                                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
                                ])->all(),
                            ], JSON_UNESCAPED_SLASHES) !!}
                        </script>
                    @endpush
                @elseif($slug === 'our-partners')
                    <h2 class="text-2xl font-black">Partner Ecosystem</h2>
                    <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3">
                        @foreach($partners->isNotEmpty() ? $partners : collect(['Industry Experts','Academic Partners','Innovation Partners','Hiring Partners','Technology Partners','Community Partners']) as $partner)
                            <div class="rounded-md border border-slate-200 bg-white p-5 text-center font-extrabold">{{ is_string($partner) ? $partner : $partner->name }}</div>
                        @endforeach
                    </div>
                @elseif($slug === 'blog')
                    <h2 class="text-2xl font-black">Blog CMS Ready</h2>
                    @if($posts->isNotEmpty())
                        <div class="mt-5 grid gap-4">
                            @foreach($posts as $post)
                                <article class="rounded-md border border-slate-200 p-4">
                                    <h3 class="font-black">{{ $post->title }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ Str::limit(strip_tags($post->body), 140) }}</p>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 leading-8 text-slate-600">The SRS marks blog as a net-new module. This route is ready for posts, categories, tags, author attribution, RSS, and structured data.</p>
                    @endif
                @elseif($slug === 'industries')
                    <h2 class="text-2xl font-black">Industries We Serve</h2>
                    <div class="mt-5 grid grid-cols-2 gap-3">
                        @foreach(['IT & Digital Services', 'SaaS & Cloud Solutions', 'FinTech', 'Healthcare', 'EdTech', 'Manufacturing', 'E-Commerce', 'Corporate Operations'] as $industry)
                            <div class="rounded-md border border-slate-200 bg-white p-4 text-center font-extrabold">{{ $industry }}</div>
                        @endforeach
                    </div>
                @elseif($slug === 'awards-recognition')
                    <h2 class="text-2xl font-black">Awards & Recognition Coming Soon</h2>
                    <p class="mt-4 leading-8 text-slate-600">We're compiling Bengal IT Hub's award wins, media mentions, and industry recognitions into a dedicated showcase. Check back soon.</p>
                    <a class="bih-button mt-6" href="/contact">Get In Touch</a>
                @else
                    <h2 class="text-2xl font-black">Laravel Migration Page</h2>
                    <p class="mt-4 leading-8 text-slate-600">This page preserves the current WordPress URL inventory and gives the CMS build a clean place to migrate rich text, images, SEO metadata, and reusable content blocks.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
