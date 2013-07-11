<?php namespace JeroenG\LaravelPhotoGallery\Facades;

use Illuminate\Support\Facades\Facade;

class Gallery extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'gallery'; }

}