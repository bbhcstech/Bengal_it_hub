@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Technology: '.$item->name : 'Add Tech Stack Item' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.tech-stack.update', $item) : route('admin.tech-stack.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Technology Name *</label>
            <input type="text" class="a-input" name="name" value="{{ old('name', $item->name) }}" required placeholder="e.g. Laravel, React, Docker, AWS" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Category *</label>
            <select class="a-select" name="category" required style="width:100%;">
                <option value="frontend" {{ old('category', $item->category) === 'frontend' ? 'selected' : '' }}>Frontend</option>
                <option value="backend" {{ old('category', $item->category ?? 'backend') === 'backend' ? 'selected' : '' }}>Backend</option>
                <option value="cloud_devops" {{ old('category', $item->category) === 'cloud_devops' ? 'selected' : '' }}>Cloud &amp; DevOps</option>
                <option value="database" {{ old('category', $item->category) === 'database' ? 'selected' : '' }}>Database &amp; Data</option>
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Logo Image</label>
            @if($item->logo)
                <div style="margin-bottom:8px;"><img src="{{ asset('storage/'.$item->logo) }}" alt="Logo" style="max-height:40px;"></div>
            @endif
            <input type="file" class="a-input" name="logo" accept="image/*" style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Display Order</label>
                <input type="number" class="a-input" name="order" value="{{ old('order', $item->order ?? 0) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Visibility</label>
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <span>Active on site</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold">Save Technology</button>
            <a href="{{ route('admin.tech-stack.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
