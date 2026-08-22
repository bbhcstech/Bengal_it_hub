@extends('layouts.admin')

@section('content')
    @php
        $statMeta = [
            'services' => [
                'label' => 'Services Live',
                'icon' => 'purple',
                'trend' => '↑ 10%',
                'spark' => [40, 50, 60, 60, 70, 70, 80, 80, 90, 90, 100, 100],
                'svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>',
            ],
            'events' => [
                'label' => 'Events / HackFest',
                'icon' => 'gold',
                'trend' => '↑ 22%',
                'spark' => [12, 18, 24, 32, 43, 54, 65, 74, 84, 90, 95, 100],
                'svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>',
            ],
            'posts' => [
                'label' => 'Blog Posts',
                'icon' => 'green',
                'trend' => '↑ 8%',
                'spark' => [66, 66, 75, 75, 83, 83, 83, 91, 91, 100, 100, 100],
                'svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 7h7l-5.5 4.5L18.5 21 12 16.5 5.5 21l2-7.5L2 9h7z"/></svg>',
            ],
            'leads' => [
                'label' => 'Total Leads',
                'icon' => 'red',
                'trend' => 'New',
                'spark' => [33, 55, 22, 66, 44, 77, 33, 55, 88, 44, 66, 100],
                'svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>',
            ],
        ];

        $featureGroups = [
            'Website & CMS Content' => [
                ['title' => 'Pages & Landing Sections', 'route' => 'admin.pages', 'shortcut' => 'Alt + P', 'desc' => 'Manage homepage hero, vision, & static pages', 'icon' => '📄'],
                ['title' => 'Page Content Editor', 'route' => 'admin.content.index', 'shortcut' => 'Alt + C', 'desc' => 'Visual block editor for website pages', 'icon' => '✏️'],
                ['title' => 'Services Catalog', 'route' => 'admin.services', 'shortcut' => 'Alt + S', 'desc' => 'Software, web, app, & AI services', 'icon' => '💼'],
                ['title' => 'Products & SaaS Lines', 'route' => 'admin.products.index', 'shortcut' => 'Alt + D', 'desc' => 'CodeCraft, CloudStack, & AI tools', 'icon' => '🚀'],
                ['title' => 'Portfolio Case Studies', 'route' => 'admin.portfolio.index', 'shortcut' => 'Alt + K', 'desc' => 'Showcase client projects & builds', 'icon' => '🎨'],
            ],
            'Company & Team Directory' => [
                ['title' => 'Core Differentiators', 'route' => 'admin.differentiators.index', 'shortcut' => 'Alt + 1', 'desc' => 'Manage USP selling points', 'icon' => '⭐'],
                ['title' => 'Process Steps', 'route' => 'admin.process-steps.index', 'shortcut' => 'Alt + 2', 'desc' => 'Discover, Design, Build, & Scale', 'icon' => '🔄'],
                ['title' => 'Team Members', 'route' => 'admin.team.index', 'shortcut' => 'Alt + 3', 'desc' => 'Engineers, leadership, & mentors', 'icon' => '👥'],
                ['title' => 'Testimonials', 'route' => 'admin.testimonials.index', 'shortcut' => 'Alt + T', 'desc' => 'Client reviews & feedback quotes', 'icon' => '💬'],
                ['title' => 'Tech Stack Directory', 'route' => 'admin.tech-stack.index', 'shortcut' => 'Alt + 4', 'desc' => 'Laravel, Vue, AI, & Cloud stack', 'icon' => '🛠️'],
            ],
            'Insights & Growth Ecosystem' => [
                ['title' => 'Blog & Insights', 'route' => 'admin.blog', 'shortcut' => 'Alt + B', 'desc' => 'Publish news, articles, & announcements', 'icon' => '📰'],
                ['title' => 'FAQs Directory', 'route' => 'admin.faqs', 'shortcut' => 'Alt + F', 'desc' => 'Common Q&A questions & answers', 'icon' => '❓'],
                ['title' => 'Partners Directory', 'route' => 'admin.partners', 'shortcut' => 'Alt + 5', 'desc' => 'Academic & industry partner profiles', 'icon' => '🤝'],
                ['title' => 'SEO Meta Manager', 'route' => 'admin.seo.index', 'shortcut' => 'Alt + O', 'desc' => 'Page titles, descriptions, & OG tags', 'icon' => '🔍'],
                ['title' => '301/302 Redirects', 'route' => 'admin.redirects.index', 'shortcut' => 'Alt + 6', 'desc' => 'URL redirect mapping rules', 'icon' => '🔀'],
            ],
            'Events, Feeds & Leads' => [
                ['title' => 'AI Chatbot Q&A', 'route' => 'admin.chatbot.index', 'shortcut' => 'Alt + A', 'desc' => 'AI bot knowledge training pairs', 'icon' => '🤖'],
                ['title' => 'Events & HackFest', 'route' => 'admin.events', 'shortcut' => 'Alt + E', 'desc' => 'PRAGATI 2026 event management', 'icon' => '🏆'],
                ['title' => 'RSS News Sources', 'route' => 'admin.rss-sources', 'shortcut' => 'Alt + R', 'desc' => 'Automated TechBiz news feeds', 'icon' => '📡'],
                ['title' => 'Contact Submissions', 'route' => 'admin.leads', 'shortcut' => 'Alt + L', 'desc' => 'Client inquiries, leads, & messages', 'icon' => '📩'],
                ['title' => 'Console Settings', 'route' => 'admin.settings', 'shortcut' => 'Alt + G', 'desc' => 'Global brand, contact, & GA4 keys', 'icon' => '⚙️'],
            ]
        ];
    @endphp

    <style>
    .bih-dash-section { margin-bottom: 28px; }
    .bih-feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
    }
    .bih-feature-card {
        background: var(--a-surface, #1e293b);
        border: 1px solid var(--a-border, #334155);
        border-radius: 14px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        transition: all 0.22s ease;
        position: relative;
        overflow: hidden;
    }
    .bih-feature-card:hover {
        transform: translateY(-3px);
        border-color: var(--a-brand, #38bdf8);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    .bih-shortcut-badge {
        font-family: monospace;
        font-size: 0.7rem;
        font-weight: 700;
        background: rgba(234, 179, 8, 0.15);
        color: #facc15;
        border: 1px solid rgba(234, 179, 8, 0.3);
        padding: 2px 7px;
        border-radius: 6px;
        letter-spacing: 0.05em;
    }
    .bih-chart-card {
        background: var(--a-surface, #1e293b);
        border: 1px solid var(--a-border, #334155);
        border-radius: 16px;
        padding: 22px;
    }
    </style>

    <div class="admin-dashboard-container">
        {{-- ── Top Stat Cards ── --}}
        <div class="a-grid a-grid-4 bih-dash-section">
            @foreach (['services', 'events', 'posts', 'leads'] as $key)
                @php
                    $meta = $statMeta[$key];
                    $val = $counts[$key] ?? 0;
                @endphp
                <div class="stat-box">
                    <div class="stat-top">
                        <div class="stat-icon {{ $meta['icon'] }}">
                            {!! $meta['svg'] !!}
                        </div>
                        @if($key === 'leads')
                            <span class="badge badge-gold">{{ $leads->count() }} recent</span>
                        @else
                            <span class="trend-chip trend-up">{{ $meta['trend'] }}</span>
                        @endif
                    </div>
                    <div class="num">{{ number_format($val) }}</div>
                    <div class="label">{{ $meta['label'] }}</div>
                    <div class="sparkline">
                        @foreach($meta['spark'] as $h)
                            <span style="height:{{ $h }}%;"></span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ── Analytics & Graphs Section (Line Trend & Pie Charts) ── --}}
        <div class="a-grid bih-dash-section" style="grid-template-columns: 1.6fr 1fr; align-items: stretch; gap: 20px;">
            {{-- Monthly Activity & Inquiries Trend Graph --}}
            <div class="bih-chart-card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <div>
                        <span style="font-size:0.75rem; font-weight:700; color:var(--a-text-muted); text-transform:uppercase; letter-spacing:0.06em;">MONTHLY INQUIRIES &amp; TRAFFIC TREND</span>
                        <h3 style="margin:4px 0 0; font-size:1.3rem;">Client Submissions &amp; Activity</h3>
                    </div>
                    <a href="{{ route('admin.leads') }}" class="btn btn-outline btn-sm">View Leads Inbox &rarr;</a>
                </div>

                {{-- Line Graph SVG --}}
                <svg viewBox="0 0 600 200" style="width:100%; height:180px; margin-top:12px;" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="trendGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.35"/>
                            <stop offset="100%" stop-color="#38bdf8" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <line x1="20" y1="180" x2="580" y2="180" stroke="var(--a-border)" stroke-width="1"/>
                    <line x1="20" y1="120" x2="580" y2="120" stroke="var(--a-border)" stroke-width="1" stroke-dasharray="3 4"/>
                    <line x1="20" y1="60" x2="580" y2="60" stroke="var(--a-border)" stroke-width="1" stroke-dasharray="3 4"/>
                    <path d="M20,150 Q120,90 220,120 T420,60 T580,30 L580,180 L20,180 Z" fill="url(#trendGrad)"/>
                    <path d="M20,150 Q120,90 220,120 T420,60 T580,30" fill="none" stroke="#38bdf8" stroke-width="3.5" stroke-linecap="round"/>
                    <circle cx="20" cy="150" r="5" fill="#1e293b" stroke="#38bdf8" stroke-width="3"/>
                    <circle cx="160" cy="105" r="5" fill="#1e293b" stroke="#38bdf8" stroke-width="3"/>
                    <circle cx="300" cy="115" r="5" fill="#1e293b" stroke="#38bdf8" stroke-width="3"/>
                    <circle cx="440" cy="55" r="5" fill="#1e293b" stroke="#38bdf8" stroke-width="3"/>
                    <circle cx="580" cy="30" r="6" fill="#facc15" stroke="#1e293b" stroke-width="3"/>
                </svg>
                <div style="display:flex; justify-content:space-between; font-size:0.75rem; color:var(--a-text-muted); font-weight:700; margin-top:8px; padding:0 8px;">
                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun (Current)</span>
                </div>
            </div>

            {{-- Pie Chart / Donut Distribution --}}
            <div class="bih-chart-card" style="display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                    <span style="font-size:0.75rem; font-weight:700; color:var(--a-text-muted); text-transform:uppercase; letter-spacing:0.06em;">LEAD CATEGORY DISTRIBUTION</span>
                    <h3 style="margin:4px 0 0; font-size:1.2rem;">Submissions by Topic</h3>
                </div>

                {{-- Interactive Pie / Donut SVG --}}
                <div style="position:relative; width:150px; height:150px; margin:16px auto;">
                    <svg viewBox="0 0 140 140" style="width:100%; height:100%; transform:rotate(-90deg);">
                        <circle cx="70" cy="70" r="54" fill="none" stroke="var(--a-border)" stroke-width="16"/>
                        {{-- Software Dev (45%) --}}
                        <circle cx="70" cy="70" r="54" fill="none" stroke="#38bdf8" stroke-width="16" stroke-dasharray="152 339" stroke-dashoffset="0" stroke-linecap="round"/>
                        {{-- HackFest (30%) --}}
                        <circle cx="70" cy="70" r="54" fill="none" stroke="#facc15" stroke-width="16" stroke-dasharray="101 339" stroke-dashoffset="-152" stroke-linecap="round"/>
                        {{-- Staff Augmentation & AI (25%) --}}
                        <circle cx="70" cy="70" r="54" fill="none" stroke="#2dd4bf" stroke-width="16" stroke-dasharray="86 339" stroke-dashoffset="-253" stroke-linecap="round"/>
                    </svg>
                    <div style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                        <span style="font-size:1.6rem; font-weight:800; color:#fff;">{{ $counts['leads'] ?? 0 }}</span>
                        <span style="font-size:0.7rem; font-weight:700; color:var(--a-text-muted); text-transform:uppercase;">Total Inquiries</span>
                    </div>
                </div>

                <div style="display:grid; gap:8px; font-size:0.8rem; margin-top:8px;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="display:flex; align-items:center; gap:8px;"><span style="width:10px; height:10px; border-radius:50%; background:#38bdf8;"></span>Software &amp; Web Dev</span>
                        <strong>45%</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="display:flex; align-items:center; gap:8px;"><span style="width:10px; height:10px; border-radius:50%; background:#facc15;"></span>HackFest PRAGATI</span>
                        <strong>30%</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="display:flex; align-items:center; gap:8px;"><span style="width:10px; height:10px; border-radius:50%; background:#2dd4bf;"></span>Staffing &amp; Partnerships</span>
                        <strong>25%</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             ALL ADMIN PANEL FEATURES SECTION (IN ONE PLACE WITH SHORTCUTS)
             ═══════════════════════════════════════════════════════════ --}}
        <div class="bih-dash-section">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
                <div>
                    <h2 style="margin:0; font-size:1.4rem; font-weight:800;">All Admin Features &amp; Modules</h2>
                    <p style="margin:4px 0 0; color:var(--a-text-muted); font-size:0.88rem;">Direct shortcut access to every feature page in the Bengal IT Hub Admin Console.</p>
                </div>
                <div style="font-size:0.8rem; color:var(--a-text-muted); font-weight:600; display:flex; align-items:center; gap:6px;">
                    <span>⚡ Tip: Press keyboard shortcut key combinations to navigate instantly</span>
                </div>
            </div>

            @foreach($featureGroups as $groupTitle => $features)
                <div style="margin-bottom: 24px;">
                    <h3 style="font-size:0.95rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; color:var(--a-text-muted); margin:0 0 12px; display:flex; align-items:center; gap:8px;">
                        <span style="width:8px; height:8px; border-radius:50%; background:var(--a-gold, #facc15);"></span>
                        {{ $groupTitle }}
                    </h3>

                    <div class="bih-feature-grid">
                        @foreach($features as $feat)
                            <a href="{{ route($feat['route']) }}" class="bih-feature-card" title="Go to {{ $feat['title'] }}">
                                <div>
                                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                                        <span style="font-size:1.6rem; line-height:1;">{{ $feat['icon'] }}</span>
                                        <span class="bih-shortcut-badge">{{ $feat['shortcut'] }}</span>
                                    </div>
                                    <h4 style="margin:0 0 4px; font-size:0.96rem; font-weight:700; color:#fff;">{{ $feat['title'] }}</h4>
                                    <p style="margin:0; font-size:0.8rem; color:var(--a-text-muted); line-height:1.4;">{{ $feat['desc'] }}</p>
                                </div>
                                <div style="margin-top:14px; font-size:0.78rem; font-weight:700; color:var(--a-brand, #38bdf8); display:flex; align-items:center; gap:4px;">
                                    <span>Open Feature</span>
                                    <span>&rarr;</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ── Bottom Split: Recent Submissions & Activity ── --}}
        <div class="a-grid" style="grid-template-columns:1.6fr 1fr; align-items:start;">
            <div>
                {{-- Recent Leads Table --}}
                <div class="a-card">
                    <div class="page-header" style="margin-bottom:14px;">
                        <div class="a-card-head" style="margin:0;">
                            <span class="a-card-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                            </span>
                            <h3 style="margin:0;">Recent Contact Submissions</h3>
                        </div>
                        <a href="{{ route('admin.leads') }}" class="btn btn-outline btn-sm">Manage All Leads</a>
                    </div>
                    <table class="a-table">
                        <thead>
                            <tr>
                                <th>Contact Name</th>
                                <th>Email / Contact</th>
                                <th>Form Type</th>
                                <th>Submitted</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leads as $lead)
                                <tr>
                                    <td>
                                        <div class="table-avatar-row">
                                            <div class="mini-avatar">{{ Str::of($lead->name)->substr(0, 2)->upper() }}</div>
                                            <div>
                                                <strong>{{ $lead->name }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $lead->email }} {{ $lead->phone ? '· '.$lead->phone : '' }}</td>
                                    <td><span class="badge badge-gold">{{ $lead->form_type ?? 'Contact' }}</span></td>
                                    <td>{{ $lead->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ route('admin.leads') }}" class="btn btn-outline btn-sm">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;color:var(--a-text-muted);padding:24px;">No lead submissions recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{-- Recent Activity --}}
                <div class="a-card">
                    <div class="a-card-head">
                        <span class="a-card-icon">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                        </span>
                        <h3 style="margin:0;">Recent Activity Log</h3>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:16px;">
                        @forelse($activities as $activity)
                            <div class="flex gap-2" style="align-items:flex-start;">
                                <div class="mini-avatar">{{ Str::of(optional($activity->user)->name ?? 'System')->substr(0, 2)->upper() }}</div>
                                <div>
                                    <strong style="font-size:0.85rem;">{{ optional($activity->user)->name ?? 'System' }}</strong>
                                    <p style="margin:2px 0 0;font-size:0.8rem;color:var(--a-text-muted);">{{ $activity->action }} {{ class_basename($activity->subject_type) }}</p>
                                    <span style="font-size:0.72rem;color:var(--a-text-muted);">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <p style="font-size:0.82rem;color:var(--a-text-muted);margin:0;">No recent activity logs.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Keyboard Shortcuts Hotkey Script --}}
    <script>
    document.addEventListener('keydown', function (e) {
        if (e.altKey && !e.ctrlKey && !e.shiftKey) {
            const key = e.key.toLowerCase();
            const shortcutMap = {
                'p': '{{ route("admin.pages") }}',
                'c': '{{ route("admin.content.index") }}',
                's': '{{ route("admin.services") }}',
                'd': '{{ route("admin.products.index") }}',
                'k': '{{ route("admin.portfolio.index") }}',
                't': '{{ route("admin.testimonials.index") }}',
                'b': '{{ route("admin.blog") }}',
                'f': '{{ route("admin.faqs") }}',
                'o': '{{ route("admin.seo.index") }}',
                'a': '{{ route("admin.chatbot.index") }}',
                'e': '{{ route("admin.events") }}',
                'r': '{{ route("admin.rss-sources") }}',
                'l': '{{ route("admin.leads") }}',
                'g': '{{ route("admin.settings") }}',
                'u': '{{ route("admin.users.index") }}'
            };

            if (shortcutMap[key]) {
                e.preventDefault();
                window.location.href = shortcutMap[key];
            }
        }
    });
    </script>
@endsection
