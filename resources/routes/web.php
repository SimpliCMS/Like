<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::prefix('like')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('like', 'LikeController@like')->name('like');
        Route::delete('like', 'LikeController@unlike')->name('unlike');
    });
});
