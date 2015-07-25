<?php

namespace JeroenG\LaravelPhotoGallery\Services;

use JeroenG\LaravelPhotoGallery\Contracts as Contracts;

class GalleryService
{
    private $adapters;

    public function __construct(
        Contracts\AlbumAdapter $albumAdapter,
        Contracts\PhotoAdapter $photoAdapter,
        Contracts\UserAdapter $userAdapter,
        Contracts\TagAdapter $tagAdapter
    ) {
        $this->adapters['album'] = $albumAdapter;
        $this->adapters['photo'] = $photoAdapter;
        $this->adapters['user'] = $userAdapter;
        $this->adapters['tag'] = $tagAdapter;
    }

    public function sayHello()
    {
        return 'hi';
    }
}