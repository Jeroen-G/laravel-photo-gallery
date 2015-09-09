<?php

namespace JeroenG\LaravelPhotoGallery\Controllers;

use Illuminate\Http\Request;
use JeroenG\LaravelPhotoGallery\Entities as Entity;

class PhotosController extends Controller
{
	/**
	 * Show the form for creating a new photo.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$albumArray = \Gallery::album()->all()->toArray();
		foreach ($albumArray as $album) {
		    $dropdown[$album->getId()] = $album->getName();
		}
		$data = array('type' => 'photo', 'dropdown' => $dropdown);
		return view('gallery::new', $data)->with('form', 'gallery::partials.new-photo');
	}

	/**
	 * Store a newly created photo in storage.
	 *
	 * @param  $request
	 * @param  $filesystem
	 * @return \Illuminate\View\View
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'photo_path' => 'image|required',
    		'album_id' => 'required',
            'photo_name' => 'required',
            'photo_description' => 'max:255',
		]);

		$file = $request->file('photo_path');
		$filename = str_random(10).time().$file->getClientOriginalName();
		$file->move(public_path('uploads/photos'), $filename);

		$photo = new Entity\Photo();
		$photo->map([
			'file' => $filename,
    		'album_id' => $request->input('album_id'),
            'name' => $request->input('photo_name'),
            'description' => $request->input('photo_description'),
            'order' => 0,
		]);

		\Gallery::photo()->add($photo);

		return \Redirect::route('gallery')->with('alertsuccess', \Lang::get('gallery::gallery.creation'));
	}

	/**
	 * Display the specified photo.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function show($albumId, $photoId)
	{
		$photo = \Gallery::photo()->find($photoId);
		return view('gallery::photo', ['photo' => $photo]);
	}

	/**
	 * Show the form for editing the specified photo.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function edit($albumId, $photoId)
	{
		$photo = \Gallery::photo()->find($photoId);
		$albumArray = \Gallery::album()->all()->toArray();
		foreach ($albumArray as $album) {
		    $dropdown[$album->getId()] = $album->getName();
		}
		$data = array('type' => 'photo', 'dropdown' => $dropdown, 'photo' => $photo);
		return view('gallery::edit', $data)->with('form', 'gallery::partials.edit-photo');

	}

	/**
	 * Update the specified photo in the database.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function update(Request $request, $albumId, $photoId)
	{
        $this->validate($request, [
    		'album_id' => 'required',
            'photo_name' => 'required',
            'photo_description' => 'max:255',
		]);

		$photo = new Entity\Photo();
		$photo->map([
			'id' => $photoId,
    		'album_id' => $request->input('album_id'),
            'name' => $request->input('photo_name'),
            'description' => $request->input('photo_description'),
            'order' => 0,
		]);

		\Gallery::photo()->save($photo);

		return \Redirect::route('gallery.album.photo.show', ['albumId' => $albumId, 'photoId' => $photoId])->with('alertsuccess', \Lang::get('gallery::gallery.update'));
		}

	/**
	 * Remove the specified photo from the database.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function destroy($albumId, $photoId)
	{
        $photo = new Entity\Photo();
		$photo->map([
			'id' => $photoId,
		]);
		\Gallery::photo()->delete($photo);
        return \Redirect::route("gallery.album.show", ['id' => $albumId])->with('alertsuccess', \Lang::get('gallery::gallery.removal'));
	}
}