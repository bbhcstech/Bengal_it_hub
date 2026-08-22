@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Tech Stack &amp; Technologies</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage technologies, frameworks, databases, cloud &amp; DevOps tools.</p>
    </div>
    <a href="{{ route('admin.tech-stack.create') }}" class="btn btn-gold">+ Add Tech Stack Item</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Technology</th>
                <th>Category</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><strong>#{{ $item->order }}</strong></td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        @if($item->logo)
                            <img src="{{ asset('storage/'.$item->logo) }}" alt="{{ $item->name }}" style="max-height:24px;">
                        @endif
                        <strong>{{ $item->name }}</strong>
                    </div>
                </td>
                <td><span class="badge badge-purple">{{ Str::headline($item->category) }}</span></td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.tech-stack.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.tech-stack.destroy', $item) }}" onsubmit="return confirm('Delete technology item?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:30px;color:var(--a-text-muted);">No tech stack items registered yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
