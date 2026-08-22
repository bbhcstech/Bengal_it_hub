<?php

namespace App\Services;

use App\Models\ContentBlock;

class ContentBlockSeeder
{
    public static function seedDefaults(): void
    {
        $defaults = [
            'home' => [
                ['hero_headline', 'Homepage Hero Title', 'Igniting Zen X Tech & AI Innovation from Bengal', 'text', 1],
                ['hero_subheadline', 'Homepage Hero Subtitle', 'Building India\'s AI Gigafactory and empowering global enterprises with scalable software, cloud, and talent.', 'textarea', 2],
                ['hero_image', 'Homepage Hero Banner Image', '/assets/images/hero-banner.jpg', 'image', 3],
                ['cta_primary_label', 'Primary CTA Button Label', 'Explore Services', 'text', 4],
                ['cta_primary_url', 'Primary CTA Button Link', '/services', 'text', 5],
            ],
            'about-us' => [
                ['hero_title', 'About Us Hero Title', 'Pioneering Tech Transformation in Bengal & Beyond', 'text', 1],
                ['hero_intro', 'About Us Intro Text', 'Bengal IT Hub is a premier IT solutions provider and AI talent ecosystem delivering digital transformation.', 'textarea', 2],
                ['about_image', 'About Us Main Image', '/assets/images/about-hero.jpg', 'image', 3],
            ],
            'vision-2030' => [
                ['hero_title', 'Vision 2030 Title', 'Vision 2030: Bengal AI Gigafactory', 'text', 1],
                ['hero_intro', 'Vision 2030 Intro Text', 'Transforming West Bengal into India\'s central AI talent, cloud infrastructure, and software hub by 2030.', 'textarea', 2],
            ],
            'services' => [
                ['hero_title', 'Services Page Title', 'Enterprise IT & AI Solutions', 'text', 1],
                ['hero_intro', 'Services Page Subtitle', 'Custom software development, cloud infrastructure, AI marketing, and staff augmentation.', 'textarea', 2],
            ],
            'products' => [
                ['hero_title', 'Products Page Title', 'SaaS & Technology Products', 'text', 1],
                ['hero_intro', 'Products Page Subtitle', 'Production-tested digital platforms built for scale, performance, and security.', 'textarea', 2],
            ],
            'tech-biz' => [
                ['hero_title', 'TechBiz Title', 'TechBiz Insights & Newsroom', 'text', 1],
                ['hero_intro', 'TechBiz Subtitle', 'Latest updates, strategic corporate partnerships, and technology innovation milestones.', 'textarea', 2],
            ],
            'our-clients' => [
                ['hero_title', 'Clients Page Title', 'Trusted by Industry Leaders', 'text', 1],
                ['hero_intro', 'Clients Page Subtitle', 'Empowering growth for enterprise clients, institutions, and innovative startups.', 'textarea', 2],
            ],
            'awards-recognition' => [
                ['hero_title', 'Awards Title', 'Awards & Industry Recognition', 'text', 1],
                ['hero_intro', 'Awards Subtitle', 'Celebrating excellence, certifications, and industry achievements.', 'textarea', 2],
            ],
            'our-partners' => [
                ['hero_title', 'Partners Page Title', 'Partner Ecosystem', 'text', 1],
                ['hero_intro', 'Partners Page Subtitle', 'Strategic technology partners, academic institutions, and industry allies.', 'textarea', 2],
            ],
            'tech-innovation' => [
                ['hero_title', 'Tech Innovation Title', 'Tech Innovation Hub', 'text', 1],
                ['hero_intro', 'Tech Innovation Subtitle', 'Curated research, emerging tech insights, and automated RSS news feeds.', 'textarea', 2],
            ],
            'industries' => [
                ['hero_title', 'Industries Page Title', 'Industries We Serve', 'text', 1],
                ['hero_intro', 'Industries Subtitle', 'Tailored software solutions across Real Estate, Healthcare, EduTech, Manufacturing, Logistics, and Hospitality.', 'textarea', 2],
            ],
            'hackfest-2026' => [
                ['hero_title', 'HackFest Title', 'The Bengal HackFest PRAGATI 2026', 'text', 1],
                ['hero_intro', 'HackFest Subtitle', 'East India\'s flagship AI Hackathon bringing together top developers, mentors, and industry sponsors.', 'textarea', 2],
            ],
            'contact' => [
                ['hero_title', 'Contact Page Title', 'Get in Touch with Bengal IT Hub', 'text', 1],
                ['hero_intro', 'Contact Subtitle', 'Tell us about your project requirements, partnership proposals, or career aspirations.', 'textarea', 2],
                ['contact_email', 'Support Email', 'contact@bengalithub.com', 'text', 3],
                ['contact_phone', 'Support Phone', '+91 98300 00000', 'text', 4],
                ['contact_address', 'Office Address', 'Kolkata, West Bengal, India', 'textarea', 5],
            ],
            'academic-partnership' => [
                ['hero_title', 'Academic Partnership Title', 'Academic Partnership Program', 'text', 1],
                ['hero_intro', 'Academic Subtitle', 'Collaborating with universities and institutes to foster AI talent development.', 'textarea', 2],
            ],
            'footer' => [
                ['footer_tagline', 'Footer Tagline', 'Future-Ready Technology Solutions & AI Talent Ecosystem.', 'textarea', 1],
                ['copyright_text', 'Copyright Notice', 'Copyright 2026 Bengal IT Hub. All rights reserved.', 'text', 2],
            ],
        ];

        foreach ($defaults as $page => $blocks) {
            foreach ($blocks as [$key, $label, $content, $type, $order]) {
                ContentBlock::firstOrCreate(
                    ['page' => $page, 'section_key' => $key],
                    ['label' => $label, 'content' => $content, 'type' => $type, 'order' => $order]
                );
            }
        }
    }
}
