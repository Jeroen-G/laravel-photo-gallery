<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

class FlickrPhotoRepository implements PhotoRepository {

	private $fid;
	
	public function __construct()
	{
		// api key & secret key
		\Flickering::handshake(\Config::get('gallery::api'), \Config::get('gallery::secret'));

		// User id
		$this->fid = \Config::get('gallery::fid');
	}

	public function all(){}

	public function find($id)
	{
		$results = \Flickering::getResultsOf('photos.getInfo', array('photo_id' => $id));
		return $results;
	}

	public function findOrFail($id)
	{
		return $this->find($id);
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

		$results = \Flickering::getResultsOf('photosets.getPhotos', array(
			'photoset_id' 	=>	$albumId,
			'per_page' 		=>	$per_page,
			'page'			=>	$page
		));
		return $results;
	}

	public function create($input, $filename){}

	public function update($id, $input){}

	public function delete($id){}

	public function forceDelete($id){}

	public function restore($id){}

	public function restoreFromAlbum($albumId){}
}
