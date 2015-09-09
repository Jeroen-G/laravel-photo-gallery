<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use Illuminate\Support\Collection;
use JeroenG\LaravelPhotoGallery\Models\Photo;
use JeroenG\LaravelPhotoGallery\Entities as Entity;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class EloquentPhotoAdapter implements PhotoAdapter
{
    public function all()
    {
        $collection = [];
        $all = Photo::all();
        foreach ($all as $photo) {
            $collection[$photo->id] = $this->fromEloquent($photo);
        }
        return Collection::make($collection);
    }

    public function find($id)
    {
        $photo = Photo::findOrFail($id);
        if($photo) return $this->fromEloquent($photo);
    }

    public function findHidden($id)
    {
        $photo = Photo::onlyTrashed()->where('id', $id)->get();
        if($photo) return $this->fromEloquent($photo);        
    }

    public function findByAlbumId($albumId)
    {
        return $this->findByAttribute(['album_id' => $albumId]);
    }

    public function findByAttribute(array $attribute)
    {
        $collection = [];
        $all = Photo::where(function($query) use ($attribute) {
            foreach ($attribute as $att => $value) {
                $query->where($att, $value);
            }
        })->get();
        foreach ($all as $photo) {
            $collection[$photo->id] = $this->fromEloquent($photo);
        }
        return Collection::make($collection);
    }

    public function add(Entity\Photo $photo)
    {
        return $this->save($photo);
    }

    public function update(Entity\Photo $photo)
    {
        $data = $photo->toArray();
        $photo = Photo::find($data['id']);
        $photo->name = $data['name'];
        $photo->description = $data['description'];
        $photo->order = $data['order'];
        $photo->album_id = $data['album_id'];
        return $photo->save();
    }

    public function save(Entity\Photo $photo)
    {
        $data = $photo->toArray();
        if(array_key_exists('id', $data)) {
            return $this->update($photo);
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

    public function fromEloquent(Photo $photo)
    {
        $entity = new Entity\Photo();
        $entity->map([
            'id' => $photo->id,
            'name' => $photo->name,
            'description' => $photo->description,
            'file' => $photo->file,
            'size' => $photo->size,
            'album_id' => $photo->album_id,
        ]);
        return $entity;
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
        return Photo::withTrashed()->where('id', $photo->getId())->forceDelete();
    }

}