<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
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

            $view->with('siteBrand', $brand)->with('siteNav', $nav)->with('seoSettings', $seoSettings);
        });
    }
}
