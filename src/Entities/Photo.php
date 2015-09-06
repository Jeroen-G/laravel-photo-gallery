<?php

namespace JeroenG\LaravelPhotoGallery\Entities;

use JeroenG\LaravelPhotoGallery\Contracts;
use JeroenG\LaravelPhotoGallery\Traits\Editable;
use JeroenG\LaravelPhotoGallery\Traits\Mappable;

class Photo implements Contracts\Photo
{
    use Mappable, Editable;

    private $metadata;

    public function getId()
    {
        return $this->metadata['id'];
    }

    public function getName()
    {
        return $this->metadata['name'];
    }

    public function getDescription()
    {
        return $this->metadata['description'];
    }

    public function getFile()
    {
        return $this->metadata['file'];
    }

    public function getSize()
    {
        return $this->metadata['size'];
    }

    public function getAlbum()
    {
        return $this->metadata['album_id'];
    }

    public function getMetadata($attribute)
    {
        return $this->metadata[$attribute];
    }

    public function metadataContains($attribute)
    {
        return isset($this->metadata[$attribute]);
    }
}