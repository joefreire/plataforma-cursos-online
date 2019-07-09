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

use Auth;
use Redirect;
use App\Material;
use App\Curso;
use App\Aula;


class MaterialController extends Controller
{
    public function index($aula_id){
        $aula = Aula::find($aula_id);
        $materiais = Material::where('aula_id', $aula_id)->get();
        return view('front.instrutor.aulas.materiais')
                ->with('aula', $aula)
                ->with('materiais', $materiais);
    }

    public function criar($aula_id)
    {        
        $aula = Aula::find($aula_id);        
        return view('front.instrutor.aulas.material_edicao')        		                
        		->with('aula', $aula);
    }

    public function insert(Request $r, $aula_id)
    {        
        $arquivoName = '';

        if ($r->file('arquivo') != ''){
            $arquivoName = md5(date('YmdHis')).'.'.$r->file('arquivo')->getClientOriginalExtension();
            $r->file('arquivo')->move(base_path().'/public/uploads/materiais/', $arquivoName);
        }

        $a = new Material();
        $a->fill($r->all());
        $a->nome = $arquivoName;
        $a->aula_id = $aula_id;        
        $a->save();

        Session::flash('message', 'Material cadastrado com sucesso!');
        return Redirect('/Instrutor/Curso/Modulo/Aula/Material/'.$aula_id);        
    }

    public function editar($id)
    {        
        $m = Material::find($id);        
        $aula = Aula::find($m->aula_id);         	
        
    	return view('front.instrutor.aulas.material_edicao')
    			->with('aula', $aula)                
    			->with('material', $m);
    }

    public function update(Request $r, $id)
    {                            
        $a = Material::find($id);
        
        $arquivoName = $a->nome;

        if ($r->file('arquivo') != ''){
            $arquivoName = md5(date('YmdHis')).'.'.$r->file('arquivo')->getClientOriginalExtension();
            $r->file('arquivo')->move(base_path().'/public/uploads/materiais/', $arquivoName);
        }
        
        $a->nome = $arquivoName;
        $a->fill($r->all());
        $a->save();

        Session::flash('message', 'Material atualizado com sucesso!');
        return Redirect('/Instrutor/Curso/Modulo/Aula/Material/'.$a->aula_id);        
    }

    public function destroy(Request $r, $id)
    {
        $a = Material::find($id);        
        $a->delete();
        
        Session::flash('message', 'Material removido com sucesso!');
        return Redirect('/Instrutor/Curso/Modulo/Aula/Material/'.$a->aula_id);
    }
}
