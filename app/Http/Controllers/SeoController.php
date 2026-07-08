<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $urls = collect(['/','/vision-2030','/hackfest-2026','/sponsor-hackfest-2026','/sponsor-form-hackfest-2026','/services','/tech-talk','/about-us','/our-partners','/faq','/blog','/contact','/terms-conditions','/privacy-policy'])
            ->merge(collect(array_keys(config('bengalhub.services')))->map(fn ($slug) => '/'.$slug));

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nSitemap: ".url('/sitemap.xml')."\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
