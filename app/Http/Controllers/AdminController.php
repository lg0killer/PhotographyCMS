<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user_activity = User::query()
            ->select('id', 'name','last_login')
            ->whereNotNull('last_login')
            ->orderByDesc('last_login')
            ->limit(10)
            ->get();
        return inertia('Admin/Dashboard/Index',
        [
            'user_activity' => $user_activity,
        ]);
    }
}
