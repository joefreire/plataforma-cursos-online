<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'imagem', 'instrutor_id', 'categoria_id', 'duracao', 'valor', 'nivel', 'aprovado', 'comissao','video','definicao_prova','subtitulo','album_vimeo'
    ];

    public static $rules = array(           
        'nome' => 'required' ,
        'imagem' => 'nullable|image|max:50000' ,

    );

    public static $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',        
    );
    
    protected $table = 'cursos';
    public $timestamps = true;


    public function setComissaoAttribute($value)
    {
        $this->attributes['comissao'] = ($value=='' ? '0.00' : is_int($value)?number_format($value, 2):myFloatValue($value));
    }
    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = ($value=='' ? '0.00' : is_int($value)?number_format($value, 2):myFloatValue($value));
    }
    public function getValorAttribute($value) {
        return (!empty($value) ? str_replace(".",",",$value) : '0,00');
    }
    public function getComissaoAttribute($value) {
        return (!empty($value) ? str_replace(".",",",$value) : '0,00');
    }
    public function categoria()
    {
        return $this->HasOne(Categoria::class, 'id', 'categoria_id');
    }
    public function instrutor()
    {
        return $this->HasOne(User::class, 'id', 'instrutor_id');
    }
}
