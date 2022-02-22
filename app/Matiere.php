<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = ['name', 'unite', 'description'];

    public function stocks(){
        return $this->hasMany(MatierePremiere::class);
    }

    public static function findDesignation($designation){
        return self::where('name', $designation)->first();
    }

    public function stockDisponible(){
        return $this->stocks()->sum('quantite_dispo');
    }

    public function prixCourant(){
        return $this->stocks()->where('quantite_dispo', '>', '0')->max('pu');
    }

    public function reduceStock($quantite_to_reduce){

        while ($quantite_to_reduce != 0){

            $matierePremier = MatierePremiere::where('matiere_id', $this->id)->where('quantite_dispo', '>', '0')->first();

            $quantite_dispo = $matierePremier->quantite_dispo;

            if ($quantite_to_reduce > $quantite_dispo){
                $quantite_to_reduce = $quantite_to_reduce - $quantite_dispo;
                $matierePremier->quantite_dispo = $matierePremier->quantite_dispo - $quantite_dispo;
            }else{
                $matierePremier->quantite_dispo = $matierePremier->quantite_dispo - $quantite_to_reduce;
                $quantite_to_reduce = 0;
            }

            $matierePremier->save();

        }

    }

    public function recoverStock($quantite_to_recover){

        $matierePremier = MatierePremiere::where('matiere_id', $this->id)->latest('created_at')->first();

        $matierePremier->quantite_dispo += $quantite_to_recover;

        $matierePremier->save();

    }

    public function isInUSe(){

        $formuleProduit = FormuleProduit::where('matiere_id', $this->id)->get();

        if ($formuleProduit->isEmpty()){
            return false;
        }

        return true;
    }

    public function formuleInUse(){

        $formuleProduits = FormuleProduit::where('matiere_id', $this->id)->get();

        $formules = collect();

        foreach ($formuleProduits as $formuleProduit){
            $formules->push($formuleProduit->formule);
        }

        return $formules;

    }

    public function scopeQuantite_dispo($query){

        return $query->groupBy('matieres.id')
                    ->leftjoin("matiere_premieres" , "matiere_premieres.matiere_id", "=", "matieres.id")
                    ->selectRaw('matieres.name as matiere, matieres.id as matiere_id, sum(matiere_premieres.quantite_dispo)  as quantite_disponible ')
                    ->get();
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($matiere) {
            $matiere->stocks()->delete();
        });
    }
}
