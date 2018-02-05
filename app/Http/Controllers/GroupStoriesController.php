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
     * @param Group $group
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update(Group $group, Request $request)
    {
        $orderedStories = collect(request('stories'));

        $orderedStories->map(function ($story) use ($group) {
            $storyToUpdate = Story::find($story['id']);

            if ($storyToUpdate) {
                $storyToUpdate->group_id = $group->id;
                $storyToUpdate->rank = $story['rank'];

                $storyToUpdate->save();
            }
        });

        return response()->json([
            'success' => true,
            'group' => $group->load('stories')
        ]);
    }
}
