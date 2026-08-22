@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Page Content Block Editor</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Edit on-page copy, hero section headlines, image URLs, and text blocks per page without touching code.</p>
    </div>
    <a href="{{ route('admin.content.create', $page) }}" class="btn btn-gold">+ Add Block to {{ Str::headline($page) }}</a>
</div>

<div class="a-card" style="margin-bottom:20px;">
    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="font-weight:600;font-size:0.88rem;color:var(--a-text-muted);">Select Page to Edit:</span>
        @foreach($pages as $p)
            <a href="{{ route('admin.content.index', $p) }}" class="btn btn-sm {{ $page === $p ? 'btn-gold' : 'btn-outline' }}">
                {{ Str::headline($p) }}
            </a>
        @endforeach
    </div>
</div>

<div class="a-card">
    <form method="POST" action="{{ route('admin.content.update', $page) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display:flex;flex-direction:column;gap:20px;">
            @forelse($blocks as $block)
                <div style="padding:16px;background:var(--a-bg);border:1px solid var(--a-border);border-radius:10px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                        <div>
                            <strong style="font-size:0.95rem;">{{ $block->label }}</strong>
                            <code style="margin-left:8px;font-size:0.78rem;color:var(--a-primary);">{{ $block->section_key }}</code>
                        </div>
                        <form method="POST" action="{{ route('admin.content.destroy', $block) }}" onsubmit="return confirm('Remove block?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="padding:2px 8px;">Remove</button>
                        </form>
                    </div>

                    @if($block->type === 'textarea' || $block->type === 'richtext')
                        <textarea class="a-textarea" name="blocks[{{ $block->id }}]" rows="4" style="width:100%;">{{ old("blocks.{$block->id}", $block->content) }}</textarea>
                    @elseif($block->type === 'image')
                        @if($block->content)
                            <div style="margin-bottom:8px;"><img src="{{ $block->content }}" alt="Image" style="max-height:80px;border-radius:6px;"></div>
                        @endif
                        <input type="text" class="a-input" name="blocks[{{ $block->id }}]" value="{{ old("blocks.{$block->id}", $block->content) }}" placeholder="/assets/images/..." style="width:100%;margin-bottom:6px;">
                        <input type="file" class="a-input" name="block_files[{{ $block->id }}]" accept="image/*" style="width:100%;">
                    @else
                        <input type="text" class="a-input" name="blocks[{{ $block->id }}]" value="{{ old("blocks.{$block->id}", $block->content) }}" style="width:100%;">
                    @endif
                </div>
            @empty
                <div style="text-align:center;padding:40px 20px;color:var(--a-text-muted);">
                    <p style="margin:0 0 10px;">No editable content blocks created for the <strong>{{ Str::headline($page) }}</strong> page yet.</p>
                    <a href="{{ route('admin.content.create', $page) }}" class="btn btn-gold btn-sm">+ Add First Block</a>
                </div>
            @endforelse
        </div>

        @if($blocks->count() > 0)
            <div style="margin-top:20px;">
                <button type="submit" class="btn btn-gold">Save All Changes for {{ Str::headline($page) }} Page</button>
            </div>
        @endif
    </form>
</div>
@endsection
