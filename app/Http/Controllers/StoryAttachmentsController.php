<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryAttachmentsController extends Controller
{
    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     */
    public function store(Story $story)
    {
        $file = request()->file('qqfile');

        $story->addMedia($file)->toMediaCollection("stories-{$story->id}", 'local');

        return response()->json([
            'success' => true,
            'media' => $story->fresh()->getMedia("stories-{$story->id}")
        ]);
    }

    public function show(Story $story)
    {
        return response()->json([
            'success' => true,
            'media' => $story->fresh()->getMedia("stories-{$story->id}")
        ]);
    }

}