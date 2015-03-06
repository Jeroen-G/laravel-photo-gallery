<?php namespace JeroenG\LaravelPhotoGallery\Contracts;

use Illuminate\Contracts\Filesystem\Factory as Filesystem;

interface AlbumRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function create($input);

	public function update($id, $input);

	public function delete($id, PhotoRepository $photos, Filesystem $storage);

	public function forceDelete($id, PhotoRepository $photos, Filesystem $storage);

	public function restore($id, PhotoRepository $photos, Filesystem $storage);
}