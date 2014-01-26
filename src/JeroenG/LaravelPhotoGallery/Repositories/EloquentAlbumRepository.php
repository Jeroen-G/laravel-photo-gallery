<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

use JeroenG\LaravelPhotoGallery\Models\Album;

class EloquentAlbumRepository implements AlbumRepository {
	
	public function all()
	{
		return Album::all();
	}

	public function find($id)
	{
		return Album::find($id);
	}

	public function findOrFail($id)
	{
		return Album::findOrFail($id);
	}

	public function create($input)
	{
		return Album::create($input);
	}
}