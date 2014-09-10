<?php

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
|
| Here is where all of the routes for the Photo Gallery package are registered.
|
*/

Route::get('gallery', array('as' => 'gallery', 'uses' => 'JeroenG\LaravelPhotoGallery\Controllers\GalleryController@index'));

Route::group(array('prefix' => 'gallery'), function()
{
	Route::resource('album', 'JeroenG\LaravelPhotoGallery\Controllers\AlbumsController', array('except' => array('index')));
	Route::resource('album.photo', 'JeroenG\LaravelPhotoGallery\Controllers\PhotosController', array('except' => array('index')));
});