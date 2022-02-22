<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatierePremiere extends Model
{

    protected $fillable = ['matiere_id', 'numero_bl', 'fournisseur', 'quantite', 'quantite_dispo', 'pu', 'montant', 'frais_livraison',
        'mode_paiement', 'montant_credit', 'date_credit', 'commentaire', 'numero_facture'];

    protected $dates = ['date_credit'];

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    
    

}
