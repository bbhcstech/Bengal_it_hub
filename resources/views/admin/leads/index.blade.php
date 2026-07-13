@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Customer Requests</p>
        <h1>Leads Inbox</h1>
    </div>
    <a class="rounded bg-slate-950 px-4 py-2 font-bold text-white" href="{{ route('admin.leads.export') }}">Export CSV</a>
</div>

<form class="flex flex-wrap gap-3 rounded-md bg-white p-4 shadow-sm">
    <select class="min-w-48 rounded border p-3" name="form_type">
        <option value="">All forms</option>
        @foreach($formTypes as $type)
            <option value="{{ $type }}" @selected(request('form_type') === $type)>{{ $type }}</option>
        @endforeach
    </select>
    <select class="min-w-44 rounded border p-3" name="status">
        <option value="">All statuses</option>
        @foreach(['new','contacted','closed'] as $status)
            <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
        @endforeach
    </select>
    <button class="rounded bg-teal-700 px-4 py-2 font-bold text-white">Filter</button>
</form>

<div class="mt-6 grid gap-4">
    @foreach($leads as $lead)
        <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="rounded-md bg-white p-5 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-4 lg:grid-cols-[1fr_260px]">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="text-xl font-black">{{ $lead->name }}</p>
                        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-black uppercase text-amber-800">{{ $lead->status }}</span>
                    </div>
                    <p class="mt-2 text-sm font-semibold text-slate-600">{{ $lead->form_type }} &middot; {{ $lead->email }} &middot; {{ $lead->phone }} &middot; {{ $lead->created_at->format('d M Y H:i') }}</p>
                    @if($lead->subject)<p class="mt-3 font-bold">{{ $lead->subject }}</p>@endif
                    @if($lead->message)<p class="mt-2 text-slate-700">{{ $lead->message }}</p>@endif
                    @if($lead->payload)<pre class="mt-3 overflow-auto rounded-lg bg-slate-100 p-3 text-xs">{{ json_encode($lead->payload, JSON_PRETTY_PRINT) }}</pre>@endif
                </div>
                <div class="grid gap-3">
                    <select class="rounded border p-3" name="status">
                        @foreach(['new','contacted','closed'] as $status)
                            <option @selected($lead->status === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    <textarea class="min-h-28 rounded border p-3" name="notes" placeholder="Internal notes">{{ $lead->notes }}</textarea>
                    <button class="rounded bg-slate-950 px-4 py-2 font-bold text-white">Update</button>
                </div>
            </div>
        </form>
    @endforeach
</div>
<div class="mt-6">{{ $leads->links() }}</div>
@endsection
