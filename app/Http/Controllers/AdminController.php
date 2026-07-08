<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'leads' => Lead::latest()->take(10)->get(),
            'counts' => [
                'leads' => Lead::count(),
                'services' => count(config('bengalhub.services')),
                'eventModules' => 7,
                'roles' => ['Super Admin', 'Content Editor', 'Event Manager', 'Leads Manager'],
            ],
        ]);
    }
}
