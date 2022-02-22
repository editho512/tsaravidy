<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
