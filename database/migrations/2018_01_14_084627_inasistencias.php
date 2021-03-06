<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inasistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inasistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_alumno');
            $table->date('fecha');
            $table->integer('estatus')->comment('1=Justificada, 2=No justificada');
            $table->integer('tipojustificacion')->comment('0=No procede,1=Personal,2=Familiar,3=enfermedad');
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
        Schema::dropIfExists('inasistencias');
    }
}
