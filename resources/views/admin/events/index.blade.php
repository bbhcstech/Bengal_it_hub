@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Event Manager</p>
        <h1>Events</h1>
    </div>
    <a class="rounded bg-teal-700 px-4 py-2 font-bold text-white" href="{{ route('admin.events.create') }}">Add Event</a>
</div>

<div class="grid gap-4">
    @foreach($events as $event)
        <a class="rounded-md bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-300" href="{{ route('admin.events.edit', $event) }}">
            <p class="text-xl font-black">{{ $event->name }}</p>
            <p class="text-sm text-slate-600">/{{ $event->slug }} &middot; {{ $event->status }}</p>
        </a>
    @endforeach
</div>
@endsection
