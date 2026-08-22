@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit Testimonial: '.$item->client_name : 'Add Testimonial' }}</h1>
</div>

<div class="a-card" style="max-width:700px;">
    <form method="POST" action="{{ $item->exists ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Client Name *</label>
            <input type="text" class="a-input" name="client_name" value="{{ old('client_name', $item->client_name) }}" required style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Designation / Title</label>
                <input type="text" class="a-input" name="designation" value="{{ old('designation', $item->designation) }}" placeholder="e.g. VP of Operations" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Company Name</label>
                <input type="text" class="a-input" name="company" value="{{ old('company', $item->company) }}" placeholder="e.g. Tech Global Inc." style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Testimonial Quote *</label>
            <textarea class="a-textarea" name="quote" rows="4" required style="width:100%;">{{ old('quote', $item->quote) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Client Photo</label>
            @if($item->photo)
                <div style="margin-bottom:8px;"><img src="{{ asset('storage/'.$item->photo) }}" alt="Photo" style="max-height:80px;border-radius:50%;"></div>
            @endif
            <input type="file" class="a-input" name="photo" accept="image/*" style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:20px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Rating (1 to 5)</label>
                <input type="number" class="a-input" name="rating" min="1" max="5" value="{{ old('rating', $item->rating ?? 5) }}" style="width:100%;">
            </div>
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
            <button type="submit" class="btn btn-gold">Save Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
