<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{        
        use \Awobaz\Compoships\Compoships;
        public function produto(){
          return $this->belongsTo('App\Curso', 'produto_id', 'id');
        }
        public function venda(){
          return $this->belongsTo('App\Venda', 'venda_id', 'id');
        }
  
        protected $guarded = [
            'id'
        ];

        public static $rules = array(                       
            'produto_id' => 'required',
            'vendedor_id' => 'required',
            'quantidade' => 'required',
            'valor_unitario' => 'required'        
        );
  
        public static $messages = array(            
            'produto_id.required' => 'O campo produto precisa ser informado. Por favor, você pode verificar isso?',
            'vendedor_id.required' => 'O campo vendedor precisa ser informado. Por favor, você pode verificar isso?',
            'quantidade.required' => 'O campo quantidade precisa ser informado. Por favor, você pode verificar isso?',
            'valor_unitario.required' => 'O campo valor unitário precisa ser informado. Por favor, você pode verificar isso?'
        );
        
        public $timestamps = true;
        protected $table = 'vendas_produtos';
}
