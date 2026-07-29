@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr]">
        <div>
            <p class="bih-eyebrow">Lead Capture</p>
            <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">{{ $title }}</h1>
            <p class="mt-5 text-xl leading-9 text-slate-600">{{ $intro }}</p>
            <div class="bih-card mt-8 p-6 text-sm leading-7 text-slate-600">
                <strong class="text-slate-950">Office:</strong> {{ $siteBrand['address'] ?? config('bengalhub.brand.address') }}<br>
                <strong class="text-slate-950">Phone:</strong> {{ $siteBrand['phone'] ?? config('bengalhub.brand.phone') }}
            </div>
        </div>
        @if($type === 'participant')
            <div class="bih-card p-8 text-center">
                <p class="bih-eyebrow">Registrations Closed</p>
                <h2 class="mt-3 text-2xl font-black leading-tight text-slate-950 md:text-3xl">The Bengal HackFest PRAGATI 2026 Has Concluded</h2>
                <p class="mt-4 leading-7 text-slate-600">Participant registrations closed on 30 April 2026, and the event has now been held. Thank you to everyone who took part. Registration for the next HackFest is not open yet, follow our channels or reach out below to be notified as soon as it is.</p>
                <div class="mt-7 flex flex-wrap justify-center gap-3">
                    <a class="bih-button" href="/contact?interest=Next+HackFest+Notification">Get Notified for the Next HackFest</a>
                    <a class="bih-button bih-button-secondary" href="/hackfest-2026">Back to Event Overview</a>
                </div>
            </div>
        @else
        <form class="bih-card grid gap-5 p-6" method="POST" action="{{ route('leads.store') }}">
            @csrf
            <input type="hidden" name="form_type" value="{{ $type === 'sponsor' ? 'hackfest_sponsor' : $type }}">
            <input class="hidden" tabindex="-1" autocomplete="off" name="website">
            @if(session('status'))
                <div class="rounded-md bg-teal-50 p-4 font-bold text-teal-800">{{ session('status') }}</div>
            @endif
            <div class="grid gap-2">
                <label class="font-bold" for="name">Name</label>
                <input class="bih-field" id="name" name="name" required value="{{ old('name') }}" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                @error('name')<p id="name-error" class="text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div class="grid gap-2">
                    <label class="font-bold" for="email">Email</label>
                    <input class="bih-field" id="email" name="email" type="email" value="{{ old('email') }}" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                    @error('email')<p id="email-error" class="text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-2">
                    <label class="font-bold" for="phone">Phone</label>
                    <input class="bih-field" id="phone" name="phone" value="{{ old('phone') }}">
                </div>
            </div>
            @if(in_array($type, ['sponsor', 'academic']))
                <div class="grid gap-2">
                    <label class="font-bold" for="{{ $type === 'sponsor' ? 'company' : 'college' }}">{{ $type === 'sponsor' ? 'Company / Organization' : 'College / Institution' }}</label>
                    <input class="bih-field" id="{{ $type === 'sponsor' ? 'company' : 'college' }}" name="{{ $type === 'sponsor' ? 'company' : 'college' }}" value="{{ old($type === 'sponsor' ? 'company' : 'college') }}">
                </div>
            @endif
            <div class="grid gap-2">
                <label class="font-bold" for="subject">Subject / Interest</label>
                <input class="bih-field" id="subject" name="subject" value="{{ old('subject', request('interest')) }}">
            </div>
            <div class="grid gap-2">
                <label class="font-bold" for="message">Message</label>
                <textarea class="bih-field min-h-36" id="message" name="message" placeholder="Tell us what you need">{{ old('message') }}</textarea>
            </div>
            <button class="bih-button justify-self-start" type="submit">Submit Enquiry</button>
        </form>
        @endif
    </div>
</section>
@endsection
