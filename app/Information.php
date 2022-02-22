<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    //
    protected $fillable = ["adresse", "telephone", "email", "nif", "stat", "rcs"];
}
