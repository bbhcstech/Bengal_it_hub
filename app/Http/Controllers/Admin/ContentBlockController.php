<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Services\ContentBlockSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContentBlockController extends Controller
{
    protected array $pages = [
        'home',
        'about-us',
        'vision-2030',
        'services',
        'products',
        'tech-biz',
        'our-clients',
        'awards-recognition',
        'our-partners',
        'tech-innovation',
        'industries',
        'hackfest-2026',
        'contact',
        'academic-partnership',
        'footer',
    ];

    public function index(string $page = 'home')
    {
        abort_unless(in_array($page, $this->pages), 404);

        ContentBlockSeeder::seedDefaults();

        return view('admin.content.index', [
            'page' => $page,
            'pages' => $this->pages,
            'blocks' => ContentBlock::where('page', $page)->orderBy('order')->get(),
        ]);
    }

    public function update(Request $request, string $page)
    {
        abort_unless(in_array($page, $this->pages), 404);

        $values = $request->input('blocks', []);
        $files = $request->file('block_files', []);

        foreach ($values as $id => $content) {
            $block = ContentBlock::find($id);
            if ($block && $block->page === $page) {
                if (isset($files[$id]) && $files[$id]->isValid()) {
                    $file = $files[$id];
                    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                    $file->move(public_path('assets/images'), $filename);
                    $block->content = '/assets/images/' . $filename;
                } else {
                    $block->content = $content;
                }
                $block->save();
            }
        }

        Cache::forget("content_blocks_{$page}");
        Cache::flush();

        return back()->with('status', 'Page content and images updated successfully.');
    }

    public function create(string $page)
    {
        abort_unless(in_array($page, $this->pages), 404);

        return view('admin.content.form', ['page' => $page]);
    }

    public function store(Request $request, string $page)
    {
        abort_unless(in_array($page, $this->pages), 404);

        $data = $request->validate([
            'section_key' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'type' => ['required', 'in:text,textarea,richtext,image'],
            'order' => ['nullable', 'integer'],
        ]);
        $data['page'] = $page;

        ContentBlock::create($data);
        Cache::forget("content_blocks_{$page}");
        Cache::flush();

        return redirect()->route('admin.content.index', $page)->with('status', 'Block added.');
    }

    public function destroy(ContentBlock $block)
    {
        $page = $block->page;
        $block->delete();
        Cache::forget("content_blocks_{$page}");
        Cache::flush();

        return redirect()->route('admin.content.index', $page)->with('status', 'Block removed.');
    }
}
