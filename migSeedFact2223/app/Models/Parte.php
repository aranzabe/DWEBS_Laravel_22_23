<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    use HasFactory;

    function puestoPor(){
        return $this->belongsTo(Profesor::class,'id','idprofesor');
    }
}
