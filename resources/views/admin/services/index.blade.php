@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Services Management</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage IT services, kicker subtitles, service features, and SEO metadata.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-gold">+ Add Service</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Service Title</th>
                <th>Kicker Subtitle</th>
                <th>Featured</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr>
                <td><strong>#{{ $service->sort_order }}</strong></td>
                <td>
                    <strong>{{ $service->title }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">/services/{{ $service->slug }}</div>
                </td>
                <td>{{ $service->kicker ?: '—' }}</td>
                <td>
                    @if($service->is_featured)
                        <span class="badge badge-gold">Featured</span>
                    @else
                        <span style="color:var(--a-text-muted);">&mdash;</span>
                    @endif
                </td>
                <td>
                    @if($service->status === 'published')
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-muted">Draft</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.services.delete', $service) }}" onsubmit="return confirm('Delete this service?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No services created yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
