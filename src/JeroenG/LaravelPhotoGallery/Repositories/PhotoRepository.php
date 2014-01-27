<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

interface PhotoRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function findByAlbumId($albumId);

	public function create($input, $filename);

	public function update($id, $input);

	public function delete($id);
}