Laravel Photo Gallery
=====================

A photo gallery for Laravel 4.2

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/quality-score.png?s=d18bf338ee3a9ea64a8347d5893b59969b8a6b21)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Latest Stable Version](https://poser.pugx.org/jeroen-g/laravel-photo-gallery/v/stable.png)](https://packagist.org/packages/jeroen-g/laravel-photo-gallery)

## Installation
First you should install this package through Composer and edit your project's `composer.json`:

    "require": {
        "laravel/framework": "4.2.*",
        "jeroen-g/laravel-photo-gallery": "v1.*"
    }

Next, update Composer via the command line:

    composer update

The next step is to add the service provider in `app/config/app.php`:

    'JeroenG\LaravelPhotoGallery\LaravelPhotoGalleryServiceProvider',

The last thing to do is to migrate:

    php artisan migrate --package="jeroen-g/laravel-photo-gallery"

This will create the tables for the gallery. Now you're ready to start!

## Usage

### Photos
The photos will be uploaded to the folder `public/uploads/photos/`.

### Views
If you want to change the way the gallery looks, use this command:

    php artisan view:publish jeroen-g/laravel-photo-gallery

Now you can edit the views for the gallery in the `app/views/packages/jeroen-g/laravel-photo-gallery` directory.

### Config
There are a few settings you could change in a configuration file. To set these values, use this command:

    php artisan config:publish jeroen-g/laravel-photo-gallery

The configuration file can now be found inside `app/config/packages/`

### Flickr
If you want to use the Flickr API you have to take a few extra steps:
- Create the file `app/bindings.php` and paste this code:

    ```php
    <?php
    $this->app->bind('Repositories\PhotoRepository', 'JeroenG\LaravelPhotoGallery\Repositories\FlickrPhotoRepository'); 
    $this->app->bind('Repositories\AlbumRepository', 'JeroenG\LaravelPhotoGallery\Repositories\FlickrAlbumRepository');
    ```

- Add this service provider to the array in `app/config/app.php`:

    `'Flickering\FlickeringServiceProvider',`
    
- And this to the Facades array in the same file:

    `'Flickering' => 'Flickering\Facades\Flickering',`

- Use the command mentioned before to publish the views of the package. In the package views you will find a folder named 'flickr', place the contents of that folder in the `app/views/packages/jeroen-g/laravel-photo-gallery` folder, overwriting the existing files.
- use the command to publish the config file for this package. Open the file and insert your Flickr ID, API key and secret.