<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVault;


class UserVaultController extends Controller
{
    function index()
    {
        return inertia('Vault/Index',[
            'photos' => UserVault::with('user','photo')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Vault/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
}
