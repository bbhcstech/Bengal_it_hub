<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next, ?string $module = null): Response
    {
        $user = Auth::user();

        if (! $user || ! $user->is_active) {
            return redirect()->route('admin.login');
        }

        if ($module && ! $user->canManage($module)) {
            abort(403);
        }

        return $next($request);
    }
}
