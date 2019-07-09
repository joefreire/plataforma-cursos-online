<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    protected $fillable = [
        'user_id', 'aula_id', 'texto'
    ];

    public static $rules = array(           
        'user_id' => 'required',
        'aula_id' => 'required'        
    );

    public static $messages = array(
        'user_id.required' => 'O campo user_id precisa ser informado. Por favor, você pode verificar isso?',
        'aula_id.required' => 'O campo aula_id precisa ser informado. Por favor, você pode verificar isso?'
    );

    public $timestamps = true;
    protected $table = 'anotacoes';
}
