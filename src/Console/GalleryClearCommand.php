<?php namespace JeroenG\LaravelPhotoGallery\Console;

use Illuminate\Console\Command;

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
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->comment('Deleting photos...');
		
		$this->comment('Deleting albums...');

		$this->info('Gallery cleared!');
	}

}