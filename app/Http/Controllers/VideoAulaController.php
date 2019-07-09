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

use App\Curso;
use App\UserCurso;
use App\ModuloCurso;
use App\Aula;
use App\UserAula;
use App\Questao;
use App\Anotacao;
use App\Material;
use DB;
use Auth;
use Vimeo;

class VideoAulaController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            if(!$this->user){       
                \Session::flash('error', 'Você precisa estar logado para executar essa ação');
                return Redirect('/Logar');
            }
            return $next($request);
        });


    }
    public function index($curso_id){
        if(Auth::user()->tipo != 0){
            $x = UserCurso::where('user_id', Auth::user()->id)
            ->where('curso_id', $curso_id)                
            ->first();
        }else{
            $x = '';
        }
        
        if (isset($x)) {

            $curso = Curso::with('instrutor')->find($curso_id);
            $questoes = Questao::where('curso_id', $curso_id)->get();
            $modulos = ModuloCurso::where('curso_id', $curso_id)->get();  

            if($curso->video != ''){
                $vimeo = Vimeo::request('/videos/'.$curso->video,
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
            $m = ModuloCurso::where('curso_id', $curso_id)->orderBy('id')->first();


            return view('front.aluno.videoaulas.detalhes_curso')
            ->with('curso', $curso)
            ->with('modulos', $modulos)
            ->with('x', $x)                                  
            ->with('questoes', $questoes)
            ->with('vimeo_status', $vimeo);
        }
    }

    public function assistir($curso_id, $aula_id){
        if(Auth::user()->tipo != 0){
            $x = UserCurso::where('user_id', Auth::user()->id)
            ->where('curso_id', $curso_id)                
            ->first();
        }else{
            $x = '';
        }

        if (isset($x)) {


            $curso = Curso::find($curso_id);
            $questoes = Questao::where('curso_id', $curso_id)->get();
            $modulos = ModuloCurso::where('curso_id', $curso_id)->get();



            $aula = Aula::where('aulas.id', $aula_id)
            ->join('modulos_cursos as m', 'm.id', '=', 'aulas.modulo_id')
            ->select('aulas.nome as aula_nome', 'aulas.descricao as aula_descricao', 'aulas.video as aula_video',
               'aulas.id as aula_id', 'm.nome as modulo_nome', 'aulas.modulo_id as modulo_id', 'aulas.ordem as ordem')
            ->first();

            if($aula->aula_video != ''){
                $vimeo = Vimeo::request('/videos/'.$aula->aula_video,
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
            
            $proxima_aula = Aula::where('modulo_id', $aula->modulo_id)->where('ordem', '>', $aula->ordem)->first();
            $aula_anterior = Aula::where('modulo_id', $aula->modulo_id)->where('ordem', '<', $aula->ordem)->orderBy('ordem','desc')->first();

            $assistido = UserAula::where('aula_id', $aula_id)
            ->where('user_id', Auth::user()->id)
            ->first();

            $anotacao = Anotacao::where('aula_id', $aula_id)
            ->where('user_id', Auth::user()->id)
            ->first();

            //return response()->json($assistido);

            return view('front.aluno.videoaulas.assistir')
            ->with('curso', $curso)
            ->with('modulos', $modulos)
            ->with('aula', $aula)
            ->with('assistido', $assistido)
            ->with('x', $x)
            ->with('anotacao', $anotacao)
            ->with('aula_id', $aula_id)
            ->with('proxima_aula', $proxima_aula)
            ->with('aula_anterior', $aula_anterior)
            ->with('questoes', $questoes)
            ->with('vimeo_status', $vimeo);
        }
    }

    public function index_prova($curso_id){
        $x = UserCurso::where('user_id', Auth::user()->id)
        ->where('curso_id', $curso_id)                
        ->first();

        if (isset($x)) {
            $curso = Curso::find($curso_id);
            $questoes = Questao::where('curso_id', $curso_id)->get();
            $modulos = ModuloCurso::where('curso_id', $curso_id)->get();

            return view('front.aluno.videoaulas.introducao')
            ->with('curso', $curso)
            ->with('modulos', $modulos)                    
            ->with('questoes', $questoes)
            ->with('x', $x)
            ->with('aula', new Aula());
        }
    }
    
    public function iniciar_prova($curso_id){
        $x = UserCurso::where('user_id', Auth::user()->id)
        ->where('curso_id', $curso_id)                
        ->first();

        if (isset($x)) {
            $curso = Curso::find($curso_id);
            $questoes = Questao::where('curso_id', $curso_id)->get();
            $modulos = ModuloCurso::where('curso_id', $curso_id)->get();

            return view('front.aluno.videoaulas.prova')
            ->with('curso', $curso)
            ->with('modulos', $modulos)                    
            ->with('questoes', $questoes)
            ->with('x', $x)
            ->with('aula', new Aula());
        }
    }

    public function finalizar_prova(Request $r, $curso_id){                                

        $x = UserCurso::where('user_id', Auth::user()->id)
        ->where('curso_id', $curso_id)                
        ->first();

        if (isset($x)) {  

            $curso = Curso::find($curso_id);
            $questoes = Questao::where('curso_id', $curso_id)->get();
            $modulos = ModuloCurso::where('curso_id', $curso_id)->get();            
            $questoes = Questao::where('curso_id', $curso_id)->get();            
            
            $qtd = count($questoes);
            $acertos = 0;
            for ($i = 0; $i < $qtd; $i++){            
                $op = $r->query('radio_'.($i+1));

                $alternativas = DB::table('alternativas')->where('questao_id', $questoes[$i]->id)->get();
                if (isset($op) && $alternativas[($op-1)]->resposta > 0){
                    $acertos++;
                }
            }

            $pontuacao = 0;
            $pontuacao = ($acertos * 100) / $qtd;     

            $x->nota = $pontuacao;
            $x->andamento = '100';
            $x->data_nota = date('Y-m-d');
            $x->save();       

            return view('front.aluno.videoaulas.resultado_prova')
            ->with('pontuacao', $pontuacao)
            ->with('curso', $curso)
            ->with('modulos', $modulos)                    
            ->with('questoes', $questoes)
            ->with('x', $x)
            ->with('aula', new Aula());
        }                      
    } 

    public function insert_anotacao(Request $r, $aula_id){

        $a = Anotacao::where('aula_id', $aula_id)
        ->where('user_id', Auth::user()->id)
        ->first();
        $aula = Aula::with('modulo')->find($aula_id);
        $UserCurso = UserCurso::where('user_id', Auth::id())->where('curso_id', $aula->modulo->curso_id)->first();

        if(Auth::user()->tipo != '0' && empty($UserCurso)){
            Session::flash('error', 'Sem Permissão');
            return Redirect('/Logar');
        }

        if (isset($a)) {
            $a->fill($r->all());
        }else{            
            $a = new Anotacao();
            $a->fill($r->all());
            $a->user_id = Auth::user()->id;
            $a->aula_id = $aula_id;
        }
        
        $a->save();                
    }  

    public function baixar($aula_id){

        $aula = Aula::with('modulo')->find($aula_id);
        $materiais = Material::where('aula_id', $aula_id)->get();       
        $UserCurso = UserCurso::where('user_id', Auth::id())->where('curso_id', $aula->modulo->curso_id)->first();

        if(Auth::user()->tipo != '0' && empty($UserCurso)){
            Session::flash('error', 'Sem Permissão');
            return Redirect('/Logar');
        }
        
        return view('zip')->with('materiais', $materiais)
        ->with('aula', $aula);
    }

    public function proxima_videoaula($aula_id){

    }

}
