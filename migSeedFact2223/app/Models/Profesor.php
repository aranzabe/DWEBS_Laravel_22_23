<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parte;

class Profesor extends Model
{
    use HasFactory;

    protected $table="profesores";

    //\App\Models\Profesor::with('partesPuestos')->get()
    function partesPuestos(){
        return $this->hasMany(Parte::class,'id','idprofesor');
    }
}
