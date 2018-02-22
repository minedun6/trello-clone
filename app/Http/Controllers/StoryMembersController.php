<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StoryMembersController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'members' => User::all()
        ]);
    }
}
