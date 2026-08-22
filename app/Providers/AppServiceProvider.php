<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $publicUrl = config('bengalhub.public_url') ?: config('app.url');

        // Canonical/og/sitemap URLs must always be https:// in production,
        // regardless of proxy/load-balancer headers. Left off in local so
        // XAMPP dev (http://) keeps working unchanged.
        if (! $this->app->environment('local')) {
            URL::forceScheme('https');
        }

        // In production, absolute URLs must use the configured public domain
        // even if the request arrives through a raw IP or proxy host. Local
        // XAMPP stays request-based so subfolder/LAN asset URLs keep working.
        if (! $this->app->environment('local')) {
            URL::forceRootUrl($publicUrl);
        }

        View::composer('*', function ($view): void {
            $brand = config('bengalhub.brand');
            $nav = config('bengalhub.nav');
            $seoSettings = [];

            try {
                if (Schema::hasTable('site_settings')) {
                    $brand = SiteSetting::value('brand', $brand);
                    $nav = SiteSetting::value('nav', $nav);
                    $seoSettings = SiteSetting::value('seo', []);
                }
            } catch (Throwable) {
                //
            }

            $defaultNav = config('bengalhub.nav');
            if (is_array($nav)) {
                foreach ($defaultNav as $key => $val) {
                    if (is_array($val)) {
                        $nav[$key] = is_array($nav[$key] ?? null) ? array_merge($val, $nav[$key]) : $val;
                    }
                }

                $techTalkLinks = [
                    'TechBiz' => '/tech-biz',
                    'Tech Innovation Hub' => '/tech-innovation',
                    'Our Clients' => '/our-clients',
                ];

                $nav['Tech Talk'] = array_merge(
                    $techTalkLinks,
                    array_diff_key(is_array($nav['Tech Talk'] ?? null) ? $nav['Tech Talk'] : [], $techTalkLinks)
                );

                if (is_array($nav['Insights'] ?? null)) {
                    $nav['Insights'] = array_diff_key($nav['Insights'], $techTalkLinks);
                }

                unset(
                    $nav['HackFest 2026'],
                    $nav['Our Partners'],
                    $nav['our-partners'],
                    $nav['Our partners'],
                    $nav['News & Events'],
                    $nav['news & events'],
                    $nav['News & events'],
                    $nav['News and Events']
                );
                $nav['News & Event'] = is_array($nav['News & Event'] ?? null) ? $nav['News & Event'] : [];
                $nav['News & Event']['HackFest 2026'] = '/hackfest-2026';

                $orderedNav = [];
                foreach (array_keys($defaultNav) as $key) {
                    if (array_key_exists($key, $nav)) {
                        $orderedNav[$key] = $nav[$key];
                    }
                }

                $nav = $orderedNav;
            } else {
                $nav = $defaultNav;
            }

            $view->with('siteBrand', $brand)->with('siteNav', $nav)->with('seoSettings', $seoSettings);
        });
    }
}
