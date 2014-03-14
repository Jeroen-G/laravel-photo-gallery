<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

class FlickrPhotoRepository implements PhotoRepository {

	private $flickr;
	private $fid;
	
	public function __construct()
	{
		$this->flickr = new \phpFlickr(\Config::get('gallery::api'), \Config::get('gallery::secret'));
		$this->fid = \Config::get('gallery::fid');
	}

	public function all(){}

	public function find($id)
	{
		return $this->flickr->photos_getInfo($id);
	}

	public function findOrFail($id)
	{
		return $this->flickr->photos_getInfo($id);
	}

	public function findByAlbumId($albumId)
	{
		$per_page = 10;
		if(\Input::has('page'))
		{
			$page = \Input::get('page');
		}
		else
		{
			$page = 1;
		}

		return $this->flickr->photosets_getPhotos($albumId, null, null, $per_page, $page);
	}

	public function create($input, $filename){}

	public function update($id, $input){}

	public function delete($id){}

	public function forceDelete($id){}

	public function restore($id){}

	public function restoreFromAlbum($albumId){}
}
