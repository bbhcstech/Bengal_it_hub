@extends('layouts.admin')

@section('content')
    @php
        $statMeta = [
            'leads' => ['label' => 'Total Leads', 'sub' => 'New website enquiries', 'tone' => 'blue', 'icon' => 'LD', 'delta' => '+8.4%'],
            'services' => ['label' => 'Services', 'sub' => 'Active service pages', 'tone' => 'green', 'icon' => 'SV', 'delta' => '+3.1%'],
            'events' => ['label' => 'Events', 'sub' => 'Managed programmes', 'tone' => 'red', 'icon' => 'EV', 'delta' => '+2.0%'],
            'posts' => ['label' => 'Blog Posts', 'sub' => 'Published content pool', 'tone' => 'violet', 'icon' => 'BL', 'delta' => '+5.9%'],
        ];
        $chartBars = $counts;
        $chartMax = max(array_values($chartBars)) ?: 1;
        $leadTotal = max((int) ($counts['leads'] ?? 0), 1);
        $activityTotal = max($activities->count(), 1);
    @endphp

    <div class="admin-dashboard">
        <section class="admin-dashboard-main" aria-label="Dashboard overview">
            <div class="admin-dashboard-heading">
                <div>
                    <p>Admin Report</p>
                    <h1>CMS Dashboard</h1>
                </div>
                <a href="{{ route('home') }}" target="_blank" rel="noopener">Open Website</a>
            </div>

            <div class="admin-stat-grid">
                @foreach ($counts as $label => $value)
                    @php($meta = $statMeta[$label] ?? ['label' => Str::headline($label), 'sub' => 'CMS records', 'tone' => 'blue', 'icon' => Str::upper(Str::substr($label, 0, 2)), 'delta' => '+1.8%'])
                    <article class="admin-stat-card is-{{ $meta['tone'] }}">
                        <div class="admin-stat-card-top">
                            <span>{{ $meta['icon'] }}</span>
                            <em>{{ $meta['delta'] }}</em>
                        </div>
                        <p>{{ $meta['label'] }}</p>
                        <strong>{{ number_format($value) }}</strong>
                        <small>{{ $meta['sub'] }}</small>
                    </article>
                @endforeach
            </div>

            <article class="admin-chart-card">
                <div class="admin-card-title">
                    <div>
                        <h2>CMS Content Health</h2>
                        <p>Track managed sections across the console</p>
                    </div>
                    <span>This month</span>
                </div>
                <div class="admin-chart-legend" aria-hidden="true">
                    <span><i></i> Records</span>
                    <span><i></i> Coverage</span>
                </div>
                <div class="admin-bar-chart">
                    @foreach ($chartBars as $label => $value)
                        <div class="admin-bar-item">
                            <div class="admin-bar-track">
                                <span style="height: {{ max(18, round(($value / $chartMax) * 100)) }}%"></span>
                                <i style="height: {{ max(12, min(88, round((($value + 1) / ($chartMax + 3)) * 82))) }}%"></i>
                            </div>
                            <p>{{ Str::headline($label) }}</p>
                        </div>
                    @endforeach
                </div>
            </article>
        </section>

        <aside class="admin-dashboard-side" aria-label="Dashboard details">
            <article class="admin-side-card admin-progress-card">
                <div class="admin-card-title">
                    <div>
                        <h2>Lead Statistic</h2>
                        <p>Track your website enquiries</p>
                    </div>
                    <span>Today</span>
                </div>
                <div class="admin-rings" aria-hidden="true">
                    <span class="ring-one"></span>
                    <span class="ring-two"></span>
                    <span class="ring-three"></span>
                    <div>
                        <strong>{{ number_format($counts['leads'] ?? 0) }}</strong>
                        <small>Total Leads</small>
                    </div>
                </div>
                <div class="admin-metric-list">
                    <div>
                        <span>Recent leads</span>
                        <strong>{{ number_format($leads->count()) }}</strong>
                        <em>+{{ round(($leads->count() / $leadTotal) * 100) }}%</em>
                    </div>
                    <div>
                        <span>Recent activity</span>
                        <strong>{{ number_format($activities->count()) }}</strong>
                        <em>+{{ round(($activities->count() / $activityTotal) * 100) }}%</em>
                    </div>
                    <div>
                        <span>Services</span>
                        <strong>{{ number_format($counts['services'] ?? 0) }}</strong>
                        <em class="is-alert">+{{ number_format($counts['services'] ?? 0) }}</em>
                    </div>
                </div>
            </article>

            <article class="admin-side-card">
                <div class="admin-card-title">
                    <div>
                        <h2>Latest Leads</h2>
                        <p>Newest form submissions</p>
                    </div>
                    <a href="{{ route('admin.leads') }}">View all</a>
                </div>
                <div class="admin-lead-list">
                    @forelse($leads as $lead)
                        <a href="{{ route('admin.leads') }}">
                            <span>{{ Str::of($lead->name)->substr(0, 1)->upper() }}</span>
                            <div>
                                <strong>{{ $lead->name }}</strong>
                                <small>{{ $lead->form_type }} · {{ $lead->email }} {{ $lead->phone }}</small>
                            </div>
                        </a>
                    @empty
                        <p class="admin-empty">No leads yet.</p>
                    @endforelse
                </div>
            </article>
        </aside>

        <section class="admin-activity-card">
            <div class="admin-card-title">
                <div>
                    <h2>Recent Activity</h2>
                    <p>Latest admin actions in the console</p>
                </div>
                <span>Live</span>
            </div>
            <div class="admin-activity-list">
                @forelse($activities as $activity)
                    <div>
                        <span>{{ Str::of($activity->action)->substr(0, 1)->upper() }}</span>
                        <p>
                            <strong>{{ $activity->action }} {{ class_basename($activity->subject_type) }}</strong>
                            <small>{{ optional($activity->user)->name ?? 'System' }} · {{ $activity->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                @empty
                    <p class="admin-empty">No activity yet.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
