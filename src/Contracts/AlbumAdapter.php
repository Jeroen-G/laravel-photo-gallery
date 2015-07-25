<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

use Album;

interface AlbumAdapter
{
    public function all();
    public function find($id);
    public function findHidden($id);
    public function findByAttribute(array $attribute);
    public function add(Album $album);
    public function save(Album $album);
    public function hide(Album $album);
    public function restore(Album $album);
    public function delete(Album $album);
}