<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $redirects = Redirect::orderBy('id', 'desc')->paginate(20);
        return view('admin.redirects.index', compact('redirects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_url' => ['required', 'string', 'max:255', 'unique:redirects,source_url'],
            'target_url' => ['required', 'string', 'max:255'],
            'status_code' => ['required', 'in:301,302'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['source_url'] = '/' . ltrim($validated['source_url'], '/');

        Redirect::create($validated);

        return back()->with('status', '301/302 Redirect rule added successfully.');
    }

    public function update(Request $request, Redirect $redirect)
    {
        $validated = $request->validate([
            'source_url' => ['required', 'string', 'max:255', 'unique:redirects,source_url,' . $redirect->id],
            'target_url' => ['required', 'string', 'max:255'],
            'status_code' => ['required', 'in:301,302'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['source_url'] = '/' . ltrim($validated['source_url'], '/');

        $redirect->update($validated);

        return back()->with('status', 'Redirect rule updated successfully.');
    }

    public function destroy(Redirect $redirect)
    {
        $redirect->delete();
        return back()->with('status', 'Redirect rule deleted successfully.');
    }
}
