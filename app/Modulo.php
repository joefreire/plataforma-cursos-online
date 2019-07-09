<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = [
        'nome', 
    ];    

    public $timestamps = true;
    protected $table = 'modulos';
}
