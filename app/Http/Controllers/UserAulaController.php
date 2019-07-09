<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Response;

use App\UserAula;
use Redirect;
use Auth;
use DB;

class UserAulaController extends Controller
{
    public function marcarAssistido(Request $r, $aula_id){

        $u = UserAula::where('aula_id', $aula_id)
        ->where('user_id', Auth::user()->id)
        ->first();

        $aula = \App\Aula::with('modulo')->find($aula_id);

        $aulas_curso = DB::table('aulas')
        ->select('curso_id', DB::raw('count(*) as total'))
        ->join('modulos_cursos', 'aulas.modulo_id', '=', 'modulos_cursos.id')
        ->where('modulos_cursos.curso_id', $aula->modulo->curso_id)->first();


        if (isset($u)){
            $u->delete();
            $userCurso = \App\UserCurso::where('user_id', Auth::id())->where('curso_id', $aula->modulo->curso_id)->first();         
            if($userCurso->andamento > 0){
                $userCurso->andamento = (int)$userCurso->andamento - (((int)$aulas_curso->total / 100)*100);
            }             
            $userCurso->save();   
        }else{

            $u = new UserAula();
            $u->fill($r->all());
            $u->data = date('Y-m-d');
            $u->user_id = Auth::user()->id;
            $u->save();    
            $userCurso = \App\UserCurso::where('user_id', Auth::id())->where('curso_id', $aula->modulo->curso_id)->first();  
            if($userCurso->andamento > 0){               
               $userCurso->andamento = (int)$userCurso->andamento + (((int)$aulas_curso->total / 100)*100);    
           } 
           $userCurso->save();   

       }

       return Redirect::back();    
   }
}
