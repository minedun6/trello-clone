<?php

namespace App\Http\Controllers\Api;

use App\Models\Group;
use App\Models\User;
use App\Http\Controllers\Controller;

class ApiDataController extends Controller
{

    public function __invoke()
    {
        $groups = Group::all();
        $members = User::all();

        return response()->json([
            'success' => true,
            'groups' => $groups,
            'members' => $members
        ]);
    }

}
