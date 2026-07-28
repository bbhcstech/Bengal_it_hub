<section id="service-details" class="bih-service-b-features bih-section bg-slate-50">
    <div class="bih-container">
        <div class="max-w-3xl">
            <p class="bih-eyebrow">What This Enables</p>
            <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Everything this service brings to the table, one capability at a time</h2>
            <p class="bih-page-intro mt-5">A grounded, practical breakdown of what actually changes once this service is in motion.</p>
        </div>
        <div class="mt-10 grid gap-10 lg:grid-cols-[1.1fr_.9fr] lg:items-start">
            <div class="bih-service-b-feature-list grid divide-y divide-slate-200 rounded-md border border-slate-200 bg-white">
                @foreach($service['features'] as $feature)
                    <div class="bih-service-b-feature-item flex items-start gap-4 p-5">
                        <span class="bih-service-b-feature-number text-sm font-black text-teal-700">0{{ $loop->iteration }}</span>
                        <p class="font-bold leading-7 text-slate-800">{{ $feature }}</p>
                    </div>
                @endforeach
            </div>
            @if(!empty($service['gallery'][1]))
                <img class="bih-service-b-feature-image h-full min-h-64 w-full rounded-md object-cover shadow-xl" src="{{ $service['gallery'][1] }}" alt="{{ $service['title'] }} in practice">
            @endif
        </div>
    </div>
</section>
