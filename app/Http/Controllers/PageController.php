<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Support\InternalLinks;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Per-service section layout combination. Each service gets a distinct
     * mix of hero/features/formats/flow/outcomes section variants (a/b/c)
     * so pages built from the same shared content schema don't all look alike.
     */
    private const SERVICE_LAYOUTS = [
        'tech-ed-fest' => ['hero' => 'a', 'features' => 'a', 'formats' => 'a', 'flow' => 'a', 'outcomes' => 'a'],
        'educamp' => ['hero' => 'b', 'features' => 'b', 'formats' => 'b', 'flow' => 'b', 'outcomes' => 'b'],
        'eduverse-2' => ['hero' => 'c', 'features' => 'c', 'formats' => 'c', 'flow' => 'c', 'outcomes' => 'c'],
        'groomify' => ['hero' => 'b', 'features' => 'a', 'formats' => 'b', 'flow' => 'b', 'outcomes' => 'a'],
        'ai-marketing' => ['hero' => 'a', 'features' => 'c', 'formats' => 'a', 'flow' => 'c', 'outcomes' => 'b'],
        'biz-consultation' => ['hero' => 'c', 'features' => 'b', 'formats' => 'c', 'flow' => 'a', 'outcomes' => 'c'],
        'biz-enablement' => ['hero' => 'b', 'features' => 'c', 'formats' => 'b', 'flow' => 'a', 'outcomes' => 'b'],
        'e-collab-2' => ['hero' => 'a', 'features' => 'b', 'formats' => 'c', 'flow' => 'b', 'outcomes' => 'c'],
        'staff-augmentation' => ['hero' => 'c', 'features' => 'a', 'formats' => 'a', 'flow' => 'c', 'outcomes' => 'a'],
        'corporate-operations-outsourcing' => ['hero' => 'b', 'features' => 'b', 'formats' => 'a', 'flow' => 'c', 'outcomes' => 'b'],
    ];

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
                image: 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85',
            ),
            'services' => $services,
            'event' => $event,
            'home' => $home,
            'landingPages' => $this->landingPages(['vision', 'vision-2030', 'about-us']),
            'faqs' => $this->faqs('site'),
            'partners' => $this->cmsReady('partners') ? Partner::published()->hasSlug()->where('scope', 'home')->orderBy('sort_order')->get() : collect(),
        ]);
    }

    public function serviceIndex(): View
    {
        return view('pages.services.index', [
            'seo' => $this->seo('Services | Bengal IT Hub', 'Explore Bengal IT Hub services across AI marketing, talent, education, business enablement, and operations outsourcing.'),
            'services' => $this->services(),
        ]);
    }

    public function products(): View
    {
        return view('pages.products.index', [
            'seo' => $this->seo(
                'Products | Bengal IT Hub',
                'Software, web, app, IoT, AI, and digital marketing products built by Bengal IT Hub across modern, production-tested technology.',
            ),
            'products' => config('bengalhub.products'),
        ]);
    }

    public function productShow(string $slug): View
    {
        $products = collect(config('bengalhub.products.items'));
        $product = $products->firstWhere('slug', $slug);
        abort_unless($product, 404);

        return view('pages.products.show', [
            'seo' => $this->seo(
                $product['title'].' | Bengal IT Hub Products',
                $product['summary'],
                image: $product['image'] ?? null,
            ),
            'product' => $product,
            'technologies' => config('bengalhub.products.technologies'),
            'otherProducts' => $products->where('slug', '!=', $slug)->take(3),
            'internalLinks' => InternalLinks::forProduct($product),
        ]);
    }

    public function techBiz(): View
    {
        return view('pages.techbiz', [
            'seo' => $this->seo(
                'TechBiz | Bengal IT Hub',
                "TechBiz is Bengal IT Hub's technology newsroom, covering partnership meetings, product milestones, and industry collaboration.",
            ),
            'techbiz' => config('bengalhub.techbiz'),
        ]);
    }

    public function clients(): View
    {
        return view('pages.clients.index', [
            'seo' => $this->seo(
                'Our Clients | Bengal IT Hub',
                'Explore Bengal IT Hub client companies, logos, sectors, deal products, and digital systems delivered across practical business categories.',
                image: config('bengalhub.clients.intro.image'),
            ),
            'clients' => config('bengalhub.clients'),
        ]);
    }

    public function awardsRecognition(): View
    {
        return view('pages.awards-recognition', [
            'seo' => $this->seo(
                'Awards & Recognition | Bengal IT Hub',
                "Awards, certifications, media mentions, and industry recognition earned by Bengal IT Hub.",
                image: config('bengalhub.awards.intro.image'),
            ),
            'awards' => config('bengalhub.awards'),
        ]);
    }

    public function serviceShow(string $slug): View
    {
        $serviceModel = $this->cmsReady('services') ? Service::published()->where('slug', $slug)->first() : null;
        $service = config('bengalhub.services')[$slug] ?? $serviceModel?->toPublicArray() ?? null;
        abort_unless($service, 404);

        return view('pages.services.show', [
            'seo' => $this->seo(
                $serviceModel?->meta_title ?: $service['title'].' | Bengal IT Hub',
                $serviceModel?->meta_description ?: $service['summary'],
                $serviceModel?->meta_keywords,
                $serviceModel?->meta_robots,
                $service['image'] ?? null,
            ),
            'service' => $service,
            'slug' => $slug,
            'layout' => self::SERVICE_LAYOUTS[$slug] ?? null,
            'internalLinks' => InternalLinks::forService($slug, $service),
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
            'partners' => $this->cmsReady('partners') ? Partner::published()->hasSlug()->where('scope', 'home')->orderBy('sort_order')->get() : collect(),
        ]);
    }

    public function hackfestChiefGuest(): View
    {
        return view('pages.event.chief-guest', [
            'seo' => $this->seo(
                'Chief Guest | The Bengal HackFest PRAGATI 2026',
                'Meet the distinguished Chief Guest of honor for The Bengal HackFest PRAGATI 2026.',
            ),
            'event' => $this->eventDataForFeaturePage(),
        ]);
    }

    public function hackfestChiefAdviser(): View
    {
        return view('pages.event.chief-adviser', [
            'seo' => $this->seo(
                'Chief Adviser | The Bengal HackFest PRAGATI 2026',
                'Meet the Chief Adviser providing strategic guidance for The Bengal HackFest PRAGATI 2026.',
            ),
            'event' => $this->eventDataForFeaturePage(),
        ]);
    }

    public function hackfestSpeakers(): View
    {
        return view('pages.event.speakers', [
            'seo' => $this->seo(
                'Speakers & Panelists | The Bengal HackFest PRAGATI 2026',
                "A showcase of the expert speakers, panelists, and industry leaders at The Bengal HackFest PRAGATI 2026.",
            ),
            'event' => $this->eventDataForFeaturePage(),
        ]);
    }

    public function hackfestGallery(): View
    {
        $eventModel = $this->cmsReady('events') ? Event::where('status', 'published')->orderByDesc('id')->first() : null;
        $galleryItems = $eventModel ? $eventModel->galleryItems()->published()->get() : collect();

        return view('pages.event.gallery', [
            'seo' => $this->seo(
                'Gallery | The Bengal HackFest PRAGATI 2026',
                'Photos and videos from The Bengal HackFest PRAGATI 2026, added as real event media becomes available.',
            ),
            'event' => $this->eventDataForFeaturePage(),
            'galleryItems' => $galleryItems,
        ]);
    }

    public function hackfestFaq(): View
    {
        return view('pages.event.faq', [
            'seo' => $this->seo(
                'FAQ | The Bengal HackFest PRAGATI 2026',
                'Answers to the most common questions about The Bengal HackFest PRAGATI 2026.',
            ),
            'event' => $this->eventDataForFeaturePage(),
        ]);
    }

    public function hackfestVenue(): View
    {
        return view('pages.event.venue', [
            'seo' => $this->seo(
                'Event Venue | The Bengal HackFest PRAGATI 2026',
                'Venue details for The Bengal HackFest PRAGATI 2026 Grand Finale.',
            ),
            'event' => $this->eventDataForFeaturePage(),
        ]);
    }

    private function eventDataForFeaturePage(): array
    {
        $eventModel = $this->cmsReady('events') ? Event::with(['timelines', 'people'])->where('status', 'published')->orderByDesc('id')->first() : null;

        return array_merge(config('bengalhub.event'), $eventModel?->toPublicArray() ?: []);
    }

    public function form(string $type): View
    {
        $labels = [
            'contact' => ['Contact Us', 'Tell us what you want to build, partner, or discuss.'],
            'participant' => ['HackFest 2026 Registration', 'Registrations for The Bengal HackFest PRAGATI 2026 closed on 30 April 2026.'],
            'sponsor' => ['Sponsors Request for Meeting', 'Start a sponsor or exclusive partner conversation.'],
            'academic' => ['Academic Partnership Enquiry', 'Invite your college or institution into the ecosystem.'],
        ];

        abort_unless(isset($labels[$type]), 404);

        return view('pages.form', [
            'seo' => $this->seo(
                $labels[$type][0].' | Bengal IT Hub',
                $labels[$type][1],
                robots: $type === 'participant' ? 'noindex, follow' : null,
            ),
            'type' => $type,
            'title' => $labels[$type][0],
            'intro' => $labels[$type][1],
        ]);
    }

    public function static(string $slug): View
    {
        $pageModel = $this->cmsReady('pages') ? Page::where('slug', $slug)->where('status', 'published')->first() : null;

        if ($slug === 'vision-2030') {
            return view('pages.vision-2030', [
                'seo' => $this->seo(
                    $pageModel?->meta_title ?: 'Vision 2030 | Bengal IT Hub',
                    $pageModel?->meta_description ?: "Vision 2030 is Bengal IT Hub's mission to build India's first AI Gigafactory from Bengal, transforming West Bengal into India's leading AI talent and innovation ecosystem.",
                    $pageModel?->meta_keywords,
                    $pageModel?->meta_robots,
                ),
            ]);
        }

        if ($slug === 'about-us') {
            return view('pages.about-us', [
                'seo' => $this->seo(
                    $pageModel?->meta_title ?: 'About Us | Bengal IT Hub',
                    $pageModel?->meta_description ?: 'Bengal IT Hub is an IT company and AI talent ecosystem delivering software, cloud, digital transformation, AI solutions, skilling, and enterprise-ready technology execution from Bengal.',
                    $pageModel?->meta_keywords,
                    $pageModel?->meta_robots,
                ),
                'partners' => $this->cmsReady('partners') ? Partner::published()->hasSlug()->whereIn('scope', ['home', 'about'])->orderBy('sort_order')->get() : collect(),
            ]);
        }

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
            'internalLinks' => InternalLinks::forStatic($slug, $page),
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

    private function landingPages(array $slugs)
    {
        if (! $this->cmsReady('pages')) {
            return collect();
        }

        return Page::whereIn('slug', $slugs)
            ->where('status', 'published')
            ->get()
            ->keyBy('slug');
    }

    public function fallbackPages(): array
    {
        return [
            'vision-2030' => ['Vision 2030', 'AI Powered Bengal', 'Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.'],
            'about-us' => ['About Us', 'About Our AI Talent Platform', 'Bengal IT Hub delivers globally deployable AI and technology talent through industry-aligned skilling, real-world experience, and enterprise-ready execution.'],
            'vision' => ['Vision', 'Vision Section', 'Two focused pathways introduce the long-term Bengal IT Hub direction and the company behind it.'],
            'faq' => ['FAQ', 'Answers For Visitors', 'Browse common questions about Bengal IT Hub, its services, events, and partnership opportunities.'],
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

    private function seo(string $title, string $description, ?string $keywords = null, ?string $robots = null, ?string $image = null): array
    {
        return compact('title', 'description') + [
            'image' => $image ?: asset('logo_bengal_it_hub.svg'),
            'keywords' => $keywords ?: config('bengalhub.seo.keywords'),
            'robots' => $robots ?: config('bengalhub.seo.robots'),
        ];
    }
}
