<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

use JeroenG\LaravelPhotoGallery\Models\Photo;

class EloquentPhotoRepository implements PhotoRepository {
	
	public function all()
	{
		return Photo::all();
	}

	public function find($id)
	{
		return Photo::find($id);
	}

	public function findOrFail($id)
	{
		return Photo::findOrFail($id);
	}

	public function create($input)
	{
		return Photo::create($input);
	}

	public function where($first, $operator, $second)
	{
		return Photo::where($first, $operator, $second);
	}
}