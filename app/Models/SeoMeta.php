<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        'page_type',
        'page_id',
        'route_slug',
        'title',
        'meta_description',
        'keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'robots',
        'schema_type',
        'schema_json',
    ];

    protected $casts = [
        'schema_json' => 'array',
    ];

    /**
     * Fetch SEO data for a given route slug, falling back to sensible defaults.
     */
    public static function forSlug(string $slug): array
    {
        $meta = static::where('route_slug', $slug)->first();

        $siteName = Setting::get('site_name', 'Bengal IT Hub');
        $siteTagline = Setting::get('site_tagline', 'Bengal IT Hub delivers custom software, AI solutions, web development and IT services.');
        $defaultLogo = url(Setting::get('site_logo_light', '/logo_bengal_it_hub.svg'));

        $defaults = [
            'title' => $siteName . ' | Custom Software, AI & IT Innovation Hub',
            'meta_description' => $siteTagline,
            'keywords' => 'software development company, IT hub, AI solutions, web development, mobile app development, Bengal IT Hub',
            'canonical_url' => url()->current(),
            'og_title' => null,
            'og_description' => null,
            'og_image' => url(Setting::get('default_og_image', '/assets/images/logo-square.jpg')),
            'twitter_title' => null,
            'twitter_description' => null,
            'twitter_image' => null,
            'robots' => 'index,follow',
            'schema_type' => 'Organization',
            'schema_json' => null,
        ];

        if (! $meta) {
            $data = $defaults;
        } else {
            $data = [
                'title' => $meta->title ?: $defaults['title'],
                'meta_description' => $meta->meta_description ?: $defaults['meta_description'],
                'keywords' => $meta->keywords ?: $defaults['keywords'],
                'canonical_url' => $meta->canonical_url ?: $defaults['canonical_url'],
                'og_title' => $meta->og_title ?: ($meta->title ?: $defaults['title']),
                'og_description' => $meta->og_description ?: ($meta->meta_description ?: $defaults['meta_description']),
                'og_image' => $meta->og_image ? url($meta->og_image) : $defaults['og_image'],
                'twitter_title' => $meta->twitter_title ?: ($meta->title ?: $defaults['title']),
                'twitter_description' => $meta->twitter_description ?: ($meta->meta_description ?: $defaults['meta_description']),
                'twitter_image' => $meta->twitter_image ? url($meta->twitter_image) : ($meta->og_image ? url($meta->og_image) : $defaults['og_image']),
                'robots' => $meta->robots ?: $defaults['robots'],
                'schema_type' => $meta->schema_type ?: $defaults['schema_type'],
                'schema_json' => $meta->schema_json,
            ];
        }

        if (empty($data['schema_json'])) {
            $data['schema_json'] = static::generateSchema($data['schema_type'], $data['title'], $data['meta_description'], $data['canonical_url'], $defaultLogo);
        }

        return $data;
    }

    /**
     * Generate standard JSON-LD Schema array based on type.
     */
    public static function generateSchema(string $type, string $title, string $description, string $url, string $logoUrl): array
    {
        $siteName = Setting::get('site_name', 'Bengal IT Hub');
        $phone = Setting::get('contact_phone', '+91 98765 43210');
        $email = Setting::get('contact_email', 'contact@bengalithub.com');
        $address = Setting::get('contact_address', 'Kolkata, West Bengal, India');

        switch ($type) {
            case 'Organization':
            case 'LocalBusiness':
                return [
                    '@context' => 'https://schema.org',
                    '@type' => $type === 'LocalBusiness' ? 'LocalBusiness' : 'Organization',
                    'name' => $siteName,
                    'url' => url('/'),
                    'logo' => $logoUrl,
                    'description' => $description,
                    'telephone' => $phone,
                    'email' => $email,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $address,
                        'addressLocality' => 'Kolkata',
                        'addressRegion' => 'West Bengal',
                        'addressCountry' => 'IN',
                    ],
                ];

            case 'Service':
                return [
                    '@context' => 'https://schema.org',
                    '@type' => 'Service',
                    'name' => $title,
                    'description' => $description,
                    'provider' => [
                        '@type' => 'Organization',
                        'name' => $siteName,
                        'url' => url('/'),
                    ],
                    'url' => $url,
                ];

            case 'Article':
                return [
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $title,
                    'description' => $description,
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => $url,
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => $siteName,
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => $logoUrl,
                        ],
                    ],
                ];

            case 'WebSite':
            default:
                return [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => $siteName,
                    'url' => url('/'),
                    'description' => $description,
                ];
        }
    }
}
