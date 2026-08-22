@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Client Testimonials</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage client reviews, ratings, company names, and feedback quotes.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold">+ Add Testimonial</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Client</th>
                <th>Company</th>
                <th>Quote</th>
                <th>Rating</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><strong>#{{ $item->order }}</strong></td>
                <td>
                    <strong>{{ $item->client_name }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">{{ $item->designation }}</div>
                </td>
                <td>{{ $item->company ?: '—' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->quote, 55) }}</td>
                <td><span style="color:var(--a-gold);font-weight:bold;">★ {{ $item->rating }}/5</span></td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $item) }}" onsubmit="return confirm('Delete testimonial?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:30px;color:var(--a-text-muted);">No testimonials added yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
