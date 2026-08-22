@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Differentiator: '.$item->title : 'Add Differentiator' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.differentiators.update', $item) : route('admin.differentiators.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Title *</label>
            <input type="text" class="a-input" name="title" value="{{ old('title', $item->title) }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Description</label>
            <textarea class="a-textarea" name="description" rows="4" style="width:100%;">{{ old('description', $item->description) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Icon Name (SVG or Heroicon name)</label>
            <input type="text" class="a-input" name="icon" value="{{ old('icon', $item->icon) }}" placeholder="e.g. cpu, shield-check, zap" style="width:100%;">
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
            <button type="submit" class="btn btn-gold">Save Differentiator</button>
            <a href="{{ route('admin.differentiators.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
