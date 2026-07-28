<section class="relative overflow-hidden bg-slate-950 text-white">
    <img class="absolute inset-0 h-full w-full object-cover opacity-40" src="{{ $service['image'] }}" alt="{{ $service['title'] }} service at Bengal IT Hub">
    <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/90 to-slate-950/48"></div>
    <div class="bih-container relative grid min-h-[78vh] gap-10 py-16 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div>
            <p class="text-sm font-black uppercase text-amber-300">{{ $service['kicker'] }}</p>
            <h1 class="mt-4 max-w-4xl text-5xl font-black leading-tight text-white md:text-7xl">{{ $service['title'] }}</h1>
            <p class="bih-page-intro bih-on-dark mt-6">{{ $service['summary'] }}</p>
            <p class="mt-4 max-w-3xl leading-8 text-white/82">{{ $service['body'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
                <a class="bih-button bih-button-light" href="#service-details">Explore Details</a>
            </div>
        </div>

        <div class="grid gap-4">
            <div class="bih-service-hero-visual">
                <img class="h-72 w-full object-cover sm:h-96" src="{{ $service['gallery'][0] ?? $service['image'] }}" alt="{{ $service['title'] }} experience">
                <div class="bih-service-hero-stats">
                    @foreach(($service['stats'] ?? []) as $stat)
                        <div class="bih-service-hero-stat-card">
                            <p>{{ $stat['value'] }}</p>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="grid gap-3 rounded-md border border-white/14 bg-white/10 p-4 backdrop-blur sm:grid-cols-3">
                @foreach(array_slice($service['audiences'] ?? [], 0, 6) as $audience)
                    <div class="rounded-md bg-white/12 px-3 py-2 text-center text-xs font-black uppercase text-white/88">{{ $audience }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>
