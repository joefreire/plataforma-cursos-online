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
use App\Curso;
use App\ModuloCurso;

class ModuloCursoController extends Controller
{
    public function listar($id)
    {
        $m = ModuloCurso::where('curso_id', $id)->get();
        $curso = Curso::find($id);
        return view('front.instrutor.modulos.modulos')
        ->with('modulos', $m)
        ->with('cursoId', $id)
        ->with('curso', $curso);
    }

    public function criar($id)
    {        
        $c = Curso::find($id);

        return view('front.instrutor.modulos.modulo_editar')        		
        ->with('curso', $c);
    }

    public function modulo_criar(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), ModuloCurso::$rules, ModuloCurso::$messages);

        if ($validator->fails()) {                 
            return Redirect('/Instrutor/Curso/Modulo/Novo/'.$id)->withErrors($validator);
        } else {

            $m = new ModuloCurso();
            $m->fill($r->all());
            $m->curso_id = $id;
            $m->save();

            Session::flash('message', 'Módulo cadastrado com sucesso!');
            return Redirect('/Instrutor/Curso/Modulo/'.$id);
        }
    }

    public function editar($id)
    {
        $m = ModuloCurso::find($id);
        $c = Curso::find($m->curso_id);
        if($c->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Cursos');
        }

        return view('front.instrutor.modulos.modulo_editar')
        ->with('curso', $c)
        ->with('modulo', $m);
    }

    public function modulo_editar(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), ModuloCurso::$rules, ModuloCurso::$messages);

        if ($validator->fails()) {     
            return Redirect('/Instrutor/Curso/Modulo/Editar/'.$id)->withErrors($validator);
        } else {

            $m = ModuloCurso::with('curso')->find($id);

            if($m->curso->instrutor_id != Auth::id()){            
                Session::flash('error', 'Sem Permissão!');
                return Redirect('/Instrutor/Cursos');
            }
            $m->fill($r->all());
            $m->save();

            Session::flash('message', 'Dados atualizados com sucesso!');
            return Redirect('/Instrutor/Curso/Modulo/'.$m->curso_id);
        }
    }

    public function deletar(Request $r, $id)
    {
        $a = ModuloCurso::with('curso')->find($id);
        $curso_id = $a->curso_id;


        if($a->curso->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Cursos');
        }

        $a->delete();
        
        Session::flash('message', 'Módulo removido com sucesso!');
        return redirect('/Instrutor/Curso/Modulo/'.$curso_id);
    }

    
}
