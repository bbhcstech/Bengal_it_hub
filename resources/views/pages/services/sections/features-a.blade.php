<section id="service-details" class="bih-section bg-white">
    <div class="bih-container grid gap-10 lg:grid-cols-[.88fr_1.12fr] lg:items-start">
        <div class="lg:sticky lg:top-28">
            <p class="bih-eyebrow">What This Enables</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">A complete framework built around what this service delivers</h2>
            <p class="bih-page-intro mt-5">Every capability below is designed to work together, turning a single service into a connected, repeatable system of value.</p>
            @if(!empty($service['gallery'][1]))
                <img class="mt-8 h-72 w-full rounded-md object-cover shadow-xl" src="{{ $service['gallery'][1] }}" alt="{{ $service['title'] }} in practice">
            @endif
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($service['features'] as $feature)
                <article class="bih-card flex min-h-28 gap-4 p-5">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-md bg-teal-700 text-white">
                        @include('partials.icon', ['name' => 'check', 'size' => 'h-4 w-4'])
                    </span>
                    <p class="font-bold leading-7 text-slate-800">{{ $feature }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
