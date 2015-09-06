<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

use Photo;

interface PhotoAdapter
{
    public function all();
    public function find($id);
    public function findHidden($id);
    public function findByAlbumId($albumId);
    public function findByAttribute(array $attribute);
    public function add(Photo $photo);
    public function update(Photo $photo);
    public function save(Photo $photo);
    public function hide(Photo $photo);
    public function restore(Photo $photo);
    public function delete(Photo $photo);
}