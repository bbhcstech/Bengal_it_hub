@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Core Differentiators</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage "Why Choose Us" key value propositions displayed across landing pages.</p>
    </div>
    <a href="{{ route('admin.differentiators.create') }}" class="btn btn-gold">+ Add Differentiator</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Title</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><strong>#{{ $item->order }}</strong></td>
                <td><strong>{{ $item->title }}</strong></td>
                <td>{{ \Illuminate\Support\Str::limit($item->description, 60) ?: '—' }}</td>
                <td><code>{{ $item->icon ?: 'default' }}</code></td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.differentiators.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.differentiators.destroy', $item) }}" onsubmit="return confirm('Delete this item?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No differentiators created yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
