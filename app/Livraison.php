<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{

    protected $fillable = ['produit_id', 'numero_bl', 'quantite', 'date_livraison', 'commentaire', 'pu_vente', 'information_id'];

    protected $dates = ['date_livraison'];

    public function produit(){
        return $this->belongsTo(Produit::class);
    }

    public function scopeLivraison_list($query, $date = []){
        
        $req = $query->join("produits" , "produits.id", "=", "livraisons.produit_id")
                    ->groupBy('produits.formule_id')
                    ->selectRaw('produits.formule_id , sum(livraisons.quantite)  as quantite_livraison ');
                    

            if( isset($date["debut"]) && strtotime($date["debut"]) ){
                $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
                $req->where('produits.created_at', '>=', $debut);
            }
            
            if( isset($date["fin"]) && strtotime($date["fin"]) ){
                /*$fin = date("Y-m-d", strtotime($date["fin"]) ).' 23:59:99';
                $req->where('productions.created_at', '<=', $fin);*/
                $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
                $req->where('produits.created_at', '<=', $fin);
            }

        return $req->get();
   }

   public static function livraisonPerProduct($date = []){

        $req =  self::join("produits", "produits.id", "=", "livraisons.produit_id")
                 ->join("formules", "formules.id", "=", "produits.formule_id")
                 ->groupBy("formules.id")
                 ->selectRaw("sum(livraisons.quantite) as quantite , formules.name as label , formules.id");
                 

        if( isset($date["debut"]) && strtotime($date["debut"]) ){
            $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
            $req->where('livraisons.created_at', '>=', $debut);
        }
        
        if( isset($date["fin"]) && strtotime($date["fin"]) ){
            /*$fin = date("Y-m-d", strtotime($date["fin"]) ).' 23:59:99';
            $req->where('productions.created_at', '<=', $fin);*/
            $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
            $req->where('livraisons.created_at', '<=', $fin);
        }

        return $req->get();
    }
}
