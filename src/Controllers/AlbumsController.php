<?php

namespace JeroenG\LaravelPhotoGallery\Controllers;

use Illuminate\Http\Request;
use JeroenG\LaravelPhotoGallery\Entities as Entity;
use JeroenG\LaravelPhotoGallery\Facades\Gallery;

class AlbumsController extends Controller
{
	/**
	 * Show the form for creating a new album.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$data = array('type' => 'album');
		return view('gallery::new', $data)->with('form', 'gallery::partials.new-album');
	}

	/**
	 * Store a newly created album in storage.
	 *
	 * @param  $request
	 * @return \Illuminate\View\View
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'album_name' => 'required',
			'album_description' => 'max:255',
		]);

		$album = new Entity\Album();
		$album->map([
			'name' => $request->input('album_name'),
			'description' => $request->input('album_description'),
			'order' => 0,
		]);

		Gallery::album()->add($album);

		return \Redirect::route('gallery')->with('alertsuccess', \Lang::get('gallery::gallery.creation'));
	}

	/**
	 * Display the specified albums' photos.
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		$album = Gallery::album()->find($id);
		$albumPhotos = Gallery::photo()->findByAlbumId($id);
		return view('gallery::album', ['album' => $album, 'albumPhotos' => $albumPhotos]);
	}

	/**
	 * Show the form for editing the specified album.
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$album = Gallery::album()->find($id);

		$data = array('type' => 'album', 'album' => $album);
		return view('gallery::edit', $data)->with('form', 'gallery::partials.edit-album');
	}

	/**
	 * Update the specified album in the database.
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'album_name' => 'required',
			'album_description' => 'max:255',
		]);

		$album = new Entity\Album();
		$album->map([
			'id' => $id,
			'name' => $request->input('album_name'),
			'description' => $request->input('album_description'),
			'order' => 0,
		]);

		Gallery::album()->save($album);

		return \Redirect::route('gallery.album.show', ['id' => $id])->with('alertsuccess', \Lang::get('gallery::gallery.update'));
	}

	/**
	 * Remove the specified album from the database.
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 */
	public function destroy($id)
	{
		$album = new Entity\Album();
		$album->map([
			'id' => $id,
		]);
		Gallery::album()->delete($album);
        return \Redirect::route("gallery")->with('alertsuccess', \Lang::get('gallery::gallery.removal'));
	}
}