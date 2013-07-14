<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

class GalleryController extends BaseController {

	protected $album;

	protected $photo;

	public function __construct(\JeroenG\LaravelPhotoGallery\Models\Album $album, \JeroenG\LaravelPhotoGallery\Models\Photo $photo)
    {
        $this->album = $album;
        $this->photo = $photo;
    }

    /**
	 * Methods for showing
     **/

	/**
	 * Listing all albums
	 *
	 **/
	public function getIndex()
	{
		$allAlbums = $this->album->all();
		$this->layout->content = \View::make('gallery::index', array('allAlbums' => $allAlbums));
	}

	/**
	 * Showing photos in one album
	 *
	 **/
	public function getAlbum($id)
	{
		$albumPhotos = $this->album->findOrFail($id)->photos;
		$this->layout->content = \View::make('gallery::album', array('albumPhotos' => $albumPhotos));
	}

	/**
	 * Showing a single photo
	 *
	 **/
	public function getPhoto($id)
	{
		$photo = $this->photo->findOrFail($id);
		$this->layout->content = \View::make('gallery::photo', array('photo' => $photo));
	}

	/**
	 * Showing the form for creating an album or photo
	 *
	 **/
	public function getNew($type = 'photo')
	{
		if ($type == 'album') {
			$data = array('type' => 'album');
			$this->layout->content = \View::make('gallery::new', $data)->nest('form', 'gallery::forms.new-album');
		}
		elseif ($type == 'photo') {
			$albumArray = $this->album->all()->toArray();
			foreach ($albumArray as $album) {
			    $dropdown[$album['album_id']] = $album['album_name'];
			}

			$data = array('type' => 'photo', 'dropdown' => $dropdown);
			$this->layout->content = \View::make('gallery::new', $data)->nest('form', 'gallery::forms.new-photo', $data);
		}
	}

/**
	 * Showing the form for editing an album or photo
	 *
	 **/
	public function getEdit($type = 'photo', $id)
	{
		if ($type == 'album') {
			$album = $this->album->find($id);

			if(is_null($id))
			{
				return \Redirect::to('gallery');
			}

			$data = array('type' => 'album', 'album' => $album);
			$this->layout->content = \View::make('gallery::edit', $data)->nest('form', 'gallery::forms.edit-album', $data);
		}
		elseif ($type == 'photo') {
			$photo = $this->photo->find($id);
			
			if(is_null($id))
			{
				return \Redirect::to('gallery');
			}

			$albumArray = $this->album->all()->toArray();
			foreach ($albumArray as $album) {
			    $dropdown[$album['album_id']] = $album['album_name'];
			}

			$data = array('type' => 'photo', 'dropdown' => $dropdown, 'photo' => $photo);
			$this->layout->content = \View::make('gallery::edit', $data)->nest('form', 'gallery::forms.edit-photo', $data);
		}
	}

	/**
	 * Methods for creating
     **/

	/**
	 * Adding an album
	 *
	 **/
	public function postAlbum()
	{
		$input = \Input::all();

		$validator = \Validator::make($input, $this->album->rules);

		if($validator->passes())
		{
			$this->album->create($input);

			return \Redirect::to('gallery');
		}
		else
		{
			return \Redirect::to('gallery/new/album')
            ->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
		}
	}

	/**
	 * Adding an photo
	 *
	 **/
	public function postPhoto()
	{
		$input = \Input::all();

		$validator = \Validator::make($input, $this->photo->rules);

		if($validator->passes())
		{
			$file = \Input::file('path')->getClientOriginalName();
			//$this->photo->create(array('photo_name' => $input['name'], 'photo_description' => $input['description'], 'photo_path' => $file));

			$newPhoto = new \JeroenG\LaravelPhotoGallery\Models\Photo;
			$newPhoto->photo_name = $input['photo_name'];
			$newPhoto->photo_description = $input['photo_description'];
			$newPhoto->photo_path = $file;
			$newPhoto->album_id = $input['album_id'];
			$newPhoto->save();

			return \Redirect::to('gallery');
		}
		else
		{
			return \Redirect::to('gallery/new/photo')
            ->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
		}
	}

	/**
	 * Methods for updating
     **/

	/**
	 * Updating an album
	 *
	 **/
	public function putAlbum($id)
	{
		$input = \Input::except('_method');

        $validator = \Validator::make($input,$this->album->rules);

        if ($validator->passes())
        {
            $album = $this->album->find($id);
            $album->update($input);

            return \Redirect::to('gallery/album/' . $id);
        }
        else
        {
        	return \Redirect::to('gallery/edit/album/' . $id)
            ->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
        }
	}

	/**
	 * Updating a photo
	 *
	 **/
	public function putPhoto($id)
	{
		$input = \Input::except('_method');

        $validator = \Validator::make($input,$this->photo->rules);

        if ($validator->passes())
        {
            $photo = $this->photo->find($id);
            $photo->update($input);

            return \Redirect::to('gallery/photo/' . $id);
        }
        else
        {
        	return \Redirect::to('gallery/edit/photo/' . $id)
            ->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
        }
	}
}