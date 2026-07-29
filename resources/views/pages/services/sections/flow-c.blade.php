@if(!empty($service['flow']))
    <section class="bih-section bg-white">
        <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:items-start">
            <div class="lg:sticky lg:top-28">
                <p class="bih-eyebrow">How It Works</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Step by step, from where you are to where you want to be</h2>
                <p class="bih-page-intro mt-5">Each stage hands off cleanly into the next, so nothing gets lost between planning and delivery.</p>
            </div>
            <div class="grid gap-0">
                @foreach($service['flow'] as $item)
                    <div class="flex gap-5">
                        <div class="flex flex-col items-center">
                            <span class="grid h-11 w-11 flex-none place-items-center rounded-full bg-teal-700 text-sm font-black text-white">{{ $item['step'] }}</span>
                            @if(!$loop->last)
                                <span class="my-1 w-px flex-1 bg-slate-200"></span>
                            @endif
                        </div>
                        <div class="pb-8 last:pb-0">
                            <h3 class="text-lg font-black text-slate-950">{{ $item['title'] }}</h3>
                            <p class="bih-copy mt-2">{{ $item['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
