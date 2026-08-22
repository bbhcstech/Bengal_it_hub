@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">AI Chatbot Knowledge Base</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage Q&amp;A pairs and keyword triggers for the automated chatbot assistant.</p>
    </div>
    <a href="{{ route('admin.chatbot.create') }}" class="btn btn-gold">+ Add Q&amp;A Entry</a>
</div>

<div class="a-grid" style="grid-template-columns:2fr 1fr;gap:20px;align-items:start;">
    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:16px;">Trigger Question &amp; Answer Knowledge Rules</h3>
        <table class="a-table">
            <thead>
                <tr>
                    <th style="width:60px;">Order</th>
                    <th>Question</th>
                    <th>Keywords</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td><strong>#{{ $item->order }}</strong></td>
                    <td>
                        <strong>{{ $item->question }}</strong>
                        <div style="font-size:0.78rem;color:var(--a-text-muted);margin-top:2px;">{{ \Illuminate\Support\Str::limit($item->answer, 60) }}</div>
                    </td>
                    <td><code>{{ \Illuminate\Support\Str::limit($item->keywords, 30) }}</code></td>
                    <td>
                        @if($item->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-muted">Disabled</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:inline-flex;gap:6px;">
                            <a href="{{ route('admin.chatbot.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.chatbot.destroy', $item) }}" onsubmit="return confirm('Delete Q&A rule?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:var(--a-text-muted);">No Q&amp;A rules defined yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:14px;">Recent Visitor Conversations</h3>
        <div style="display:flex;flex-direction:column;gap:12px;max-height:500px;overflow-y:auto;">
            @forelse($recentConversations as $conv)
                <div style="padding:10px;background:var(--a-bg);border-radius:8px;font-size:0.82rem;">
                    <div style="font-weight:600;color:var(--a-text);">User: {{ $conv->user_message }}</div>
                    <div style="color:var(--a-text-muted);margin-top:4px;">Bot: {{ \Illuminate\Support\Str::limit($conv->bot_reply, 80) }}</div>
                    <div style="font-size:0.72rem;color:var(--a-text-muted);margin-top:4px;">{{ $conv->created_at->diffForHumans() }} &middot; {{ $conv->ip_address }}</div>
                </div>
            @empty
                <p style="color:var(--a-text-muted);font-size:0.85rem;margin:0;">No recent conversations logged.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
