<?php

namespace App\Http\Controllers;

use App\Support\InternalLinks;
use Illuminate\View\View;

class IndustriesController extends Controller
{
    public function index(): View
    {
        return view('pages.industries.index', [
            'seo' => $this->buildSeo(
                'Industries | Bengal IT Hub',
                'Bengal IT Hub builds technology solutions across Real Estate, Health Care, EdTech, Manufacturing, Logistics, Travel & Hospitality, Retail, Banking & Finance, Transportation, and Information Services.',
            ),
            'industries' => config('bengalhub.industries'),
        ]);
    }

    public function show(string $industry): View
    {
        $data = config("bengalhub.industries.{$industry}");
        abort_unless($data, 404);

        return view('pages.industries.show', [
            'seo' => $this->buildSeo(
                $data['name'].' | Bengal IT Hub Industries',
                $data['summary'],
                $data['image'] ?? null,
            ),
            'slug' => $industry,
            'industry' => $data,
            'internalLinks' => InternalLinks::forIndustry($industry, $data),
        ]);
    }

    public function showSub(string $industry, string $sub): View
    {
        $data = config("bengalhub.industries.{$industry}");
        abort_unless($data, 404);

        $branch = $data['subBranches'][$sub] ?? null;
        abort_unless($branch, 404);

        return view('pages.industries.sub-show', [
            'seo' => $this->buildSeo(
                $branch['name'].' | '.$data['name'].' | Bengal IT Hub',
                $branch['summary'],
                $branch['image'] ?? null,
            ),
            'industrySlug' => $industry,
            'industry' => $data,
            'branch' => $branch,
            'internalLinks' => InternalLinks::forIndustry($industry, $data, $branch),
        ]);
    }

    private function buildSeo(string $title, string $description, ?string $image = null): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'image' => $image ?: asset('logo_bengal_it_hub.svg'),
            'keywords' => config('bengalhub.seo.keywords'),
            'robots' => config('bengalhub.seo.robots'),
        ];
    }
}
