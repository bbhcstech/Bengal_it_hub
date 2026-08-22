@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Portfolio &amp; Case Studies</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Showcase client projects, industry solutions, problem-solution breakdowns, and metrics.</p>
    </div>
    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-gold">+ Add Project</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Project Title</th>
                <th>Industry</th>
                <th>Service Tag</th>
                <th>Outcome</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><strong>#{{ $item->order }}</strong></td>
                <td>
                    <strong>{{ $item->title }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">/portfolio/{{ $item->slug }}</div>
                </td>
                <td>{{ $item->industry ?: '—' }}</td>
                <td><span class="badge badge-gold">{{ $item->service_tag ?: 'General' }}</span></td>
                <td>{{ \Illuminate\Support\Str::limit($item->outcome_line, 45) ?: '—' }}</td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}" onsubmit="return confirm('Delete portfolio project?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:30px;color:var(--a-text-muted);">No portfolio projects added yet. Click "+ Add Project" to publish one.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
