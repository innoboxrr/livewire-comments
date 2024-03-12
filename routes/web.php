<?php

use Illuminate\Support\Facades\Route;

Route::get('user/{id}/avatar', 'UserController@avatar')->name('user.avatar');

Route::get('block/{blockId}/user/{userId}/comments', 'CommentController@index')->name('comments.index');
Route::get('block/{blockId}/comments', 'CommentController@blockIndex')->name('block.comments.index');
Route::get('user/{userId}/comments', 'CommentController@userIndex')->name('user.comments.index');



// Webhook
Route::post('blocks/{blockId}/user/{userId}/comments', 'CommentController@store')->name('comments.store');