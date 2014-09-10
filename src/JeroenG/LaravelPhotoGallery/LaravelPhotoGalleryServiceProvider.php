<?php namespace JeroenG\LaravelPhotoGallery;

use Illuminate\Support\ServiceProvider;

class LaravelPhotoGalleryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('jeroen-g/laravel-photo-gallery', 'gallery');

		// Views will first be sought in app/views/gallery before the package view is used.
		\View::addNamespace('gallery', app_path().'/views/gallery');
		\View::addNamespace('gallery', __DIR__.'/../../views');

		// Shortcut for using the gallery language lines.
		\Lang::addNamespace('gallery', __DIR__.'/../../lang');

		include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		if (file_exists(app_path().'/bindings.php')) {
			include app_path() . '/bindings.php';
		}
		else
		{
			include __DIR__.'/bindings.php';
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('gallery');
	}

}