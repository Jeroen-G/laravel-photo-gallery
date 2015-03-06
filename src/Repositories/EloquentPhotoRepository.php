<?php namespace JeroenG\LaravelPhotoGallery\Repositories;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use JeroenG\LaravelPhotoGallery\Models\Photo;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoRepository;

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

	public function create(Request $request, Filesystem $storage)
	{
		$filename = str_random(10).time() .".". $request->file('photo_file')->getClientOriginalExtension();
        $storage->put('uploads/photos/'.$filename, \File::get($request->file('photo_file')));

        $input = $request->input();
		$newPhoto = new Photo;
		$newPhoto->photo_name = $input['photo_name'];
		$newPhoto->photo_description = $input['photo_description'];
		$newPhoto->filename = $filename;
		$newPhoto->album_id = $input['album_id'];
		return $newPhoto->save();
	}

	public function update($id, $input)
	{
		$photo = Photo::find($id);
		$photo->photo_name = $input['photo_name'];
		$photo->photo_description = $input['photo_description'];
		$photo->album_id = $input['album_id'];
		$photo->touch();
		return $photo->save();
	}

	public function delete($id, Filesystem $storage)
	{
		$photo = Photo::find($id);
        $file = "uploads/photos/".$photo->filename;
        $this->checkDeletedDir($storage);
        $storage->move($file, "uploads/photos/deleted/".$photo->filename);
		return $photo->delete();
	}

	public function checkDeletedDir(Filesystem $storage)
	{
   		return $storage->exists("uploads/photos/deleted/") || $storage->makeDirectory("uploads/photos/deleted/");
	}

	public function forceDelete($id, Filesystem $storage)
	{
		$photo = Photo::find($id);
        if ($storage->exists("uploads/photos/deleted/".$photo->filename))
        {
        	$storage->delete("uploads/photos/deleted/".$photo->filename);
        }
        else
        {
        	$storage->delete("uploads/photos/".$photo->filename);
        }
		return $photo->forceDelete();
	}

	public function restore($id, Filesystem $storage)
	{
		$photo = Photo::withTrashed()->find($id);
        $deletedFile = "uploads/photos/deleted/".$photo->filename;
        $storage->move($deletedFile, "uploads/photos/".$photo->filename);
		return $photo->restore();
	}

	public function restoreFromAlbum($albumId, Filesystem $storage)
	{
		$albumPhotos = Photo::withTrashed()->where('album_id', $albumId)->get();

		foreach ($albumPhotos as $photo) {
			$this->restore($photo->photo_id, $storage);
		}
	}
}