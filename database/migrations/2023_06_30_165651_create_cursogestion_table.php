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
        Schema::create('cursogestion', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_gestion');
            $table->primary(['id_curso', 'id_gestion']);
            $table->foreign('id_curso')->references('id')->on('curso');
            $table->foreign('id_gestion')->references('id')->on('gestion');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursogestion');
    }
};
