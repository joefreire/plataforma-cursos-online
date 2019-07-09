<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloCurso extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'curso_id'
    ];

    public static $rules = array(           
        'nome' => 'required'        
    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'        
    );

    public $timestamps = true;
    protected $table = 'modulos_cursos';

    public function curso()
    {
        return $this->HasOne(Curso::class, 'id', 'curso_id');
    }
}
