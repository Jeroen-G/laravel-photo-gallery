<?php

namespace JeroenG\LaravelPhotoGallery\Contracts;

interface Album
{
	public function getId();
    public function getName();
    public function getDescription();
    public function getMetadata($attribute);
    public function metadataContains($attribute);
    public function getPhotos();
    public function addPhotos($data);
    public function rename($newName);
    public function edit(array $metadata);
    public function map(array $metadata);
}
