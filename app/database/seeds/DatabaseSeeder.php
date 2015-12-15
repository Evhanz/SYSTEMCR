<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('FotocheckTableSeeder');
        $this->call('PersonaTableSeeder');
        $this->call('ReunioneTableSeeder');

		// $this->call('UserTableSeeder');
	}

}
