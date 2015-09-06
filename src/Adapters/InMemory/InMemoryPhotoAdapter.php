<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\InMemory;

use Illuminate\Support\Collection;
use JeroenG\LaravelPhotoGallery\Contracts\Photo;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class InMemoryPhotoAdapter implements PhotoAdapter
{
    private $photos;
    private $hiddenPhotos;

    public function all()
    {
        return Collection::make($this->photos)->keyBy('id');
    }

    public function find($id)
    {
        if(isset($this->photos[$id]))
        {
            return $this->photos[$id];
        }
        return false;
    }

    public function findHidden($id)
    {
        if(isset($this->hiddenPhotos[$id]))
        {
            return $this->hiddenPhotos[$id];
        }
        return false;
    }

    public function findByAlbumId($albumId)
    {
        return $this->findByAttribute(['album_id' => $albumId]);
    }

    public function findByAttribute(array $attribute)
    {
        $results = [];
        
        foreach ($attribute as $att => $value) {
            foreach ($this->photos as $photo) {
                if($photo->metadataContains($att) && $photo->getMetadata($att) == $value) {
                    $results[] = $photo;
                }
            }
        }
        return Collection::make($results)->keyBy('id');
    }

    public function add(Photo $photo)
    {
        return $this->photos[$photo->getId()] = $photo;
    }

    public function save(Photo $photo)
    {
        return $this->photos[$photo->getId()] = $photo;
    }

    public function update(Photo $photo)
    {
        return $this->photos[$photo->getId()] = $photo;
    }

    public function hide(Photo $photo)
    {
        $this->hiddenPhotos[$photo->getId()] = $photo;
        unset($this->photos[$photo->getId()]);
    }
    
    public function restore(Photo $photo)
    {
        $this->photos[$photo->getId()] = $photo;
        unset($this->hiddenPhotos[$photo->getId()]);
    }

    public function delete(Photo $photo)
    {
        if(isset($this->photos[$photo->getId()])) {
            unset($this->photos[$photo->getId()]);
        } elseif(isset($this->hiddenPhotos[$photo->getId()])) {
            unset($this->hiddenPhotos[$photo->getId()]);
        }
    }
}