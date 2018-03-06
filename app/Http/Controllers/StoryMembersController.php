<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;

class StoryMembersController extends Controller
{
    public function store(Story $story)
    {
        $story->members()->sync(collect(request()->input('members'))->pluck('id'));

        return response()->json([
            'success' => true,
            'members' => $story->members()->get()
        ]);
    }
}
