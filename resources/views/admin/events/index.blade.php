@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Events &amp; HackFest 2026 Management</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage hackathons, chief guests, speakers, venue info, gallery items, and timeline schedules.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-gold">+ Add Event</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>URL Slug</th>
                <th>Venue</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($events as $event)
            <tr>
                <td>
                    <strong>{{ $event->name }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">{{ $event->tagline ?: 'HackFest Event' }}</div>
                </td>
                <td><code>/{{ $event->slug }}</code></td>
                <td>{{ $event->venue ?: '—' }}</td>
                <td>
                    @if($event->status === 'published')
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-muted">{{ Str::headline($event->status) }}</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-outline btn-sm">Edit Event Details</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:30px;color:var(--a-text-muted);">No events registered. Click "+ Add Event" to create HackFest 2026.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
