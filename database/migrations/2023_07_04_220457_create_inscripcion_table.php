<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inscripcion');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_gestion');
            $table->unsignedBigInteger('id_alumno');

            $table->foreign(['id_curso', 'id_gestion'])
            ->references(['id_curso', 'id_gestion'])
            ->on('cursogestion');
            $table->foreign('id_alumno')->references('id')->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcion');
    }
};
