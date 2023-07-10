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
        Schema::create('materiagestion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_gestion');
            $table->unsignedBigInteger('id_materia');
            
            $table->primary(['id_curso', 'id_gestion', 'id_materia']);
            $table->foreign('id_materia')->references('id')->on('materia');
            
            $table->foreign(['id_curso', 'id_gestion'])
            ->references(['id_curso', 'id_gestion'])
            ->on('cursogestion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiagestion');
    }
};
