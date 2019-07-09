<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
	protected $guarded = [
		'id'
	];

	public $timestamps = true;
	protected $table = 'desconto';
}
