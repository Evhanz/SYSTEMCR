<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultasTable extends Migration {


	public function up()
	{
        Schema::create('multas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('persona_id');
            $table->string('reunion_id');
            $table->enum('estado',['pagado','deuda']);
            $table->string('multa')->nullable();
            $table->string('n_comprobante')->nullable();
            $table->timestamps();
        });
	}


	public function down()
	{
        Schema::drop('multas');
	}

}
