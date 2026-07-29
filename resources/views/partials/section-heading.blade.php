<div class="max-w-3xl">
    <p class="bih-eyebrow">{{ $eyebrow ?? 'Bengal IT Hub' }}</p>
    @if(($level ?? 'h2') === 'h1')
        <h1 class="bih-section-title mt-3 text-3xl md:text-5xl">{{ $title }}</h1>
    @else
        <h2 class="bih-section-title mt-3 text-3xl md:text-5xl">{{ $title }}</h2>
    @endif
    @isset($intro)
        <p class="bih-page-intro mt-4">{{ $intro }}</p>
    @endisset
</div>
