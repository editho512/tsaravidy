<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormuleProduit extends Model
{

    protected $fillable = ['formule_id', 'matiere_id', 'valeur'];

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    public function formule(){

        return $this->belongsTo(Formule::class);
    }

    public function scopeValeur_formule($query){
        
        return $query->join('formules', 'formules.id', "=" , "formule_produits.formule_id")
                    ->selectRaw('formules.name, formules.id, formules.quantite,  formule_produits.matiere_id, formule_produits.valeur')
                    ->get();
    }
    

    public static function findMatiere($formule_id, $matiere_id){
        return FormuleProduit::where('formule_id', $formule_id)->where('matiere_id',$matiere_id)->first();
    }

}
