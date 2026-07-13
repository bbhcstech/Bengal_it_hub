<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $services = $this->services();
        $event = $this->eventData();
        $home = $this->cmsReady('site_settings') ? SiteSetting::value('home', []) : [];

        return view('pages.home', [
            'seo' => $this->seo(
                $home['meta_title'] ?? 'Future Ready Bengal | AI Hackathon & IT Services | Bengal IT Hub',
                $home['meta_description'] ?? 'Bengal IT Hub ignites Zen X innovation in Eastern India through advanced IT solutions, SaaS, cloud, AI marketing, talent empowerment, and The Bengal HackFest PRAGATI 2026.',
                $home['meta_keywords'] ?? null,
            ),
            'services' => $services,
            'event' => $event,
            'home' => $home,
            'faqs' => $this->faqs('site'),
            'partners' => $this->cmsReady('partners') ? Partner::published()->where('scope', 'home')->orderBy('sort_order')->get() : collect(),
        ]);
    }

    public function serviceIndex(): View
    {
        return view('pages.services.index', [
            'seo' => $this->seo('Services | Bengal IT Hub', 'Explore Bengal IT Hub services across AI marketing, talent, education, business enablement, and operations outsourcing.'),
            'services' => $this->services(),
        ]);
    }

    public function serviceShow(string $slug): View
    {
        $serviceModel = $this->cmsReady('services') ? Service::published()->where('slug', $slug)->first() : null;
        $service = $serviceModel?->toPublicArray() ?? config('bengalhub.services')[$slug] ?? null;
        abort_unless($service, 404);

        return view('pages.services.show', [
            'seo' => $this->seo(
                $serviceModel?->meta_title ?: $service['title'].' | Bengal IT Hub',
                $serviceModel?->meta_description ?: $service['summary'],
                $serviceModel?->meta_keywords,
                $serviceModel?->meta_robots,
            ),
            'service' => $service,
            'slug' => $slug,
        ]);
    }

    public function event(): View
    {
        $eventModel = $this->cmsReady('events') ? Event::with(['timelines', 'people'])->where('status', 'published')->orderByDesc('id')->first() : null;

        return view('pages.event.show', [
            'seo' => $this->seo(
                $eventModel?->meta_title ?: 'Hackfest 2026 | The Bengal HackFest PRAGATI',
                $eventModel?->meta_description ?: 'East India premier AI Hackathon at Jadavpur University, Kolkata. Register, sponsor, mentor, and build future-ready innovation.',
                $eventModel?->meta_keywords,
                $eventModel?->meta_robots,
            ),
            'event' => array_merge(config('bengalhub.event'), $eventModel?->toPublicArray() ?: []),
            'partners' => $this->cmsReady('partners') ? Partner::published()->where('scope', 'home')->orderBy('sort_order')->get() : collect(),
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
        $pageModel = $this->cmsReady('pages') ? Page::where('slug', $slug)->where('status', 'published')->first() : null;
        $page = $pageModel
            ? [$pageModel->title, $pageModel->blocks['eyebrow'] ?? '', $pageModel->blocks['intro'] ?? '']
            : $this->fallbackPages()[$slug] ?? null;

        abort_unless($page, 404);

        return view('pages.static', [
            'seo' => $this->seo(
                $pageModel?->meta_title ?: $page[0].' | Bengal IT Hub',
                $pageModel?->meta_description ?: $page[2],
                $pageModel?->meta_keywords,
                $pageModel?->meta_robots,
            ),
            'page' => $page,
            'slug' => $slug,
            'faqs' => $this->faqs('site'),
            'partners' => $this->cmsReady('partners') ? Partner::published()->whereIn('scope', ['home', 'about'])->orderBy('sort_order')->get() : collect(),
            'posts' => $this->cmsReady('blog_posts') ? BlogPost::where('status', 'published')->latest('published_at')->take(6)->get() : collect(),
        ]);
    }

    public function showBySlug(string $slug): View
    {
        if (($this->cmsReady('services') && Service::published()->where('slug', $slug)->exists()) || isset(config('bengalhub.services')[$slug])) {
            return $this->serviceShow($slug);
        }

        return $this->static($slug);
    }

    private function services()
    {
        if (! $this->cmsReady('services')) {
            return collect(config('bengalhub.services'));
        }

        $services = Service::published()->ordered()->get();

        if ($services->isEmpty()) {
            return collect(config('bengalhub.services'));
        }

        return $services->mapWithKeys(fn (Service $service) => [$service->slug => $service->toPublicArray()]);
    }

    private function eventData(): array
    {
        if (! $this->cmsReady('events')) {
            return config('bengalhub.event');
        }

        $event = Event::with(['timelines', 'people'])->where('status', 'published')->orderByDesc('id')->first();

        return $event?->toPublicArray() ?: config('bengalhub.event');
    }

    private function faqs(string $scope): array
    {
        if (! $this->cmsReady('faqs')) {
            return $scope === 'site' ? config('bengalhub.faqs') : [];
        }

        $faqs = Faq::published()->where('scope', $scope)->ordered()->get();

        if ($faqs->isEmpty() && $scope === 'site') {
            return config('bengalhub.faqs');
        }

        return $faqs->map(fn (Faq $faq) => [$faq->question, $faq->answer])->all();
    }

    private function fallbackPages(): array
    {
        return [
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
    }

    private function cmsReady(string $table): bool
    {
        return Schema::hasTable($table);
    }

    private function seo(string $title, string $description, ?string $keywords = null, ?string $robots = null): array
    {
        return compact('title', 'description') + [
            'image' => asset('logo_bengal_it_hub.png'),
            'keywords' => $keywords ?: config('bengalhub.seo.keywords'),
            'robots' => $robots ?: config('bengalhub.seo.robots'),
        ];
    }
}
