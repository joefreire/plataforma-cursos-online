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


use App\Instrutor;
use App\Curso;
use App\Categoria;
use App\ModuloCurso;
use App\Aula;
use Auth;
use Redirect;
use DB;
use Vimeo;
use SEO;
use SEOMeta;
use App\VendaProduto;

class CursoController extends Controller
{
    public function listar()
    {

        $c = Curso::with('categoria')->where('instrutor_id', Auth::id())->get();
        return view('front.instrutor.cursos.cursos')->with('cursos', $c);
    }

    public function criar()
    {        
        $categorias = Categoria::where('categoria_id', null)->orderBy('nome')->get();
        return view('front.instrutor.cursos.curso_editar')
        ->with('categorias', $categorias);
    }

    public function curso_criar(Request $r)
    {
        $validator = Validator::make(Input::all(), Curso::$rules, Curso::$messages);

        if ($validator->fails()) {     
            $messages = $validator->messages();
            return Redirect('/Instrutor/Curso/Novo')->withErrors($validator);
        } else {

            $c = new Curso();
            $c->fill($r->all());
            $c->instrutor_id = Auth::user()->id;
            $vimeo = Vimeo::request('/me/albums', 
                array(
                    'name' => $r->nome.' --'.Auth::id(),
                    'description' => 'Album do curso '.$r->nome.' --user '.Auth::user()->email,
                ),'POST');

            if($vimeo['status'] == '201'){
                $c->album_vimeo = basename($vimeo['body']['link']);

                if($r->file != ''){
                    $imageName = md5(date('YmdHis')).'.'.$r->file('file')->getClientOriginalExtension();
                    $r->file('file')->move(base_path().'/public/uploads/cursos/', $imageName);
                    $c->imagem = $imageName;
                }
                if($r->video != ''){

                    $videoCapa = Vimeo::request('/videos/'.$r->video,
                        array(
                            'name' => $r->nome,
                            'description' => 'Video capa '.$r->nome.' '.$r->descricao,
                        ),'PATCH'
                    );
                    $putAlbum = Vimeo::request('/me/albums/'.$c->album_vimeo.'/videos/'.$c->video, 
                        array(),'PUT');

                    if($putAlbum['status'] == '204'){
                        $c->save();
                        Session::flash('sucess', 'Curso cadastrado com sucesso!');
                        return Redirect('/Instrutor/Cursos');
                    }else{
                        $vimeo = Vimeo::request('/me/albums/'.$c->id_vimeo, array(), 'DELETE');
                        Session::flash('error', 'Erro ao enviar video');
                        return Redirect('/Instrutor/Cursos');
                    }

                }
            }else{
                Session::flash('error', $vimeo['body']['error']);
                return Redirect('/Instrutor/Cursos');
            }       
            $c->save();     
            Session::flash('sucess', 'Curso cadastrado com sucesso!');
            return Redirect('/Instrutor/Cursos');
        }
    }

    public function editar($id)
    {
        $categorias = Categoria::where('categoria_id', null)->orderBy('nome')->get();
        $c = Curso::find($id);
        if($c->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Cursos');
        }
        if($c->video != ''){
            $vimeo = Vimeo::request('/videos/'.$c->video,
                array(),'GET'
            );

            if(!isset($vimeo['body']['transcode']['status'])){
                $vimeo = 'Sem video';
            }else{
                $vimeo = $vimeo['body']['transcode']['status'];
            }
        }else{
            $vimeo = 'Sem video';
        }

        if(empty($c) || $c->instrutor_id != Auth::id() ){            
            Session::flash('error', 'Sem permissão para acessar!');
            return Redirect('/Instrutor/Cursos');
        }
        return view('front.instrutor.cursos.curso_editar')
        ->with('categorias', $categorias)
        ->with('curso', $c)
        ->with('vimeo_status', $vimeo);
    }

    public function curso_editar(Request $r, $id)
    {
        $validator = Validator::make(Input::all(), Curso::$rules, Curso::$messages);
        if ($validator->fails()) {     
            $messages = $validator->messages();
            return Redirect('/Instrutor/Curso/Editar')->withErrors($validator);
        } else {
            $c = Curso::find($id);  
            $request = $r->all();
            foreach ($request as $key => $value) {
                if($value == null){
                    unset($request[$key]);
                }
            }          
            $c->fill($request);
            if($r->file != ''){
                $imageName = md5(date('YmdHis')).'.'.$r->file('file')->getClientOriginalExtension();
                $r->file('file')->move(base_path().'/public/uploads/cursos/', $imageName);
                $c->imagem = $imageName;
            }
            if($r->video != ''){

                $videoCapa = Vimeo::request('/videos/'.$r->video,
                    array(
                        'name' => $r->nome,
                        'description' => 'Video capa '.$r->nome.' '.$r->descricao,
                    ),'PATCH'
                );
                $putAlbum = Vimeo::request('/me/albums/'.$c->album_vimeo.'/videos/'.$c->video, 
                    array(),'PUT');

                if($putAlbum['status'] == '204'){
                    $c->save();
                    Session::flash('sucess', 'Curso editado com sucesso!');
                    return Redirect('/Instrutor/Cursos');
                }else{
                    $vimeo = Vimeo::request('/me/albums/'.$c->id_vimeo, array(), 'DELETE');
                    Session::flash('error', 'Erro ao enviar video');
                    return Redirect('/Instrutor/Cursos');
                }
            }

            $c->save();
            Session::flash('sucess', 'Dados atualizados com sucesso!');
            return Redirect('/Instrutor/Cursos');
        }
    }

    public function destroy(Request $r, $id)
    {
        $a = Curso::find($id); 
        if($a->instrutor_id != Auth::id()){            
            Session::flash('error', 'Sem Permissão!');
            return Redirect('/Instrutor/Cursos');
        }       
        $a->delete();

        Session::flash('message', 'Curso removido com sucesso!');
        return redirect('/Instrutor/Cursos');
    }

    public function cursos(){  
        $categorias = Categoria::all();
        $cursos = Curso::with('categoria','instrutor')->where('cursos.aprovado', '1')
        ->orderBy('cursos.created_at')->paginate(5);

        return view('front.aluno.cursos.cursos')                
        ->with('cursos', $cursos)
        ->with('categorias', $categorias);
    }

    public function link_compartilhado($idcrypt){
      $ids_decode = base64_decode($idcrypt);
      $ids = explode('-', $ids_decode);
      var_dump($ids_decode);
      Session::put('afiliado_id', $ids[1]);
      return redirect('/Curso/Detalhes/'.$ids[0]);
  }

  public function curso_detalhes($id){

    if (Session::has('afiliado_id')){
        echo Session::get('afiliado_id');
    }

    $curso = Curso::with('categoria')->where('cursos.id', $id)
    ->join('users as u', 'u.id', '=', 'cursos.instrutor_id')
    ->select('u.*', 'cursos.*', 'cursos.id as curso_id')
    ->first();

    SEO::setTitle($curso->nome);
    SEO::setDescription($curso->descricao);
    SEOMeta::setDescription($curso->descricao);
    SEOMeta::addMeta('article:published_time', $curso->created_at->toW3CString(), 'property');
    if($curso->update_at != null){
        SEOMeta::addMeta('article:modified_time', $curso->update_at->toW3CString(), 'property');
    }
    SEOMeta::addMeta('article:tag', $curso->categoria->nome, 'property');
    SEOMeta::addMeta('article:section', 'curso', 'property');
    SEOMeta::setKeywords(SEOMeta::getKeywords());
    SEOMeta::addKeyword([$curso->categoria->nome, $curso->name]);

    if(Auth::user()){
        $curso_user = DB::table('users_cursos')->where('user_id', Auth::user()->id)->where('curso_id', $id)->get();
        if(count($curso_user) == 0){
            $ok = 0;
        }else{
            $ok = 1;
        }
    }else{
        $ok = 0;
    }

    $comentarios = DB::table('comentarios')->where('curso_id', $id)->orderBy('data','desc')->paginate(5);

    $modulos = ModuloCurso::where('curso_id', $id)->get();

        //return $curso;
    return view('front.aluno.cursos.curso_detalhes')
    ->with('curso', $curso)
    ->with('modulos', $modulos)
    ->with('comentarios', $comentarios)
    ->with('id', $id)
    ->with('ok', $ok);
}

public function categoria($id)
{

    $categorias = Categoria::all();
    $categoria = DB::table('categorias')->where('id', $id)->first()->nome;
    $cursos = Curso::with('categoria','instrutor')->where('cursos.aprovado', '1')->where('categoria_id',$id)
    ->orderBy('cursos.created_at')->paginate(5);
    SEO::setTitle('Tinele - Cursos '.$categoria);
    SEO::setDescription('Cursos de '.$categoria);
    SEOMeta::setDescription('Tinele - Cursos '.$categoria);
    SEOMeta::addMeta('article:section', $categoria, 'property');
    SEOMeta::setKeywords(SEOMeta::getKeywords());
    SEOMeta::addKeyword([$categoria]);
    SEOMeta::addKeyword($cursos->pluck('nome')->implode(','));

    return view('front.aluno.cursos.cursos')                
    ->with('cursos', $cursos)
    ->with('categoria', $categoria)
    ->with('categorias', $categorias);
}

public function busca(Request $r)
{
    $categorias = Categoria::all();
    $categoria = $r->q;
    $busca = '1';
    $cursos = Curso::with('categoria','instrutor')
    ->whereRAW('(cursos.nome LIKE "%'.$r->q.'%" OR cursos.descricao LIKE "%'.$r->q.'%")')->where('cursos.aprovado', '1')
    ->orderBy('cursos.created_at')->get();

    return view('front.aluno.cursos.cursos')                
    ->with('cursos', $cursos)
    ->with('categoria', $categoria)
    ->with('busca', $busca)
    ->with('categorias', $categorias);
}

public function curso_rating(Request $r, $id)
{

    DB::table('comentarios')->insert(['aluno_id' => Auth::user()->id, 'data' => date('Y-m-d'), 'comentario' => $r->mensgem, 'rating' => $r->rating, 'curso_id' => $id]);

    $all = DB::table('comentarios')->where('curso_id', $id)->get();

    $total = 0;
    $ins = count($all);

    foreach($all as $A){
        $total = $total + $A->rating;
    }

    $res = $total / $ins;

    DB::table('cursos')->where('id', $id)->update(['stars' => $res]);

    Session::flash('message', 'Comentário efetuado com sucesso!');
    return Redirect('/Curso/Detalhes/'.$id);
}

public function index()
{
    $cursos = Curso::with('instrutor')->get();
    return view('admin.cursos.cursos')->with('cursos', $cursos);
}

public function habiitar($id)
{
    $curso = Curso::find($id);

    if($curso->aprovado == null){
        $curso->aprovado = '1';
    }else{
        $curso->aprovado = null;
    }

    $curso->save();

    return Redirect::back();

}

public function curso_pagar($id){
    $curso = Curso::find($id);
    $aluno = Auth::user();


    $cart = VendaProduto::where('rand_log', Session::get('RAND_LOG'))->get();
    return view('front.pagamento',compact('curso','aluno','cart'));
}

}
