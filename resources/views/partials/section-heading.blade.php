<div class="max-w-3xl">
    <p class="bih-eyebrow">{{ $eyebrow ?? 'Bengal IT Hub' }}</p>
    <h2 class="mt-3 text-3xl font-black leading-tight text-slate-950 md:text-5xl">{{ $title }}</h2>
    @isset($intro)
        <p class="mt-4 text-lg leading-8 text-slate-600">{{ $intro }}</p>
    @endisset
</div>
