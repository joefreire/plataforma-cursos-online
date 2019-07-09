<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comissao extends Model
{
       protected $fillable = [
        'user_id', 'valor', 'data', 'rand_log'
    ];

    public static $rules = array(           
        'user_id' => 'required',
        'valor' => 'required',
        'data' => 'required',
        'rand_log' => 'required'
    );

    public static $messages = array(
        'user_id.required' => 'O campo user_id precisa ser informado. Por favor, você pode verificar isso?',
        'valor.required' => 'O campo valor precisa ser informado. Por favor, você pode verificar isso?',
        'data.required' => 'O campo data precisa ser informado. Por favor, você pode verificar isso?',
        'rand_log.required' => 'O campo rand_log precisa ser informado. Por favor, você pode verificar isso?'
    );

    public $timestamps = true;
    protected $table = 'comissoes';
}
