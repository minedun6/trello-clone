<?php

Route::get('/', 'PageController');
Route::resource('groups', 'GroupController');
Route::resource('stories', 'StoryController');

Route::put('/projects/groups/', 'ProjectGroupsController@update');
Route::put('/groups/{group}/stories', 'GroupStoriesController@update');
