@extends('layouts.app')

@php
    $chiefGuest = collect($event['people'])->first(fn ($p) => $p[0] === 'Chief Guest');
    $chiefAdviser = collect($event['people'])->first(fn ($p) => $p[0] === 'Chief Adviser');
    $speakers = collect($event['people'])->filter(fn ($p) => $p[0] === 'Speakers & Panelists')->values();
    $hackFestPath = 'HackFest/';
    $hackFestImage = fn ($file) => asset($hackFestPath.rawurlencode($file));
    $personImages = [
        'Dr. Mahuya Hom Choudhury' => 'Dr.Mahuya Hom Choudhury.png',
        'Mr. Debashis Sen' => 'Debasish_Sen.png',
        'Dr. Pallabi Sengupta' => 'pallabi sengupta image.jpg',
        'Dr. Swastik Nandi' => 'Dr. Swastik.jpeg',
        'Mr. Monoj K. Nath' => 'Monoj Nath.jpeg',
        'Dr. Tanushyam Chattopadhyay' => 'Tanushyam Chattopadhyay.jpg',
        'Adv. Tapojit Dey' => 'Tapojit Dey.jpeg',
        'Mr. Hemanta Ghosh' => 'HEMANTA GHOSH.jpg.jpeg',
        'Dr. Ranjan Ghosh' => 'Dr Ranjan Ghosh.jpeg',
        'Mr. Souvik Das' => 'Souvik Das.jpeg',
    ];
    $personPhoto = fn ($name) => !empty($personImages[$name]) ? $hackFestImage($personImages[$name]) : null;
    $eventLogo = $hackFestImage('Hackathon_Logo_B&W.png');
    $heroTitle = trim(str_replace('PRAGATI 2026', '', $event['name']));
@endphp

@section('content')
<section class="bih-hackfest-hero">
    <div class="bih-container grid min-h-[calc(100vh-5rem)] gap-10 py-14 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
        <div class="relative z-10">
            <p class="text-sm font-black uppercase text-amber-300">{{ $event['badge'] ?? "East India's Premier HackFest" }}</p>
            <h1 class="bih-hackfest-title">
                <span>{{ $heroTitle }}</span>
                <strong>PRAGATI 2026</strong>
            </h1>
            <p class="mt-5 max-w-2xl text-lg font-bold leading-8 text-cyan-50">{{ $event['tagline'] }}</p>
            <div class="bih-hackfest-hero-meta">
                <span>Hosted at {{ $event['venue'] }}</span>
                <span>Grand Finale: {{ $event['finale'] }}</span>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                <a class="bih-button bih-button-light" href="/academic-partnership">Academic Partnership</a>
            </div>
        </div>
        <div class="bih-hackfest-visual-stack">
            <div class="bih-hackfest-logo-panel">
                <img src="{{ $eventLogo }}" alt="The Bengal HackFest PRAGATI 2026 logo">
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach($event['counters'] as $label => $value)
                    <div class="bih-hackfest-stat">
                        <strong>{{ $value }}</strong>
                        <span>{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@if(!empty($event['about']))
<section class="bih-section bih-hackfest-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div class="bih-hackfest-image-frame">
            <img src="{{ $eventLogo }}" alt="Online Hackathon The Bengal HackFest PRAGATI 2026">
        </div>
        <div>
            @include('partials.section-heading', ['eyebrow' => $event['about']['eyebrow'], 'title' => $event['about']['title'], 'intro' => $event['about']['intro']])
            <div class="mt-7 grid gap-3 sm:grid-cols-2">
                @foreach($event['about']['bullets'] as $bullet)
                    <div class="bih-hackfest-check">
                        <span>&#10003;</span>
                        <p>{{ $bullet }}</p>
                    </div>
                @endforeach
            </div>
            <p class="mt-6 max-w-3xl leading-8 text-slate-600">{{ $event['about']['closing'] }}</p>
            <a class="bih-button mt-7 inline-flex" href="/hackfest-2026/register">Join The Fest</a>
        </div>
    </div>
</section>
@endif

@if(!empty($event['participation']))
<section class="bih-section bih-hackfest-band bih-hackfest-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => "Let's Understand", 'title' => 'Why to Participate?', 'intro' => 'Three clear tracks for students, institutes, and corporates to build real value from one innovation platform.'])
        <div class="mt-10 grid items-stretch gap-5 md:grid-cols-3">
            @foreach($event['participation'] as $card)
                <article class="bih-hackfest-track">
                    <p>{{ $card['number'] }}</p>
                    <h3>{{ $card['title'] }}</h3>
                    <ul>
                        @foreach($card['bullets'] as $bullet)
                            <li>{{ $bullet }}</li>
                        @endforeach
                    </ul>
                    <a href="/contact">Learn More</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="bih-hackfest-section py-16">
    <div class="bih-container grid gap-10 lg:grid-cols-[.88fr_1.12fr]">
        <div>
            @include('partials.section-heading', ['eyebrow' => 'The Bengal HackFest PRAGATI 2026', 'title' => 'Event Timeline'])
            <div class="mt-8 grid gap-4">
                @foreach($event['timeline'] as [$label, $date, $isOpen])
                    <div class="bih-hackfest-timeline">
                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <p>{{ $label }} @if($isOpen)<em>Open</em>@endif</p>
                            <strong>{{ $date }}</strong>
                        </div>
                    </div>
                @endforeach
                <div class="bih-hackfest-timeline">
                    <span>05</span>
                    <div>
                        <p>Venue</p>
                        <strong>{{ $event['venue'] }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid content-start gap-6">
            @if($chiefGuest)
                <article id="guest" class="bih-hackfest-feature-person">
                    @if($personPhoto($chiefGuest[1]))
                        <img src="{{ $personPhoto($chiefGuest[1]) }}" alt="{{ $chiefGuest[1] }}">
                    @endif
                    <div>
                        <p class="bih-eyebrow">The Chief Guest</p>
                        <h3>{{ $chiefGuest[1] }}</h3>
                        <p>As the distinguished Chief Guest of honor, she will deliver the keynote address, represent the event's highest office, and engage with attendees on strategic themes.</p>
                        <p>{{ $chiefGuest[2] }}</p>
                        @if(!empty($chiefGuest[3]))
                            <a href="{{ $chiefGuest[3] }}" target="_blank" rel="noopener">LinkedIn</a>
                        @endif
                    </div>
                </article>
            @endif
            @if($chiefAdviser)
                <article id="adviser" class="bih-hackfest-feature-person">
                    @if($personPhoto($chiefAdviser[1]))
                        <img src="{{ $personPhoto($chiefAdviser[1]) }}" alt="{{ $chiefAdviser[1] }}">
                    @endif
                    <div>
                        <p class="bih-eyebrow">The Chief Adviser</p>
                        <h3>{{ $chiefAdviser[1] }}</h3>
                        <p>As the Chief Adviser, he is providing strategic guidance on program direction, partnerships, and high-level decision-making, ensuring alignment with the event's goals.</p>
                        <p>{{ $chiefAdviser[2] }}</p>
                        @if(!empty($chiefAdviser[3]))
                            <a href="{{ $chiefAdviser[3] }}" target="_blank" rel="noopener">LinkedIn</a>
                        @endif
                    </div>
                </article>
            @endif
        </div>
    </div>
</section>

@if($speakers->isNotEmpty())
<section class="bih-section bih-hackfest-panelists" id="panelists">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'People', 'title' => 'The Speakers & Panelists', 'intro' => "A polished showcase of the event's expert speakers, panelists, and industry leaders."])
        <div class="mt-10 grid items-stretch gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($speakers as [$role, $name, $bio, $linkedin])
                <article class="bih-hackfest-person-card">
                    @if($personPhoto($name))
                        <img src="{{ $personPhoto($name) }}" alt="{{ $name }}">
                    @else
                        <div class="bih-hackfest-person-fallback">{{ collect(explode(' ', $name))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}</div>
                    @endif
                    <div>
                        <p>{{ $role }}</p>
                        <h3>{{ $name }}</h3>
                        <p>{{ $bio }}</p>
                        @if(!empty($linkedin))
                            <a href="{{ $linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!empty($event['sponsorship']))
<section class="bih-hackfest-section py-16">
    <div class="bih-container grid gap-8 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
        <div class="bih-hackfest-sponsor-panel">
            <p class="bih-eyebrow">Sponsorship Categories</p>
            <h2>Partner with East India's student innovation stage.</h2>
            <div class="mt-5 flex flex-wrap gap-2">
                @foreach($event['sponsorship']['tiers'] as $tier)
                    <span>{{ $tier }}</span>
                @endforeach
            </div>
            <p class="bih-eyebrow mt-7">Partnership Categories</p>
            <div class="mt-5 flex flex-wrap gap-2">
                @foreach($event['sponsorship']['partnerTiers'] as $tier)
                    <span class="is-amber">{{ $tier }}</span>
                @endforeach
            </div>
        </div>
        <div class="grid gap-4">
            <a class="bih-button" href="{{ $event['sponsorship']['brochureUrl'] }}">Download Sponsorship Brochure</a>
            <a class="bih-button bih-button-secondary" href="{{ $event['sponsorship']['scheduleUrl'] }}">Schedule Partnership Discussion</a>
        </div>
    </div>
</section>
@endif

@if(!empty($event['whoShouldJoin']) || !empty($event['whyMatters']))
<section class="bih-section bih-hackfest-band bih-hackfest-section">
    <div class="bih-container grid gap-10 lg:grid-cols-2">
        <div>
            @include('partials.section-heading', ['eyebrow' => 'Ecosystem', 'title' => 'Who Should Join?'])
            <div class="mt-8 grid gap-5">
                @foreach($event['whoShouldJoin'] as $card)
                    <article class="bih-hackfest-track">
                        <h3>{{ $card['title'] }}</h3>
                        @if($card['description'])
                            <p class="mt-2 leading-7 text-slate-600">{{ $card['description'] }}</p>
                        @endif
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($card['tags'] as $tag)
                                <span class="rounded-full bg-white px-3 py-1 text-xs font-extrabold text-slate-700 shadow-sm">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="bih-hackfest-matter">
            @include('partials.section-heading', ['eyebrow' => 'Bigger Picture', 'title' => 'Why This Matters?'])
            @foreach($event['whyMatters'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!empty($event['registerCtas']))
<section class="bih-section bih-hackfest-section" id="register">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Get Involved', 'title' => 'Register to Participate'])
        <div class="mt-10 grid items-stretch gap-5 md:grid-cols-3">
            @foreach($event['registerCtas'] as $cta)
                <article class="bih-hackfest-register-card">
                    <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $cta['role'] }}</h3>
                    <p>{{ $cta['description'] }}</p>
                    <a class="bih-button mt-5 inline-flex" href="{{ $cta['href'] }}" @if(str_starts_with($cta['href'], 'http')) target="_blank" rel="noopener" @endif>Register Now</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="bih-section bih-hackfest-venue-section" id="venue">
    <div class="bih-container grid gap-8 lg:grid-cols-[.95fr_1.05fr] lg:items-start">
        <div class="bih-hackfest-venue">
            @if(!empty($event['venueDetails']['tags']))
                <div class="flex flex-wrap gap-2">
                    @foreach($event['venueDetails']['tags'] as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
            @include('partials.section-heading', ['eyebrow' => 'Hosted at', 'title' => $event['venueDetails']['name'] ?? $event['venue'], 'intro' => 'Grand Finale: '.$event['finale']])
            @if(!empty($event['venueDetails']))
                <p class="mt-2 font-bold text-slate-700">{{ $event['venueDetails']['campus'] }}, {{ $event['venueDetails']['address'] }}</p>
                <p class="mt-3 leading-7 text-slate-600">{{ $event['venueDetails']['description'] }}</p>
            @endif
            <div class="mt-6 flex flex-wrap gap-3">
                <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
                <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
                <a class="bih-button bih-button-secondary" href="/academic-partnership">Academic Partnership</a>
            </div>
        </div>
        <div class="bih-hackfest-faq" id="faq">
            <h2>HackFest FAQ</h2>
            <div>
                @foreach($event['faqs'] as [$question, $answer])
                    <details>
                        <summary>{{ $question }}</summary>
                        <p>{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </div>
</section>

@if($partners->isNotEmpty())
<section class="bih-hackfest-section py-16">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Partners', 'title' => 'People Who Are Supporting Us', 'intro' => $event['supportersNote'] ?? null])
        <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach($partners as $partner)
                <div class="rounded-md border border-slate-200 bg-white p-5 text-center font-extrabold shadow-sm">{{ $partner->name }}</div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="bih-section bih-hackfest-band">
    <div class="bih-container">
        <div class="bih-hackfest-contact">
            <img src="{{ $eventLogo }}" alt="Hackathon fest The Bengal HackFest PRAGATI 2026">
            <div>
                @include('partials.section-heading', ['eyebrow' => 'Support', 'title' => 'Still Have Questions?'])
                <p>Email us at: {{ $siteBrand['email'] ?? config('bengalhub.brand.email') }}</p>
                <p>Call / WhatsApp: {{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}</p>
                <p>Or click below to contact us, and our team will reply back asap.</p>
                <a class="bih-button mt-6 inline-flex" href="/contact">Contact Now</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('schema')
    {{--
        Event.startDate must be ISO 8601 per Google's Event structured data
        requirements — "20 April 2026" is not valid and would fail the Rich
        Results Test. Parsed to a date-only ISO string since only the day,
        not a specific time, is known.
    --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $event['name'],
            'description' => $event['tagline'],
            'startDate' => \Carbon\Carbon::parse($event['finale'])->toDateString(),
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'eventStatus' => 'https://schema.org/EventScheduled',
            'location' => [
                '@type' => 'Place',
                'name' => $event['venueDetails']['name'] ?? $event['venue'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $event['venueDetails']['campus'] ?? $event['venue'],
                    'addressLocality' => 'Kolkata',
                    'addressRegion' => 'West Bengal',
                    'addressCountry' => 'IN',
                ],
            ],
            'organizer' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => $event['name'], 'url' => url()->current()],
    ]])
    @if(!empty($event['faqs']))
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
    @endif
@endpush
