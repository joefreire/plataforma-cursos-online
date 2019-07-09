<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrutorLogin extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'acesso_id', 'telefone', 'endereco', 'observacoes'
    ];

    public static $rules = array(           
        'email' => 'required',
        'password' => 'required'
    );

    public static $messages = array(
        'email.required' => 'O campo email precisa ser informado. Por favor, você pode verificar isso?',
        'password.required' => 'O campo senha precisa ser informado. Por favor, você pode verificar isso?'
    );

    protected $table = 'users';
    public $timestamps = true;
}