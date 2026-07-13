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
    <div class="grid gap-4 md:grid-cols-3"><input class="rounded border p-3" name="name" placeholder="Name" required><input class="rounded border p-3" name="logo" placeholder="Logo URL/path"><input class="rounded border p-3" name="link_url" placeholder="Link URL"></div>
    <div class="grid gap-4 md:grid-cols-3"><input class="rounded border p-3" name="scope" value="home"><input class="rounded border p-3" type="number" name="sort_order" value="0"><select class="rounded border p-3" name="status"><option>published</option><option>draft</option></select></div>
    <button class="w-fit rounded bg-teal-700 px-4 py-2 font-bold text-white">Add Partner</button>
</form>
<div class="mt-6 grid gap-4">
    @foreach($partners as $partner)
        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" class="grid gap-3 rounded-md bg-white p-5 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-3 md:grid-cols-3"><input class="rounded border p-3" name="name" value="{{ $partner->name }}" required><input class="rounded border p-3" name="logo" value="{{ $partner->logo }}"><input class="rounded border p-3" name="link_url" value="{{ $partner->link_url }}"></div>
            <div class="grid gap-3 md:grid-cols-3"><input class="rounded border p-3" name="scope" value="{{ $partner->scope }}"><input class="rounded border p-3" type="number" name="sort_order" value="{{ $partner->sort_order }}"><select class="rounded border p-3" name="status"><option @selected($partner->status === 'published')>published</option><option @selected($partner->status === 'draft')>draft</option></select></div>
            <button class="w-fit rounded bg-slate-950 px-4 py-2 font-bold text-white">Save</button>
        </form>
    @endforeach
</div>
@endsection
