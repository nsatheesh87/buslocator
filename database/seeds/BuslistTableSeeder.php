<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BuslistTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');
		DB::table('buslist')->delete();
		$list = array(
			['busno'=> 'PJ01', 'name' => 'PJ City BUS', 'latitude' => '3.14920', 'longitude' => '101.68485', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['busno'=> 'AWZ85', 'name' => 'AB Private BUS', 'latitude' => '3.126998', 'longitude' => '101.6225279', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['busno'=> 'QZX345', 'name' => 'QZ CITY BUS', 'latitude' => '3.129225', 'longitude' => '101.686138', 'created_at' => new DateTime, 'updated_at' => new DateTime]
			);
		DB::table('buslist')->insert($list);
	}

}