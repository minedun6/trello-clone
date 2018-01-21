<?php

Route::get('/', 'PageController');
Route::resource('groups', 'GroupController');
Route::resource('stories', 'StoryController');
