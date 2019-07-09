<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    protected $fillable = [
        'curso_id', 'enunciado', 'ordem'
    ];
    
    public static $rules = array(           
        'curso_id' => 'required',
        'enunciado' => 'required'        
    );    

    public static $messages = array(
        'curso_id.required' => 'O campo curso_id precisa ser informado. Por favor, você pode verificar isso?',        
        'enunciado.required' => 'O campo enunciado precisa ser informado. Por favor, você pode verificar isso?'
    );

    public function curso()
    {
        return $this->HasOne(Curso::class, 'id', 'curso_id');
    }
    public $timestamps = true;
    protected $table = 'questoes';
}
