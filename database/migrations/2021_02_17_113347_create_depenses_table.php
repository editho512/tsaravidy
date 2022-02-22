<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('unite')->nullable();
            $table->string('numero_bl')->nullable();
            $table->string('type')->nullable();
            $table->string('fournisseur')->nullable();
            $table->double('quantite')->nullable();
            $table->double('pu')->nullable();
            $table->double('montant')->nullable();
            $table->double('frais_livraison')->nullable();
            $table->string('mode_paiement')->default("comptant");
            $table->double('montant_credit')->default(0);
            $table->timestamp('date_credit')->nullable();
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
        Schema::dropIfExists('depenses');
    }
}
