<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReunionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reuniones', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('descripcion',255);
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('multa',4,2);
            $table->enum('estado',['habil','cierre']);
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
		Schema::drop('reuniones');
	}

}
