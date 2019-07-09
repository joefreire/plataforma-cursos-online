<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'video', 'ordem', 'modulo_id',
    ];

     public static $rules = array(           
        'nome' => 'required',        
        'ordem' => 'required',
        'video' => 'required',
    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',        
        'ordem.required' => 'O campo ordem precisa ser informado. Por favor, você pode verificar isso?',
    );

    public function modulo()
    {
        return $this->HasOne(ModuloCurso::class, 'id', 'modulo_id');
    }

    public $timestamps = true;
    protected $table = 'aulas';
}
