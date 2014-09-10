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

	public function findByAlbumId($albumId)
	{
		return Photo::where('album_id', '=', $albumId)->paginate(10);
	}

	public function create($input, $filename)
	{
		$newPhoto = new Photo;
		$newPhoto->photo_name = $input['photo_name'];
		$newPhoto->photo_description = $input['photo_description'];
		$newPhoto->photo_path = $filename;
		$newPhoto->album_id = $input['album_id'];
		return $newPhoto->save();
	}

	public function update($id, $input)
	{
		$photo = Photo::find($id);
		$photo->photo_name = $input['photo_name'];
		$photo->photo_description = $input['photo_description'];
		$photo->photo_path = $input['photo_path'];
		$photo->album_id = $input['album_id'];
		$photo->touch();
		return $photo->save();
	}

	public function delete($id)
	{
		$photo = Photo::find($id);
        $file = "uploads/photos/" . $photo->photo_path;
        $this->hasDeletedDir();
        rename($file, "uploads/photos/deleted/" . $photo->photo_path);
		return $photo->delete();
	}

	public function hasDeletedDir()
	{
   		return is_dir("uploads/photos/deleted/") || mkdir("uploads/photos/deleted/");
	}

	public function forceDelete($id)
	{
		$photo = Photo::find($id);
        $file = "uploads/photos/" . $photo->photo_path;
        unlink($file);
		return $photo->forceDelete();
	}

	public function restore($id)
	{
		$photo = Photo::withTrashed()->find($id);
        $deletedFile = "uploads/photos/deleted/" . $photo->photo_path;
        rename($deletedFile, "uploads/photos/" . $photo->photo_path);
		return $photo->restore();
	}

	public function restoreFromAlbum($albumId)
	{
		$albumPhotos = Photo::withTrashed()->where('album_id', $albumId)->get();

		foreach ($albumPhotos as $photo) {
			$this->restore($photo->photo_id);
		}
	}
}