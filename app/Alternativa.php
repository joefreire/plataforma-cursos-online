<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    protected $fillable = [
        'questao_id', 'descricao', 'resposta'
    ];
    
    public static $rules = array(           
        'questao_id' => 'required',
        'descricao' => 'required',
        'resposta' => 'required'
    );    

    public $timestamps = true;
    protected $table = 'alternativas';
    public function questao(){
        return $this->HasOne(Questao::class, 'id', 'questao_id');
    }
}
