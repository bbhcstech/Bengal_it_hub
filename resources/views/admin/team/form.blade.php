@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Team Member: '.$item->name : 'Add Team Member' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.team.update', $item) : route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Name *</label>
            <input type="text" class="a-input" name="name" value="{{ old('name', $item->name) }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Designation / Role</label>
            <input type="text" class="a-input" name="designation" value="{{ old('designation', $item->designation) }}" placeholder="e.g. Chief Technology Officer" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Short Bio</label>
            <textarea class="a-textarea" name="bio" rows="3" style="width:100%;">{{ old('bio', $item->bio) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Profile Photo</label>
            @if($item->photo)
                <div style="margin-bottom:8px;"><img src="{{ asset('storage/'.$item->photo) }}" alt="Photo" style="max-height:80px;border-radius:50%;"></div>
            @endif
            <input type="file" class="a-input" name="photo" accept="image/*" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">LinkedIn Profile URL</label>
            <input type="url" class="a-input" name="linkedin_url" value="{{ old('linkedin_url', $item->linkedin_url) }}" placeholder="https://linkedin.com/in/..." style="width:100%;">
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
            <button type="submit" class="btn btn-gold">Save Member</button>
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
