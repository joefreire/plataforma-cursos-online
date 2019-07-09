<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'acesso_id', 'telefone', 'endereco', 'observacoes', 'tipo'
    ];

    public static $rules = array(           
        'name' => 'required',
        'password' => 'confirmed | min:5'
    );

    public static $messages = array(
        'name.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',
        'password.confirmed' => 'As senhas não coincidem. Por favor, você pode verificar isso?',
        'password.min' => 'As senhas devem conter no mínimo 6 caracteres. Por favor, você pode verificar isso?',
    );

    protected $hidden = [
        'password'
    ];

    protected $table = 'users';
    public $timestamps = true;
}
