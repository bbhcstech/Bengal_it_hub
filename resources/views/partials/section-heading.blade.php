<div class="max-w-3xl">
    <p class="bih-eyebrow">{{ $eyebrow ?? 'Bengal IT Hub' }}</p>
    <h2 class="bih-section-title mt-3 text-3xl md:text-5xl">{{ $title }}</h2>
    @isset($intro)
        <p class="bih-page-intro mt-4">{{ $intro }}</p>
    @endisset
</div>
