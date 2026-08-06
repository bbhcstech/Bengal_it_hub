<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\View\View;

class PartnersController extends Controller
{
    public function index(): View
    {
        $partners = Partner::published()->hasSlug()->ordered()->get();
        $content = config('bengalhub.partnersPage');
        $content['intro']['stats'] = [
            ['value' => (string) $partners->count(), 'label' => 'Partner Categories'],
            ['value' => (string) $partners->pluck('scope')->unique()->count(), 'label' => 'Collaboration Scopes'],
            ['value' => '4', 'label' => 'Ways We Partner Together'],
            ['value' => '2030', 'label' => 'Vision We\'re Building Toward'],
        ];

        return view('pages.partners.index', [
            'seo' => $this->buildSeo(
                'Our Partners | Bengal IT Hub',
                'Meet the industry, academic, innovation, and technology partners working alongside Bengal IT Hub.',
            ),
            'partners' => $partners,
            'content' => $content,
        ]);
    }

    public function show(Partner $partner): View
    {
        abort_unless($partner->status === 'published', 404);

        $related = Partner::published()
            ->hasSlug()
            ->where('id', '!=', $partner->id)
            ->where('scope', $partner->scope)
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.partners.show', [
            'seo' => $this->buildSeo(
                $partner->name.' | Bengal IT Hub Partners',
                $partner->description ?: 'A partner working alongside Bengal IT Hub.',
                $partner->logo,
            ),
            'partner' => $partner,
            'related' => $related,
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
