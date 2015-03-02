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
		$this->loadViewsFrom(__DIR__.'/../../views', 'gallery');
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'gallery');

        $resources = realpath(__DIR__.'/../resources');
		$this->publishes([
            $resources.'/views' => base_path('resources/views/vendor/gallery'),
            $resources.'/config/gallery.php' => config_path('gallery.php'),
            __DIR__.'/../public' => public_path('gallery'),
    	]);

        include $resources.'/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$resources = realpath(__DIR__.'/../resources');
        $this->mergeConfigFrom($resources.'/config/gallery.php', 'gallery');

		if (file_exists(app_path().'/bindings.php')) {
			include app_path() . '/bindings.php';
		}
		else
		{
			include $resources.'/bindings.php';
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['gallery'];
	}

}