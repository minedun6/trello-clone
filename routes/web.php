<?php

Route::get('/', 'PageController@index');

Route::resource('groups', 'GroupController');
Route::resource('stories', 'StoryController');

Route::post('/stories/{story}/attachements', 'StoryAttachementsController@store');

Route::post('/uploads', 'PageController@upload')->name('uploads');

Route::put('/projects/groups/', 'ProjectGroupsController@update');
Route::put('/groups/{group}/stories', 'GroupStoriesController@update');
