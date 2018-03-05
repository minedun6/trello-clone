<?php

Route::get('/', 'PageController@index');

Route::resource('groups', 'GroupController');
Route::resource('stories', 'StoryController');

Route::get('/stories/members', 'StoryMembersController@index');
Route::post('/stories/{story}/members', 'StoryMembersController@store');
//Route::get('/stories/{story}/attachments', 'StoryAttachmentsController@show');
Route::post('/stories/{story}/attachments', 'StoryAttachmentsController@store');

//Route::get('/uploads', 'PageController@uploads')->name('uploads');
Route::post('aws/signature', 'AwsController');

Route::put('/projects/groups/', 'ProjectGroupsController@update');
Route::put('/groups/{group}/stories', 'GroupStoriesController@update');
