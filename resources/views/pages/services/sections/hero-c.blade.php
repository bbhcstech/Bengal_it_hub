<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-35" src="{{ $service['image'] }}" alt="{{ $service['title'] }} service at Bengal IT Hub">
    <div class="absolute inset-0 bg-linear-to-l from-slate-950 via-slate-950/90 to-slate-950/48"></div>
    <div class="bih-container relative grid min-h-[68vh] gap-10 py-16 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
        <div class="overflow-hidden rounded-md border border-white/14 shadow-2xl lg:order-1">
            <img class="h-72 w-full object-cover sm:h-96" src="{{ $service['gallery'][0] ?? $service['image'] }}" alt="{{ $service['title'] }} experience">
        </div>
        <div class="lg:order-2 lg:text-right">
            <p class="text-sm font-black uppercase text-amber-300">{{ $service['kicker'] }}</p>
            <h1 class="mt-4 text-5xl font-black leading-tight text-white md:text-7xl">{{ $service['title'] }}</h1>
            <p class="bih-page-intro bih-on-dark mt-6 lg:ml-auto">{{ $service['summary'] }}</p>
            <p class="mt-4 leading-8 text-white/82 lg:ml-auto lg:max-w-xl">{{ $service['body'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3 lg:justify-end">
                <a class="bih-button" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
                <a class="bih-button bih-button-light" href="#service-details">Explore Details</a>
            </div>
        </div>
    </div>

    <div class="relative border-t border-white/10 bg-white/5 py-6 backdrop-blur">
        <div class="bih-container">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                @foreach(($service['stats'] ?? []) as $stat)
                    <div class="text-center">
                        <p class="text-2xl font-black text-amber-300">{{ $stat['value'] }}</p>
                        <p class="text-xs font-black uppercase text-white/70">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-5 flex flex-wrap justify-center gap-2 border-t border-white/10 pt-5">
                @foreach(array_slice($service['audiences'] ?? [], 0, 6) as $audience)
                    <span class="rounded-full bg-white/10 px-3 py-1.5 text-xs font-black uppercase text-white/80">{{ $audience }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
