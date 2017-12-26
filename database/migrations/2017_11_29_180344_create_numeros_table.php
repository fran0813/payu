<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numeros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero', 45);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->enum('pago', array('Verdadero', 'Falso',))->default('Falso');
            $table->integer('loteria_id')->unsigned();
            $table->foreign('loteria_id')->references('id')->on('loterias');
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
        Schema::dropIfExists('numeros');
    }
}
