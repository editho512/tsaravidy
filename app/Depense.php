<?php

namespace App;

use App\Salarie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = ['name', 'unite', 'numero_bl', 'type', 'fournisseur', 'quantite', 'pu', 'montant', 'frais_livraison', 'mode_paiement', 'montant_credit', 'date_credit', 'commentaire'];
    protected $dates = ['date_credit'];
    /**
     * Get all of the comments for the Depense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salaries()
    {
        return $this->hasMany(Salarie::class);
    }

    public function scopeDashboard_list($query , $date = null){
       

        $req = $query->groupBy('type')
        ->selectRaw('type , sum(montant) as montant_total');

        if( isset($date["debut"]) && strtotime($date["debut"]) ){
            $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
            $req->where('created_at', '>=', $debut);
        }
        if( isset($date["fin"]) && strtotime($date["fin"]) ){
            $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
            $req->where('created_at', '<=', $fin);
        }
         return $req->get();

        
    }
    
    public function scopeDashboard_total($query , $date = null){

        $req = $query->selectRaw('sum(montant) as montant_total');

        if( isset($date["debut"]) && strtotime($date["debut"]) ){
            $debut = date("Y-m-d", strtotime($date["debut"]) ).' 00:00:00';
            $req->where('created_at', '>=', $debut);
        }
        if( isset($date["fin"]) && strtotime($date["fin"]) ){
            $fin = date("Y-m-d", strtotime($date["fin"]) ).' 00:00:00';
            $req->where('created_at', '<=', $fin);
        }
         return $req->first();

        
    }
    public function scopePeriodique_list($query , $debut = 0){

        $sql = "select MONTH(created_at) as mois, YEAR(created_at) as annee, SUM(montant) as montant_total 
                from depenses GROUP BY MONTH(created_at) , YEAR(created_at) 
                ORDER BY     YEAR(created_at) DESC , MONTH(created_at)  
                DESC LIMIT ".$debut." , 6 ";
                
        return DB::select(DB::raw($sql) );
          
    }

}

