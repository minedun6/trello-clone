<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;

class StoryMembersController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'members' => User::all()
        ]);
    }

    public function store(Story $story)
    {
        return $story->members()->sync(collect(request()->input('members'))->pluck('id'));
    }

}
