@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Team Members &amp; Leadership</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage team profiles, designations, bios, and LinkedIn profile URLs.</p>
    </div>
    <a href="{{ route('admin.team.create') }}" class="btn btn-gold">+ Add Team Member</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Member</th>
                <th>Designation</th>
                <th>LinkedIn</th>
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
                        @if($item->photo)
                            <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                        @else
                            <div class="mini-avatar">{{ Str::of($item->name)->substr(0, 2)->upper() }}</div>
                        @endif
                        <strong>{{ $item->name }}</strong>
                    </div>
                </td>
                <td>{{ $item->designation ?: '—' }}</td>
                <td>
                    @if($item->linkedin_url)
                        <a href="{{ $item->linkedin_url }}" target="_blank" style="color:var(--a-primary);font-size:0.82rem;">Profile ↗</a>
                    @else
                        <span style="color:var(--a-text-muted);">&mdash;</span>
                    @endif
                </td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.team.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.team.destroy', $item) }}" onsubmit="return confirm('Remove team member?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No team members added yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
