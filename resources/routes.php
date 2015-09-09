<?php

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
|
| Here is where all of the routes for the Photo Gallery package are registered.
|
*/

Route::get('gallery', ['as' => 'gallery', 'uses' => 'JeroenG\LaravelPhotoGallery\Controllers\GalleryController@index']);
Route::group(['prefix' => 'gallery'], function()
{
    Route::resource('album', 'JeroenG\LaravelPhotoGallery\Controllers\AlbumsController', ['except' =>['index']]);
    Route::resource('album.photo', 'JeroenG\LaravelPhotoGallery\Controllers\PhotosController', ['except' =>['index']]);
});