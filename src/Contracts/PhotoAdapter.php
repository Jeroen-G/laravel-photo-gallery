<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

use Photo as Entity;

interface PhotoAdapter
{
    public function all();
    public function find($id);
    public function findHidden($id);
    public function findByAlbumId($albumId);
    public function findByAttribute(array $attribute);
    public function add(Entity $photo);
    public function update(Entity $photo);
    public function save(Entity $photo);
    public function hide(Entity $photo);
    public function restore(Entity $photo);
    public function delete(Entity $photo);
}