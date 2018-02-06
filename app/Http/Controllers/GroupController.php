<?php

namespace App\Http\Controllers;

use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'groups' => Group::all()
        ]);
    }
}
