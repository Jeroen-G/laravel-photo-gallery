<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

class FlickrAlbumRepository implements AlbumRepository {

	private $fid;
	
	public function __construct()
	{
		// api key & secret key
		\Flickering::handshake(\Config::get('gallery::api'), \Config::get('gallery::secret'));

		// User id
		$this->fid = \Config::get('gallery::fid');
	}

	public function all()
	{
		$results = \Flickering::getResultsOf('photosets.getList', array('user_id' => $this->fid));
		return $results;
	}

	public function find($id)
	{
		$results = \Flickering::getResultsOf('photosets.getInfo', array('photoset_id' => $id));
		return $results;
	}

	public function findOrFail($id)
	{
		return $this->find($id);
	}

	public function create($input){}

	public function update($id, $input){}

	public function delete($id){}

	public function forceDelete($id){}

	public function restore($id){}
}