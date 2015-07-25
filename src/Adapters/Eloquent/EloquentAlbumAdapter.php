<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter;

class EloquentAlbumAdapter implements AlbumAdapter
{
    public function all()
    {
        return Photo::all();
    }
}