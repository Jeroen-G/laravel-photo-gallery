<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('photo_id');
			$table->integer('tag_id');
			$table->string('tag_desc');
			$table->string('tag_type');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photos_tags');
	}

}
