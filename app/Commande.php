<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{

    protected $fillable = ['user', 'numero_bc', 'date_livraison', 'date_paiement', 'description'];

    protected $dates = ['date_livraison', 'date_paiement'];

    public function produits(){
        return $this->hasMany(Produit::class);
    }

    public function isCommandeComplete(){

        $isComplete = true;

        $produits = $this->produits;

        if($produits->isEmpty()){
            return false;
        }

        foreach ($produits as $produit) {
            if ($produit->isProductionComplete() == false){
                $isComplete = false;
            }
        }

        return $isComplete;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($commande) {
            $produits = $commande->produits;
            foreach ($produits as $produit){
                $produit->productions()->delete();
                $produit->livraisons()->delete();
            }
            $commande->produits()->delete();
        });
    }

    public static function first_month(){
        $res = self::first();
        return $res->created_at;
    }

}
