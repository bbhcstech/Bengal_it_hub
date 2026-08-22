<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Bengal IT Hub Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}?v=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo_bengal_it_hub.svg') }}?v=1">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v={{ time() }}">
    <style>
        .admin-shell {
            display: flex !important;
            min-height: 100vh !important;
        }
        .admin-sidebar {
            width: 268px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            height: 100vh !important;
            overflow-y: auto !important;
            z-index: 1000 !important;
        }
        .admin-main {
            flex: 1 !important;
            min-width: 0 !important;
            margin-left: 268px !important;
        }
        @media (max-width: 991px) {
            .admin-sidebar {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
            }
            .admin-main {
                margin-left: 0 !important;
            }
        }
    </style>
    <script>
        (function () {
            var stored = localStorage.getItem('bith-theme');
            var theme = stored || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();
    </script>
</head>
<body>

<div class="admin-shell">
    {{-- ── Admin Sidebar ── --}}
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <img src="{{ asset('assets/images/logo-square.jpg') }}" alt="Bengal IT Hub" style="height:32px;width:32px;border-radius:7px;object-fit:cover;">
            <span>Bengal Admin</span>
        </a>

        {{-- Overview --}}
        <div class="nav-group">
            <div class="nav-group-title">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                </span>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- Website Management --}}
        <div class="nav-group">
            <div class="nav-group-title">Website Content</div>
            @if(auth()->user()->canManage('pages'))
                <a href="{{ route('admin.pages') }}" class="nav-link {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/></svg></span>
                    <span>Pages &amp; Landing Sections</span>
                </a>
                <a href="{{ route('admin.content.index') }}" class="nav-link {{ request()->routeIs('admin.content*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.1 2.1 0 013 3L12 15l-4 1 1-4z"/></svg></span>
                    <span>Page Content Editor</span>
                </a>
            @endif
            @if(auth()->user()->canManage('services'))
                <a href="{{ route('admin.services') }}" class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg></span>
                    <span>Services</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><path d="M3.3 7L12 12l8.7-5M12 22V12"/></svg></span>
                    <span>Products &amp; SaaS</span>
                </a>
                <a href="{{ route('admin.portfolio.index') }}" class="nav-link {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg></span>
                    <span>Portfolio Case Studies</span>
                </a>
            @endif
            @if(auth()->user()->canManage('pages'))
                <a href="{{ route('admin.differentiators.index') }}" class="nav-link {{ request()->routeIs('admin.differentiators*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></span>
                    <span>Core Differentiators</span>
                </a>
                <a href="{{ route('admin.process-steps.index') }}" class="nav-link {{ request()->routeIs('admin.process-steps*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></span>
                    <span>Process Steps</span>
                </a>
                <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></span>
                    <span>Team Members</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></span>
                    <span>Testimonials</span>
                </a>
                <a href="{{ route('admin.tech-stack.index') }}" class="nav-link {{ request()->routeIs('admin.tech-stack*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg></span>
                    <span>Tech Stack</span>
                </a>
            @endif
            @if(auth()->user()->canManage('blog'))
                <a href="{{ route('admin.blog') }}" class="nav-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></span>
                    <span>Blog &amp; Insights</span>
                </a>
            @endif
            @if(auth()->user()->canManage('pages'))
                <a href="{{ route('admin.faqs') }}" class="nav-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"/></svg></span>
                    <span>FAQs</span>
                </a>
                <a href="{{ route('admin.partners') }}" class="nav-link {{ request()->routeIs('admin.partners*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></span>
                    <span>Partners</span>
                </a>
            @endif
        </div>

        {{-- SEO & Growth --}}
        <div class="nav-group">
            <div class="nav-group-title">SEO &amp; Growth</div>
            <a href="{{ route('admin.seo.index') }}" class="nav-link {{ request()->routeIs('admin.seo*') ? 'active' : '' }}">
                <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></svg></span>
                <span>SEO Manager</span>
            </a>
            <a href="{{ route('admin.redirects.index') }}" class="nav-link {{ request()->routeIs('admin.redirects*') ? 'active' : '' }}">
                <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 10 20 15 15 20"/><path d="M4 4v7a4 4 0 004 4h12"/></svg></span>
                <span>301/302 Redirects</span>
            </a>
            <a href="{{ route('admin.chatbot.index') }}" class="nav-link {{ request()->routeIs('admin.chatbot*') ? 'active' : '' }}">
                <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/></svg></span>
                <span>AI Chatbot Q&amp;A</span>
            </a>
        </div>

        {{-- Events & RSS --}}
        <div class="nav-group">
            <div class="nav-group-title">Events &amp; Feeds</div>
            @if(auth()->user()->canManage('events'))
                <a href="{{ route('admin.events') }}" class="nav-link {{ request()->routeIs('admin.events*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg></span>
                    <span>Events &amp; HackFest</span>
                </a>
            @endif
            @if(auth()->user()->canManage('rss'))
                <a href="{{ route('admin.rss-sources') }}" class="nav-link {{ request()->routeIs('admin.rss-sources*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 11a9 9 0 019 9M4 4a16 16 0 0116 16"/><circle cx="5" cy="19" r="1"/></svg></span>
                    <span>RSS Sources</span>
                </a>
            @endif
        </div>

        {{-- Leads & Submissions --}}
        <div class="nav-group">
            <div class="nav-group-title">Leads &amp; Messages</div>
            @if(auth()->user()->canManage('leads'))
                <a href="{{ route('admin.leads') }}" class="nav-link {{ request()->routeIs('admin.leads*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg></span>
                    <span>Contact Submissions</span>
                </a>
            @endif
        </div>

        {{-- System Settings --}}
        <div class="nav-group">
            <div class="nav-group-title">System</div>
            @if(auth()->user()->canManage('settings'))
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg></span>
                    <span>Console Settings</span>
                </a>
                <a href="{{ route('admin.template-editor.index') }}" class="nav-link {{ request()->routeIs('admin.template-editor*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></span>
                    <span>Template Editor</span>
                </a>
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <span class="nav-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></span>
                        <span>Admin Users</span>
                    </a>
                @endif
            @endif
        </div>

        <div class="sidebar-upsell">
            <strong>✨ Bengal Console</strong>
            <p>Full CMS management active for Bengal IT Hub website and events.</p>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-gold btn-sm" style="width:100%;justify-content:center;">View Live Site</a>
        </div>
    </aside>

    {{-- ── Main Admin Content ── --}}
    <div class="admin-main">
        {{-- Topbar --}}
        <div class="admin-topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button type="button" onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = '{{ route('admin.dashboard') }}'; }" class="btn btn-outline btn-sm" title="Go back to previous page" style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;font-weight:600;border-radius:8px;cursor:pointer;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Back</span>
                </button>
                <div class="topbar-titles">
                    <div class="crumb">Console</div>
                    <h1 style="font-size:1.1rem;margin:0;">Bengal Admin</h1>
                </div>
            </div>
            <div class="topbar-search">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" placeholder="Search services, leads, pages...">
            </div>
            <div class="topbar-actions">
                <button type="button" class="admin-theme-toggle" data-theme-toggle aria-label="Toggle dark mode">
                    <span class="knob">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/></svg>
                    </span>
                </button>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm">View Site ↗</a>
                <div class="user-chip">
                    <div class="avatar">{{ Str::of(auth()->user()->name ?? 'Administrator')->substr(0, 2)->upper() }}</div>
                    <div class="meta">
                        <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                        <span>{{ Str::headline(auth()->user()->role ?? 'super_admin') }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>

        {{-- Content View --}}
        <div class="admin-content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script>
    (function () {
        var root = document.documentElement;
        document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var next = root.classList.contains('dark') ? 'light' : 'dark';
                root.classList.toggle('dark');
                localStorage.setItem('bith-theme', next);
            });
        });
    })();

    // Universal AJAX Form Interceptor & Automatic Fresh Page Reload System
    (function () {
        if (!document.getElementById('bih-spin-style')) {
            var style = document.createElement('style');
            style.id = 'bih-spin-style';
            style.innerHTML = '@keyframes bihSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
            document.head.appendChild(style);
        }

        document.addEventListener('submit', function (e) {
            var form = e.target;

            // Bypass AJAX if explicitly disabled or CSV export
            if (form.getAttribute('data-ajax') === 'false' || form.action.includes('/export')) {
                return;
            }

            var actionSelect = form.querySelector('select[name="action"]');
            if (actionSelect && actionSelect.value === 'export') {
                return;
            }

            e.preventDefault();

            var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.75';
                submitBtn.innerHTML = '<span style="display:inline-flex;align-items:center;gap:6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="animation:bihSpin 0.75s linear infinite;"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg> Processing...</span>';
            }

            var formData = new FormData(form);
            var fetchUrl = form.action || window.location.href;
            var fetchMethod = (form.method || 'POST').toUpperCase();

            fetch(fetchUrl, {
                method: fetchMethod,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token') || ''
                }
            })
            .then(function (response) {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    // Smooth reload page to show fresh data cleanly without stale state
                    window.location.reload();
                }
            })
            .catch(function () {
                window.location.reload();
            });
        });
    })();
</script>
</body>
</html>
