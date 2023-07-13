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
        Schema::create('aula', function (Blueprint $table) {
           
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_gestion');
            $table->unsignedBigInteger('id_materia');

            $table->foreign(['id_curso', 'id_gestion', 'id_materia'])
            ->references(['id_curso', 'id_gestion', 'id_materia'])
            ->on('materiagestion');

            $table->unsignedBigInteger('id_horario');
            $table->foreign('id_horario')->references('id')->on('horario');

            $table->string('aula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aula');
    }
};
