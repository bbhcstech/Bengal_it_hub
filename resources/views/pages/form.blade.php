@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container grid gap-10 lg:grid-cols-[.85fr_1.15fr]">
        <div>
            <p class="bih-eyebrow">Lead Capture</p>
            <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">{{ $title }}</h1>
            <p class="mt-5 text-xl leading-9 text-slate-600">{{ $intro }}</p>
            <div class="bih-card mt-8 p-6 text-sm leading-7 text-slate-600">
                <strong class="text-slate-950">Office:</strong> {{ config('bengalhub.brand.address') }}<br>
                <strong class="text-slate-950">Phone:</strong> {{ config('bengalhub.brand.phone') }}
            </div>
        </div>
        <form class="bih-card grid gap-5 p-6" method="POST" action="{{ route('leads.store') }}">
            @csrf
            <input type="hidden" name="form_type" value="{{ $type === 'participant' ? 'hackfest_participant' : ($type === 'sponsor' ? 'hackfest_sponsor' : $type) }}">
            <input class="hidden" tabindex="-1" autocomplete="off" name="website">
            @if(session('status'))
                <div class="rounded-md bg-teal-50 p-4 font-bold text-teal-800">{{ session('status') }}</div>
            @endif
            <div class="grid gap-2">
                <label class="font-bold" for="name">Name</label>
                <input class="bih-field" id="name" name="name" required value="{{ old('name') }}">
                @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div class="grid gap-2">
                    <label class="font-bold" for="email">Email</label>
                    <input class="bih-field" id="email" name="email" type="email" value="{{ old('email') }}">
                </div>
                <div class="grid gap-2">
                    <label class="font-bold" for="phone">Phone</label>
                    <input class="bih-field" id="phone" name="phone" value="{{ old('phone') }}">
                </div>
            </div>
            @if($type === 'participant')
                <div class="grid gap-5 md:grid-cols-2">
                    <input class="bih-field" name="college" placeholder="College / Institute">
                    <input class="bih-field" name="team_size" type="number" min="1" max="10" placeholder="Team size">
                </div>
            @endif
            @if(in_array($type, ['sponsor', 'academic']))
                <input class="bih-field" name="{{ $type === 'sponsor' ? 'company' : 'college' }}" placeholder="{{ $type === 'sponsor' ? 'Company / Organization' : 'College / Institution' }}">
            @endif
            <input class="bih-field" name="subject" placeholder="Subject / Interest" value="{{ request('interest') }}">
            <textarea class="bih-field min-h-36" name="message" placeholder="Tell us what you need"></textarea>
            <button class="bih-button justify-self-start" type="submit">Submit Enquiry</button>
        </form>
    </div>
</section>
@endsection
