<section id="service-details" class="bih-section bg-white">
    <div class="bih-container">
        <div class="grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
            @if(!empty($service['gallery'][1]))
                <img class="h-80 w-full rounded-md object-cover shadow-xl" src="{{ $service['gallery'][1] }}" alt="{{ $service['title'] }} in practice">
            @endif
            <div>
                <p class="bih-eyebrow">What This Enables</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">The core capabilities this service is built to deliver</h2>
                <p class="bih-page-intro mt-5">A focused set of capabilities, each one addressing a specific part of the problem this service solves.</p>
                <div class="mt-8 grid gap-3">
                    @foreach($service['features'] as $feature)
                        <div class="flex items-center gap-4 border-l-4 border-teal-700 bg-slate-50 py-3 pl-4 pr-3">
                            <p class="font-bold leading-6 text-slate-800">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
