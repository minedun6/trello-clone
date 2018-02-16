<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryAttachementsController extends Controller
{
    public function store(Story $story)
    {
        $file = request()->file('qqfile');

        $story->addMedia($file)->toMediaCollection("stories-{$story->id}");

        return response()->json([
            'success' => true,
            'media' => $story->fresh()->getMedia("stories-{$story->id}")
        ]);
    }
}
