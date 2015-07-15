<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BusstopTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');
		DB::table('busstop')->delete();
		$list = array(
			['name' => 'New Mall Bus Stop', 'latitude' => '3.14900', 'longitude' => '101.68485', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['name' => 'Brick Field Bus stop', 'latitude' => '3.1292250', 'longitude' => '101.686138', 'created_at' => new DateTime, 'updated_at' => new DateTime]
			);
		DB::table('busstop')->insert($list);
	}

}