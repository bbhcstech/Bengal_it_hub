@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>Partners &amp; Ecosystem Network</h1>
    <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage industry partner profiles, company details, logos, projects, and partner pages.</p>
</div>

<div class="a-card" style="margin-bottom:24px;">
    <h3 style="margin-top:0;margin-bottom:16px;">Add New Partner</h3>
    <form method="POST" action="{{ route('admin.partners.store') }}">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Company Name *</label>
                <input type="text" class="a-input" name="name" placeholder="Company Name" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">URL Slug</label>
                <input type="text" class="a-input" name="slug" placeholder="auto-generated" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Logo Image URL/Path</label>
                <input type="text" class="a-input" name="logo" placeholder="/assets/images/..." style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Location / Address</label>
                <input type="text" class="a-input" name="address" placeholder="Kolkata, India" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Website / Link URL</label>
                <input type="url" class="a-input" name="link_url" placeholder="https://..." style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Partner Description</label>
            <textarea class="a-textarea" name="description" rows="3" placeholder="Overview of partner capabilities..." style="width:100%;"></textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Clients Count</label>
                <input type="text" class="a-input" name="clients_count" placeholder="500+" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Employees Count</label>
                <input type="text" class="a-input" name="employees_count" placeholder="200+" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Scope</label>
                <input type="text" class="a-input" name="scope" value="home" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Sort Order</label>
                <input type="number" class="a-input" name="sort_order" value="0" style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Status</label>
            <select class="a-select" name="status" style="width:100%;">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <button type="submit" class="btn btn-gold">+ Add Partner</button>
    </form>
</div>

<div class="a-card">
    <h3 style="margin-top:0;margin-bottom:16px;">Registered Partners ({{ $partners->count() }})</h3>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @forelse($partners as $partner)
            <form method="POST" action="{{ route('admin.partners.update', $partner) }}" style="padding:16px;background:var(--a-bg);border:1px solid var(--a-border);border-radius:10px;">
                @csrf
                @method('PUT')

                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:12px;">
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Company Name</label>
                        <input type="text" class="a-input" name="name" value="{{ $partner->name }}" required style="width:100%;font-weight:600;">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Slug</label>
                        <input type="text" class="a-input" name="slug" value="{{ $partner->slug }}" style="width:100%;">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Logo Image</label>
                        <input type="text" class="a-input" name="logo" value="{{ $partner->logo }}" style="width:100%;">
                    </div>
                </div>

                <div style="margin-bottom:12px;">
                    <textarea class="a-textarea" name="description" rows="2" style="width:100%;">{{ $partner->description }}</textarea>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <button type="submit" class="btn btn-outline btn-sm">Save Partner</button>
                    @if($partner->slug)
                        <a href="{{ route('our-partners.show', $partner->slug) }}" target="_blank" style="color:var(--a-primary);font-size:0.82rem;">View Partner Page &rarr;</a>
                    @endif
                </div>
            </form>
        @empty
            <p style="color:var(--a-text-muted);margin:0;">No partners registered.</p>
        @endforelse
    </div>
</div>
@endsection
