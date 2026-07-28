@if(!empty($service['formats']))
    <section class="bih-service-b-formats bih-section bg-slate-50">
        <div class="bih-container">
            <div class="max-w-4xl">
                <p class="bih-eyebrow">Program Formats</p>
                <h2 class="bih-section-title mt-3 text-4xl md:text-5xl">A closer look at how this service comes to life</h2>
                <p class="bih-page-intro mt-5">A practical, step-by-step look at how each format actually delivers on the ground.</p>
            </div>
            <div class="mt-10 grid gap-10">
                @foreach($service['formats'] as $format)
                    <div class="bih-service-b-format grid gap-6 lg:grid-cols-2 lg:items-center">
                        <div class="bih-service-b-format-image overflow-hidden rounded-md shadow-lg {{ $loop->even ? 'lg:order-2' : '' }}">
                            <img class="h-56 w-full object-cover sm:h-64" src="{{ $format['image'] }}" alt="{{ $format['title'] }} by Bengal IT Hub">
                        </div>
                        <div class="bih-service-b-format-copy">
                            <p class="text-xs font-black uppercase tracking-wide text-teal-700">0{{ $loop->iteration }}</p>
                            <h3 class="mt-2 text-2xl font-black text-slate-950">{{ $format['title'] }}</h3>
                            <p class="bih-copy mt-3">{{ $format['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
