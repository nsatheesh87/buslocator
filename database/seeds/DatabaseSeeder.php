<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('BuslistTableSeeder');

        $this->command->info('Bus list table seeded!');

        $this->call('BusstopTableSeeder');

        $this->command->info('Bus list table seeded!');

        $this->call('LocationsTableSeeder');

        $this->command->info('Bus list table seeded!');
		// $this->call('UserTableSeeder');
	}

}
