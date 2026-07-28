@if(!empty($service['flow']))
    <section class="bg-white py-16">
        <div class="bih-container">
            <div class="grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:items-start">
                <div>
                    <p class="bih-eyebrow">How It Works</p>
                    <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">From first conversation to measurable impact</h2>
                    <p class="bih-page-intro mt-5">A clear operating rhythm that takes this engagement from kickoff to outcome without guesswork.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($service['flow'] as $item)
                        <article class="rounded-md border border-slate-200 bg-slate-50 p-5 shadow-sm">
                            <p class="text-2xl font-black text-teal-700">{{ $item['step'] }}</p>
                            <h3 class="mt-3 text-xl font-black text-slate-950">{{ $item['title'] }}</h3>
                            <p class="bih-copy mt-2 text-sm">{{ $item['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
