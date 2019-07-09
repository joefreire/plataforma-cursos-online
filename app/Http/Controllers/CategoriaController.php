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
use App\Categoria;
use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $lista = Categoria::where('categoria_id', null)->orderBy('nome')->get();
        return view('admin.categorias.categorias')
                    ->with('categorias', $lista);
    }

    public function create(){
        $categorias = Categoria::where('categoria_id', null)->orderBy('nome')->get();
        return view('admin.categorias.categoria_edicao')
                    ->with('categorias', $categorias);
    }

    public function insert(Request $r)
    {                
        $validator = Validator::make(Input::all(), Categoria::$rules, Categoria::$messages);
    	if ($validator->fails()) {     
	        $messages = $validator->messages();
            return Redirect('/categoria/adicionar')->withErrors($validator);
        }else{
            $a = new Categoria();
            $a->fill($r->all());            
            $a->save();
            
            Session::flash('message', 'Categoria adicionada com sucesso!');
            return redirect('categorias');
        }
    }

    public function edit($id)
    {
        $a = Categoria::find($id);
        $categorias = Categoria::where('categoria_id', null)->orderBy('nome')->get();
        return view('admin.categorias.categoria_edicao')
                    ->with('categoria', $a)
                    ->with('categorias', $categorias);
    }

    public function update(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), Categoria::$rules, Categoria::$messages);
    	if ($validator->fails()) {     
	        $messages = $validator->messages();
            return Redirect('/categoria/adicionar')->withErrors($validator);
        }else{
            $a = Categoria::find($id);
            $a->fill($r->all());            
            $a->save();
            
            Session::flash('message', 'Categoria editada com sucesso!');
            return redirect('categorias');
        }
    }

    public function destroy(Request $r, $id)
    {
        //Categoria::where('categoria_id', $id)->delete();
        //$a = Categoria::find($id);
        //$a->delete();
      
        EXCLUIR_CATEGORIA($id);
        
        Session::flash('message', 'Categoria removida com sucesso!');
        return redirect('categorias');
    } 
    
}
