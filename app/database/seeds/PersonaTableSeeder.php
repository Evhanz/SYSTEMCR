<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SysCR\Entities\Persona;
use SysCR\Entities\User;

class PersonaTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $bandera = 0;

        foreach(range(1, 100) as $index)
        {

            $fullName = $faker->name;

            $user = User::create([
                'usuario' =>$faker->name,
                'email' =>  $faker->email,
                'password' => \Hash::make(123456),
                'user_type'=> 'usuario'

            ]);

                Persona::create([

                    'id' => $user->id,
                    'dni'=>$faker->buildingNumber,
                    'nombre' => $faker->name,
                    'apellidoP' => $faker->lastName,
                    'apellidoM' => $faker->lastName,
                    'direccion' => $faker->address,
                    'correo' => $faker->email,
                    'telefono' => $faker->phoneNumber,
                    'celular' => $faker->phoneNumber,
                    'foto' => 'asd',
                    'tipo' => 'Alumno',
                    'nivel' => $faker->randomElement(['Primaria','Secundaria']),
                    'grado' => $faker->randomElement(['1','2','3','4','5','6']),
                    'seccion' =>$faker->randomElement(['A','B','C']),
                    'estado' => true,
                    'apoderado_id' =>$faker->randomElement([null,1]),
                    'fotocheck_id' =>$faker->randomElement([null,1,2,3])

                ]);



            $bandera++;


        }


        foreach(Persona::all() as $persona ){
            $valor = $persona->apoderado_id;
            if($valor == null){
                $persona->tipo = 'Apoderado';
                $persona->nivel=null;
                $persona->grado = null;
                $persona->seccion = null;
                $persona->save();
            }
        }
    }

}