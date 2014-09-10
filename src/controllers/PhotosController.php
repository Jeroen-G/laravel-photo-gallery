<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

use JeroenG\LaravelPhotoGallery\Validators as Validators;

class PhotosController extends BaseController {

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
		$this->photo = \App::make('Repositories\PhotoRepository');
	}

	/**
	 * Show the form for creating a new photo.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$albumArray = $this->album->all()->toArray();
		$dropdown[0] = '';

		if (empty($albumArray)) {
			$dropdown[0] = \Lang::get('gallery::gallery.none') . \Lang::choice('gallery::gallery.album', 2);
		}

		foreach ($albumArray as $album) {
		    $dropdown[$album['album_id']] = $album['album_name'];
		}

		$data = array('type' => 'photo', 'dropdown' => $dropdown);
		$this->layout->content = \View::make('gallery::new', $data)
		->nest('form', 'gallery::forms.new-photo', $data);
	}

	/**
	 * Store a newly created photo in storage.
	 *
	 * @return \Illuminate\View\View
	 */
	public function store()
	{
		$input = \Input::all();

		$validation = new Validators\Photo;

		if($validation->passes())
		{
			$filename = str_random(4) . \Input::file('photo_path')->getClientOriginalName();
			$destination = "uploads/photos/";
            $upload = \Input::file('photo_path')->move($destination, $filename);

			if( $upload == false )
			{
				return \Redirect::to('gallery.album.photo.create')
       			->withInput()
       			->withErrors($validation->errors)
       			->with('message', \Lang::get('gallery::gallery.errors'));
			}

			$this->photo->create($input, $filename);
			return \Redirect::route("gallery.album.show", array('id' => $input['album_id']));
		}
		else
		{
			return \Redirect::route('gallery.album.photo.create')
            ->withInput()->withErrors($validation->errors)
            ->with('message', \Lang::get('gallery::gallery.errors'));
		}
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
		$photo = $this->photo->findOrFail($photoId);
		$this->layout->content = \View::make('gallery::photo', array('photo' => $photo));
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
		$photo = $this->photo->find($photoId);

		$albumArray = $this->album->all()->toArray();
		foreach ($albumArray as $album) {
		    $dropdown[$album['album_id']] = $album['album_name'];
		}

		$data = array('type' => 'photo', 'dropdown' => $dropdown, 'photo' => $photo);
		$this->layout->content = \View::make('gallery::edit', $data)
		->nest('form', 'gallery::forms.edit-photo', $data);
	}

	/**
	 * Update the specified photo in the database.
	 *
	 * @param int $albumId Id of the album
	 * @param int $photoId Id of the photo
	 * @return \Illuminate\View\View
	 */
	public function update($albumId, $photoId)
	{
		$input = \Input::except('_method');

        $validation = new Validators\Photo($input);

        if ($validation->passes())
        {
            $this->photo->update($photoId, $input);

            return \Redirect::route("gallery.album.photo.show", array('albumId' => $albumId, 'photoId' => $photoId));
        }
        else
        {
        	return \Redirect::route("gallery.album.photo.edit", array('albumId' => $albumId, 'photoId' => $photoId))
            ->withInput()
            ->withErrors($validation->errors)
            ->with('message', \Lang::get('gallery::gallery.errors'));
        }
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
        $this->photo->delete($photoId);
        return \Redirect::route("gallery.album.show", array('id' => $albumId));
	}
}