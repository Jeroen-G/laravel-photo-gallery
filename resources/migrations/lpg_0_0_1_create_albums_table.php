<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table)
		{
			$table->increments('album_id');
			$table->string('album_name');
			$table->string('album_description')->nullable();
			$table->integer('order')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
		DB::table('albums')->insert(
	        array(
	            'album_name' => 'Default',
	            'album_description' => 'Default Album'
	        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}

}
