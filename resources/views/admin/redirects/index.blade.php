@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">URL Redirects Manager (301 / 302)</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage legacy URL redirects to maintain Google SEO ranking link equity when URLs change.</p>
    </div>
</div>

<div class="a-grid" style="grid-template-columns:1fr 2fr;gap:20px;align-items:start;">
    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:16px;">Add Redirect Rule</h3>
        <form method="POST" action="{{ route('admin.redirects.store') }}">
            @csrf

            <div style="margin-bottom:14px;">
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Source URL Path *</label>
                <input type="text" class="a-input" name="source_url" placeholder="/old-services-page" required style="width:100%;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Target Destination URL *</label>
                <input type="text" class="a-input" name="target_url" placeholder="/services/custom-software" required style="width:100%;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">Redirect Status Code *</label>
                <select class="a-select" name="status_code" required style="width:100%;">
                    <option value="301">301 Permanent Redirect (SEO Link Equity)</option>
                    <option value="302">302 Temporary Redirect</option>
                </select>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <span style="font-size:0.88rem;">Active rule</span>
                </label>
            </div>

            <button type="submit" class="btn btn-gold" style="width:100%;">Add Redirect Rule</button>
        </form>
    </div>

    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:16px;">Active Redirect Rules</h3>
        <table class="a-table">
            <thead>
                <tr>
                    <th>Source URL</th>
                    <th>Target Destination</th>
                    <th>Status</th>
                    <th>Hits</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($redirects as $rule)
                <tr>
                    <td><code>{{ $rule->source_url }}</code></td>
                    <td><a href="{{ $rule->target_url }}" target="_blank" style="color:var(--a-primary);">{{ $rule->target_url }}</a></td>
                    <td>
                        @if($rule->status_code == 301)
                            <span class="badge badge-success">301 Permanent</span>
                        @else
                            <span class="badge badge-gold">302 Temp</span>
                        @endif
                    </td>
                    <td><strong>{{ number_format($rule->hits) }}</strong></td>
                    <td style="text-align:right;">
                        <form method="POST" action="{{ route('admin.redirects.destroy', $rule) }}" onsubmit="return confirm('Delete redirect rule?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:var(--a-text-muted);">No 301/302 URL redirect rules defined yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">
            {{ $redirects->links() }}
        </div>
    </div>
</div>
@endsection
