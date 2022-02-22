<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatierePremieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matiere_premieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('matiere_id');
            $table->string('numero_bl')->nullable();
            $table->string('fournisseur')->nullable();
            $table->double('quantite');
            $table->double('quantite_dispo');
            $table->double('pu');
            $table->double('montant');
            $table->double('frais_livraison')->default(0);
            $table->string('mode_paiement')->default("comptant");
            $table->double('montant_credit')->default(0);
            $table->timestamp('date_credit')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('numero_facture')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('matiere_premieres');
    }
}
