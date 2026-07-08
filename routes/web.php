<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'serviceIndex'])->name('services.index');
Route::get('/hackfest-2026', [PageController::class, 'event'])->name('event.show');
Route::get('/hackfest-2026/register', fn () => app(PageController::class)->form('participant'))->name('event.register');
Route::get('/sponsor-form-hackfest-2026', fn () => app(PageController::class)->form('sponsor'))->name('event.sponsor-form');
Route::get('/sponsor-hackfest-2026', fn () => app(PageController::class)->static('sponsor-hackfest-2026'))->name('event.sponsor');
Route::get('/contact', fn () => app(PageController::class)->form('contact'))->name('contact');
Route::get('/academic-partnership', fn () => app(PageController::class)->form('academic'))->name('academic');
Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

foreach (array_keys(config('bengalhub.services')) as $slug) {
    Route::get('/'.$slug, fn () => app(PageController::class)->serviceShow($slug))->name('services.'.$slug);
}

Route::get('/{slug}', [PageController::class, 'static'])
    ->whereIn('slug', [
        'vision-2030',
        'about-us',
        'our-partners',
        'faq',
        'blog',
        'tech-talk',
        'terms-conditions',
        'privacy-policy',
        'download-sponsor-brochure',
        'download-final-year-career-template-v1-0',
        'pricing',
        'amenities',
        'ascend',
        'vault',
        'sponsor-hackfest-2026',
    ]);
