@extends('layouts.app')

@section('content')
<section class="bg-white pt-10 pb-6">
    <div class="bih-container">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-bold text-slate-500" aria-label="Breadcrumb">
            <a class="transition hover:text-teal-700" href="{{ route('blog.index') }}">Blog</a>
            <span class="text-slate-300">/</span>
            @if($post->category)
                <span class="text-slate-500">{{ $post->category->name }}</span>
                <span class="text-slate-300">/</span>
            @endif
            <span class="text-slate-500">{{ Str::limit($post->title, 60) }}</span>
        </nav>
    </div>
</section>

<section class="bg-white pb-12">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.32fr] lg:items-start">
        <article>
            @if($post->category)
                <p class="bih-eyebrow">{{ $post->category->name }}</p>
            @endif
            <h1 class="mt-4 text-3xl font-black leading-tight tracking-tight text-slate-950 md:text-5xl">{{ $post->title }}</h1>
            <time datetime="{{ $post->published_at?->toIso8601String() }}" class="mt-5 block text-xs font-black uppercase text-slate-500">{{ $post->published_at?->format('d M Y') }}</time>

            @if($post->featured_image)
                <img class="mt-6 h-64 w-full rounded-lg object-cover shadow-lg sm:h-96" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
            @endif

            <div class="bih-copy mt-6 grid gap-4">
                @foreach(explode("\n\n", strip_tags($post->body)) as $paragraph)
                    @continue(trim($paragraph) === '')
                    <p>{{ trim($paragraph) }}</p>
                @endforeach
            </div>

            <div class="mt-8 border-t border-slate-100 pt-6">
                <a class="bih-button" href="{{ route('blog.index') }}">Back to Blog</a>
            </div>
        </article>

        <aside class="grid content-start gap-6">
            @if($related->isNotEmpty())
                <div class="bih-card p-5">
                    <p class="bih-eyebrow">More Reads</p>
                    <div class="mt-4 grid gap-4">
                        @foreach($related as $item)
                            <a href="{{ route('blog.show', $item->slug) }}" class="flex gap-3 hover:text-teal-700">
                                @if($item->featured_image)
                                    <img class="h-14 w-14 flex-none rounded-md object-cover" src="{{ $item->featured_image }}" alt="{{ $item->title }}">
                                @else
                                    <span class="grid h-14 w-14 flex-none place-items-center rounded-md bg-slate-100 text-sm font-black text-slate-500">{{ Str::substr($item->title, 0, 1) }}</span>
                                @endif
                                <span class="text-sm font-bold leading-snug">{{ Str::limit($item->title, 70) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</section>

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Services, Articles, And Case Studies',
    'intro' => 'Keep following the topic through Bengal IT Hub services, technology articles, and proof pages.',
])

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'image' => ($post->og_image ?: $post->featured_image) ? [$post->og_image ?: $post->featured_image] : [],
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub'],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Bengal IT Hub',
                'url' => url('/'),
                'logo' => ['@type' => 'ImageObject', 'url' => asset('logo_bengal_it_hub.svg')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url()->current()],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => $post->title, 'url' => url()->current()],
    ]])
@endpush
@endsection
