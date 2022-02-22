<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produit_id');
            $table->double('nombre_cycle');
            $table->double('quantite');
            $table->integer('nombre_casse')->default(0);
            $table->timestamp('date_available');
            $table->timestamp('date_production');
            $table->string('commentaire')->nullable();
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
        Schema::dropIfExists('productions');
    }
}
