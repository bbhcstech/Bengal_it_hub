@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">SEO Manager &amp; Meta Tags</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage page titles, meta descriptions, canonical URLs, Open Graph images, robots directives, and JSON-LD schema markup for Google ranking.</p>
    </div>
    <a href="{{ route('admin.seo.create') }}" class="btn btn-gold">+ Add SEO Page Entry</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>Route Slug</th>
                <th>Page Title</th>
                <th>Page Type</th>
                <th>Robots Directive</th>
                <th>Schema Type</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><code>{{ $item->route_slug }}</code></td>
                <td>
                    <strong>{{ \Illuminate\Support\Str::limit($item->title, 45) }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">{{ \Illuminate\Support\Str::limit($item->meta_description, 55) }}</div>
                </td>
                <td><span class="badge badge-gold">{{ Str::headline($item->page_type) }}</span></td>
                <td><span class="badge badge-success">{{ $item->robots }}</span></td>
                <td><span class="badge badge-purple">{{ $item->schema_type }}</span></td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.seo.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.seo.destroy', $item) }}" onsubmit="return confirm('Delete SEO entry?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No custom SEO meta entries added yet. Default global SEO rules are currently active.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
