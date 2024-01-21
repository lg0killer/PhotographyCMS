<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return inertia('Admin/User/Index',[
            'users' => User::query()
                ->select('id', 'name', 'email','is_admin','email_verified_at','last_login')
                ->when(request('search'), fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
                ->when(request('role'), fn ($query, $role) => $query->whereRole($role))
                ->when(request('status'), fn ($query, $status) => $query->whereStatus($status))
                ->withCount('photos')
                ->orderByDesc('created_at')
                ->paginate(50)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        return inertia('Admin/User/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', 'min:8', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ]);

        User::create($request->all());

        return redirect()->route('admin.user.index')->banner('User created.');
    }

    // public function show(User $user)
    // {
    //     return inertia('Admin/User/Show', [
    //         'user' => $user->load('photos'),
    //     ]);
    // }

    public function edit(User $user)
    {
        return inertia('Admin/User/Edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'is_admin' => ['required', 'integer', 'min:0', 'max:1'],
            //'email_verified_at' => ['nullable', 'date'],
        ]));

        if ($request->email_verified_at) {
            $user->markEmailAsVerified();
        }

        if ($request->password) {
            $user->update($request->validate([
                'password' => ['required', 'min:8', 'confirmed'],
            ]));
        }

        return redirect()->route('admin.user.index')->banner('User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')->banner('User deleted.');
    }
}
