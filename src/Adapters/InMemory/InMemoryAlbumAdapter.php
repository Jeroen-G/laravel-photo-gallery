<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\InMemory;

use Illuminate\Support\Collection;
use JeroenG\LaravelPhotoGallery\Contracts\Album;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter;

class InMemoryAlbumAdapter implements AlbumAdapter
{
    private $albums;
    private $hiddenAlbums;

    public function all()
    {
        return Collection::make($this->albums)->keyBy('id');
    }

    public function find($id)
    {
        if(isset($this->albums[$id]))
        {
            return $this->albums[$id];
        }
        return false;
    }

    public function findHidden($id)
    {
        if(isset($this->hiddenAlbums[$id]))
        {
            return $this->hiddenAlbums[$id];
        }
        return false;
    }

    public function findByAttribute(array $attribute)
    {
        $results = [];
        
        foreach ($attribute as $att => $value) {
            foreach ($this->albums as $album) {
                if($album->metadataContains($att) && $album->getMetadata($att) == $value) {
                    $results[] = $album;
                }
            }
        }
        return Collection::make($results)->keyBy('id');
    }

    public function add(Album $album)
    {
        return $this->albums[$album->getId()] = $album;
    }

    public function save(Album $album)
    {
        $new = $this->albums[$album->getId()] = $album;
        return $new;
    }

    public function hide(Album $album)
    {
        $this->hiddenAlbums[$album->getId()] = $album;
        unset($this->albums[$album->getId()]);
    }
    
    public function restore(Album $album)
    {
        $this->albums[$album->getId()] = $album;
        unset($this->hiddenAlbums[$album->getId()]);
    }

    public function delete(Album $album)
    {
        if(isset($this->albums[$album->getId()])) {
            unset($this->albums[$album->getId()]);
        } elseif(isset($this->hiddenAlbums[$album->getId()])) {
            unset($this->hiddenAlbums[$album->getId()]);
        }
    }
}