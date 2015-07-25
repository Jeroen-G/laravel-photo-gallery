<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\InMemory;

use JeroenG\LaravelPhotoGallery\Contracts\TagAdapter;

class InMemoryTagAdapter implements TagAdapter
{
    public function all()
    {
        return Photo::all();
    }
}