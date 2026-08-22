@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">RSS Feeds &amp; News Sources</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage external tech news RSS feeds for automated news aggregation on the Tech Innovation portal.</p>
    </div>
    <div style="display:flex;gap:8px;">
        <form method="POST" action="{{ route('admin.rss-sources.sync-all') }}" style="margin:0;">
            @csrf
            <button class="btn btn-outline" type="submit">Sync All Feeds Now</button>
        </form>
        <a href="{{ route('admin.rss-sources.create') }}" class="btn btn-gold">+ Add RSS Source</a>
    </div>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>Source Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Last Sync</th>
                <th>Sync Result</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($sources as $source)
            <tr>
                <td>
                    <strong>{{ $source->name }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">{{ \Illuminate\Support\Str::limit($source->feed_url, 45) }}</div>
                </td>
                <td><span class="badge badge-purple">{{ $source->category?->name ?? 'General' }}</span></td>
                <td>
                    @if($source->is_active)
                        <span class="badge badge-success">Enabled</span>
                    @else
                        <span class="badge badge-muted">Disabled</span>
                    @endif
                </td>
                <td>{{ $source->last_synced_at ? $source->last_synced_at->diffForHumans() : 'Never' }}</td>
                <td>
                    @if($source->last_sync_status === 'success')
                        <span class="badge badge-success">Success</span>
                    @elseif($source->last_sync_status)
                        <span class="badge badge-gold">{{ $source->last_sync_status }}</span>
                    @else
                        <span style="color:var(--a-text-muted);">&mdash;</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <form method="POST" action="{{ route('admin.rss-sources.sync', $source) }}" style="margin:0;">
                            @csrf
                            <button class="btn btn-gold btn-sm" type="submit">Sync Now</button>
                        </form>
                        <a href="{{ route('admin.rss-sources.edit', $source) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.rss-sources.delete', $source) }}" onsubmit="return confirm('Delete this RSS feed?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No RSS feed sources registered. Click "+ Add RSS Source" to start.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
