<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>BIH Console</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bih-admin">
    @php
        $adminNav = [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'match' => 'admin.dashboard',
                'icon' => 'DB',
                'can' => true,
            ],
            [
                'label' => 'Pages',
                'route' => 'admin.pages',
                'match' => 'admin.pages*',
                'icon' => 'PG',
                'can' => auth()->user()->canManage('pages'),
            ],
            [
                'label' => 'Services',
                'route' => 'admin.services',
                'match' => 'admin.services*',
                'icon' => 'SV',
                'can' => auth()->user()->canManage('services'),
            ],
            [
                'label' => 'Events',
                'route' => 'admin.events',
                'match' => 'admin.events*',
                'icon' => 'EV',
                'can' => auth()->user()->canManage('events'),
            ],
            [
                'label' => 'Blog',
                'route' => 'admin.blog',
                'match' => 'admin.blog*',
                'icon' => 'BL',
                'can' => auth()->user()->canManage('blog'),
            ],
            [
                'label' => 'RSS Sources',
                'route' => 'admin.rss-sources',
                'match' => 'admin.rss-sources*',
                'icon' => 'RS',
                'can' => auth()->user()->canManage('rss'),
            ],
            [
                'label' => 'FAQs',
                'route' => 'admin.faqs',
                'match' => 'admin.faqs*',
                'icon' => 'FQ',
                'can' => auth()->user()->canManage('pages'),
            ],
            [
                'label' => 'Partners',
                'route' => 'admin.partners',
                'match' => 'admin.partners*',
                'icon' => 'PT',
                'can' => auth()->user()->canManage('pages'),
            ],
            [
                'label' => 'Leads',
                'route' => 'admin.leads',
                'match' => 'admin.leads*',
                'icon' => 'LD',
                'can' => auth()->user()->canManage('leads'),
            ],
            [
                'label' => 'Settings',
                'route' => 'admin.settings',
                'match' => 'admin.settings*',
                'icon' => 'ST',
                'can' => auth()->user()->canManage('settings'),
            ],
        ];
    @endphp
    <div class="bih-admin-shell">
        <aside class="bih-admin-sidebar">
            <div class="bih-admin-sidebar-inner">
                <a href="{{ route('admin.dashboard') }}" class="bih-admin-brand" aria-label="BIH Console dashboard">
                    <img src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub">
                    <span>
                        <strong>Bengal IT Hub</strong>
                        <em>Admin Console</em>
                    </span>
                </a>

                <nav class="bih-admin-nav" aria-label="Admin navigation">
                    @foreach ($adminNav as $item)
                        @if ($item['can'])
                            <a class="{{ request()->routeIs($item['match']) ? 'is-active' : '' }}"
                                href="{{ route($item['route']) }}">
                                <span>{{ $item['icon'] }}</span>
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </aside>

        <section class="bih-admin-panel">
            <header class="bih-admin-topbar">
                <div>
                    <p class="text-xs font-black uppercase text-teal-700">Private Workspace</p>
                    <h2>{{ auth()->user()->name ?? 'Administrator' }}</h2>
                </div>
                <div class="bih-admin-actions">
                    <a class="bih-admin-ghost" href="{{ route('home') }}" target="_blank" rel="noopener">View Site</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="bih-admin-logout" type="submit">Logout</button>
                    </form>
                </div>
            </header>

            <div class="bih-admin-welcome">
                <div>
                    <p>Welcome in, {{ Str::before(auth()->user()->name ?? 'Administrator', ' ') }}</p>
                    <span>Manage Bengal IT Hub content, leads, events, and website settings.</span>
                </div>
                <div class="hidden gap-2 md:flex">
                    <span>CMS</span>
                    <span>Events</span>
                    <span>Leads</span>
                </div>
            </div>

            <main class="bih-admin-content">
                @if (session('status'))
                    <div class="mb-5 rounded-lg border border-teal-200 bg-teal-50 p-4 font-bold text-teal-900">
                        {{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-900">
                        {{ $errors->first() }}</div>
                @endif
                @yield('content')
            </main>
        </section>
    </div>
</body>

</html>
