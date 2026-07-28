@if(!empty($service['outcomes']))
    <section class="bg-slate-950 py-16 text-white">
        <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:items-center">
            <div>
                <p class="text-sm font-black uppercase text-amber-300">Expected Outcomes</p>
                <h2 class="mt-3 text-4xl font-black leading-tight text-white md:text-5xl">Real outcomes that go beyond the delivery itself</h2>
                <p class="mt-5 leading-8 text-white/82">The result is not just a service. It is a repeatable capability that keeps paying off long after delivery.</p>
                <a class="bih-button mt-8" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($service['outcomes'] as $outcome)
                    <div class="flex items-start gap-3 rounded-md border border-white/12 bg-white/8 p-4">
                        <span class="mt-0.5 grid h-6 w-6 flex-none place-items-center rounded-full bg-teal-400 text-slate-950">
                            @include('partials.icon', ['name' => 'check', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold leading-7 text-white/84">{{ $outcome }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
