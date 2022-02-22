<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{

    protected $fillable = ['name', 'commande_id', 'category_id', 'formule_id', 'quantite', 'pu_vente', 'montant', 'cout_essence', 'cout_salarial', 'cout_livraison', 'description'];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }

    public function formule(){
        return $this->belongsTo(Formule::class);
    }

    public function productions(){
        return $this->hasMany(Production::class)->orderByDesc('created_at');
    }

    public function livraisons(){
        return $this->hasMany(Livraison::class);
    }

    public function variations(){
        return $this->formule()->with('variations')->get()->pluck('variations')->flatten();
    }

    public function cycleTotal(){
        return $this->productions()->sum('nombre_cycle');
    }

    public function casseTotal(){
        return $this->productions()->sum('nombre_casse');
    }

    public function revientMoyen(){

        $revient = 0;

        $productions = $this->productions;

        foreach ($productions as $production){
            $revient += $production->quantite * $production->revient;
        }

        /*if (($this->quantiteProduit() - $this->casseTotal()) == 0){
            return 0;
        }*/

        $revient = $revient / (intval($this->quantiteProduit()) == 0 ? 1 : $this->quantiteProduit() );

        return round($revient, 2);
    }

    public function quantiteProduit(){
        return $this->productions()->sum('quantite');
    }

    public function quantiteLivrer(){
        return $this->livraisons()->sum('quantite');
    }

    public function coutTotalProduction(){
        return $this->quantite * $this->revientMoyen();
    }

    public function quantiteAProduire(){
        return $this->quantite - $this->quantiteProduit();
    }

    public function quantiteDisponible(){
        return $this->productions()->where('date_available', '<=', Carbon::now())->sum('quantite') - $this->quantiteLivrer();
    }

    public function quantiteEnSechage(){
        return $this->productions()->where('date_available', '>', Carbon::now())->sum('quantite');
    }

    public function isProductionComplete(){
        return $this->quantite == $this->quantiteProduit();
    }

    public function estimationParCycle(){

        if ($this->productions()->sum('nombre_cycle') == 0){
            return 0;
        }
        return round($this->productions()->sum('quantite') / $this->productions()->sum('nombre_cycle'),0);
    }

    public function estimationParCycleAvecCasse(){

        if ($this->productions()->sum('nombre_cycle') == 0){
            return 0;
        }
        return round(($this->productions()->sum('quantite') - $this->casseTotal()) / $this->productions()->sum('nombre_cycle'),0);
    }

    public function scopeProduit_list($query , $only_avalaible = false , $date = []){

        $req =  $query->join("productions" , "productions.produit_id", "=", "produits.id")
        ->groupBy('produits.formule_id')
        ->selectRaw('produits.formule_id,  sum(productions.quantite)  as quantite_produit ');

        if($only_avalaible){
            $now = date("Y-m-d");
            $req = $req->where("productions.date_available" , "<=" , $now);
        }

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

    public static function boot() {
        parent::boot();

        static::deleting(function($produit) {
            $produit->productions()->delete();
            $produit->livraisons()->delete();
        });
    }


    public function scopeRevient_list($query , $date = null){
       
     $req = $query->groupBy("produits.id")
             ->join("livraisons", "livraisons.produit_id", "=", "produits.id")
             ->join("formules", "formules.id" , "=" , "produits.formule_id")
             ->selectRaw("produits.id as produit ,
                          sum(livraisons.quantite) as quantite_produit ,
                          formules.name ,
                          formules.id as formule_id ,
                        ( sum(livraisons.quantite) * produits.pu_vente) as chiffre_affaire");
 
    
 
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
