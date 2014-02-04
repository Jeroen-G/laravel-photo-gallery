<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

use JeroenG\LaravelPhotoGallery\Models\Album;

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
		$q = $this->flickr->photosets_getList($this->fid);
		return $q;
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

	public function update($id, $input)
	{
		$album = Album::find($id);
		$album->album_name = $input['album_name'];
		$album->album_description = $input['album_description'];
		$album->touch();
		return $album->save();
	}

	public function delete($id)
	{
		$album = Album::find($id);
		$albumPhotos = $album->photos;
		$photoRepository = \App::make('Repositories\PhotoRepository');

		foreach ($albumPhotos as $photo) {
			$photoRepository->delete($photo->photo_id);
		}
		return $album->delete();
	}

	public function forceDelete($id)
	{
		$album = Album::find($id);
		$albumPhotos = $album->photos;
		$photoRepository = \App::make('Repositories\PhotoRepository');

		foreach ($albumPhotos as $photo) {
			$photoRepository->forceDelete($photo->photo_id);
		}
		return $album->forceDelete();
	}

	public function restore($id)
	{
		$album = Album::withTrashed()->find($id);
		$photoRepository = \App::make('Repositories\PhotoRepository');
		$photoRepository->restoreFromAlbum($id);
		return $album->restore();
	}
}