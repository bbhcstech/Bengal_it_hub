@if(!empty($service['formats']))
    <section class="bih-section">
        <div class="bih-container">
            <div class="max-w-4xl">
                <p class="bih-eyebrow">Program Formats</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">Every format is shaped around a clear purpose and a polished delivery</h2>
                <p class="bih-page-intro mt-5">Each format below can be shaped to fit the audience, scale, and outcome this engagement needs.</p>
            </div>
            <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach($service['formats'] as $format)
                    <article class="bih-card bih-image-card group overflow-hidden">
                        <div class="relative h-52 overflow-hidden">
                            <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $format['image'] }}" alt="{{ $format['title'] }} by Bengal IT Hub">
                            <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-slate-950/16 to-transparent"></div>
                            <span class="absolute bottom-4 left-4 grid h-11 w-11 place-items-center rounded-md bg-white text-teal-700 shadow-lg">
                                @include('partials.icon', ['name' => 'target'])
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="bih-section-title text-2xl">{{ $format['title'] }}</h3>
                            <p class="bih-copy mt-3">{{ $format['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
