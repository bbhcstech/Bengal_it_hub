@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>Add New Admin User</h1>
</div>

<div class="a-card" style="max-width:650px;">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Full Name *</label>
            <input type="text" class="a-input" name="name" value="{{ old('name') }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Email Address *</label>
            <input type="email" class="a-input" name="email" value="{{ old('email') }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Password *</label>
            <input type="password" class="a-input" name="password" required minlength="8" style="width:100%;">
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Role &amp; Module Access *</label>
            <select class="a-select" name="role" required style="width:100%;">
                <option value="super_admin">Super Admin (Full Console Access)</option>
                <option value="content_editor">Content Editor (Pages, Services, Blog, Partners, FAQs)</option>
                <option value="event_manager">Event Manager (Events &amp; HackFest Registrations)</option>
                <option value="leads_manager">Leads Manager (Contact Submissions &amp; Lead Export)</option>
            </select>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold">Create Admin User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
