# Laravel Photo Gallery

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/quality-score.png)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Code Coverage](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/coverage.png)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Latest Version](https://img.shields.io/github/release/jeroen-g/laravel-photo-gallery.svg?style=flat)](https://github.com/jeroen-g/laravel-photo-gallery/releases)
[![License](https://img.shields.io/badge/License-EUPL--1.1-blue.svg?style=flat)](license.md)

A photo gallery for Laravel 5.

## Installation

Via Composer

``` bash
$ composer require jeroen-g/laravel-photo-gallery
```

The next step is to add the service provider in `app/config/app.php`:

    'JeroenG\LaravelPhotoGallery\LaravelPhotoGalleryServiceProvider',

The last thing to do is to migrate:

    php artisan migrate --package="jeroen-g/laravel-photo-gallery"

This will create the tables for the gallery. Now you're ready to start! Visit `/gallery` on your host to view the Photo Gallery.

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

## Contributing

Please see [contributing.md](contributing.md) for details.

## License

The EU Public License. Please see [license.md](license.md) for more information.

## Changelog

Please see [changelog.md](changelog.md) for the changes made.