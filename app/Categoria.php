<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome', 'categoria_id'
    ];

    public static $rules = array(           
        'nome' => 'required'        
    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'
    );
  
    public $timestamps = true;
  
    protected $table = 'categorias';
  
}
