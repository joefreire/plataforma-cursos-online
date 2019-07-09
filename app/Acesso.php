<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $fillable = [
        'nome', 'regras'
    ];

    public static $rules = array(           
        'nome' => 'required'        
    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'
    );

    public $timestamps = true;
    protected $table = 'acessos';
}
