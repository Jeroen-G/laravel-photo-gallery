<?php namespace JeroenG\LaravelPhotoGallery\Controllers;

class BaseController extends \Illuminate\Routing\Controllers\Controller {

	/**
	 * The default layout.
	 *
	 * @var string
	 */
	protected $layout = 'gallery::layouts.master';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

}