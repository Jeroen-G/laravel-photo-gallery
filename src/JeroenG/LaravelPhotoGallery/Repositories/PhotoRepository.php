<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

interface PhotoRepository {
	
	public function all();

	public function find($id);

	public function findOrFail($id);

	public function create($input);

	public function where($first, $operator, $second);
}