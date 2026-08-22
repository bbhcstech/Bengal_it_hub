@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Process Step: '.$item->title : 'Add Process Step' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.process-steps.update', $item) : route('admin.process-steps.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 2fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Step Number *</label>
                <input type="number" class="a-input" name="step_number" value="{{ old('step_number', $item->step_number ?? 1) }}" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Title *</label>
                <input type="text" class="a-input" name="title" value="{{ old('title', $item->title) }}" required style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Description</label>
            <textarea class="a-textarea" name="description" rows="4" style="width:100%;">{{ old('description', $item->description) }}</textarea>
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
            <button type="submit" class="btn btn-gold">Save Step</button>
            <a href="{{ route('admin.process-steps.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
