<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'de', 'para', 'texto', 'visualizado', 'data', 'rand_log'
    ];

    public static $rules = array(           
        'de' => 'required',
        'para' => 'required',
        'texto' => 'required',      
        'data' => 'required'
    );

    public $timestamps = true;
    protected $table = 'mensagens';
}
