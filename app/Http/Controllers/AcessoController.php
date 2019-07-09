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

use App\Acesso;
use App\Modulo;

class AcessoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $lista = Acesso::orderBy('nome')->get();
        return view('admin.acessos.acessos')
                    ->with('acessos', $lista);
    }

    public function create(){
        $modulos = Modulo::orderBy('nome')->get();
        return view('admin.acessos.acesso_edicao')
                    ->with('modulos', $modulos);
    }

    public function insert(Request $r)
    {                
        $validator = Validator::make(Input::all(), Acesso::$rules, Acesso::$messages);
    	if ($validator->fails()) {     
	        $messages = $validator->messages();
            return Redirect('/acesso/adicionar')->withErrors($validator);
        }else{
            $a = new Acesso();
            $a->fill($r->all());
            $a->regras = implode(",", $a->regras);
            $a->save();
            
            Session::flash('message', 'Acesso adicionado com sucesso!');
            return redirect('acessos');
        }
    }

    public function edit($id)
    {
        $a = Acesso::find($id);
        $modulos = Modulo::orderBy('nome')->get();
        return view('admin.acessos.acesso_edicao')
                    ->with('acesso', $a)
                    ->with('modulos', $modulos);
    }

    public function update(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), Acesso::$rules, Acesso::$messages);
    	if ($validator->fails()) {     
	        $messages = $validator->messages();
            return Redirect('/acesso/adicionar')->withErrors($validator);
        }else{
            $a = Acesso::find($id);
            $a->fill($r->all());
            $a->regras = implode(",", $a->regras);
            $a->save();
            
            Session::flash('message', 'Acesso editado com sucesso!');
            return redirect('acessos');
        }
    }

    public function destroy(Request $r, $id)
    {
        $a = Acesso::find($id);        
        $a->delete();
        
        Session::flash('message', 'Acesso removido com sucesso!');
        return redirect('acessos');
    }    

    // public function enviar_acesso($id)
    // {
    //     echo getenv('SITE_TITLE');
    // }
}
