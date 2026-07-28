@if(!empty($service['formats']))
    <section class="bih-section bg-white">
        <div class="bih-container">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <p class="bih-eyebrow">Program Formats</p>
                    <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">The delivery formats that make this service work in practice</h2>
                </div>
                <p class="hidden text-sm font-bold text-slate-400 sm:block">Scroll to explore &rarr;</p>
            </div>
            <div class="mt-10 -mx-4 flex gap-5 overflow-x-auto px-4 pb-4 sm:mx-0 sm:px-0">
                @foreach($service['formats'] as $format)
                    <article class="bih-card bih-image-card group w-70 flex-none overflow-hidden sm:w-80">
                        <div class="relative h-44 overflow-hidden">
                            <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $format['image'] }}" alt="{{ $format['title'] }} by Bengal IT Hub">
                        </div>
                        <div class="p-5">
                            <h3 class="bih-section-title text-xl">{{ $format['title'] }}</h3>
                            <p class="bih-copy mt-2 text-sm">{{ $format['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
