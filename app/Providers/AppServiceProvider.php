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

            $nav = array_replace_recursive(config('bengalhub.nav'), is_array($nav) ? $nav : []);

            $view->with('siteBrand', $brand)->with('siteNav', $nav)->with('seoSettings', $seoSettings);
        });
    }
}
