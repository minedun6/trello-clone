<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'groups' => Group::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $story = Story::create([
            'group_id' => $request->input('story.group_id'),
            'description' => $request->input('story.title'),
            'due_date' => Carbon::parse($request->input('story.due_date'))
        ]);

        $story->attachTags($request->input('story.tags'));

        return response()->json([
            'success' => true,
            'story' => $story->fresh()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Story $story)
    {
        $story->update([
            'group_id' => $request->get('targetGroup')
        ]);

        return response()->json([
            'success' => true,
            'message' => $story,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
