<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        return view('admin.users.index', ['users' => User::orderBy('name')->get()]);
    }

    public function create()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        return view('admin.users.form', ['item' => new User()]);
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:super_admin,content_editor,event_manager,leads_manager'],
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('admin.users.index')->with('status', 'Admin user created successfully.');
    }

    public function destroy(User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        abort_if($user->id === auth()->id(), 403, "You can't delete your own account.");

        $user->delete();

        return back()->with('status', 'Admin user removed successfully.');
    }
}
