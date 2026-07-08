@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container">
        @include('partials.section-heading', ['eyebrow' => 'Admin Panel Shell', 'title' => 'Role-Wise CMS Dashboard', 'intro' => 'A first Laravel admin surface for Super Admin, Content Editor, Event Manager, and Leads Manager workflows.'])
        <div class="mt-8 grid gap-4 md:grid-cols-4">
            <div class="bih-card p-5"><div class="text-3xl font-black">{{ $counts['leads'] }}</div><p class="font-bold text-slate-600">Leads</p></div>
            <div class="bih-card p-5"><div class="text-3xl font-black">{{ $counts['services'] }}</div><p class="font-bold text-slate-600">Services</p></div>
            <div class="bih-card p-5"><div class="text-3xl font-black">{{ $counts['eventModules'] }}</div><p class="font-bold text-slate-600">Event Modules</p></div>
            <div class="bih-card p-5"><div class="text-3xl font-black">{{ count($counts['roles']) }}</div><p class="font-bold text-slate-600">Roles</p></div>
        </div>
        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <div class="bih-card p-6">
                <h2 class="text-2xl font-black">Role Modules</h2>
                <div class="mt-4 grid gap-3">
                    @foreach($counts['roles'] as $role)
                        <div class="rounded-md border border-slate-200 bg-white p-4 font-extrabold">{{ $role }}</div>
                    @endforeach
                </div>
            </div>
            <div class="bih-card p-6">
                <h2 class="text-2xl font-black">Latest Leads</h2>
                <div class="mt-4 grid gap-3">
                    @forelse($leads as $lead)
                        <div class="rounded-md border border-slate-200 bg-white p-4">
                            <p class="font-black">{{ $lead->name }} <span class="text-sm text-teal-700">({{ $lead->form_type }})</span></p>
                            <p class="text-sm text-slate-600">{{ $lead->email }} {{ $lead->phone }}</p>
                        </div>
                    @empty
                        <p class="text-slate-600">No leads yet. Submit a public form to see it here.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
