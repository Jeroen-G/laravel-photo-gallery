<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use JeroenG\LaravelPhotoGallery\Model\Photo;
use JeroenG\LaravelPhotoGallery\Entities as Entity;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class EloquentPhotoAdapter implements PhotoAdapter
{
    public function all()
    {
        return Photo::all();
    }

    public function find($id)
    {
        return Photo::find($id);
    }

    public function findHidden($id)
    {
        return Photo::onlyTrashed()->where('id', $id)->get();
    }

    public function findByAlbumId($albumId)
    {
        return $this->findByAttribute(['album_id', $albumId]);
    }

    public function findByAttribute(array $attribute)
    {
        return Photo::where(function($query) {
            foreach ($attribute as $att => $value) {
                $query->where($att, $value);
            }
        })
        ->get();
    }

    public function add(Entity\Photo $photo)
    {
        return $this->save($photo);
    }

    public function update(Entity\Photo $photo)
    {
        $data = $photo;
        $photo = Photo::find($data['id']);
        foreach ($data as $key => $value) {
            $photo->$key = $value;
        }
        return $photo->save();
    }

    public function save(Entity\Photo $photo)
    {
        $data = $photo->toArray();
        if(array_key_exists('id', $data)) {
            return $this->update($data);
        } else {
            return $this->toEloquent($data)->save();
        }
    }

    public function toEloquent($data)
    {
        $photo = new Photo;
        foreach ($data as $key => $value) {
            $photo->$key = $value;
        }
        return $photo;
    }

    public function hide(Entity\Photo $photo)
    {
        return Photo::where('id', $photo->getId())->delete();
    }

    public function restore(Entity\Photo $photo)
    {
        return Photo::withTrashed()->where('id', $photo->getId())->restore();
    }

    public function delete(Entity\Photo $photo)
    {
        return Photo::withTrashed()->where('id', $photo->getId())->get()->forceDelete();
    }

}