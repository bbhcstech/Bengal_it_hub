@if(!empty($service['outcomes']))
    <section class="bih-service-b-outcomes bih-section bg-slate-50">
        <div class="bih-container">
            <div class="max-w-3xl">
                <p class="bih-eyebrow">Expected Outcomes</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">What you can expect once this service is in motion</h2>
                <p class="bih-page-intro mt-5">A repeatable, measurable improvement across the areas that matter most to the business.</p>
            </div>
            <div class="bih-service-b-outcome-list mt-8 flex flex-wrap gap-3">
                @foreach($service['outcomes'] as $outcome)
                    <span class="bih-service-b-outcome rounded-full border border-teal-700/20 bg-white px-5 py-2.5 font-extrabold text-teal-800 shadow-sm">{{ $outcome }}</span>
                @endforeach
            </div>
            <a class="bih-button mt-8 inline-flex" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
        </div>
    </section>
@endif
