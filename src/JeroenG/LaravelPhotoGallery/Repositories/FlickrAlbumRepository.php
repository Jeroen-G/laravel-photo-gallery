<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

class FlickrAlbumRepository implements AlbumRepository {

	private $flickr;
	private $fid;
	
	public function __construct()
	{
		$this->flickr = new \phpFlickr(\Config::get('gallery::api'), \Config::get('gallery::secret'));
		$this->fid = \Config::get('gallery::fid');
	}

	public function all()
	{
		return $this->flickr->photosets_getList($this->fid);
	}

	public function find($id)
	{
		return $this->flickr->photosets_getInfo($id);
	}

	public function findOrFail($id)
	{
		return $this->flickr->photosets_getInfo($id);
	}

	public function create($input){}

	public function update($id, $input){}

	public function delete($id){}

	public function forceDelete($id){}

	public function restore($id){}
}