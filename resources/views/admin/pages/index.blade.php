@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Pages &amp; Landing Sections</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage page content, hero text, CTA buttons, and individual page SEO meta settings.</p>
    </div>
    <a href="{{ route('admin.content.index') }}" class="btn btn-gold">Page Content Block Editor &rarr;</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>Page Title</th>
                <th>URL Slug</th>
                <th>SEO Meta Title</th>
                <th>Robots</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($pages as $page)
            <tr>
                <td><strong>{{ $page->title }}</strong></td>
                <td><code>/{{ $page->slug }}</code></td>
                <td>{{ \Illuminate\Support\Str::limit($page->meta_title ?: $page->title, 45) }}</td>
                <td><span class="badge badge-purple">{{ $page->meta_robots ?: 'index, follow' }}</span></td>
                <td>
                    @if($page->status === 'published')
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-muted">Draft</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline btn-sm">Edit Page &amp; SEO</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No pages found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
