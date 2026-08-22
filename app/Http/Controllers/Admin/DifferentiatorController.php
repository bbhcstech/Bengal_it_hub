<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Differentiator;
use Illuminate\Http\Request;

class DifferentiatorController extends Controller
{
    public function index()
    {
        return view('admin.differentiators.index', ['items' => Differentiator::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('admin.differentiators.form', ['item' => new Differentiator()]);
    }

    public function store(Request $request)
    {
        Differentiator::create($this->validated($request));

        return redirect()->route('admin.differentiators.index')->with('status', 'Differentiator created successfully.');
    }

    public function edit(Differentiator $differentiator)
    {
        return view('admin.differentiators.form', ['item' => $differentiator]);
    }

    public function update(Request $request, Differentiator $differentiator)
    {
        $differentiator->update($this->validated($request));

        return redirect()->route('admin.differentiators.index')->with('status', 'Differentiator updated successfully.');
    }

    public function destroy(Differentiator $differentiator)
    {
        $differentiator->delete();

        return back()->with('status', 'Differentiator deleted successfully.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
