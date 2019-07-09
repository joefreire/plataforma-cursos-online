<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'name', 
        'dt_nascimento', 
        'cpf', 
        'password', 
        'telefone', 
        'endereco', 
        'cep', 
        'bairro', 
        'estado', 
        'cidade', 
        'numero', 
        'complemento', 
        'observacoes', 
        'tipo'
    ];

    public static $rules = array(           
        'name' => 'required',
        'email' => 'required',
        'password' => 'confirmed'
    );

    public static $messages = array(
        'name.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',
        'password.confirmed' => 'As senhas não coincidem. Por favor, você pode verificar isso?'        
    );

    protected $hidden = [
        'password'
    ];

    protected $table = 'users';
}


