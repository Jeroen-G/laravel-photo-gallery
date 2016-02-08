<?php

namespace JeroenG\LaravelPhotoGallery\Controllers;

use JeroenG\LaravelPhotoGallery\Facades\Gallery;

class GalleryController extends Controller
{
    /**
     * Show a list of all the albums.
     *
     * @return \Illuminate\View\View
     */
	public function index()
	{
		$allAlbums = Gallery::album()->all();
		return view('gallery::index', ['allAlbums' => $allAlbums]);
	}
}