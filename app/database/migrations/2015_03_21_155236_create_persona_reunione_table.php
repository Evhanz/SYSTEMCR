<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaReunioneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona_reunione', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('persona_id')->unsigned()->index();
			$table->foreign('persona_id')->references('id')->on('personas');
			$table->integer('reunione_id')->unsigned()->index();
			$table->foreign('reunione_id')->references('id')->on('reuniones')->onDelete('cascade');
            $table->boolean('estado');
            $table->time('hora');
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
		Schema::drop('persona_reunione');
	}

}
