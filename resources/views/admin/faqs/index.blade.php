@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Knowledge Base</p>
        <h1>FAQs</h1>
    </div>
</div>
<form method="POST" action="{{ route('admin.faqs.store') }}" class="grid gap-4 rounded-md bg-white p-5 shadow-sm">
    @csrf
    <div class="grid gap-4 md:grid-cols-4">
        <input class="rounded border p-3" name="category" placeholder="Category">
        <input class="rounded border p-3" name="scope" value="site" placeholder="scope: site or hackfest-2026" required>
        <input class="rounded border p-3" type="number" name="sort_order" value="0" placeholder="Order">
        <select class="rounded border p-3" name="status"><option>published</option><option>draft</option></select>
    </div>
    <input class="rounded border p-3" name="question" placeholder="Question" required>
    <textarea class="rounded border p-3" name="answer" placeholder="Answer" required></textarea>
    <button class="w-fit rounded bg-teal-700 px-4 py-2 font-bold text-white">Add FAQ</button>
</form>
<div class="mt-6 grid gap-4">
    @foreach($faqs as $faq)
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="grid gap-3 rounded-md bg-white p-5 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-3 md:grid-cols-4">
                <input class="rounded border p-3" name="category" value="{{ $faq->category }}">
                <input class="rounded border p-3" name="scope" value="{{ $faq->scope }}" required>
                <input class="rounded border p-3" type="number" name="sort_order" value="{{ $faq->sort_order }}">
                <select class="rounded border p-3" name="status"><option @selected($faq->status === 'published')>published</option><option @selected($faq->status === 'draft')>draft</option></select>
            </div>
            <input class="rounded border p-3 font-bold" name="question" value="{{ $faq->question }}" required>
            <textarea class="rounded border p-3" name="answer" required>{{ $faq->answer }}</textarea>
            <div class="flex gap-3"><button class="rounded bg-slate-950 px-4 py-2 font-bold text-white">Save</button></div>
        </form>
    @endforeach
</div>
@endsection
