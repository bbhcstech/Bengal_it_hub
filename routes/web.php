<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndustriesController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\TechInnovationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/services', [PageController::class, 'serviceIndex'])->name('services.index');
Route::get('/products', [PageController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [PageController::class, 'productShow'])->name('products.show');
Route::get('/tech-biz', [PageController::class, 'techBiz'])->name('techbiz.index');
Route::get('/our-clients', [PageController::class, 'clients'])->name('clients.index');
Route::get('/awards-recognition', [PageController::class, 'awardsRecognition'])->name('awards-recognition');
Route::get('/our-partners', [PartnersController::class, 'index'])->name('our-partners.index');
Route::get('/our-partners/{partner:slug}', [PartnersController::class, 'show'])->name('our-partners.show');
Route::get('/tech-innovation', [TechInnovationController::class, 'index'])->name('tech-innovation.index');
Route::get('/tech-innovation/{slug}', [TechInnovationController::class, 'show'])->name('tech-innovation.show');
Route::get('/industries', [IndustriesController::class, 'index'])->name('industries.index');
Route::get('/industries/{industry}/{sub}', [IndustriesController::class, 'showSub'])->name('industries.sub-show');
Route::get('/industries/{industry}', [IndustriesController::class, 'show'])->name('industries.show');
Route::get('/hackfest-2026', [PageController::class, 'event'])->name('event.show');
Route::get('/hackfest-2026/register', fn () => app(PageController::class)->form('participant'))->name('event.register');
Route::get('/hackfest-2026/chief-guest', [PageController::class, 'hackfestChiefGuest'])->name('event.chief-guest');
Route::get('/hackfest-2026/chief-adviser', [PageController::class, 'hackfestChiefAdviser'])->name('event.chief-adviser');
Route::get('/hackfest-2026/speakers', [PageController::class, 'hackfestSpeakers'])->name('event.speakers');
Route::get('/hackfest-2026/faq', [PageController::class, 'hackfestFaq'])->name('event.faq');
Route::get('/hackfest-2026/venue', [PageController::class, 'hackfestVenue'])->name('event.venue');
Route::get('/hackfest-2026/gallery', [PageController::class, 'hackfestGallery'])->name('event.gallery');
Route::get('/sponsor-form-hackfest-2026', fn () => app(PageController::class)->form('sponsor'))->name('event.sponsor-form');
Route::get('/sponsor-hackfest-2026', fn () => app(PageController::class)->static('sponsor-hackfest-2026'))->name('event.sponsor');
Route::get('/contact', fn () => app(PageController::class)->form('contact'))->name('contact');
Route::get('/academic-partnership', fn () => app(PageController::class)->form('academic'))->name('academic');
Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');

Route::get('/sitemap', [SeoController::class, 'html'])->name('sitemap.html');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/sitemap-pages.xml', [SeoController::class, 'sitemapPages'])->name('sitemap.pages');
Route::get('/sitemap-services.xml', [SeoController::class, 'sitemapServices'])->name('sitemap.services');
Route::get('/sitemap-industries.xml', [SeoController::class, 'sitemapIndustries'])->name('sitemap.industries');
Route::get('/sitemap-partners.xml', [SeoController::class, 'sitemapPartners'])->name('sitemap.partners');
Route::get('/sitemap-tech-news-{page}.xml', [SeoController::class, 'sitemapTechNews'])->whereNumber('page')->name('sitemap.tech-news');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::redirect('/admin', '/', 301);

Route::get('/bih-console/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/bih-console/login', [AdminAuthController::class, 'authenticate'])->middleware('throttle:5,1')->name('admin.authenticate');

Route::middleware('admin')->prefix('bih-console')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin:services')->group(function () {
        Route::get('/services', [AdminController::class, 'services'])->name('services');
        Route::get('/services/create', [AdminController::class, 'createService'])->name('services.create');
        Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
        Route::get('/services/{service}/edit', [AdminController::class, 'editService'])->name('services.edit');
        Route::put('/services/{service}', [AdminController::class, 'updateService'])->name('services.update');
        Route::delete('/services/{service}', [AdminController::class, 'deleteService'])->name('services.delete');
    });

    Route::middleware('admin:events')->group(function () {
        Route::get('/events', [AdminController::class, 'events'])->name('events');
        Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
        Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{event}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{event}', [AdminController::class, 'updateEvent'])->name('events.update');
    });

    Route::middleware('admin:pages')->group(function () {
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
        Route::get('/pages/{page}/edit', [AdminController::class, 'editPage'])->name('pages.edit');
        Route::put('/pages/{page}', [AdminController::class, 'updatePage'])->name('pages.update');
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
        Route::post('/faqs', [AdminController::class, 'storeFaq'])->name('faqs.store');
        Route::put('/faqs/{faq}', [AdminController::class, 'updateFaq'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [AdminController::class, 'deleteFaq'])->name('faqs.delete');
        Route::get('/partners', [AdminController::class, 'partners'])->name('partners');
        Route::post('/partners', [AdminController::class, 'storePartner'])->name('partners.store');
        Route::put('/partners/{partner}', [AdminController::class, 'updatePartner'])->name('partners.update');
        Route::delete('/partners/{partner}', [AdminController::class, 'deletePartner'])->name('partners.delete');
    });

    Route::middleware('admin:blog')->group(function () {
        Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
        Route::get('/blog/create', [AdminController::class, 'createPost'])->name('blog.create');
        Route::post('/blog/categories', [AdminController::class, 'storeBlogCategory'])->name('blog.categories.store');
        Route::post('/blog', [AdminController::class, 'storePost'])->name('blog.store');
        Route::get('/blog/{post}/edit', [AdminController::class, 'editPost'])->name('blog.edit');
        Route::put('/blog/{post}', [AdminController::class, 'updatePost'])->name('blog.update');
    });

    Route::middleware('admin:leads')->group(function () {
        Route::get('/leads', [AdminController::class, 'leads'])->name('leads');
        Route::get('/leads/export', [AdminController::class, 'exportLeads'])->name('leads.export');
        Route::put('/leads/{lead}', [AdminController::class, 'updateLead'])->name('leads.update');
    });

    Route::middleware('admin:settings')->group(function () {
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    });

    Route::middleware('admin:rss')->group(function () {
        Route::get('/rss-sources', [AdminController::class, 'rssSources'])->name('rss-sources');
        Route::get('/rss-sources/create', [AdminController::class, 'createRssSource'])->name('rss-sources.create');
        Route::post('/rss-sources', [AdminController::class, 'storeRssSource'])->name('rss-sources.store');
        Route::get('/rss-sources/{rssSource}/edit', [AdminController::class, 'editRssSource'])->name('rss-sources.edit');
        Route::put('/rss-sources/{rssSource}', [AdminController::class, 'updateRssSource'])->name('rss-sources.update');
        Route::delete('/rss-sources/{rssSource}', [AdminController::class, 'deleteRssSource'])->name('rss-sources.delete');
        Route::post('/rss-sources/{rssSource}/sync', [AdminController::class, 'syncRssSource'])->name('rss-sources.sync');
        Route::post('/rss-sources/sync-all', [AdminController::class, 'syncAllRssSources'])->name('rss-sources.sync-all');
    });
});

Route::get('/{slug}', [PageController::class, 'showBySlug'])->name('content.show');
