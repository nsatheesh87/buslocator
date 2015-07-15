<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocationsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		// $this->call('UserTableSeeder');
		DB::table('locations')->delete();
		$list = array(
			['name' => 'Kuala lumpur, Malaysia', 'latitude' => '3.1398820', 'longitude' => '101.69376799', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['name' => 'Petaling jaya, Malaysia', 'latitude' => '3.09929', 'longitude' => '101.64486', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['name' => 'Chennai, India', 'latitude' => '13.08268', 'longitude' => '80.27072', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			);
		DB::table('locations')->insert($list);
	}

}