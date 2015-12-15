<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SysCR\Entities\Fotocheck;

class FotocheckTableSeeder extends Seeder {

	public function run()
	{
		Fotocheck::create([
            'codigo_barras' => 'asd1234',
            'observacion' => 'no'

        ]);
        Fotocheck::create([
            'codigo_barras' => 'asd1235',
            'observacion' => 'no'

        ]);
        Fotocheck::create([
            'codigo_barras' => 'asd1236',
            'observacion' => 'no'

        ]);
	}

}