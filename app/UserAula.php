<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAula extends Model
{
    protected $fillable = [
        'user_id', 'aula_id', 'data'
    ];
    
    public static $rules = array(           
        'user_id' => 'required',
        'aula_id' => 'required',
        'data' => 'required'
    );    

    public $timestamps = true;
    protected $table = 'users_aulas';

    public function aulas(){
        return $this->HasMany(Aula::class, 'id', 'aula_id');
    }
    public function user(){
        return $this->HasOne(User::class, 'id', 'user_id');
    }
}
