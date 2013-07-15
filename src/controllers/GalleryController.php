<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

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
	 * @return \Illuminate\View\View
	 **/
	public function getIndex()
	{
		$allAlbums = $this->album->all();
		$this->layout->content = \View::make('gallery::index', array('allAlbums' => $allAlbums));
	}

	/**
	 * Showing photos in one album
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 **/
	public function getAlbum($id)
	{
		$album = $this->album->findOrFail($id);
		$albumPhotos = $this->photo->where('album_id', '=', $id)->paginate(10);
		//$albumPhotos = \Paginator::make($albumPhotos->toArray(), $albumPhotos->count(), 2);
		$this->layout->content = \View::make('gallery::album', array('album' => $album, 'albumPhotos' => $albumPhotos));
	}

	/**
	 * Showing a single photo
	 *
	 * @param int $id Id of the photo
	 * @return \Illuminate\View\View
	 **/
	public function getPhoto($id)
	{
		$photo = $this->photo->findOrFail($id);
		$this->layout->content = \View::make('gallery::photo', array('photo' => $photo));
	}

	/**
	 * Showing the form for creating an album or photo
	 *
	 * @param string $type Either 'album' or 'photo'
	 * @return \Illuminate\View\View
	 **/
	public function getNew($type = 'photo')
	{
		if ($type == 'album') {
			$data = array('type' => 'album');
			$this->layout->content = \View::make('gallery::new', $data)->nest('form', 'gallery::forms.new-album');
		}
		elseif ($type == 'photo') {
			$albumArray = $this->album->all()->toArray();
			$dropdown[0] = '';

			if (empty($albumArray)) {
				$dropdown[0] = \Lang::get('gallery::gallery.none') . \Lang::choice('gallery::gallery.album', 2);
			}

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
	 * @param string $type Either 'album' or 'photo'
	 * @param int $id Id of the album or photo
	 * @return \Illuminate\View\View
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
	 * @return \Illuminate\View\View
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
	 * @return \Illuminate\View\View
	 **/
	public function postPhoto()
	{
		$input = \Input::all();

		$validator = \Validator::make($input, $this->photo->rules);

		if($validator->passes())
		{
			$filename = str_random(4) . \Input::file('photo_path')->getClientOriginalName();
			$destination = "uploads/photos/";
			$upload = \Input::file('photo_path')->move($destination, $filename);

			if( $upload == false )
			{
				return \Redirect::to('gallery/new/photo')
       			->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
			}

			//$this->photo->create(array('photo_name' => $input['name'], 'photo_description' => $input['description'], 'photo_path' => $file));

			$newPhoto = new \JeroenG\LaravelPhotoGallery\Models\Photo;
			$newPhoto->photo_name = $input['photo_name'];
			$newPhoto->photo_description = $input['photo_description'];
			$newPhoto->photo_path = $filename;
			$newPhoto->album_id = $input['album_id'];
			$newPhoto->save();

			return \Redirect::to('gallery/album/' . $input['album_id']);
		}
		return \Redirect::to('gallery/new/photo')
       	->withInput()->withErrors($validator)->with('message', \Lang::get('validation.errors'));
	}

	/**
	 * Methods for updating
     **/

	/**
	 * Updating an album
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
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
	 * @param int $id Id of the photo
	 * @return \Illuminate\View\View
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

	/**
	 * Methods for deleting
     **/

	/**
	 * Deleting an album
	 *
	 * @param int $id Id of the album
	 * @return \Illuminate\View\View
	 **/
	public function deleteAlbum ($id)
	{
		$album = $this->album->find($id);
		$albumPhotos = $album->photos;
		
		foreach ($albumPhotos as $photo) {
			$this->deletePhoto($photo->photo_id);
		}

		$album->delete();

		return \Redirect::to('gallery');
	}

	/**
	 * Deleting a photo
	 *
	 * @param int $id Id of the photo
	 * @return \Illuminate\View\View
	 **/
	public function deletePhoto ($id)
	{
		$photo = $this->photo->find($id);
		$album = $photo->album_id;
        $file = "uploads/photos/" . $photo->photo_path;
        
        unlink($file);
        $photo->delete();

        return \Redirect::to("gallery/album/$album");
	}
}