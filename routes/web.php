<?php

use Illuminate\Support\Facades\Route;

Route::get('user/{id}/avatar', 'UserController@avatar')->name('user.avatar');