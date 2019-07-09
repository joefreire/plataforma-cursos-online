<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;


  protected $fillable = [
    'name', 'email', 'password', 'acesso_id', 'telefone', 'observacoes', 'tipo', 'cep', 'numero','complemento','cidade','estado','bairro','endereco',
    'cpf', 'bankNumber','agencyCheckNumber', 'agencyNumber', 'accountNumber','accountCheckNumber'
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];

  public static $rules = array(           
    'name' => 'required',
    'email' => 'required',
    'password' => 'confirmed'
  );

  public static $messages = array(
    'name.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'
  );

  protected $table = 'users';
  public $timestamps = true;

  public function UserCursos()
  {
    return $this->HasMany(UserCurso::class, 'user_id', 'id');
  }

  public function Compras()
  {
    return $this->HasMany(Venda::class, 'cliente_id', 'id');
  }

  public function cursos_andamento()
  {
    return \App\UserCurso::where('user_id', \Auth::user()->id)
    ->where('users_cursos.andamento', '<', '100')
    ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
    ->join('users as u', 'u.id', '=', 'c.instrutor_id')                    
    /*      ->join('vendas as v', 'v.cliente_id', '=', 'users_cursos.user_id')*/
    ->get();      
  } 

  public function cursos_concluidos()
  { 
    return \App\UserCurso::where('user_id', \Auth::user()->id)
    ->where('users_cursos.andamento', '>=', '100')
    ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
    ->join('users as u', 'u.id', '=', 'c.instrutor_id')                    
    ->groupBy('users_cursos.id')                    
    ->get();
  }

}
