<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    
        protected $fillable = [
            'para', 'evento', 'link', 'tipo', 'visualizado'
        ];
    
        public static $messages = array(
            'name.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?'
        );
        
        public $timestamps = true;
        protected $table = 'notificacoes';
}
