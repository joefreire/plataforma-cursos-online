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
use App\UserCurso;
use Auth;
use Redirect;
use DB;

class FrontController extends Controller
{
    public function home()
    {
        $destaques = Curso::join('users as u', 'u.id', '=', 'cursos.instrutor_id')
                    ->join('categorias as c', 'c.id', '=', 'cursos.categoria_id')
                    ->select('cursos.nome as curso_nome',
                             'cursos.descricao as curso_descricao',
                             'cursos.duracao as curso_duracao',
                             'cursos.valor as curso_valor',
                             'cursos.imagem as curso_imagem',
                             'c.nome as categoria_nome',
                             'cursos.nivel as curso_nivel',
                             'cursos.id as curso_id',
                             'u.foto as instrutor_foto',
                             'u.name as instrutor_nome')->where('cursos.aprovado', '1')
                    ->inRandomOrder()->limit(4)->get();

        $procurados = Curso::join('users as u', 'u.id', '=', 'cursos.instrutor_id')
                    ->join('categorias as c', 'c.id', '=', 'cursos.categoria_id')
                    ->select('cursos.nome as curso_nome',
                             'cursos.descricao as curso_descricao',
                             'cursos.duracao as curso_duracao',
                             'cursos.valor as curso_valor',
                             'cursos.imagem as curso_imagem',
                             'c.nome as categoria_nome',
                             'cursos.nivel as curso_nivel',
                             'cursos.id as curso_id',
                             'u.foto as instrutor_foto',
                             'u.name as instrutor_nome')->where('cursos.aprovado', '1')
                    ->inRandomOrder()->limit(4)->get();
        return view('front.home')
            ->with('destaques', $destaques)
            ->with('procurados', $procurados);
    }

    public function newsletter(Request $r)
    {
        DB::table('email_marketing')->insert(['email' => $r->email, 'data' => date('Y-m-d'), 'aula_id'=>$r->aula_assistir_gratis]);
        Session::put('acesso_gratis', '1');
        Session::flash('message', 'Obrigado por se cadastrar em nossa Newsletter. Você já pode assistir as aulas grátis!');
        return Redirect::back();
    }

    public function destroy_newsletter(Request $r, $id){
        DB::table('email_marketing')->where('id', $id)->delete();
        Session::flash('message', 'Categoria removida com sucesso!');
        return Redirect::back();
    }

    public function index_verificar_certificado(){
        return view('front.verificar_certificado');
    }

    public function sobre(){
        return view('front.sobre');
    }

    public function verificar_certificado(Request $r){


        $certificado = UserCurso::whereRAW('SUBSTRING( md5(users_cursos.id), 1,12) = "'.$r->numero.'"')
                ->join('users as u', 'u.id', '=', 'users_cursos.user_id')
                ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
                ->select('c.nome as curso_nome', 'u.name as aluno_nome', 'users_cursos.data_nota as data', 'users_cursos.updated_at as updated_at')
                ->first();

        if(empty($certificado)){
            $certificado = "Sem Registros";
        }

        return view('front.verificar_certificado')->with('certificado', $certificado);
    }

}