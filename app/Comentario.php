<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'aluno_id', 'data', 'comentario', 'rating', 'curso_id'
    ];
    
    public $timestamps = true;
    protected $table = 'comentarios';
}
