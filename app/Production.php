<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{

    protected $fillable = ['produit_id', 'nombre_cycle', 'quantite', 'nombre_casse', 'date_available', 'date_production', 'revient', 'commentaire'];

    protected $dates = ['date_available', 'date_production'];

    public function produit(){
        return $this->belongsTo(Produit::class);
    }

    public static function calculeRevient($verb , $type = "production"){

        $produit = Produit::find($verb['produit_id']);
        $matieres_besoins = $produit->variations();

        $revient = 0;
        foreach ($matieres_besoins as $matiere){
            $matiere->matiere->reduceStock($matiere->besoin);
            //Calcul du matiere premiere
            $revient += $matiere->valeur * $matiere->matiere->prixCourant();
            
        }
        $revient = ($revient * $verb['nombre_cycle'])/($verb['quantite'] + $verb['nombre_casse'] );
        if($type == "production"){
            $revient += $produit->cout_essence + $produit->cout_salarial + $produit->livraison;

        }

        return  round($revient , 2);
    }

    public static function productionPerProduct( $date = []){

       $req =  self::join("produits", "produits.id", "=", "productions.produit_id")
                    ->join("formules", "formules.id", "=", "produits.formule_id")
                    ->groupBy("formules.id")
                    ->selectRaw("sum(productions.quantite) as quantite , formules.name as label , formules.id");
                    

        if( isset($date["debut"]) && strtotime($date["debut"]) ){
            $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
            $req->where('productions.created_at', '>=', $debut);
        }
            
        if( isset($date["fin"]) && strtotime($date["fin"]) ){
                /*$fin = date("Y-m-d", strtotime($date["fin"]) ).' 23:59:99';
                $req->where('productions.created_at', '<=', $fin);*/
            $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
            $req->where('productions.created_at', '<=', $fin);
        }

        return $req->get();
    }

}
