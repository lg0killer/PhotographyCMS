<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function edit()
    {
        return inertia('UserAccount/Edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update(request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]));
        if ($request->filled('password')) {
            $user->update(request()->validate([
                'password' => 'required|string|min:8|confirmed'
            ]));
        }

        return redirect()->route('user.photo.index')
            ->with('success', 'User account updated successfully');
    }

    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]));
        Auth::login($user);

        return redirect()->route('user.photo.index')
            ->with('success', 'User account created successfully');
    }
}
