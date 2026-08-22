@extends('layouts.admin')

@section('content')
<style>
/* Modern Admin Data Table Styling */
.bih-leads-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
}
.bih-leads-stats {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.bih-stat-card {
    background: var(--a-surface, #1e293b);
    border: 1px solid var(--a-border, #334155);
    border-radius: 12px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 140px;
}
.bih-stat-card .val {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--a-text, #f8fafc);
}
.bih-stat-card .lbl {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--a-text-muted, #94a3b8);
    letter-spacing: 0.05em;
}

.bih-controls-bar {
    background: var(--a-surface, #1e293b);
    border: 1px solid var(--a-border, #334155);
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.bih-bulk-bar {
    background: linear-gradient(90deg, #1e3a8a 0%, #0f766e 100%);
    color: #fff;
    border-radius: 12px;
    padding: 12px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 4px 14px rgba(15, 118, 110, 0.25);
}

.bih-table-container {
    background: var(--a-surface, #1e293b);
    border: 1px solid var(--a-border, #334155);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}
.bih-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
    text-align: left;
}
.bih-table th {
    background: rgba(0, 0, 0, 0.2);
    color: var(--a-text-muted, #94a3b8);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.06em;
    padding: 14px 18px;
    border-bottom: 1px solid var(--a-border, #334155);
}
.bih-table td {
    padding: 14px 18px;
    border-bottom: 1px solid var(--a-border, #334155);
    color: var(--a-text, #e2e8f0);
    vertical-align: middle;
}
.bih-table tbody tr:hover {
    background: rgba(255, 255, 255, 0.03);
}

.action-btn-group {
    display: flex;
    align-items: center;
    gap: 6px;
}
.action-btn {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
}
.action-btn-view { background: rgba(59, 130, 246, 0.15); color: #60a5fa; border-color: rgba(59, 130, 246, 0.3); }
.action-btn-view:hover { background: #3b82f6; color: #fff; }
.action-btn-edit { background: rgba(234, 179, 8, 0.15); color: #facc15; border-color: rgba(234, 179, 8, 0.3); }
.action-btn-edit:hover { background: #eab308; color: #000; }
.action-btn-reply { background: rgba(20, 184, 166, 0.15); color: #2dd4bf; border-color: rgba(20, 184, 166, 0.3); }
.action-btn-reply:hover { background: #14b8a6; color: #fff; }
.action-btn-archive { background: rgba(100, 116, 139, 0.15); color: #94a3b8; border-color: rgba(100, 116, 139, 0.3); }
.action-btn-archive:hover { background: #64748b; color: #fff; }
.action-btn-delete { background: rgba(239, 68, 68, 0.15); color: #f87171; border-color: rgba(239, 68, 68, 0.3); }
.action-btn-delete:hover { background: #ef4444; color: #fff; }

/* Modal Styles */
.bih-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.bih-modal-backdrop.open { display: flex; }
.bih-modal {
    background: var(--a-surface, #1e293b);
    border: 1px solid var(--a-border, #334155);
    border-radius: 18px;
    width: 100%;
    max-width: 640px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    padding: 28px;
    position: relative;
    animation: modalPop 0.22s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes modalPop {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.bih-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--a-border, #334155);
}
.bih-modal-close {
    background: none;
    border: none;
    color: var(--a-text-muted, #94a3b8);
    font-size: 1.5rem;
    cursor: pointer;
    line-height: 1;
}
.bih-modal-close:hover { color: #fff; }
</style>

{{-- Page Header --}}
<div class="bih-leads-header">
    <div>
        <h1 style="margin:0; font-size:1.75rem; font-weight:800;">Leads &amp; Contact Submissions</h1>
        <p style="margin:4px 0 0; color:var(--a-text-muted); font-size:0.9rem;">Manage incoming client inquiries, HackFest registrations, and contact submissions in one place.</p>
    </div>
    <div style="display:flex; gap:10px;">
        <a href="{{ route('admin.leads.export', request()->query()) }}" class="btn btn-gold" style="display:inline-flex; align-items:center; gap:8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
            Export CSV Data
        </a>
    </div>
</div>

{{-- Counter Cards --}}
<div class="bih-leads-stats">
    <div class="bih-stat-card">
        <div>
            <div class="val">{{ $totalCount }}</div>
            <div class="lbl">Total Submissions</div>
        </div>
    </div>
    <div class="bih-stat-card" style="border-color: rgba(234, 179, 8, 0.4);">
        <div>
            <div class="val" style="color: #facc15;">{{ $newCount }}</div>
            <div class="lbl">New Unread</div>
        </div>
    </div>
    <div class="bih-stat-card" style="border-color: rgba(20, 184, 166, 0.4);">
        <div>
            <div class="val" style="color: #2dd4bf;">{{ $contactedCount }}</div>
            <div class="lbl">Contacted</div>
        </div>
    </div>
    <div class="bih-stat-card" style="border-color: rgba(100, 116, 139, 0.4);">
        <div>
            <div class="val" style="color: #94a3b8;">{{ $archivedCount }}</div>
            <div class="lbl">Archived</div>
        </div>
    </div>
    <div class="bih-stat-card" style="border-color: rgba(34, 197, 94, 0.4);">
        <div>
            <div class="val" style="color: #4ade80;">{{ $closedCount }}</div>
            <div class="lbl">Closed</div>
        </div>
    </div>
</div>

{{-- Top Controls & Search Bar --}}
<div class="bih-controls-bar">
    <form id="filterForm" method="GET" action="{{ route('admin.leads') }}" style="display:flex; align-items:center; gap:12px; flex-wrap:wrap; width:100%;">
        {{-- Entries per page selector --}}
        <div style="display:flex; align-items:center; gap:8px; font-size:0.85rem; color:var(--a-text-muted); font-weight:600;">
            <span>Show</span>
            <select class="a-select" name="per_page" onchange="this.form.submit()" style="padding:6px 12px; min-width:70px;">
                <option value="10" @selected(request('per_page') == 10)>10</option>
                <option value="25" @selected(request('per_page', 25) == 25)>25</option>
                <option value="50" @selected(request('per_page') == 50)>50</option>
                <option value="100" @selected(request('per_page') == 100)>100</option>
            </select>
            <span>entries</span>
        </div>

        {{-- Form Type Filter --}}
        <select class="a-select" name="form_type" onchange="this.form.submit()" style="min-width:170px;">
            <option value="">All Form Types</option>
            @foreach($formTypes as $type)
                <option value="{{ $type }}" @selected(request('form_type') === $type)>{{ Str::headline($type) }}</option>
            @endforeach
        </select>

        {{-- Status Filter --}}
        <select class="a-select" name="status" onchange="this.form.submit()" style="min-width:140px;">
            <option value="">All Statuses</option>
            @foreach(['new','contacted','archived','closed'] as $st)
                <option value="{{ $st }}" @selected(request('status') === $st)>{{ Str::headline($st) }}</option>
            @endforeach
        </select>

        {{-- Real-time Search Box --}}
        <div style="position:relative; flex:1; min-width:220px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, phone, subject..." class="a-input" style="width:100%; padding-left:36px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--a-text-muted);"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </div>

        <button type="submit" class="btn btn-outline" style="padding:8px 16px;">Search</button>
        @if(request()->anyFilled(['search', 'form_type', 'status', 'per_page']))
            <a href="{{ route('admin.leads') }}" class="btn btn-outline" style="padding:8px 16px; color:#f87171; border-color:rgba(239,68,68,0.4);">Clear Filter</a>
        @endif
    </form>
</div>

{{-- Bulk Actions Bar (hidden until items are checked) --}}
<form id="bulkForm" method="POST" action="{{ route('admin.leads.bulk') }}">
    @csrf
    <div id="bulkBar" class="bih-bulk-bar" style="display:none;">
        <div style="font-weight:700; font-size:0.9rem; display:flex; align-items:center; gap:8px;">
            <span id="selectedCountBadge" style="background:rgba(255,255,255,0.2); padding:3px 10px; border-radius:999px; font-size:0.82rem;">0 selected</span>
            <span>Items Selected</span>
        </div>
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <select name="action" class="a-select" style="background:#fff; color:#0f172a; font-weight:700; padding:6px 14px;">
                <option value="">Choose Bulk Action...</option>
                <option value="contacted">Mark as Contacted</option>
                <option value="archived">Archive Selected</option>
                <option value="new">Mark as New</option>
                <option value="closed">Mark as Closed</option>
                <option value="export">Export Selected CSV</option>
                <option value="delete">Delete Selected</option>
            </select>
            <button type="submit" class="btn btn-gold btn-sm" onclick="return confirmBulkAction(this.form)">Apply Bulk Action</button>
        </div>
    </div>

    {{-- Main Data Table --}}
    <div class="bih-table-container">
        <div style="overflow-x:auto;">
            <table class="bih-table">
                <thead>
                    <tr>
                        <th style="width:40px; text-align:center;">
                            <input type="checkbox" id="selectAllCheckbox" style="cursor:pointer; transform:scale(1.2);">
                        </th>
                        <th style="width:70px;">ID</th>
                        <th>Client Details</th>
                        <th>Type / Topic</th>
                        <th>Subject &amp; Message Preview</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:140px;">Date &amp; Time</th>
                        <th style="width:190px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr id="lead-row-{{ $lead->id }}">
                            <td style="text-align:center;">
                                <input type="checkbox" name="ids[]" value="{{ $lead->id }}" class="lead-row-cb" style="cursor:pointer; transform:scale(1.15);">
                            </td>
                            <td style="font-weight:700; color:var(--a-text-muted);">#{{ $lead->id }}</td>
                            <td>
                                <strong style="display:block; color:var(--a-text, #fff); font-size:0.94rem;">{{ $lead->name }}</strong>
                                <div style="font-size:0.8rem; color:var(--a-text-muted); margin-top:2px;">
                                    @if($lead->email)
                                        <a href="mailto:{{ $lead->email }}" style="color:var(--a-brand, #38bdf8); text-decoration:none;">{{ $lead->email }}</a>
                                    @else
                                        <span style="opacity:0.6;">No Email</span>
                                    @endif
                                    @if($lead->phone)
                                        &middot; <span>{{ $lead->phone }}</span>
                                    @endif
                                </div>
                                @if($lead->company || $lead->college)
                                    <div style="font-size:0.75rem; color:#94a3b8; margin-top:2px;">
                                        🏢 {{ $lead->company ?: $lead->college }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge" style="background:rgba(15, 118, 110, 0.2); color:#2dd4bf; border:1px solid rgba(15, 118, 110, 0.4); text-transform:uppercase; font-size:0.72rem; letter-spacing:0.04em;">
                                    {{ Str::headline($lead->form_type) }}
                                </span>
                            </td>
                            <td>
                                @if($lead->subject)
                                    <strong style="display:block; font-size:0.85rem; color:var(--a-text);">{{ Str::limit($lead->subject, 35) }}</strong>
                                @endif
                                <div style="font-size:0.82rem; color:var(--a-text-muted); line-height:1.4;">
                                    {{ Str::limit($lead->message ?: 'No written message provided.', 60) }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($lead->status) {
                                        'new' => 'background:rgba(234,179,8,0.2); color:#facc15; border:1px solid rgba(234,179,8,0.4);',
                                        'contacted' => 'background:rgba(20,184,166,0.2); color:#2dd4bf; border:1px solid rgba(20,184,166,0.4);',
                                        'archived' => 'background:rgba(100,116,139,0.2); color:#94a3b8; border:1px solid rgba(100,116,139,0.4);',
                                        'closed' => 'background:rgba(34,197,94,0.2); color:#4ade80; border:1px solid rgba(34,197,94,0.4);',
                                        default => 'background:rgba(148,163,184,0.2); color:#cbd5e1;'
                                    };
                                @endphp
                                <span class="badge" style="{{ $badgeClass }} padding:4px 10px; border-radius:999px; font-weight:700; font-size:0.75rem;">
                                    {{ Str::headline($lead->status) }}
                                </span>
                            </td>
                            <td style="font-size:0.8rem; color:var(--a-text-muted); white-space:nowrap;">
                                <div>{{ $lead->created_at->format('d M Y') }}</div>
                                <div style="font-size:0.75rem; opacity:0.7;">{{ $lead->created_at->format('H:i A') }}</div>
                            </td>
                            <td style="text-align:right;">
                                <div class="action-btn-group" style="justify-content:flex-end;">
                                    {{-- View Modal Button --}}
                                    <button type="button" class="action-btn action-btn-view" onclick="openViewModal({{ json_encode($lead) }})" title="View Details">
                                        View
                                    </button>

                                    {{-- Edit Status Modal Button --}}
                                    <button type="button" class="action-btn action-btn-edit" onclick="openEditModal({{ json_encode($lead) }})" title="Edit Status">
                                        Edit
                                    </button>

                                    {{-- Reply Email Button --}}
                                    @if($lead->email)
                                        <button type="button" class="action-btn action-btn-reply" onclick="openReplyModal({{ json_encode($lead) }})" title="Reply via Email">
                                            Reply
                                        </button>
                                    @endif

                                    {{-- Archive Toggle Form --}}
                                    <form method="POST" action="{{ route('admin.leads.update', $lead) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $lead->status === 'archived' ? 'new' : 'archived' }}">
                                        <button type="submit" class="action-btn action-btn-archive" title="{{ $lead->status === 'archived' ? 'Unarchive' : 'Archive' }}">
                                            {{ $lead->status === 'archived' ? 'Unarchive' : 'Archive' }}
                                        </button>
                                    </form>

                                    {{-- Delete Form --}}
                                    <form method="POST" action="{{ route('admin.leads.delete', $lead) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this lead submission permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn action-btn-delete" title="Delete Permanent">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:48px 20px; color:var(--a-text-muted);">
                                <div style="font-size:2rem; margin-bottom:8px;">📥</div>
                                <div style="font-weight:700; font-size:1.1rem; color:var(--a-text);">No lead submissions found</div>
                                <p style="margin:4px 0 0; font-size:0.88rem;">Try clearing filter options or searching with different keywords.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Row --}}
        <div style="padding:16px 20px; border-top:1px solid var(--a-border, #334155); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
            <div style="font-size:0.85rem; color:var(--a-text-muted);">
                Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} entries
            </div>
            <div>
                {{ $leads->links() }}
            </div>
        </div>
    </div>
</form>

{{-- ═══════════════════════════════════════════════════════════
     VIEW DETAILS MODAL
     ═══════════════════════════════════════════════════════════ --}}
<div id="viewModal" class="bih-modal-backdrop">
    <div class="bih-modal">
        <div class="bih-modal-header">
            <h3 style="margin:0; font-size:1.2rem; font-weight:700;">Submission Details</h3>
            <button class="bih-modal-close" onclick="closeModal('viewModal')">&times;</button>
        </div>
        <div id="viewModalContent" style="display:grid; gap:16px;">
            {{-- Injected dynamically via JS --}}
        </div>
        <div style="margin-top:24px; text-align:right;">
            <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     EDIT STATUS MODAL
     ═══════════════════════════════════════════════════════════ --}}
<div id="editModal" class="bih-modal-backdrop">
    <div class="bih-modal">
        <div class="bih-modal-header">
            <h3 style="margin:0; font-size:1.2rem; font-weight:700;">Update Lead Status &amp; Notes</h3>
            <button class="bih-modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div style="display:grid; gap:16px;">
                <div>
                    <label class="a-label" style="font-weight:700; margin-bottom:6px; display:block;">Status</label>
                    <select id="editStatus" name="status" class="a-select" style="width:100%;">
                        <option value="new">New (Unread)</option>
                        <option value="contacted">Contacted</option>
                        <option value="archived">Archived</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div>
                    <label class="a-label" style="font-weight:700; margin-bottom:6px; display:block;">Internal Notes</label>
                    <textarea id="editNotes" name="notes" class="a-textarea" rows="4" style="width:100%;" placeholder="Add follow-up notes, phone call summaries, or client preferences..."></textarea>
                </div>
            </div>
            <div style="margin-top:24px; display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn btn-gold">Save Changes</button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     REPLY EMAIL MODAL
     ═══════════════════════════════════════════════════════════ --}}
<div id="replyModal" class="bih-modal-backdrop">
    <div class="bih-modal">
        <div class="bih-modal-header">
            <h3 style="margin:0; font-size:1.2rem; font-weight:700;">Reply to Client via Email</h3>
            <button class="bih-modal-close" onclick="closeModal('replyModal')">&times;</button>
        </div>
        <form id="replyForm" method="POST" action="">
            @csrf
            <div style="display:grid; gap:16px;">
                <div>
                    <label class="a-label" style="font-weight:700; margin-bottom:4px; display:block;">Recipient</label>
                    <input id="replyToEmail" type="text" readonly class="a-input" style="width:100%; background:rgba(0,0,0,0.2);">
                </div>
                <div>
                    <label class="a-label" style="font-weight:700; margin-bottom:4px; display:block;">Subject</label>
                    <input id="replySubject" type="text" name="reply_subject" required class="a-input" style="width:100%;">
                </div>
                <div>
                    <label class="a-label" style="font-weight:700; margin-bottom:4px; display:block;">Message Body</label>
                    <textarea id="replyMessage" name="reply_message" required class="a-textarea" rows="6" style="width:100%;" placeholder="Write your response to the client..."></textarea>
                </div>
            </div>
            <div style="margin-top:24px; display:flex; justify-content:space-between; align-items:center;">
                <a id="replyMailtoBtn" href="#" class="btn btn-outline" target="_blank" style="font-size:0.82rem;">Open in Email App ↗</a>
                <div style="display:flex; gap:10px;">
                    <button type="button" class="btn btn-outline" onclick="closeModal('replyModal')">Cancel</button>
                    <button type="submit" class="btn btn-gold">Send Reply &amp; Record</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const masterCb = document.getElementById('selectAllCheckbox');
    const rowCbs = document.querySelectorAll('.lead-row-cb');
    const bulkBar = document.getElementById('bulkBar');
    const selectedBadge = document.getElementById('selectedCountBadge');

    function updateBulkState() {
        const checkedCount = document.querySelectorAll('.lead-row-cb:checked').length;
        if (checkedCount > 0) {
            bulkBar.style.display = 'flex';
            selectedBadge.textContent = checkedCount + ' selected';
        } else {
            bulkBar.style.display = 'none';
        }
    }

    if (masterCb) {
        masterCb.addEventListener('change', function () {
            rowCbs.forEach(cb => cb.checked = masterCb.checked);
            updateBulkState();
        });
    }

    rowCbs.forEach(cb => {
        cb.addEventListener('change', function () {
            if (!cb.checked && masterCb) masterCb.checked = false;
            updateBulkState();
        });
    });
});

function confirmBulkAction(form) {
    const actionSelect = form.querySelector('select[name="action"]');
    if (!actionSelect.value) {
        alert('Please choose a bulk action first.');
        return false;
    }
    if (actionSelect.value === 'delete') {
        return confirm('Are you sure you want to permanently delete all selected leads?');
    }
    return true;
}

function openViewModal(lead) {
    const container = document.getElementById('viewModalContent');
    let payloadHtml = '';
    if (lead.payload && Object.keys(lead.payload).length > 0) {
        payloadHtml = `<div style="margin-top:12px;"><strong style="display:block; margin-bottom:4px; font-size:0.85rem; color:var(--a-text-muted);">Additional Payload:</strong><pre style="margin:0; padding:12px; background:#0f172a; border-radius:8px; font-size:0.8rem; overflow:auto; max-height:160px; color:#38bdf8;">${JSON.stringify(lead.payload, null, 2)}</pre></div>`;
    }

    container.innerHTML = `
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; background:rgba(0,0,0,0.15); padding:16px; border-radius:12px;">
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Client Name</span><strong>${escapeHtml(lead.name)}</strong></div>
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Form Type</span><span class="badge" style="background:rgba(15,118,110,0.2); color:#2dd4bf;">${escapeHtml(lead.form_type)}</span></div>
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Email</span><a href="mailto:${escapeHtml(lead.email || '')}" style="color:#38bdf8;">${escapeHtml(lead.email || 'N/A')}</a></div>
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Phone</span><span>${escapeHtml(lead.phone || 'N/A')}</span></div>
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Company / College</span><span>${escapeHtml(lead.company || lead.college || 'N/A')}</span></div>
            <div><span style="color:var(--a-text-muted); font-size:0.8rem; display:block;">Submitted At</span><span>${escapeHtml(lead.created_at || 'N/A')}</span></div>
        </div>
        <div>
            <strong style="display:block; margin-bottom:4px; font-size:0.85rem; color:var(--a-text-muted);">Subject / Topic:</strong>
            <div style="font-weight:700; font-size:1rem; color:#fff;">${escapeHtml(lead.subject || 'N/A')}</div>
        </div>
        <div>
            <strong style="display:block; margin-bottom:4px; font-size:0.85rem; color:var(--a-text-muted);">Full Message:</strong>
            <div style="background:rgba(0,0,0,0.2); padding:14px; border-radius:10px; font-size:0.9rem; line-height:1.6; white-space:pre-wrap; color:#e2e8f0;">${escapeHtml(lead.message || 'No message provided.')}</div>
        </div>
        ${lead.notes ? `<div><strong style="display:block; margin-bottom:4px; font-size:0.85rem; color:var(--a-text-muted);">Admin Notes:</strong><div style="background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.3); padding:12px; border-radius:8px; font-size:0.88rem; color:#facc15;">${escapeHtml(lead.notes)}</div></div>` : ''}
        ${payloadHtml}
        ${lead.source_page ? `<div style="font-size:0.78rem; color:var(--a-text-muted); margin-top:8px;">Source Page: <a href="${escapeHtml(lead.source_page)}" target="_blank" style="color:#38bdf8;">${escapeHtml(lead.source_page)}</a></div>` : ''}
    `;

    document.getElementById('viewModal').classList.add('open');
}

function openEditModal(lead) {
    const form = document.getElementById('editForm');
    form.action = `/bih-console/leads/${lead.id}`;
    document.getElementById('editStatus').value = lead.status || 'new';
    document.getElementById('editNotes').value = lead.notes || '';
    document.getElementById('editModal').classList.add('open');
}

function openReplyModal(lead) {
    const form = document.getElementById('replyForm');
    form.action = `/bih-console/leads/${lead.id}/reply`;
    document.getElementById('replyToEmail').value = `${lead.name} <${lead.email}>`;
    document.getElementById('replySubject').value = `Re: ${lead.subject || 'Your Inquiry to Bengal IT Hub'}`;
    document.getElementById('replyMessage').value = `Dear ${lead.name},\n\nThank you for reaching out to Bengal IT Hub regarding "${lead.subject || 'your inquiry'}".\n\n\n\nBest regards,\nBengal IT Hub Team\nhttps://bengalithub.com`;
    document.getElementById('replyMailtoBtn').href = `mailto:${encodeURIComponent(lead.email)}?subject=${encodeURIComponent('Re: ' + (lead.subject || 'Your Inquiry to Bengal IT Hub'))}`;
    document.getElementById('replyModal').classList.add('open');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('open');
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
</script>
@endsection
