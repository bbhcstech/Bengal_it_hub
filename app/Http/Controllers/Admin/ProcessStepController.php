<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        return view('admin.process-steps.index', ['items' => ProcessStep::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('admin.process-steps.form', ['item' => new ProcessStep()]);
    }

    public function store(Request $request)
    {
        ProcessStep::create($this->validated($request));

        return redirect()->route('admin.process-steps.index')->with('status', 'Process step created successfully.');
    }

    public function edit(ProcessStep $processStep)
    {
        return view('admin.process-steps.form', ['item' => $processStep]);
    }

    public function update(Request $request, ProcessStep $processStep)
    {
        $processStep->update($this->validated($request));

        return redirect()->route('admin.process-steps.index')->with('status', 'Process step updated successfully.');
    }

    public function destroy(ProcessStep $processStep)
    {
        $processStep->delete();

        return back()->with('status', 'Process step deleted successfully.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'step_number' => ['required', 'integer'],
            'order' => ['nullable', 'integer'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
