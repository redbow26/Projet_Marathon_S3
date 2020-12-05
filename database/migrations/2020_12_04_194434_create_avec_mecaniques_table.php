<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvecMecaniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avec_mecaniques', function (Blueprint $table) {
            $table->unsignedBigInteger('mecanique_id');
            $table->unsignedBigInteger('jeu_id');
            $table->foreign('jeu_id')->references('id')->on('jeux')
                ->onDelete('cascade');
            $table->foreign('mecanique_id')->references('id')->on('mecaniques')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avec_mecaniques');
    }
}
