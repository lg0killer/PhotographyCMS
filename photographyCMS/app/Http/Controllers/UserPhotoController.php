<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        //$user_id = Auth::user()->id;
        return inertia(
            'User/Photo/Index',
            [
                'photos' => Photo::where('owned_by','=', $user_id)->get(),
                'photo_owner' => User::where('id','=', $user_id)->first('name')
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user,Photo $photo)
    {   
        $user_id = Auth::user()->id;
        if ($user_id == $photo->owned_by) {
        return inertia(
            'User/Photo/Show',
            [
                'photo' => $photo,
                'authorized' => true,
            ]
            );
        } else {
            return inertia(
                'User/Photo/Show',
                [
                    'photo' => $photo,
                    'authorized' => false,
                ]
                );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
