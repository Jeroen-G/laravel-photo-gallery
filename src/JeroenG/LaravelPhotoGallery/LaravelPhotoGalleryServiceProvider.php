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
		$this->package('jeroen-g/laravel-photo-gallery');

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
		$this->app->bind('gallery', function()
        {
            return new Gallery;
        });
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