<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Model\Album;
use JeroenG\LaravelPhotoGallery\Entities as Entity;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter;

class EloquentAlbumAdapter implements AlbumAdapter
{
    public function all()
    {
        return Album::all();
    }

    public function find($id)
    {
        return Album::find($id);
    }

    public function findHidden($id)
    {
        return Album::onlyTrashed()->where('id', $id)->get();
    }

    public function findByAttribute(array $attribute)
    {
        return Album::where(function($query) {
            foreach ($attribute as $att => $value) {
                $query->where($att, $value);
            }
        })
        ->get();
    }

    public function add(Entity\Album $album)
    {
        $photos = $album->getPhotos()->toArray();
        foreach ($photos as $photo) {
            $this->photoAdapter->add($photo);
        }
        return $this->save($album);
    }

    public function save(Entity\Album $album)
    {
        $data = $album->toArray();
        if(array_key_exists('id', $data)) {
            return $this->update($data);
        } else {
            return $this->toEloquent($data)->save();
        }
    }

    public function update(Entity\Album $album)
    {
        $data = $album;
        $album = Album::find($data['id']);
        foreach ($data as $key => $value) {
            $album->$key = $value;
        }
        return $album->save();
    }

    public function toEloquent($data)
    {
        $album = new Album;
        foreach ($data as $key => $value) {
            $album->$key = $value;
        }
        return $album;
    }

    public function hide(Entity\Album $album)
    {
        return Album::where('id', $album->getId())->delete();
    }
    
    public function restore(Entity\Album $album)
    {
        return Album::withTrashed()->where('id', $album->getId())->restore();
    }

    public function delete(Entity\Album $album)
    {
        return Album::withTrashed()->where('id', $album->getId())->get()->forceDelete();
    }
}