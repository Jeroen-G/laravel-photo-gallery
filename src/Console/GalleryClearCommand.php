<?php

namespace JeroenG\LaravelPhotoGallery\Console;

use Illuminate\Console\Command;
use JeroenG\LaravelPhotoGallery\Contracts\AlbumAdapter;
use JeroenG\LaravelPhotoGallery\Contracts\PhotoAdapter;

class GalleryClearCommand extends Command
{

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'gallery:clear';

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
	public function __construct(AlbumAdapter $albums, PhotoAdapter $photos)
	{
		parent::__construct();
		$this->photos = $photos;
		$this->albums = $albums;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->comment('Deleting photos...');
		$allPhotos = $this->photos->all();
		foreach ($allPhotos as $photo) {
			$this->photos->delete($photo);
		}

		$this->comment('Deleting albums...');
		$allAlbums = $this->albums->all();
		foreach ($allAlbums as $album) {
			if($album->getId() != 1)
			{
				$this->albums->delete($album);
			}
		}

		$this->info('Gallery cleared!');
	}

}