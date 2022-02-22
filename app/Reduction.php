<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reduction extends Model
{
    //
    protected $fillable = ['produit_id', 'type_reduction_id', 'is_percent', 'valeur'];

}
