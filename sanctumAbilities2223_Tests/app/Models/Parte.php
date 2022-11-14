<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Parte extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno',
        'gravedad',
        'idprofesor',
        'observaciones'
    ];

     //\App\Models\Parte::with('puestoPor')->get()
     function puestoPor(){
        return $this->belongsTo(User::class,'idprofesor','id');
    }
}
