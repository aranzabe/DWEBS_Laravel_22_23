<?php
namespace App\Models;

class Persona {
    public $n;
    public $c;

    function __construct($nom,$cur){
        $this->n = $nom;
        $this->c = $cur;
    }
}
