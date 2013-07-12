<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

class GalleryController extends BaseController {

	protected $album;

	public function __construct(\JeroenG\LaravelPhotoGallery\Models\Album $album)
    {
        $this->album = $album;
    }

	/**
	 * Listing all albums
	 *
	 **/
	public function getIndex()
	{
		$allAlbums = $this->album->all();
		$this->layout->content = \View::make('gallery::index', array('allAlbums' => $allAlbums));
	}

}