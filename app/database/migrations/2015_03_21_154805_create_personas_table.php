<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('direccion');
            $table->string('correo');
            $table->string('telefono');
            $table->string('celular')->nullable();
            $table->string('foto')->nullable();
            $table->enum('tipo',['Alumno','Apoderado']);
            $table->enum('nivel',['Primaria','Secundaria'])->nullable();
            $table->enum('grado',['1','2','3','4','5','6'])->nullable();
            $table->enum('seccion',['A','B','C'])->nullable();
            $table->boolean('estado');
            //relaciones
            $table->integer('apoderado_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('apoderado_id')->references('id')->on('personas');
            $table->integer('fotocheck_id')->unsigned()->index()->nullable()->default(NULL);
            $table->foreign('fotocheck_id')->references('id')->on('fotochecks');


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
		Schema::drop('personas');
	}

}
