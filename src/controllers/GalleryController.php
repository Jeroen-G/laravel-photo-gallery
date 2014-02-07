<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

use JeroenG\LaravelPhotoGallery\Validators as Validators;

class GalleryController extends BaseController {

	/**
	 * The album model
	 *
	 * @var \JeroenG\LaravelPhotoGallery\Models\Album
	 **/
	protected $album;

	/**
	 * The photo model
	 *
	 * @var \JeroenG\LaravelPhotoGallery\Models\Photo
	 **/
	protected $photo;

	/**
	 * Instantiate the controller
	 *
	 * @param \JeroenG\LaravelPhotoGallery\Models\Album $album
	 * @param \JeroenG\LaravelPhotoGallery\Models\Photo $photo
	 * @return void
	 **/
	public function __construct()
    {
        $this->album = \App::make('Repositories\AlbumRepository');
        //$this->photo = \App::make('Repositories\PhotoRepository');
    }

    /**
	 * Methods for showing
     **/

	/**
	 * Listing all albums
	 *
	 * @return \Illuminate\View\View
	 **/
	public function index()
	{
		$allAlbums = $this->album->all();
		$this->layout->content = \View::make('gallery::index', array('allAlbums' => $allAlbums));
	}
}