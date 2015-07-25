<?php

namespace JeroenG\LaravelPhotoGallery;

use Illuminate\Support\ServiceProvider;

class LaravelPhotoGalleryServiceProvider extends ServiceProvider
{
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
        $resources = realpath(__DIR__.'/../resources');

        $this->loadViewsFrom($resources.'/views', 'gallery');
        $this->loadTranslationsFrom($resources.'/lang', 'gallery');

        $this->publishes([
            $resources.'/views' => base_path('resources/views/vendor/gallery')
        ], 'views');

        $this->publishes([
            $resources.'/config/gallery.php' => config_path('gallery.php')
        ], 'config');

        $this->publishes([
            $resources.'/migrations' => $this->app->databasePath().'/migrations',
        ], 'migrations');

        $this->publishes([
            $resources.'/assets' => public_path('vendor/gallery'),
        ], 'assets');

        if(config('gallery.routes')) {
            if (! $this->app->routesAreCached()) {
                require $resources.'/routes.php';
            }
        }
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
        $this->bindBindings();
        $this->commands(['JeroenG\LaravelPhotoGallery\Console\GalleryClearCommand']);
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

    public function bindBindings()
    {
        // Bind the facade
        $this->app->bind('gallery', function() {
            $photo = $this->app->make('JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter');
            $album = $this->app->make('JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter');
            $user = $this->app->make('JeroenG\LaravelPhotoGallery\Contracts\UserAdapter');
            $tag = $this->app->make('JeroenG\LaravelPhotoGallery\Contracts\TagAdapter');
            return new Services\GalleryService($album, $photo, $user, $tag);
        });

        // Bind the adapters
        if(config('gallery.adapter') == 'eloquent') {
            // When using 'AlbumRepository', Laravel automatically uses the EloquentAlbumRepository
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter','JeroenG\LaravelPhotoGallery\Adapters\Eloquent\EloquentAlbumAdapter');
            // The same for Photos
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\Eloquent\EloquentPhotoAdapter');
            // And for Users
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\UserAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\Eloquent\EloquentUserAdapter');
            // And Tags
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\TagAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\Eloquent\EloquentTagAdapter');
        } elseif (config('gallery.adapter') == 'memory') {
            // When using 'AlbumRepository', Laravel automatically uses the EloquentAlbumRepository
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter','JeroenG\LaravelPhotoGallery\Adapters\InMemory\InMemoryAlbumAdapter');
            // The same for Photos
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\InMemory\InMemoryPhotoAdapter');
            // And for Users
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\UserAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\InMemory\InMemoryUserAdapter');
            // And Tags
            $this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\TagAdapter', 'JeroenG\LaravelPhotoGallery\Adapters\InMemory\InMemoryTagAdapter');
        } else {
            throw new \Exception("Invalid gallery adapter.");
        }
    }

}