<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class ProjectGroupsController extends Controller
{
    /**
     * Bulk Update the stories group
     *
     * @param Group $group
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update(Request $request)
    {
        $orderedGroups = collect(request('groups'));

        $newGroups = $orderedGroups->map(function ($group) {
            $groupToUpdate = Group::find($group['id']);

            if ($groupToUpdate) {
                $groupToUpdate->order = $group['order'];

                $groupToUpdate->save();

                return $groupToUpdate;
            }
        });

        return response()->json([
            'success' => true,
            'groups' => $newGroups
        ]);
    }
}
