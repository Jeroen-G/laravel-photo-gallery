<?php namespace JeroenG\LaravelPhotoGallery\Contracts;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;

interface PhotoRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function findByAlbumId($albumId);

	public function create(Request $request, Filesystem $storage);

	public function update($id, $input);

	public function delete($id, Filesystem $storage);

	public function forceDelete($id, Filesystem $storage);

	public function restore($id, Filesystem $storage);

	public function restoreFromAlbum($albumId, Filesystem $storage);
}