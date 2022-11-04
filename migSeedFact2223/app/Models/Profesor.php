<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table="profesores";

    function partesPuestos(){
        return $this->hasMany(Parte::class,'idprofesor','id');
    }
}
