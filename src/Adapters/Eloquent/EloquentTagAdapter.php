<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Contracts\TagAdapter;

class EloquentTagAdapter implements TagAdapter
{
    public function all()
    {
        return Photo::all();
    }
}