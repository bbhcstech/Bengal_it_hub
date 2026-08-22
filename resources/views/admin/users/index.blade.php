@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Admin Users &amp; Team Permissions</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage admin console accounts, roles (Super Admin, Content Editor, Event Manager, Leads Manager) and credentials.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-gold">+ Add Admin User</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Last Login</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $u)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="mini-avatar">{{ Str::of($u->name)->substr(0, 2)->upper() }}</div>
                        <strong>{{ $u->name }}</strong>
                    </div>
                </td>
                <td>{{ $u->email }}</td>
                <td><span class="badge badge-purple">{{ Str::headline($u->role) }}</span></td>
                <td><span class="badge badge-success">Active</span></td>
                <td>{{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Never' }}</td>
                <td style="text-align:right;">
                    @if($u->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Remove this admin account?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    @else
                        <span class="badge badge-gold">Current User</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No users found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
