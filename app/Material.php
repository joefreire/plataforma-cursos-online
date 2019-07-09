<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nome', 'aula_id', 'descricao'
    ];

    public static $rules = array(           
        'user_id' => 'required',
        'nome' => 'required'        
    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',
        'aula_id.required' => 'O campo aula_id precisa ser informado. Por favor, você pode verificar isso?'
    );

    public $timestamps = true;
    protected $table = 'materiais';
}
