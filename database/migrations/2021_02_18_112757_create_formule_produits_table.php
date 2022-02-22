<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormuleProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formule_produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('formule_id');
            $table->unsignedBigInteger('matiere_id');
            $table->double('valeur');
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
        Schema::dropIfExists('formule_produits');
    }
}
