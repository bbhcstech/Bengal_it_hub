<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\EventTimeline;
use App\Models\Faq;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Person;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'leads' => Lead::latest()->take(8)->get(),
            'activities' => ActivityLog::with('user')->latest()->take(10)->get(),
            'counts' => [
                'leads' => Lead::count(),
                'services' => Service::count(),
                'events' => Event::count(),
                'posts' => BlogPost::count(),
            ],
        ]);
    }

    public function services(): View
    {
        return view('admin.services.index', ['services' => Service::ordered()->get()]);
    }

    public function createService(): View
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function storeService(Request $request): RedirectResponse
    {
        $service = Service::create($this->serviceData($request));
        $this->log('created', $service);

        return redirect()->route('admin.services')->with('status', 'Service created.');
    }

    public function editService(Service $service): View
    {
        return view('admin.services.form', ['service' => $service]);
    }

    public function updateService(Request $request, Service $service): RedirectResponse
    {
        $before = $service->getOriginal();
        $service->update($this->serviceData($request, $service));
        $this->log('updated', $service, ['before' => $before, 'after' => $service->fresh()->toArray()]);

        return back()->with('status', 'Service updated.');
    }

    public function deleteService(Service $service): RedirectResponse
    {
        $this->log('deleted', $service, ['title' => $service->title]);
        $service->delete();

        return back()->with('status', 'Service deleted.');
    }

    public function events(): View
    {
        return view('admin.events.index', ['events' => Event::latest()->get()]);
    }

    public function createEvent(): View
    {
        return view('admin.events.form', ['event' => new Event()]);
    }

    public function storeEvent(Request $request): RedirectResponse
    {
        $event = Event::create($this->eventData($request));
        $this->syncEventRepeaters($request, $event);
        $this->log('created', $event);

        return redirect()->route('admin.events.edit', $event)->with('status', 'Event created.');
    }

    public function editEvent(Event $event): View
    {
        $event->load(['timelines', 'people']);

        return view('admin.events.form', ['event' => $event]);
    }

    public function updateEvent(Request $request, Event $event): RedirectResponse
    {
        $before = $event->getOriginal();
        $event->update($this->eventData($request, $event));
        $this->syncEventRepeaters($request, $event);
        $this->log('updated', $event, ['before' => $before, 'after' => $event->fresh()->toArray()]);

        return back()->with('status', 'Event updated.');
    }

    public function pages(): View
    {
        return view('admin.pages.index', ['pages' => Page::orderBy('slug')->get()]);
    }

    public function editPage(Page $page): View
    {
        return view('admin.pages.form', ['page' => $page]);
    }

    public function updatePage(Request $request, Page $page): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'eyebrow' => ['nullable', 'string', 'max:200'],
            'intro' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_robots' => ['nullable', Rule::in(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'])],
            'status' => ['required', 'in:draft,published'],
        ]);

        $page->update([
            'title' => $data['title'],
            'blocks' => ['eyebrow' => $data['eyebrow'] ?? '', 'intro' => $data['intro'] ?? ''],
            'meta_title' => $data['meta_title'] ?? $data['title'].' | Bengal IT Hub',
            'meta_description' => $data['meta_description'] ?? $data['intro'] ?? '',
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'meta_robots' => $data['meta_robots'] ?? 'index, follow',
            'status' => $data['status'],
        ]);
        $this->log('updated', $page);

        return back()->with('status', 'Page updated.');
    }

    public function faqs(): View
    {
        return view('admin.faqs.index', ['faqs' => Faq::ordered()->get()]);
    }

    public function storeFaq(Request $request): RedirectResponse
    {
        $faq = Faq::create($this->faqData($request));
        $this->log('created', $faq);

        return back()->with('status', 'FAQ added.');
    }

    public function updateFaq(Request $request, Faq $faq): RedirectResponse
    {
        $faq->update($this->faqData($request));
        $this->log('updated', $faq);

        return back()->with('status', 'FAQ updated.');
    }

    public function deleteFaq(Faq $faq): RedirectResponse
    {
        $this->log('deleted', $faq, ['question' => $faq->question]);
        $faq->delete();

        return back()->with('status', 'FAQ deleted.');
    }

    public function partners(): View
    {
        return view('admin.partners.index', ['partners' => Partner::orderBy('sort_order')->get()]);
    }

    public function storePartner(Request $request): RedirectResponse
    {
        $partner = Partner::create($this->partnerData($request));
        $this->log('created', $partner);

        return back()->with('status', 'Partner added.');
    }

    public function updatePartner(Request $request, Partner $partner): RedirectResponse
    {
        $partner->update($this->partnerData($request));
        $this->log('updated', $partner);

        return back()->with('status', 'Partner updated.');
    }

    public function deletePartner(Partner $partner): RedirectResponse
    {
        $this->log('deleted', $partner, ['name' => $partner->name]);
        $partner->delete();

        return back()->with('status', 'Partner deleted.');
    }

    public function blog(): View
    {
        return view('admin.blog.index', [
            'posts' => BlogPost::with('category')->latest()->get(),
            'categories' => BlogCategory::orderBy('name')->get(),
        ]);
    }

    public function createPost(): View
    {
        return view('admin.blog.form', ['post' => new BlogPost(), 'categories' => BlogCategory::orderBy('name')->get()]);
    }

    public function storePost(Request $request): RedirectResponse
    {
        $post = BlogPost::create($this->postData($request));
        $this->log('created', $post);

        return redirect()->route('admin.blog.edit', $post)->with('status', 'Post created.');
    }

    public function editPost(BlogPost $post): View
    {
        return view('admin.blog.form', ['post' => $post, 'categories' => BlogCategory::orderBy('name')->get()]);
    }

    public function updatePost(Request $request, BlogPost $post): RedirectResponse
    {
        $post->update($this->postData($request, $post));
        $this->log('updated', $post);

        return back()->with('status', 'Post updated.');
    }

    public function leads(Request $request): View
    {
        $query = Lead::with('event')->latest();

        if ($request->filled('form_type')) {
            $query->where('form_type', $request->string('form_type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return view('admin.leads.index', [
            'leads' => $query->paginate(20)->withQueryString(),
            'formTypes' => Lead::select('form_type')->distinct()->pluck('form_type'),
        ]);
    }

    public function updateLead(Request $request, Lead $lead): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,contacted,closed'],
            'notes' => ['nullable', 'string'],
        ]);

        $lead->update($data);
        $this->log('updated', $lead);

        return back()->with('status', 'Lead updated.');
    }

    public function exportLeads(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Type', 'Name', 'Email', 'Phone', 'Status', 'Subject', 'Message', 'Created']);
            Lead::orderBy('id')->chunk(200, function ($leads) use ($out) {
                foreach ($leads as $lead) {
                    fputcsv($out, [$lead->id, $lead->form_type, $lead->name, $lead->email, $lead->phone, $lead->status, $lead->subject, $lead->message, $lead->created_at]);
                }
            });
            fclose($out);
        }, 'bengal-it-hub-leads.csv');
    }

    public function settings(): View
    {
        return view('admin.settings', [
            'brand' => SiteSetting::value('brand', config('bengalhub.brand')),
            'home' => SiteSetting::value('home', []),
            'seo' => SiteSetting::value('seo', []),
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $brand = $request->validate([
            'brand.name' => ['required', 'string', 'max:120'],
            'brand.company' => ['nullable', 'string', 'max:160'],
            'brand.phone' => ['nullable', 'string', 'max:80'],
            'brand.email' => ['nullable', 'email', 'max:160'],
            'brand.address' => ['nullable', 'string'],
            'brand.socials.LinkedIn' => ['nullable', 'string'],
            'brand.socials.Facebook' => ['nullable', 'string'],
            'brand.socials.Instagram' => ['nullable', 'string'],
            'brand.socials.X' => ['nullable', 'string'],
            'brand.socials.YouTube' => ['nullable', 'string'],
            'home.hero_title' => ['nullable', 'string', 'max:160'],
            'home.hero_intro' => ['nullable', 'string'],
            'home.hero_image' => ['nullable', 'string'],
            'home.meta_title' => ['nullable', 'string', 'max:70'],
            'home.meta_description' => ['nullable', 'string', 'max:170'],
            'home.meta_keywords' => ['nullable', 'string', 'max:255'],
            'seo.google_analytics_id' => ['nullable', 'string', 'max:40'],
            'seo.google_search_console' => ['nullable', 'string', 'max:120'],
        ]);

        SiteSetting::updateOrCreate(['key' => 'brand'], ['value' => $brand['brand']]);
        SiteSetting::updateOrCreate(['key' => 'home'], ['value' => array_replace(SiteSetting::value('home', []), $brand['home'] ?? [])]);
        SiteSetting::updateOrCreate(['key' => 'seo'], ['value' => $brand['seo'] ?? []]);
        $this->log('updated', new SiteSetting(['key' => 'settings']));

        return back()->with('status', 'Settings updated.');
    }

    private function serviceData(Request $request, ?Service $service = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180'],
            'kicker' => ['nullable', 'string', 'max:180'],
            'summary' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'features_text' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_robots' => ['nullable', Rule::in(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'])],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['title']);

        return [
            'title' => $data['title'],
            'slug' => $slug,
            'kicker' => $data['kicker'] ?? null,
            'summary' => $data['summary'],
            'body' => $data['body'] ?? null,
            'features' => $this->lines($data['features_text'] ?? ''),
            'image' => $data['image'] ?? null,
            'sort_order' => $data['sort_order'] ?? $service?->sort_order ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $data['status'],
            'meta_title' => $data['meta_title'] ?? $data['title'].' | Bengal IT Hub',
            'meta_description' => $data['meta_description'] ?? $data['summary'],
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'meta_robots' => $data['meta_robots'] ?? 'index, follow',
        ];
    }

    private function eventData(Request $request, ?Event $event = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180'],
            'tagline' => ['nullable', 'string'],
            'venue' => ['nullable', 'string'],
            'finale' => ['nullable', 'string'],
            'counters_text' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_robots' => ['nullable', Rule::in(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'])],
        ]);

        return [
            'name' => $data['name'],
            'slug' => $data['slug'] ?: Str::slug($data['name']),
            'tagline' => $data['tagline'] ?? null,
            'venue' => $data['venue'] ?? null,
            'finale' => $data['finale'] ?? null,
            'counters' => $this->keyValueLines($data['counters_text'] ?? ''),
            'status' => $data['status'],
            'meta_title' => $data['meta_title'] ?? $data['name'].' | Bengal IT Hub',
            'meta_description' => $data['meta_description'] ?? $data['tagline'] ?? '',
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'meta_robots' => $data['meta_robots'] ?? 'index, follow',
        ];
    }

    private function syncEventRepeaters(Request $request, Event $event): void
    {
        $event->timelines()->delete();
        foreach ($this->pipeRows($request->string('timeline_text')) as $index => $row) {
            EventTimeline::create(['event_id' => $event->id, 'label' => $row[0] ?? '', 'date' => $row[1] ?? '', 'sort_order' => $index + 1]);
        }

        $event->people()->delete();
        foreach ($this->pipeRows($request->string('people_text')) as $index => $row) {
            Person::create(['event_id' => $event->id, 'role_type' => $row[0] ?? 'Speaker', 'name' => $row[1] ?? '', 'bio' => $row[2] ?? '', 'sort_order' => $index + 1]);
        }
    }

    private function faqData(Request $request): array
    {
        return $request->validate([
            'category' => ['nullable', 'string', 'max:120'],
            'scope' => ['required', 'string', 'max:120'],
            'question' => ['required', 'string', 'max:220'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
        ]);
    }

    private function partnerData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'logo' => ['nullable', 'string'],
            'link_url' => ['nullable', 'string'],
            'scope' => ['required', 'string', 'max:80'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published'],
        ]);
    }

    private function postData(Request $request, ?BlogPost $post = null): array
    {
        $data = $request->validate([
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180'],
            'featured_image' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,scheduled,published'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_robots' => ['nullable', Rule::in(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'])],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['author_id'] = $post?->author_id ?: Auth::id();
        $data['meta_robots'] = $data['meta_robots'] ?? 'index, follow';

        return $data;
    }

    private function lines(string $text): array
    {
        return collect(preg_split('/\R/', $text))->map(fn ($line) => trim($line))->filter()->values()->all();
    }

    private function keyValueLines(string $text): array
    {
        return collect($this->lines($text))->mapWithKeys(function (string $line) {
            [$key, $value] = array_pad(explode('|', $line, 2), 2, '');

            return [trim($key) => trim($value)];
        })->all();
    }

    private function pipeRows(string $text): array
    {
        return collect($this->lines($text))->map(fn ($line) => array_map('trim', explode('|', $line)))->values()->all();
    }

    private function log(string $action, object $subject, array $changes = []): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => $subject::class,
            'subject_id' => $subject->id ?? null,
            'changes' => $changes,
        ]);
    }
}
