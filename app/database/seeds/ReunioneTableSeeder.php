<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SysCR\Entities\Reunione;

class ReunioneTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 3) as $index)
		{
			Reunione::create([
                'descripcion' => $faker->company,
                'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'hora' => $faker->time($format = 'H:i:s', $max = 'now'),
                'multa' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
			]);




		}
	}

}