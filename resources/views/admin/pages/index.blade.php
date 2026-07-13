@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Website Content</p>
        <h1>Pages</h1>
    </div>
</div>

<div class="grid gap-3">
    @foreach($pages as $page)
        <a class="rounded-md bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-300" href="{{ route('admin.pages.edit', $page) }}">
            <p class="font-black">{{ $page->title }}</p>
            <p class="text-sm text-slate-600">/{{ $page->slug }} &middot; {{ $page->status }}</p>
        </a>
    @endforeach
</div>
@endsection
