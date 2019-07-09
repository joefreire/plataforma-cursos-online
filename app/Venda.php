<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{        
	protected $fillable = [
		'cliente_id', 'afiliado', 'status', 'total', 'cupom_desconto', 'meio_pagamento', 'transacao', 'id_transacao'
	];
	public $with = ['Desconto','Itens'];
	public $timestamps = true;
	protected $table = 'vendas';

	public function Itens()
	{
		return $this->HasMany(VendaProduto::class, 'venda_id', 'id');
	}

    public function Desconto(){
        return $this->HasOne(Desconto::class, 'id', 'cupom_desconto');
    }

	public function getCreatedAtAttribute($value)
	{
		return (!empty($value) ? \Carbon\Carbon::parse($value)->format('d/m/Y') : null);
	}

}
