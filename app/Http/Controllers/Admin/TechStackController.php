<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    public function index()
    {
        return view('admin.tech-stack.index', ['items' => TechStack::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('admin.tech-stack.form', ['item' => new TechStack()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('tech-stack', 'public');
        }
        TechStack::create($data);

        return redirect()->route('admin.tech-stack.index')->with('status', 'Tech stack item created successfully.');
    }

    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stack.form', ['item' => $techStack]);
    }

    public function update(Request $request, TechStack $techStack)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('tech-stack', 'public');
        }
        $techStack->update($data);

        return redirect()->route('admin.tech-stack.index')->with('status', 'Tech stack item updated successfully.');
    }

    public function destroy(TechStack $techStack)
    {
        $techStack->delete();

        return back()->with('status', 'Tech stack item deleted successfully.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:frontend,backend,cloud_devops,database'],
            'order' => ['nullable', 'integer'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
