<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

use Album as Entity;

interface AlbumAdapter
{
    public function all();
    public function find($id);
    public function findHidden($id);
    public function findByAttribute(array $attribute);
    public function add(Entity $album);
    public function update(Entity $album);
    public function save(Entity $album);
    public function hide(Entity $album);
    public function restore(Entity $album);
    public function delete(Entity $album);
}