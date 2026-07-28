@extends('layouts.app')

@section('content')
<section class="bih-section bg-white">
    <div class="bih-container">
        <a class="bih-link" href="/hackfest-2026">&larr; Back to The Bengal HackFest PRAGATI 2026</a>
        <div class="mt-4 max-w-3xl">
            @include('partials.section-heading', ['eyebrow' => 'Support', 'title' => 'HackFest FAQ', 'intro' => 'Answers to the most common questions about The Bengal HackFest PRAGATI 2026, from registration to judging and sponsorship.'])
            <div class="mt-6 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
                <a class="inline-flex min-h-11 items-center justify-center rounded-md border-2 border-teal-700 px-4 py-3 font-extrabold text-teal-700 transition hover:bg-teal-700 hover:text-white" href="/contact">Still Have Questions?</a>
            </div>
        </div>

        <div class="mt-10 grid gap-4 lg:grid-cols-2">
            @foreach($event['faqs'] as [$question, $answer])
                <details class="rounded-md border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer font-black text-slate-950">{{ $question }}</summary>
                    <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($event['faqs'])->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
