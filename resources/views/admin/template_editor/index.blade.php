@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Live Template Editor</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Direct live editor for website Blade templates and layouts.</p>
    </div>
</div>

<div class="a-card">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <span style="font-weight:600;font-size:0.88rem;color:var(--a-text-muted);">Select Template:</span>
        @foreach($templates as $key => $path)
            <a href="{{ route('admin.template-editor.index', ['file' => $key]) }}" class="btn btn-sm {{ $selected === $key ? 'btn-gold' : 'btn-outline' }}">
                {{ Str::headline($key) }} ({{ $path }})
            </a>
        @endforeach
    </div>

    <form method="POST" action="{{ route('admin.template-editor.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="file" value="{{ $selected }}">

        <div style="margin-bottom:14px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;color:var(--a-text-muted);">Editing File: <code>resources/views/{{ $relativePath }}</code></label>
            <textarea class="a-textarea" name="code" rows="22" style="width:100%;font-family:Consolas, Monaco, monospace;font-size:0.85rem;line-height:1.5;background:#0d1b22;color:#e6edf3;border-color:#1e3843;border-radius:8px;">{{ old('code', $code) }}</textarea>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;">
            <button type="submit" class="btn btn-gold">Save Template &amp; Clear View Cache</button>
            <span style="font-size:0.78rem;color:var(--a-text-muted);">⚡ Changes take effect immediately on live website rendering</span>
        </div>
    </form>
</div>
@endsection
