@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Services', 'title' => 'Services Built For Growth, Talent, And Execution', 'intro' => 'The WordPress service pages are now consolidated into one reusable Laravel service template with clean URLs and SEO metadata.'])
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $slug => $service)
                <a class="bih-card block p-6 transition hover:-translate-y-1 hover:border-teal-500" href="/{{ $slug }}">
                    <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
                    <h2 class="mt-3 text-2xl font-black">{{ $service['title'] }}</h2>
                    <p class="mt-3 leading-7 text-slate-600">{{ $service['summary'] }}</p>
                    <span class="mt-5 inline-flex font-extrabold text-teal-700">Learn more</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
