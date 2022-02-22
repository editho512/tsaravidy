<?php

namespace App;

use App\Produit;
use App\FormuleProduit;
use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{

    protected $fillable = ['name', 'quantite', 'description' , 'cout_essence', 'cout_salarial', 'cout_livraison'];

    public function variations(){
        return $this->hasMany(FormuleProduit::class);
    }

    public function produits(){
        return $this->hasMany(Produit::class);
    }

    public static function findDesignation($designation){
        return self::where('name', $designation)->first();
    }

    public function isInUse(){
        if ($this->produits->isEmpty()){
            return false;
        }

        return true;
    }

    
    public function scopeCommande_list($query, $date = []){

         $req = $query->leftjoin("produits" ,function($q) use ($date)
                    {
                        $q->on('produits.formule_id', '=', 'formules.id');
                        if( isset($date["debut"]) && strtotime($date["debut"]) ){
                            $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
                            $q->where('produits.created_at', '>=', $debut);
                        }
                
                        if( isset($date["fin"]) && strtotime($date["fin"]) ){
                            /*$fin = date("Y-m-d", strtotime($date["fin"]) ).' 23:59:99';
                            $req->where('productions.created_at', '<=', $fin);*/
                            $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
                            $q->where('produits.created_at', '<=', $fin);
                        } 
                    })
                ->groupBy('formules.id')
                ->selectRaw('formules.id, formules.name , sum(produits.quantite)  as quantite_commande ');
                
                

        return $req->get();
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($formule) {
            $formule->variations()->delete();
        });
    }
}
