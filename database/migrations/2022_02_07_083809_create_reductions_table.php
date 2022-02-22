<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produit_id');
            $table->unsignedBigInteger('type_reduction_id');
            $table->boolean('is_percent')->default(1);
            $table->double("valeur");
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
        Schema::dropIfExists('reductions');
    }
}
