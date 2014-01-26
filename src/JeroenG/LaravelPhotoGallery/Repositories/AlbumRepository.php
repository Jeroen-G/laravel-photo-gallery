<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

interface AlbumRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function create($input);
}