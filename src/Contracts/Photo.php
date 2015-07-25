<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

interface Photo
{
    public function getId();
    public function getName();
    public function getDescription();
    public function getFile();
    public function getSize();
    public function getAlbum();
    public function getMetadata($attribute);
    public function metadataContains($attribute);
    public function edit(array $metadata);
    public function map(array $metadata);
}
