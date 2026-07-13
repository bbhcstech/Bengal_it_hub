@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Publishing</p>
        <h1>Blog Posts</h1>
    </div>
    <a class="rounded bg-teal-700 px-4 py-2 font-bold text-white" href="{{ route('admin.blog.create') }}">Add Post</a>
</div>

<div class="grid gap-4">
    @forelse($posts as $post)
        <a class="rounded-md bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-300" href="{{ route('admin.blog.edit', $post) }}">
            <p class="text-xl font-black">{{ $post->title }}</p>
            <p class="text-sm text-slate-600">{{ $post->category?->name ?? 'Uncategorized' }} &middot; {{ $post->status }}</p>
        </a>
    @empty
        <div class="rounded-md bg-white p-5 text-slate-600 shadow-sm">No posts yet.</div>
    @endforelse
</div>
@endsection
