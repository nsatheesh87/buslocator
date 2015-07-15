<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusstopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('busstop', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->decimal('latitude', 9, 6);
			$table->decimal('longitude', 9, 6);
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
		Schema::drop('busstop');
	}

}
