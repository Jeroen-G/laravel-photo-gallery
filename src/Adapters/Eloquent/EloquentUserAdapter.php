<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Contracts\UserAdapter;

class EloquentUserAdapter implements UserAdapter
{
    public function all()
    {
        return Photo::all();
    }
}