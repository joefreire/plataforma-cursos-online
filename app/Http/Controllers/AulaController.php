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
use App\ModuloCurso;
use App\Curso;
use App\Aula;
use Redirect;

use Vimeo;


class AulaController extends Controller
{

    public function listar($id)
    {
        $a = Aula::where('modulo_id', $id)->orderBy('ordem')->get();

        $modulo = ModuloCurso::with('curso')->find($id);

        return view('front.instrutor.aulas.aulas')
        ->with('aulas', $a)
        ->with('modulo_id', $id)
        ->with('modulo', $modulo);
    }

    public function criar($id)
    {        
        $modulo = ModuloCurso::find($id);
        $curso = Curso::find($modulo->curso_id);

        return view('front.instrutor.aulas.aula_editar')        		
        ->with('modulo', $modulo)
        ->with('curso', $curso)
        ->with('modulo_id', $id);
    }

    public function aula_criar(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), Aula::$rules, Aula::$messages);

        if ($validator->fails()) {                 
            return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Nova-Aula')->withErrors($validator);
        } else {
            $modulo = ModuloCurso::with('curso')->find($id);
            $a = new Aula();
            $a->fill($r->all());
            if ($r->video != ''){                
                $vimeo = Vimeo::request('/videos/'.$r->video,
                    array(
                        'name' => $r->nome,
                        'description' => 'Video aula do modulo '.$modulo->nome.' '.$r->descricao,
                    ),'PATCH'
                );
                $putAlbum = Vimeo::request('/me/albums/'.$modulo->curso->album_vimeo.'/videos/'.$r->video, 
                    array(),'PUT');
                if($putAlbum['status'] == '204'){
                    $a->video = $r->video;
                    $a->modulo_id = $id;
                    $a->save();
                    Session::flash('sucess', 'Aula cadastrada com sucesso!');
                    return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');
                }else{                        
                    Session::flash('error', 'Erro ao enviar video');
                    return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');
                }
            }            
            Session::flash('error', 'Erro ao enviar video');
            return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');

        }
    }

    public function editar($modulo_id, $id)
    {        
        $a = Aula::with('modulo.curso')->find($id);        
        $modulo = ModuloCurso::find($a->modulo_id);
        $curso = Curso::find($modulo->curso_id);    	
        if($a->video != ''){
            $vimeo = Vimeo::request('/videos/'.$a->video,
                array(),'GET'
            );            
            if(!isset($vimeo['body']['transcode']['status'])){
                $vimeo = 'Sem video';
            }else{
                $vimeo = $vimeo['body']['transcode']['status'];
            }
        }
        if(empty($a) || $a->modulo->curso->instrutor_id != Auth::id() ){            
            Session::flash('error', 'Sem permissão para acessar!');
            return Redirect('/Instrutor/Cursos');
        }
        
        return view('front.instrutor.aulas.aula_editar')
        ->with('aula', $a)
        ->with('modulo', $modulo)
        ->with('curso', $curso)
        ->with('vimeo_status', $vimeo)
        ->with('modulo_id', $modulo_id);
    }

    public function aula_editar(Request $r, $id, $aula_id)
    {   
     $rules = array(           
        'nome' => 'required',        
        'ordem' => 'required',
        'video' => 'nullable'
    );

     $messages = array(
        'nome.required' => 'O campo nome precisa ser informado. Por favor, você pode verificar isso?',        
        'ordem.required' => 'O campo ordem precisa ser informado. Por favor, você pode verificar isso?'
    );       
     $validator = Validator::make(Input::all(), $rules, $messages);

     if ($validator->fails()) {                 
        return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Editar-Aula/'.$aula_id)->withErrors($validator);
    } else {
        $a = Aula::find($aula_id);

        $request = $r->all();
        foreach ($request as $key => $value) {
            if($value == null){
                unset($request[$key]);
            }
        }          
        $a->fill($request);
        if ($r->video != ''){
           $modulo = ModuloCurso::with('curso')->find($id);
           $vimeo = Vimeo::request('/videos/'.$r->video,
            array(
                'name' => $r->nome,
                'description' => 'Video aula do modulo '.$modulo->nome.' '.$r->descricao,
            ),'PATCH'
        );
           $putAlbum = Vimeo::request('/me/albums/'.$modulo->curso->album_vimeo.'/videos/'.$r->video, 
            array(),'PUT');
           if($putAlbum['status'] == '204'){
            $a->video = $r->video;
            $a->modulo_id = $id;
            $a->save();
            Session::flash('sucess', 'Aula cadastrada com sucesso!');
            return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');
        }else{                        
            Session::flash('error', 'Erro ao enviar video');
            return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');
        }

    }else{
        $modulo_id = $a->modulo_id;
        $a->modulo_id = $modulo_id;     
        $a->save();

        Session::flash('sucess', 'Dados atualizados com sucesso!');
        return Redirect('/Instrutor/Curso/Modulo/'.$id.'/Aulas');    
    }


}
}

public function deletar(Request $r, $id)
{
    $a = Aula::find($id);
    $modulo_id = $a->modulo_id;
    $a->delete();

    Session::flash('message', 'Módulo removido com sucesso!');
    return redirect('/Instrutor/Curso/Modulo/'.$modulo_id.'/Aulas');
}

public function gratis($id_modulo, $id_aula)
{

    $modulo = ModuloCurso::find($id_modulo);
    $aula = Aula::find($id_aula);

    if($aula->gratis == null){
        $aula->gratis = 1;
    }else{
        $aula->gratis = null;
    }

    $aula->save();

    return Redirect::back();

}

}
