<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\Event;
use App\Models\EventTimeline;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Person;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@bengalithub.com'],
            [
                'name' => 'Bengal IT Hub Admin',
                'password' => Hash::make('Bengal@12345'),
                'role' => 'super_admin',
                'is_active' => true,
            ],
        );

        SiteSetting::updateOrCreate(['key' => 'brand'], ['value' => config('bengalhub.brand')]);
        SiteSetting::updateOrCreate(['key' => 'nav'], ['value' => config('bengalhub.nav')]);
        SiteSetting::updateOrCreate(['key' => 'home'], ['value' => [
            'hero_eyebrow' => 'Professional Digital Innovation Platform',
            'hero_title' => 'Future Ready Bengal',
            'hero_highlight' => 'Bengal',
            'hero_intro' => 'Bengal IT Hub ignites Gen X innovation in Eastern India. We bridge fresh ideas to market reality through advanced IT solutions, digital engineering, talent empowerment, and The Bengal HackFest PRAGATI 2026.',
            'hero_image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85',
            'device_eyebrow' => 'Grow Your Business Online',
            'device_title' => 'AI, SaaS, Cloud & Talent Delivery',
            'stats' => ['500+ Projects', '98% Client Satisfaction', '24/7 Support'],
            'device_chips' => ['Web Platforms', 'SEO & Growth', 'E-Collab', 'Support'],
        ]]);

        foreach (config('bengalhub.services') as $index => $service) {
            Service::updateOrCreate(
                ['slug' => $index],
                [
                    'title' => $service['title'],
                    'kicker' => $service['kicker'],
                    'summary' => $service['summary'],
                    'body' => 'This page is powered by a reusable service data structure. In the full CMS phase, admins can edit the hero, body, benefit bullets, galleries, CTA, and SEO fields without code changes.',
                    'features' => $service['features'],
                    'sort_order' => array_search($index, array_keys(config('bengalhub.services')), true) + 1,
                    'is_featured' => true,
                    'status' => 'published',
                    'meta_title' => $service['title'].' | Bengal IT Hub',
                    'meta_description' => $service['summary'],
                ],
            );
        }

        $eventConfig = config('bengalhub.event');
        $event = Event::updateOrCreate(
            ['slug' => $eventConfig['slug']],
            [
                'name' => $eventConfig['name'],
                'tagline' => $eventConfig['tagline'],
                'venue' => $eventConfig['venue'],
                'finale' => $eventConfig['finale'],
                'counters' => $eventConfig['counters'],
                'status' => 'published',
                'meta_title' => 'Hackfest 2026 | The Bengal HackFest PRAGATI',
                'meta_description' => 'East India premier AI Hackathon at Jadavpur University, Kolkata. Register, sponsor, mentor, and build future-ready innovation.',
            ],
        );

        $event->timelines()->delete();
        foreach ($eventConfig['timeline'] as $index => [$label, $date, $isOpen]) {
            EventTimeline::create([
                'event_id' => $event->id,
                'label' => $label,
                'date' => $date,
                'is_open' => $isOpen,
                'sort_order' => $index + 1,
            ]);
        }

        $event->people()->delete();
        foreach ($eventConfig['people'] as $index => [$role, $name, $bio, $linkedin]) {
            Person::create([
                'event_id' => $event->id,
                'role_type' => $role,
                'name' => $name,
                'bio' => $bio,
                'linkedin_url' => $linkedin ?: null,
                'sort_order' => $index + 1,
                'status' => 'published',
            ]);
        }

        Faq::where('scope', $event->slug)->delete();
        foreach ($eventConfig['faqs'] as $index => [$question, $answer]) {
            Faq::create([
                'scope' => $event->slug,
                'question' => $question,
                'answer' => $answer,
                'category' => 'HackFest',
                'sort_order' => $index + 1,
                'status' => 'published',
            ]);
        }

        foreach (config('bengalhub.faqs') as $index => [$question, $answer]) {
            Faq::updateOrCreate(
                ['scope' => 'site', 'question' => $question],
                ['answer' => $answer, 'category' => 'General', 'sort_order' => $index + 1, 'status' => 'published'],
            );
        }

        foreach (['Industry Experts', 'Academic Partners', 'Innovation Partners', 'Hiring Partners', 'Technology Partners', 'Community Partners'] as $index => $name) {
            Partner::updateOrCreate(
                ['name' => $name, 'scope' => 'home'],
                ['sort_order' => $index + 1, 'status' => 'published'],
            );
        }

        $pages = [
            'vision-2030' => ['Vision 2030', 'AI Powered Bengal', 'Vision 2030 positions Bengal IT Hub as Bengal AI Gigafactory, transforming local talent into globally deployable AI professionals through industrial-scale skilling, staff augmentation, and enterprise collaboration.'],
            'about-us' => ['About Us', 'About Our AI Talent Platform', 'Bengal IT Hub delivers globally deployable AI and technology talent through industry-aligned skilling, real-world experience, and enterprise-ready execution.'],
            'our-partners' => ['Our Partners', 'Industry Expert Partners', 'Our partners bring real-world insight, mentorship, strategic guidance, and delivery capability to bridge academic learning with industry innovation.'],
            'faq' => ['FAQ', 'Answers For Visitors', 'Browse common questions about Bengal IT Hub, its services, events, and partnership opportunities.'],
            'blog' => ['Blog', 'Insights Coming Online', 'The live WordPress site has a placeholder blog link. This Laravel build includes the route and is ready for a full blog CMS module.'],
            'tech-talk' => ['Tech Talk', 'Curated Technology Media', 'Tech Talk currently points to external news portals and can later be brought in-house as a native insights module.'],
            'terms-conditions' => ['Terms & Conditions', 'Effective Date: 18 Feb 2026', 'By accessing the Bengal IT Hub website, registering for events, or participating in any program including The Bengal HackFest PRAGATI 2026, users agree to comply with the published terms.'],
            'privacy-policy' => ['Privacy Policy', 'Effective Date: 2 January 2026', 'Bengal IT Hub is committed to protecting personal information shared through the website, forms, registrations, events, and communication channels.'],
            'sponsor-hackfest-2026' => ['Partner With Us', 'Sponsors & Exclusive Partners', 'Bengal HackFest PRAGATI 2026 invites visionary organizations, technology leaders, and innovation-driven companies to partner with one of Eastern India premier student innovation platforms.'],
            'pricing' => ['Pricing', 'Custom Engagement Models', 'Pricing and engagement models can be configured by service, event, or partner requirement.'],
            'amenities' => ['Amenities', 'Spaces And Facilities', 'A flexible facilities page retained for migration compatibility.'],
            'ascend' => ['Ascend', 'Innovation Acceleration', 'A landing page for ideas, incubation, and market acceleration.'],
            'vault' => ['Vault', 'Strategic Knowledge Repository', 'A landing page for reusable resources, frameworks, and future-ready technology assets.'],
        ];

        foreach ($pages as $slug => $page) {
            Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $page[0],
                    'blocks' => ['eyebrow' => $page[1], 'intro' => $page[2]],
                    'meta_title' => $page[0].' | Bengal IT Hub',
                    'meta_description' => $page[2],
                    'status' => 'published',
                ],
            );
        }

        BlogCategory::updateOrCreate(['slug' => 'insights'], ['name' => 'Insights']);

        $this->command?->info('Admin login: /bih-console using admin@bengalithub.com / Bengal@12345');
    }
}
