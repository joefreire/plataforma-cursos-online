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

use App\Questao;
use App\Curso;
use App\Alternativa;
use Redirect;
use DB;
use Auth;

class ProvaController extends Controller
{
    public function index_prova($id){

        $curso = Curso::find($id);
        if($curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Prova');
        }
        $questoes = Questao::where('curso_id', $id)->get();

        return view('front.instrutor.provas.questoes')
        ->with('questoes', $questoes)
        ->with('curso', $curso);
    }

    public function criar_questao($curso_id){        
        return view('front.instrutor.provas.questao_edicao')
        ->with('curso_id', $curso_id);
    }

    public function insert_questao(Request $r, $curso_id)
    {                
        $validator = Validator::make(Input::all(), Questao::$rules, Questao::$messages);
        if ($validator->fails()) {     	        
            return Redirect('/Instrutor/Prova/Novo/'.$curso_id)->withErrors($validator);
        }else{
            $a = new Questao();
            $a->fill($r->all());            
            $a->save();
            
            Session::flash('message', 'Questão adicionada com sucesso!');
            return redirect('/Instrutor/Prova/' .$curso_id );
        }
    }

    public function edit_questao($id)
    {
        $q = Questao::with('curso')->find($id);
        if($q->curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Prova');
        }

        return view('front.instrutor.provas.questao_edicao')
        ->with('questao', $q)
        ->with('curso_id', $q->curso_id);
    }   

    public function update_questao(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), Questao::$rules, Questao::$messages);

        if ($validator->fails()) {     
            return Redirect('/Instrutor/Questao/Editar/'.$id)->withErrors($validator);
        } else {

            $q = Questao::with('curso')->find($id);
            if($q->curso->instrutor_id != Auth::id()){            
                Session::flash('error', 'Sem Permissão!');
                return Redirect('/Instrutor/Prova');
            }
            $q->fill($r->all());
            $q->save();

            Session::flash('message', 'Dados atualizados com sucesso!');
            return Redirect('/Instrutor/Prova/'.$q->curso_id);
        }
    }

    public function deletar_questao(Request $r, $id)
    {
        $q = Questao::with('curso')->find($id);
        if($q->curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Prova');
        }      

        DB::raw('delete from alternativas where questao_id = '.$q->id);

        $q->delete();
        
        Session::flash('message', 'Questão removida com sucesso!');
        return redirect('/Instrutor/Prova/'.$q->curso_id);
    }

    public function index_alternativas($questao_id){

        $q = Questao::with('curso')->find($questao_id);
        if($q->curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Prova');
        }

        $lista = Alternativa::where('questao_id', $questao_id)->get();
        $size = count($lista);

        for ($i = 0; $i < 5 - $size; $i++) {
            $a = new Alternativa();
            $a->id = 0;
            $a->questa_id = $questao_id;
            $a->descricao = "";
            $a->resposta = 0;
            $lista->push($a);
        }

        return view('front.instrutor.provas.alternativas')
        ->with('alternativas', $lista)
        ->with('questao', $q);
    }

    public function update_alternativas(Request $r, $questao_id){
        $q = Questao::with('curso')->find($questao_id);
        if($q->curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Prova/'.$q->curso->id);
        }
        $qtd = count($r->descricao);

        DB::table('alternativas')->where('questao_id', $questao_id)->delete();

        for ($i = 0; $i < $qtd; $i++){

            if($i == ($r->correto - 1) ){
                $val_r = $r->correto;
            }else{
                $val_r = 0;
            }

            if (isset($r->descricao[$i]) && $r->descricao[$i] != '') {
                $a = new Alternativa();
                $a->descricao = $r->descricao[$i];
                $a->resposta = $val_r;
                $a->questao_id = $questao_id;
                $a->save();
            }            
        }
        Session::flash('message', 'Alternativas cadastradas com sucesso!');        
         return Redirect('/Instrutor/Prova/'.$q->curso->id);
    }
}
