<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
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
Route::redirect('/admin', '/');

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
});

Route::get('/{slug}', [PageController::class, 'showBySlug'])->name('content.show');
