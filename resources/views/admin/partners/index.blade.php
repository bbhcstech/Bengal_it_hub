@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Partner Network</p>
        <h1>Partners</h1>
    </div>
</div>
<form method="POST" action="{{ route('admin.partners.store') }}" class="grid gap-4 rounded-md bg-white p-5 shadow-sm">
    @csrf
    <div class="grid gap-4 md:grid-cols-3">
        <input class="rounded border p-3" name="name" placeholder="Company name" required>
        <input class="rounded border p-3" name="slug" placeholder="Slug (optional, auto-generated)">
        <input class="rounded border p-3" name="logo" placeholder="Logo URL/path">
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <input class="rounded border p-3" name="address" placeholder="Location / address">
        <input class="rounded border p-3" name="link_url" placeholder="Website / link URL">
    </div>
    <textarea class="rounded border p-3" name="description" rows="3" placeholder="What this partner works on"></textarea>
    <div class="grid gap-4 md:grid-cols-2">
        <textarea class="rounded border p-3" name="projects_text" rows="3" placeholder="Projects (one per line)"></textarea>
        <textarea class="rounded border p-3" name="products_text" rows="3" placeholder="Products (one per line)"></textarea>
    </div>
    <div class="grid gap-4 md:grid-cols-4">
        <input class="rounded border p-3" name="clients_count" placeholder="Total clients (e.g. 500+)">
        <input class="rounded border p-3" name="employees_count" placeholder="Total employees (e.g. 200+)">
        <input class="rounded border p-3" name="scope" value="home" placeholder="Scope">
        <input class="rounded border p-3" type="number" name="sort_order" value="0" placeholder="Sort order">
    </div>
    <select class="rounded border p-3" name="status"><option>published</option><option>draft</option></select>
    <button class="w-fit rounded bg-teal-700 px-4 py-2 font-bold text-white">Add Partner</button>
</form>
<div class="mt-6 grid gap-4">
    @foreach($partners as $partner)
        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" class="grid gap-3 rounded-md bg-white p-5 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-3 md:grid-cols-3">
                <input class="rounded border p-3" name="name" value="{{ $partner->name }}" required>
                <input class="rounded border p-3" name="slug" value="{{ $partner->slug }}" placeholder="Slug">
                <input class="rounded border p-3" name="logo" value="{{ $partner->logo }}" placeholder="Logo URL/path">
            </div>
            <div class="grid gap-3 md:grid-cols-2">
                <input class="rounded border p-3" name="address" value="{{ $partner->address }}" placeholder="Location / address">
                <input class="rounded border p-3" name="link_url" value="{{ $partner->link_url }}" placeholder="Website / link URL">
            </div>
            <textarea class="rounded border p-3" name="description" rows="3" placeholder="What this partner works on">{{ $partner->description }}</textarea>
            <div class="grid gap-3 md:grid-cols-2">
                <textarea class="rounded border p-3" name="projects_text" rows="3" placeholder="Projects (one per line)">{{ implode("\n", $partner->projects ?? []) }}</textarea>
                <textarea class="rounded border p-3" name="products_text" rows="3" placeholder="Products (one per line)">{{ implode("\n", $partner->products ?? []) }}</textarea>
            </div>
            <div class="grid gap-3 md:grid-cols-4">
                <input class="rounded border p-3" name="clients_count" value="{{ $partner->clients_count }}" placeholder="Total clients (e.g. 500+)">
                <input class="rounded border p-3" name="employees_count" value="{{ $partner->employees_count }}" placeholder="Total employees (e.g. 200+)">
                <input class="rounded border p-3" name="scope" value="{{ $partner->scope }}" placeholder="Scope">
                <input class="rounded border p-3" type="number" name="sort_order" value="{{ $partner->sort_order }}" placeholder="Sort order">
            </div>
            <select class="rounded border p-3" name="status"><option @selected($partner->status === 'published')>published</option><option @selected($partner->status === 'draft')>draft</option></select>
            <div class="flex items-center justify-between gap-3">
                <button class="w-fit rounded bg-slate-950 px-4 py-2 font-bold text-white">Save</button>
                @if($partner->slug)
                    <a class="text-sm font-bold text-teal-700" href="{{ route('our-partners.show', $partner->slug) }}" target="_blank" rel="noopener">View Public Page &rarr;</a>
                @endif
            </div>
        </form>
    @endforeach
</div>
@endsection
