<article class="bs-card bih-tech-news-card reveal">
    <a href="{{ route('tech-innovation.show', $article->slug) }}" class="bs-card-media block">
        @if($article->image)
            <img src="{{ $article->image }}" alt="{{ $article->title }}" loading="lazy">
        @else
            <div style="display: grid; place-items: center; width: 100%; height: 100%; background: linear-gradient(135deg, var(--bs-primary), #123544); color: #fff; font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 700;">
                {{ Str::substr($article->source?->name ?? 'BIH', 0, 1) }}
            </div>
        @endif
    </a>
    <div class="bs-card-body">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 10px;">
            <span class="bs-badge-tag">{{ $article->category?->name ?? 'Technology' }}</span>
            @if($article->source)
                <span class="bs-badge-outline" style="font-size: 0.68rem; max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $article->source->name }}</span>
            @endif
        </div>
        <h3 style="margin-bottom: 8px;">
            <a href="{{ route('tech-innovation.show', $article->slug) }}" style="text-decoration: none; color: inherit; transition: color .2s;">
                {{ Str::limit($article->title, 80) }}
            </a>
        </h3>
        @if($article->description)
            <p style="font-size: 0.88rem; line-height: 1.65; margin-bottom: 16px;">{{ Str::limit($article->description, 120) }}</p>
        @endif
        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 14px; border-top: 1px solid var(--bs-border); font-size: 0.78rem; font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--bs-muted);">
            <time datetime="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">{{ $article->published_at?->diffForHumans() ?? $article->created_at->diffForHumans() }}</time>
            <a href="{{ route('tech-innovation.show', $article->slug) }}" style="color: var(--bs-primary); text-decoration: none; font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                Read More &rarr;
            </a>
        </div>
    </div>
</article>
