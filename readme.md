Laravel Photo Gallery
=====================

A photo gallery for Laravel 4.1

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/quality-score.png?s=d18bf338ee3a9ea64a8347d5893b59969b8a6b21)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Latest Stable Version](https://poser.pugx.org/jeroen-g/laravel-photo-gallery/v/stable.png)](https://packagist.org/packages/jeroen-g/laravel-photo-gallery)

## Installation
First you should install this package through Composer and edit your project's `composer.json`:

    "require": {
		"laravel/framework": "4.1.*",
		"jeroen-g/laravel-photo-gallery": "v1.1"
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

Now you can edit the views for the gallery in the `app/views/packages` directory.

### Config
There are a few settings you could change in a configuration file. To set these values, use this command:

    php artisan config:publish jeroen-g/laravel-photo-gallery

The configuration file can now be found inside `app/config/packages/`
