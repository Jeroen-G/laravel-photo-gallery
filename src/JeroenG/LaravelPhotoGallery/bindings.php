<?php namespace JeroenG\LaravelPhotoGallery;
// When using 'PhotoRepository', Laravel automatically uses the EloquentPhotoRepository
$this->app->bind('Repositories\PhotoRepository', 'JeroenG\LaravelPhotoGallery\Repositories\EloquentPhotoRepository');
// The same for Albums
$this->app->bind('Repositories\AlbumRepository', 'JeroenG\LaravelPhotoGallery\Repositories\EloquentAlbumRepository');