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
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->integer('order')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
		DB::table('albums')->insert(
	        array(
	            'name' => 'Default',
	            'description' => 'Default Album',
	            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
	            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
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
