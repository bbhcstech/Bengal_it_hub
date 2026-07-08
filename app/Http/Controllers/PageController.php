<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'seo' => $this->seo('AI Hackathon | The Bengal HackFest PRAGATI 2026 | Bengal IT Hub', 'Bengal IT Hub ignites innovation in Eastern India through AI talent, digital services, and The Bengal HackFest PRAGATI 2026.'),
            'services' => collect(config('bengalhub.services'))->take(6),
            'event' => config('bengalhub.event'),
        ]);
    }

    public function serviceIndex(): View
    {
        return view('pages.services.index', [
            'seo' => $this->seo('Services | Bengal IT Hub', 'Explore Bengal IT Hub services across AI marketing, talent, education, business enablement, and operations outsourcing.'),
            'services' => config('bengalhub.services'),
        ]);
    }

    public function serviceShow(string $slug): View
    {
        abort_unless(isset(config('bengalhub.services')[$slug]), 404);

        $service = config('bengalhub.services')[$slug];

        return view('pages.services.show', [
            'seo' => $this->seo($service['title'].' | Bengal IT Hub', $service['summary']),
            'service' => $service,
            'slug' => $slug,
        ]);
    }

    public function event(): View
    {
        return view('pages.event.show', [
            'seo' => $this->seo('Hackfest 2026 | The Bengal HackFest PRAGATI', 'East India premier AI Hackathon at Jadavpur University, Kolkata. Register, sponsor, mentor, and build future-ready innovation.'),
            'event' => config('bengalhub.event'),
        ]);
    }

    public function form(string $type): View
    {
        $labels = [
            'contact' => ['Contact Us', 'Tell us what you want to build, partner, or discuss.'],
            'participant' => ['Register With HackFest 2026', 'Submit your team or participant interest for PRAGATI 2026.'],
            'sponsor' => ['Sponsors Request for Meeting', 'Start a sponsor or exclusive partner conversation.'],
            'academic' => ['Academic Partnership Enquiry', 'Invite your college or institution into the ecosystem.'],
        ];

        abort_unless(isset($labels[$type]), 404);

        return view('pages.form', [
            'seo' => $this->seo($labels[$type][0].' | Bengal IT Hub', $labels[$type][1]),
            'type' => $type,
            'title' => $labels[$type][0],
            'intro' => $labels[$type][1],
        ]);
    }

    public function static(string $slug): View
    {
        $pages = [
            'vision-2030' => ['Vision 2030', 'AI Powered Bengal', 'Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.'],
            'about-us' => ['About Us', 'About Our AI Talent Platform', 'Bengal IT Hub delivers globally deployable AI and technology talent through industry-aligned skilling, real-world experience, and enterprise-ready execution.'],
            'our-partners' => ['Our Partners', 'Industry Expert Partners', 'Our partners bring real-world insight, mentorship, strategic guidance, and delivery capability to bridge academic learning with industry innovation.'],
            'faq' => ['FAQ', 'Answers For Visitors', 'Browse common questions about Bengal IT Hub, its services, events, and partnership opportunities.'],
            'blog' => ['Blog', 'Insights Coming Online', 'The live WordPress site has a placeholder blog link. This Laravel build includes the route and is ready for a full blog CMS module.'],
            'tech-talk' => ['Tech Talk', 'Curated Technology Media', 'Tech Talk currently points to external news portals and can later be brought in-house as a native insights module.'],
            'terms-conditions' => ['Terms & Conditions', 'Effective Date: 18 Feb 2026', 'By accessing the Bengal IT Hub website, registering for events, or participating in any program including The Bengal HackFest PRAGATI 2026, users agree to comply with the published terms.'],
            'privacy-policy' => ['Privacy Policy', 'Effective Date: 2 January 2026', 'Bengal IT Hub is committed to protecting personal information shared through the website, forms, registrations, events, and communication channels.'],
            'download-sponsor-brochure' => ['Download Sponsor Brochure', 'Thank You For Your Interest', 'The sponsorship brochure download flow replaces the WordPress Download Manager plugin with a native Laravel-ready download page.'],
            'download-final-year-career-template-v1-0' => ['Download Final Year Career Template v1.0', 'Career Template Download', 'A native download confirmation page for future student and career resources.'],
            'sponsor-hackfest-2026' => ['Partner With Us', 'Sponsors & Exclusive Partners', 'Bengal HackFest PRAGATI 2026 invites visionary organizations, technology leaders, and innovation-driven companies to partner with one of Eastern India premier student innovation platforms.'],
            'pricing' => ['Pricing', 'Custom Engagement Models', 'Pricing and engagement models can be configured by service, event, or partner requirement.'],
            'amenities' => ['Amenities', 'Spaces And Facilities', 'A flexible facilities page retained for migration compatibility.'],
            'ascend' => ['Ascend', 'Innovation Acceleration', 'A landing page for ideas, incubation, and market acceleration.'],
            'vault' => ['Vault', 'Strategic Knowledge Repository', 'A landing page for reusable resources, frameworks, and future-ready technology assets.'],
        ];

        abort_unless(isset($pages[$slug]), 404);

        return view('pages.static', [
            'seo' => $this->seo($pages[$slug][0].' | Bengal IT Hub', $pages[$slug][2]),
            'page' => $pages[$slug],
            'slug' => $slug,
            'faqs' => config('bengalhub.faqs'),
        ]);
    }

    private function seo(string $title, string $description): array
    {
        return compact('title', 'description') + ['image' => asset('images/og-bengal-it-hub.jpg')];
    }
}
