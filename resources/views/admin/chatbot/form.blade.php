@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Q&A Rule: '.$item->question : 'Add Chatbot Q&A Rule' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.chatbot.update', $item) : route('admin.chatbot.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Question / Intent *</label>
            <input type="text" class="a-input" name="question" value="{{ old('question', $item->question) }}" required placeholder="e.g. What services do you offer?" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Trigger Keywords (comma separated) *</label>
            <input type="text" class="a-input" name="keywords" value="{{ old('keywords', $item->keywords) }}" required placeholder="e.g. service, offer, product, development, web, mobile" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Automated Reply Answer *</label>
            <textarea class="a-textarea" name="answer" rows="5" required style="width:100%;">{{ old('answer', $item->answer) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Display / Priority Order</label>
                <input type="number" class="a-input" name="order" value="{{ old('order', $item->order ?? 0) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Visibility</label>
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <span>Active rule</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold">Save Q&amp;A Rule</button>
            <a href="{{ route('admin.chatbot.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
