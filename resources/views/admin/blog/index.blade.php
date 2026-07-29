@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Publishing</p>
        <h1>Blog Posts</h1>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Use categories as public blog sections, such as Birthday Celebrations, Functional Posts, Interview Posts, and New Joiner Posts.</p>
    </div>
    <a class="rounded bg-teal-700 px-4 py-2 font-bold text-white" href="{{ route('admin.blog.create') }}">Add Post</a>
</div>

<div class="mb-6 grid gap-5 lg:grid-cols-[1fr_.42fr]">
    <div class="rounded-md bg-white p-5 shadow-sm">
        <p class="text-sm font-black uppercase text-teal-700">Available Blog Sections</p>
        <div class="mt-4 flex flex-wrap gap-2">
            @forelse($categories as $category)
                <span class="rounded-full border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-black text-slate-700">{{ $category->name }}</span>
            @empty
                <span class="text-sm font-bold text-slate-500">No sections yet.</span>
            @endforelse
        </div>
    </div>

    <form method="POST" action="{{ route('admin.blog.categories.store') }}" class="rounded-md bg-white p-5 shadow-sm">
        @csrf
        <p class="text-sm font-black uppercase text-teal-700">Add New Section</p>
        <input class="mt-4 w-full rounded border p-3 font-bold" name="name" placeholder="Section name, e.g. Client Visit">
        <input class="mt-3 w-full rounded border p-3" name="slug" placeholder="Optional slug">
        <button class="mt-4 rounded bg-slate-950 px-4 py-2.5 font-black text-white">Create Section</button>
    </form>
</div>

<div class="grid gap-4">
    @forelse($posts as $post)
        <a class="grid gap-4 rounded-md bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-300 md:grid-cols-[96px_1fr]" href="{{ route('admin.blog.edit', $post) }}">
            @if($post->featured_image)
                <img class="h-24 w-full rounded-md object-cover" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
            @else
                <span class="grid h-24 w-full place-items-center rounded-md bg-slate-100 text-2xl font-black text-slate-500">{{ Str::substr($post->title, 0, 1) }}</span>
            @endif
            <span>
                <span class="block text-xl font-black">{{ $post->title }}</span>
                <span class="mt-1 block text-sm text-slate-600">{{ $post->category?->name ?? 'Uncategorized' }} &middot; {{ $post->status }} @if($post->published_at)&middot; {{ $post->published_at->format('d M Y') }}@endif</span>
                <span class="mt-2 block text-sm leading-6 text-slate-500">{{ Str::limit(strip_tags($post->body), 140) }}</span>
            </span>
        </a>
    @empty
        <div class="rounded-md bg-white p-5 text-slate-600 shadow-sm">No posts yet.</div>
    @endforelse
</div>
@endsection
