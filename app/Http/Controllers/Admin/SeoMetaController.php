<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class SeoMetaController extends Controller
{
    public function index()
    {
        return view('admin.seo.index', [
            'items' => SeoMeta::orderBy('page_type')->orderBy('route_slug')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.seo.form', ['item' => new SeoMeta()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('og_image_file')) {
            $path = $request->file('og_image_file')->store('uploads/seo', 'public');
            $data['og_image'] = '/storage/' . $path;
        }

        if ($request->hasFile('twitter_image_file')) {
            $path = $request->file('twitter_image_file')->store('uploads/seo', 'public');
            $data['twitter_image'] = '/storage/' . $path;
        }

        SeoMeta::create($data);

        return redirect()->route('admin.seo.index')->with('status', 'SEO entry created successfully.');
    }

    public function edit(SeoMeta $seo)
    {
        return view('admin.seo.form', ['item' => $seo]);
    }

    public function update(Request $request, SeoMeta $seo)
    {
        $data = $this->validated($request, $seo->id);

        if ($request->hasFile('og_image_file')) {
            $path = $request->file('og_image_file')->store('uploads/seo', 'public');
            $data['og_image'] = '/storage/' . $path;
        }

        if ($request->hasFile('twitter_image_file')) {
            $path = $request->file('twitter_image_file')->store('uploads/seo', 'public');
            $data['twitter_image'] = '/storage/' . $path;
        }

        $seo->update($data);

        return redirect()->route('admin.seo.index')->with('status', 'SEO entry updated successfully.');
    }

    public function destroy(SeoMeta $seo)
    {
        $seo->delete();

        return back()->with('status', 'SEO entry deleted successfully.');
    }

    protected function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'page_type' => ['required', 'string', 'max:100'],
            'route_slug' => ['required', 'string', 'max:255', 'unique:seo_meta,route_slug,' . $id],
            'title' => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'keywords' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'string', 'max:255'],
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_image' => ['nullable', 'string', 'max:255'],
            'robots' => ['required', 'string', 'max:100'],
            'schema_type' => ['required', 'string', 'max:100'],
        ]);
    }
}
