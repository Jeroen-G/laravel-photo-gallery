# Laravel Photo Gallery

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/quality-score.png)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Code Coverage](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/badges/coverage.png)](https://scrutinizer-ci.com/g/Jeroen-G/laravel-photo-gallery/)
[![Latest Version](https://img.shields.io/github/release/jeroen-g/laravel-photo-gallery.svg?style=flat)](https://github.com/jeroen-g/laravel-photo-gallery/releases)
[![License](https://img.shields.io/badge/License-EUPL--1.1-blue.svg?style=flat)](license.md)

A photo gallery for Laravel 5.

## Installation

Via Composer:
``` bash
$ composer require jeroen-g/laravel-photo-gallery
```

The next step is to add the service provider in `app/config/app.php`:
    
    JeroenG\LaravelPhotoGallery\LaravelPhotoGalleryServiceProvider::class,

And publish the resources:
``` bash
$ php artisan vendor:publish
```
Tip: you can use the `--tag={tag}` flag to publish only views, migrations, config or assets.

The last thing to do is to migrate:
```bash
$ php artisan migrate
```
This will create the tables for the gallery. Now you're ready to start! Visit `/gallery` on your host to view the Photo Gallery.

## Usage

### Photos
The photos will be uploaded to the folder `public/uploads/photos/`.

### Configuration
There are a few settings you could change in a configuration file.
The configuration can be found in `app/config/gallery.php`. One of the thing you can change is the adapter. The adapter(s) are responsible for the interactions with the persistance layer, the database most of the times. The default is Eloquent, and an test and flickr adapter are also provided. You can also make your own adapter. The adapter can be implemented by copying the adapter bindings from the package service provider into your app's service provider and changing the implementations. If you want to share your adapter, you can place a PR on Github.

### Flickr
You can use Flickr instead of a database to retrieve your photos. For this you have to set the adapter to flickr and enter your flickr credentials.

### Custom adapters
To create your own adapter, or change the existing ones, you can replace the existing adapters by binding your own adapters to the right contract(s), for example inside an application service provider. An example, if you want to change the PhotoAdapter:
```php
$this->app->bind('JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter', 'App\Adapters\CustomPhotoAdapter');
```
You can look at the Laravel Photo Gallery service provider for all the bindings that you can replace. If you have a complete replacement, for example for Doctrine instead of eloquent, feel welcome to share it, it might very well end up included in the package!

## Contributing

Please see [contributing.md](contributing.md) for details.

## License

The EU Public License. Please see [license.md](license.md) for more information.

## Changelog

Please see [changelog.md](changelog.md) for the changes made.