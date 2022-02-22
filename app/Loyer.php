<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loyer extends Model
{
    protected $fillable = ['montant', 'date_debut', 'date_fin'];


    public static function monthRent($date ){
        
        $req = self::where("date_debut", ">=", date("Y-m-d", strtotime($date)))->get();
        $_req = $req;
        if(isset($req[0]) === false || date("m", strtotime($req[0]->date_debut)) != date("m", strtotime($date)) ){
            
            $req = self::where("date_debut", "<=", date("Y-m-d", strtotime($date)))->orderBy("id", "desc")->get();
        }

        if(isset($req[0]) === false){
            $req = $_req;
        }
        return $req[0]->montant ?? 0;
    }
}
