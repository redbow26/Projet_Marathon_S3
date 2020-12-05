<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->unsignedBigInteger('jeu_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('jeu_id')->references('id')->on('jeux')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->dateTime('date_achat')->default((new \DateTime())->format('Y-m-d'));
            $table->string('lieu')->nullable(true);
            $table->decimal('prix', 7, 2, true)->nullable(true);
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achats');
    }
}
