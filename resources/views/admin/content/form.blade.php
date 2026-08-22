@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>Add New Block to {{ Str::headline($page) }} Page</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ route('admin.content.store', $page) }}">
        @csrf

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Human Readable Label *</label>
            <input type="text" class="a-input" name="label" value="{{ old('label') }}" required placeholder="e.g. Hero Section Headline" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Section Key (unique variable name) *</label>
            <input type="text" class="a-input" name="section_key" value="{{ old('section_key') }}" required placeholder="e.g. hero_headline" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Field Type *</label>
            <select class="a-select" name="type" required style="width:100%;">
                <option value="text">Single Line Text</option>
                <option value="textarea">Multi-line Textarea</option>
                <option value="richtext">Rich Text / HTML</option>
                <option value="image">Image Upload / URL</option>
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Initial Content / Default Value</label>
            <textarea class="a-textarea" name="content" rows="4" style="width:100%;">{{ old('content') }}</textarea>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Display Order</label>
            <input type="number" class="a-input" name="order" value="{{ old('order', 0) }}" style="width:100%;">
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold">Add Block</button>
            <a href="{{ route('admin.content.index', $page) }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
