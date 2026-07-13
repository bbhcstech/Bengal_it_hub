<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'form_type' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:3000'],
            'company' => ['nullable', 'string', 'max:160'],
            'college' => ['nullable', 'string', 'max:160'],
            'team_size' => ['nullable', 'integer', 'min:1', 'max:10'],
            'interest' => ['nullable', 'string', 'max:160'],
            'website' => ['nullable', 'size:0'],
        ]);

        $event = str_contains($validated['form_type'], 'hackfest') && Schema::hasTable('events')
            ? Event::where('slug', 'hackfest-2026')->first()
            : null;

        Lead::create([
            'form_type' => $validated['form_type'],
            'event_slug' => $event?->slug ?: (str_contains($validated['form_type'], 'hackfest') ? 'hackfest-2026' : null),
            'event_id' => $event?->id,
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'] ?? null,
            'payload' => collect($validated)->except(['form_type', 'name', 'email', 'phone', 'subject', 'message', 'website'])->all(),
            'source_page' => url()->previous(),
        ]);

        return back()->with('status', 'Thank you. Your submission has been saved and the Bengal IT Hub team can follow up from the admin leads inbox.');
    }
}
