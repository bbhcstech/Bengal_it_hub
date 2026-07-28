@if(!empty($service['flow']))
    <section class="bih-service-b-flow bih-section bg-slate-50">
        <div class="bih-container">
            <div class="max-w-3xl">
                <p class="bih-eyebrow">How It Works</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">A clear, connected path from start to outcome</h2>
                <p class="bih-page-intro mt-5">Four connected stages, each one building on the last toward a measurable result.</p>
            </div>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($service['flow'] as $item)
                    <div class="bih-service-b-flow-step">
                        <div class="flex items-center gap-3">
                            <span class="bih-service-b-flow-number grid h-12 w-12 flex-none place-items-center rounded-full bg-teal-700 text-lg font-black text-white">{{ $item['step'] }}</span>
                            @if(!$loop->last)
                                <span class="bih-service-b-flow-line hidden h-px flex-1 bg-slate-300 lg:block"></span>
                            @endif
                        </div>
                        <h3 class="mt-4 text-lg font-black text-slate-950">{{ $item['title'] }}</h3>
                        <p class="bih-copy mt-2 text-sm">{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
