<article class="bih-card bih-image-card bih-tech-news-card flex flex-col overflow-hidden">
    <a href="{{ route('tech-innovation.show', $article->slug) }}" class="block">
        @if($article->image)
            <img class="h-48 w-full object-cover" src="{{ $article->image }}" alt="{{ $article->title }}" loading="lazy">
        @else
            <div class="grid h-48 w-full place-items-center bg-linear-to-br from-teal-700 via-sky-700 to-slate-950 text-3xl font-black text-white">
                {{ Str::substr($article->source?->name ?? 'BIH', 0, 1) }}
            </div>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-5 md:p-6">
        <div class="flex items-center justify-between gap-3">
            <p class="bih-eyebrow">{{ $article->category?->name ?? 'Technology' }}</p>
            @if($article->source)
                <span class="max-w-[45%] truncate rounded-full bg-slate-100 px-2.5 py-1 text-xs font-black uppercase text-slate-500">{{ $article->source->name }}</span>
            @endif
        </div>
        <h3 class="bih-section-title mt-3 text-xl leading-tight">
            <a href="{{ route('tech-innovation.show', $article->slug) }}" class="hover:text-teal-700">{{ Str::limit($article->title, 90) }}</a>
        </h3>
        @if($article->description)
            <p class="bih-copy mt-3 flex-1 text-sm">{{ Str::limit($article->description, 130) }}</p>
        @endif
        <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4 text-xs font-bold text-slate-500">
            <time datetime="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">{{ $article->published_at?->diffForHumans() ?? $article->created_at->diffForHumans() }}</time>
            <a class="bih-tech-read-more" href="{{ route('tech-innovation.show', $article->slug) }}">Read More</a>
        </div>
    </div>
</article>
