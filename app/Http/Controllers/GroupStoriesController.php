<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Story;
use Illuminate\Http\Request;

class GroupStoriesController extends Controller
{
    /**
     * Bulk Update the stories group
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function update(Request $request)
    {
        return $request->all();
    }
}
