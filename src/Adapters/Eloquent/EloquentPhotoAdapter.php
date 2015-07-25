<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class EloquentPhotoAdapter implements PhotoAdapter
{
    public function all()
    {
        return Photo::all();
    }
}