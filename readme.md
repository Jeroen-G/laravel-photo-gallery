Laravel Photo Gallery
=====================

A photo gallery for Laravel 4.1

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

    composer update

Now you can edit the views for the gallery in the `app/views/packages` directory.
