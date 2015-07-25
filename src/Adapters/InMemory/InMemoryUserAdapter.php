<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\InMemory;

use JeroenG\LaravelPhotoGallery\Contracts\UserAdapter;

class InMemoryUserAdapter implements UserAdapter
{
    public function all()
    {
        return Photo::all();
    }
}