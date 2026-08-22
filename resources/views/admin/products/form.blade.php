@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $product->exists ? 'Edit Product: '.$product->name : 'Add New Product' }}</h1>
</div>

<div class="a-card" style="max-width:800px;">
    <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @if($product->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Product Name *</label>
            <input type="text" class="a-input" name="name" value="{{ old('name', $product->name) }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">URL Slug</label>
            <input type="text" class="a-input" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="auto-generated-from-name" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Tagline</label>
            <input type="text" class="a-input" name="tagline" value="{{ old('tagline', $product->tagline) }}" placeholder="e.g. Enterprise AI Powered CRM Platform" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Description</label>
            <textarea class="a-textarea" name="description" rows="5" style="width:100%;">{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Product Screenshot / Logo Image</label>
            @if($product->image)
                <div style="margin-bottom:8px;"><img src="{{ asset('storage/'.$product->image) }}" alt="Preview" style="max-height:80px;border-radius:6px;"></div>
            @endif
            <input type="file" class="a-input" name="image" accept="image/*" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">External Product URL (optional)</label>
            <input type="url" class="a-input" name="external_url" value="{{ old('external_url', $product->external_url) }}" placeholder="https://..." style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Display Order</label>
                <input type="number" class="a-input" name="order" value="{{ old('order', $product->order ?? 0) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Visibility</label>
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                    <span>Visible on public site</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold">Save Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
