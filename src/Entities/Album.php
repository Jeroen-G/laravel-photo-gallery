<?php

namespace JeroenG\LaravelPhotoGallery\Entities;

use Illuminate\Support\Collection;
use JeroenG\LaravelPhotoGallery\Contracts;
use JeroenG\LaravelPhotoGallery\Traits\Editable;
use JeroenG\LaravelPhotoGallery\Traits\Mappable;

class Album implements Contracts\Album
{
    use Mappable, Editable;

    private $metadata;
    private $photos;

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

    public function getOrder()
    {
        return $this->metadata['order'];
    }

    public function getMetadata($attribute)
    {
        return $this->metadata[$attribute];
    }

    public function metadataContains($attribute)
    {
        return isset($this->metadata[$attribute]);
    }

    public function getPhotos()
    {
        return Collection::make($this->photos);
    }

    public function addPhotos($data)
    {
        if (is_array($data)) {
            foreach ($data as $photo) {
                $this->addPhoto($photo);
            }
        }
    }

    public function addPhoto(Contracts\Photo $photo)
    {
        $this->photos[$photo->getId()] = $photo;
    }

    public function removePhotos($data)
    {
        if (is_array($data)) {
            foreach ($data as $photo) {
                $this->removePhoto($photo);
            }
        }
    }

    public function removePhoto(Contracts\Photo $photo)
    {
        if(array_key_exists($photo->getId(), $this->photos)) {
            unset($this->photos[$photo->getId()]);
        }
    }

    public function rename($newName)
    {
        return $this->metadata['name'] = $newName;
    }
}