<?php namespace JeroenG\LaravelPhotoGallery\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumRepository;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoRepository;

class GalleryClearCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gallery:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove all photos and albums';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(AlbumRepository $albums, PhotoRepository $photos, Filesystem $storage)
	{
		parent::__construct();
		$this->photos = $photos;
		$this->albums = $albums;
		$this->storage = $storage;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->comment('Deleting photos...');
		$allPhotos = $this->photos->all();
		foreach ($allPhotos as $photo) {
			$this->photos->forceDelete($photo->photo_id, $this->storage);
		}

		$this->comment('Deleting albums...');
		$allAlbums = $this->albums->all();
		foreach ($allAlbums as $album) {
			if($album->album_id != 1)
			{
				$this->albums->forceDelete($album->album_id, $this->photos, $this->storage);
			}
		}

		$this->info('Gallery cleared!');
	}

}