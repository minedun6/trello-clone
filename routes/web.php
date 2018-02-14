<?php

Route::get('/', 'PageController@index');
Route::get('/uploads', 'PageController@uploads');

Route::resource('groups', 'GroupController');
Route::resource('stories', 'StoryController');

Route::post('/uploads', 'PageController@upload')->name('uploads');

Route::put('/projects/groups/', 'ProjectGroupsController@update');
Route::put('/groups/{group}/stories', 'GroupStoriesController@update');
