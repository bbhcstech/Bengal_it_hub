@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Project: '.$item->title : 'Add Portfolio Project' }}</h1>
</div>

<div class="a-card" style="max-width:850px;">
    <form method="POST" action="{{ $item->exists ? route('admin.portfolio.update', $item) : route('admin.portfolio.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Project Title *</label>
            <input type="text" class="a-input" name="title" value="{{ old('title', $item->title) }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">URL Slug</label>
            <input type="text" class="a-input" name="slug" value="{{ old('slug', $item->slug) }}" placeholder="auto-generated" style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Industry</label>
                <input type="text" class="a-input" name="industry" value="{{ old('industry', $item->industry) }}" placeholder="e.g. Healthcare / FinTech" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Service Tag</label>
                <input type="text" class="a-input" name="service_tag" value="{{ old('service_tag', $item->service_tag) }}" placeholder="e.g. AI & Cloud Transformation" style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Key Outcome Summary Line</label>
            <input type="text" class="a-input" name="outcome_line" value="{{ old('outcome_line', $item->outcome_line) }}" placeholder="e.g. Scaled platform to 1M+ active users with 99.99% uptime" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Problem Statement</label>
            <textarea class="a-textarea" name="problem" rows="3" style="width:100%;">{{ old('problem', $item->problem) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Solution Delivered</label>
            <textarea class="a-textarea" name="solution" rows="3" style="width:100%;">{{ old('solution', $item->solution) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Results &amp; Impact</label>
            <textarea class="a-textarea" name="result" rows="3" style="width:100%;">{{ old('result', $item->result) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Thumbnail / Cover Image</label>
            @if($item->thumbnail)
                <div style="margin-bottom:8px;"><img src="{{ asset('storage/'.$item->thumbnail) }}" alt="Thumbnail" style="max-height:80px;border-radius:6px;"></div>
            @endif
            <input type="file" class="a-input" name="thumbnail" accept="image/*" style="width:100%;">
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
            <button type="submit" class="btn btn-gold">Save Project</button>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
