<?php

namespace JeroenG\LaravelPhotoGallery\Adapters\Eloquent;

use Illuminate\Support\Collection;
use JeroenG\LaravelPhotoGallery\Models\Album;
use JeroenG\LaravelPhotoGallery\Entities as Entity;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class EloquentAlbumAdapter implements AlbumAdapter
{
    private $photoAdapter;

    public function __construct(PhotoAdapter $photoAdapter)
    {
        $this->photoAdapter = $photoAdapter;
    }

    public function all()
    {
        $collection = [];
        $all = Album::all();
        foreach ($all as $album) {
            $collection[$album->id] = $this->fromEloquent($album);
        }
        return Collection::make($collection);
    }

    public function find($id)
    {
        $album = Album::findOrFail($id);
        if($album) return $this->fromEloquent($album);
    }

    public function findHidden($id)
    {
        $album = Album::onlyTrashed()->where('id', $id)->get();
        if($album) return $this->fromEloquent($album);
    }

    public function findByAttribute(array $attribute)
    {
        $collection = [];
        $all = Album::where(function($query) {
            foreach ($attribute as $att => $value) {
                $query->where($att, $value);
            }
        })->get();
        foreach ($all as $album) {
            $collection[$album->id] = $this->fromEloquent($album);
        }
        return Collection::make($collection)->keyBy('id');
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
            return $this->update($album);
        } else {
            return $this->toEloquent($data)->save();
        }
    }

    public function update(Entity\Album $album)
    {
        $data = $album->toArray();
        $album = Album::find($data['id']);
        $album->name = $data['name'];
        $album->description = $data['description'];
        $album->order = $data['order'];

        if(isset($data['photos']))
        {
            foreach ($data['photos'] as $photo) {
                $this->photoAdapter->update($photo);
            }
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

    public function fromEloquent(Album $album)
    {
        $entity = new Entity\Album();
        $entity->map([
            'id' => $album->id,
            'name' => $album->name,
            'description' => $album->description,
            'order' => $album->order,
            'photos' => $this->photoAdapter->findByAlbumId($album->id),
        ]);
        return $entity;
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
        return Album::withTrashed()->where('id', $album->getId())->forceDelete();
    }
}