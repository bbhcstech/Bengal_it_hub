<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class TemplateEditorController extends Controller
{
    /**
     * List of editable Blade templates on the site mapped to their relative paths from resources/views/
     */
    protected array $templates = [
        'home' => 'index.blade.php',
        'admin_dashboard' => 'admin/dashboard.blade.php',
        'layout_admin' => 'layouts/admin.blade.php',
        'layout_app' => 'layouts/app.blade.php',
    ];

    public function index(Request $request)
    {
        $selected = $request->query('file', 'home');
        if (!array_key_exists($selected, $this->templates)) {
            $selected = 'home';
        }

        $relativePath = $this->templates[$selected];
        $fullPath = resource_path('views/' . $relativePath);

        $code = File::exists($fullPath) ? File::get($fullPath) : '';

        return view('admin.template_editor.index', [
            'selected' => $selected,
            'templates' => $this->templates,
            'relativePath' => $relativePath,
            'code' => $code,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'file' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $selected = $request->input('file');
        if (!array_key_exists($selected, $this->templates)) {
            return back()->with('error', 'Invalid template file selected.');
        }

        $relativePath = $this->templates[$selected];
        $fullPath = resource_path('views/' . $relativePath);

        File::put($fullPath, $request->input('code'));

        Artisan::call('view:clear');
        Cache::flush();

        return back()->with('status', "Template '{$relativePath}' updated successfully! Website updated automatically.");
    }
}
