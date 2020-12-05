<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeuxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeux', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('description');
            $table->text('regles')->nullable(true);
            $table->string('langue')->default('Fr');
            $table->string('url_media')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->integer('nombre_joueurs')->nullable(true);
            $table->string('categorie')->nullable(true);
            $table->string('duree')->nullable(true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('theme_id');
            $table->unsignedBigInteger('editeur_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')
                ->onDelete('cascade');
            $table->foreign('editeur_id')->references('id')->on('editeurs')
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
        Schema::dropIfExists('jeux');
    }
}
