<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioProjectController extends Controller
{
    public function index()
    {
        return view('admin.portfolio.index', ['items' => PortfolioProject::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('admin.portfolio.form', ['item' => new PortfolioProject()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('portfolio', 'public');
        }
        PortfolioProject::create($data);

        return redirect()->route('admin.portfolio.index')->with('status', 'Portfolio project created successfully.');
    }

    public function edit(PortfolioProject $portfolio)
    {
        return view('admin.portfolio.form', ['item' => $portfolio]);
    }

    public function update(Request $request, PortfolioProject $portfolio)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('portfolio', 'public');
        }
        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('status', 'Portfolio project updated successfully.');
    }

    public function destroy(PortfolioProject $portfolio)
    {
        $portfolio->delete();

        return back()->with('status', 'Portfolio project deleted successfully.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'service_tag' => ['nullable', 'string', 'max:255'],
            'outcome_line' => ['nullable', 'string', 'max:255'],
            'problem' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'result' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
