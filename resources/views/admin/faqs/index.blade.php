@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>FAQs Management</h1>
    <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage Frequently Asked Questions for the main site and HackFest 2026.</p>
</div>

<div class="a-card" style="margin-bottom:24px;">
    <h3 style="margin-top:0;margin-bottom:16px;">Add New FAQ</h3>
    <form method="POST" action="{{ route('admin.faqs.store') }}">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Category</label>
                <input type="text" class="a-input" name="category" placeholder="General, Technical, Billing" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Scope *</label>
                <input type="text" class="a-input" name="scope" value="site" placeholder="site or hackfest-2026" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Sort Order</label>
                <input type="number" class="a-input" name="sort_order" value="0" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Status</label>
                <select class="a-select" name="status" style="width:100%;">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Question *</label>
            <input type="text" class="a-input" name="question" placeholder="Enter FAQ question..." required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Answer *</label>
            <textarea class="a-textarea" name="answer" rows="3" placeholder="Enter detailed answer..." required style="width:100%;"></textarea>
        </div>

        <button type="submit" class="btn btn-gold">+ Add FAQ</button>
    </form>
</div>

<div class="a-card">
    <h3 style="margin-top:0;margin-bottom:16px;">Existing FAQs ({{ $faqs->count() }})</h3>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @forelse($faqs as $faq)
            <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" style="padding:16px;background:var(--a-bg);border:1px solid var(--a-border);border-radius:10px;">
                @csrf
                @method('PUT')

                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;margin-bottom:12px;">
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Category</label>
                        <input type="text" class="a-input" name="category" value="{{ $faq->category }}" style="width:100%;">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Scope</label>
                        <input type="text" class="a-input" name="scope" value="{{ $faq->scope }}" required style="width:100%;">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Order</label>
                        <input type="number" class="a-input" name="sort_order" value="{{ $faq->sort_order }}" style="width:100%;">
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:4px;font-size:0.78rem;color:var(--a-text-muted);">Status</label>
                        <select class="a-select" name="status" style="width:100%;">
                            <option value="published" @selected($faq->status === 'published')>Published</option>
                            <option value="draft" @selected($faq->status === 'draft')>Draft</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:12px;">
                    <input type="text" class="a-input" name="question" value="{{ $faq->question }}" required style="width:100%;font-weight:600;">
                </div>

                <div style="margin-bottom:12px;">
                    <textarea class="a-textarea" name="answer" rows="3" required style="width:100%;">{{ $faq->answer }}</textarea>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <button type="submit" class="btn btn-outline btn-sm">Save Changes</button>
                </div>
            </form>
        @empty
            <p style="color:var(--a-text-muted);margin:0;">No FAQs found.</p>
        @endforelse
    </div>
</div>
@endsection
