<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use JeroenG\LaravelPhotoGallery\Models\Album;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumRepository;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoRepository;

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

	public function update($id, $input)
	{
		$album = Album::find($id);
		$album->album_name = $input['album_name'];
		$album->album_description = $input['album_description'];
		$album->touch();
		return $album->save();
	}

	public function delete($id, PhotoRepository $photos, Filesystem $storage)
	{
		$album = Album::find($id);
		$albumPhotos = $album->photos;

		foreach ($albumPhotos as $photo) {
			$photos->delete($photo->photo_id, $storage);
		}
		return $album->delete();
	}

	public function forceDelete($id, PhotoRepository $photos, Filesystem $storage)
	{
		$album = Album::find($id);
		$albumPhotos = $album->photos;

		foreach ($albumPhotos as $photo) {
			$photos->forceDelete($photo->photo_id, $storage);
		}
		return $album->forceDelete();
	}

	public function restore($id, PhotoRepository $photos, Filesystem $storage)
	{
		$album = Album::withTrashed()->find($id);
		$photos->restoreFromAlbum($id, $storage);
		return $album->restore();
	}
}