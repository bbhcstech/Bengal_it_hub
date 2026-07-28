<section class="bih-service-b-hero bg-white pt-12 pb-10 md:pt-16">
    <div class="bih-container grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-center">
        <div class="lg:col-span-7">
            <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
            <h1 class="bih-page-title mt-4 text-5xl md:text-6xl">{{ $service['title'] }}</h1>
            <p class="bih-page-intro mt-5">{{ $service['summary'] }}</p>
            <p class="bih-copy mt-4">{{ $service['body'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
                <a class="inline-flex min-h-11 items-center justify-center rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="#service-details">Explore Details</a>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="bih-card bih-service-b-showcase overflow-hidden">
                <img class="bih-service-b-showcase-image h-40 w-full object-cover" src="{{ $service['image'] }}" alt="{{ $service['title'] }} at Bengal IT Hub">
                <div class="bih-service-b-stats grid grid-cols-3 gap-3 p-5">
                    @foreach(($service['stats'] ?? []) as $stat)
                        <div class="bih-service-b-stat text-center">
                            <p class="text-xl font-black leading-tight text-teal-700">{{ $stat['value'] }}</p>
                            <p class="mt-1 text-[.65rem] font-black uppercase leading-snug text-slate-500">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="bih-service-b-audiences grid grid-cols-2 gap-2 border-t border-slate-100 p-4">
                    @foreach(array_slice($service['audiences'] ?? [], 0, 6) as $audience)
                        <div class="bih-service-b-audience rounded-md bg-slate-50 px-2 py-2 text-center text-[.68rem] font-black uppercase text-slate-600">{{ $audience }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
