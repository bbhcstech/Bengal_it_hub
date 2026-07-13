@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Overview</p>
        <h1>CMS Dashboard</h1>
    </div>
    <a class="rounded bg-teal-700 px-4 py-2 text-sm font-black text-white" href="{{ route('home') }}" target="_blank" rel="noopener">Open Website</a>
</div>

<div class="grid gap-3 md:grid-cols-4">
    @foreach($counts as $label => $value)
        <div class="rounded-md bg-white p-4 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-500">{{ $label }}</p>
            <div class="mt-2 text-4xl font-black text-slate-950">{{ $value }}</div>
        </div>
    @endforeach
</div>

<div class="mt-5 grid gap-5 lg:grid-cols-[1.05fr_.95fr]">
    <div class="rounded-md bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-3">
            <h2 class="text-xl font-black">Latest Leads</h2>
            <a class="text-sm font-black text-teal-700" href="{{ route('admin.leads') }}">View all</a>
        </div>
        <div class="mt-4 grid gap-3">
            @forelse($leads as $lead)
                <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4">
                    <p class="font-black">{{ $lead->name }} <span class="text-sm text-teal-700">({{ $lead->form_type }})</span></p>
                    <p class="text-sm text-slate-600">{{ $lead->email }} {{ $lead->phone }}</p>
                </div>
            @empty
                <p class="text-slate-600">No leads yet.</p>
            @endforelse
        </div>
    </div>

    <div class="rounded-md bg-white p-6 shadow-sm">
        <h2 class="text-xl font-black">Recent Activity</h2>
        <div class="mt-4 grid gap-3">
            @forelse($activities as $activity)
                <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 text-sm">
                    <p class="font-black">{{ $activity->action }} {{ class_basename($activity->subject_type) }}</p>
                    <p class="text-slate-600">{{ optional($activity->user)->name ?? 'System' }} &middot; {{ $activity->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-slate-600">No activity yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
