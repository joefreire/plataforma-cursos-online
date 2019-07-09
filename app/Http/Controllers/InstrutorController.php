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

use App\User;
use App\Instrutor;
use App\Curso;
use App\InstrutorLogin;
use Auth;

use DB;

class InstrutorController extends Controller
{
    public function auth()
    {
        if(empty(Auth::user())){
            return view('front.instrutor.auth');
        }else{
            return redirect('/Instrutor/Dashboard');
        }
        return view('front.instrutor.auth');
    }

    public function registrar()
    {
        if(empty(Auth::user())){
            return view('front.instrutor.registro');
        }else{
            return redirect('/Instrutor/Dashboard');
        }
        return view('front.instrutor.registro');
    }

    public function registro(Request $r)
    {
    	$validator = Validator::make(Input::all(), User::$rules, Instrutor::$messages);
    	if ($validator->fails()) {     	        
            return Redirect('/Instrutor/Registrar')->withErrors($validator);
        }else{
            $credentials = Input::only('email', 'password'); 
            Auth::attempt($credentials);

            if(empty(Auth::user())){
                $u = User::create([
                    'name' => $r->name,
                    'email' => $r->email,
                    'password' => bcrypt($r->password),
                    'tipo' => '1'
                ]);
                $titulo = 'Registo Tinele';
                $mensagem = '<p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Bem-vindo &agrave; Tinele!</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ol&aacute;, meu nome &eacute; Alcionildo e eu vou lhe ajudar aqui na Tinele.</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">A primeira coisa que voc&ecirc; precisa saber &eacute; que nossa equipe est&aacute; sempre &agrave; disposi&ccedil;&atilde;o para ajudar voc&ecirc; com qualquer d&uacute;vida ou dificuldade. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Para entrar em contato basta enviar um e-mail para atendimento@tinele.com.</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Agora voc&ecirc; faz parte de uma plataforma de cursos online que conecta alunos aos instrutores ao redor do mundo.</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">N&oacute;s acreditamos que todas as pessoas que possuem conhecimentos e habilidades para ofertar ao mundo podem se conectar com outras que buscam aprendizagem, capacita&ccedil;&atilde;o e aperfei&ccedil;oamento pessoal e profissional. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ent&atilde;o nossa miss&atilde;o &eacute; promover a conex&atilde;o entre essas pessoas num espa&ccedil;o online de cursos e troca experi&ecirc;ncias que poder&atilde;o transformar vidas e realizar prop&oacute;sitos. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Estamos nos esfor&ccedil;ando para sermos a maior plataforma de educa&ccedil;&atilde;o online do mundo at&eacute; 2025.</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Nossos principais valores s&atilde;o Liberdade, Meritocracia e Amor.</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">N&oacute;s oferecemos a voc&ecirc; duas op&ccedil;&otilde;es:</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Converter seus conhecimentos ou habilidades num curso online, com o qual ganhar&aacute; dinheiro e contribuir&aacute; para transformar a vida de outras pessoas; ou adquirir conhecimentos e habilidades para conquistar seu espa&ccedil;o no mundo e realizar seus prop&oacute;sitos. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Para continuar junto conosco em nossa causa, clique no bot&atilde;o abaixo e crie o seu curso:</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt; text-align: center;"><a style="text-decoration: none;" href="https://tinele.com/Instrutor/Curso/Novo"><strong><span style="font-size: 12pt; font-family: Calibri; color: #0563c1; background-color: transparent; font-variant: normal; text-decoration: underline; -webkit-text-decoration-skip: none; text-decoration-skip-ink: none; vertical-align: baseline; white-space: pre-wrap;">CRIAR UM CURSO ONLINE</span></strong></a></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Estamos muito felizes em ter voc&ecirc; aqui. E lembre-se: sempre que precisar, conte com a gente. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Espero que a sua jornada na Tinele seja Lend&aacute;ria. </span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Um abra&ccedil;o!</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Alcionildo Fontinele</span></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt; text-align: center;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">SIGA ESTA CAUSA EDUCACIONAL</span></p>
                <p style="text-align: center;">SIGA ESTA CAUSA EDUCACIONAL</p>
                <p style="text-align: center;"><a href="https://www.facebook.com/tineleead/">Facebook</a> - <a href="https://www.instagram.com/tineleead/">Instagram</a> - <a href="https://www.youtube.com/channel/UC20B0sCjtPpnnEtyPHxL0bQ/featured?view_as=subscriber">Youtube</a></p>
                <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><br /><br /></p>';
                \Mail::to($u->email)->queue(new \App\Mail\EmailGeral($u, $titulo, $mensagem));

                $credentials = Input::only('email', 'password'); 
                Auth::attempt($credentials);

                Session::flash('sucess', 'Registro efetuado com sucesso!');
                return redirect('/Instrutor/Dashboard');
            }else{
                return redirect('/Instrutor/Dashboard');
            }
        }
    }

    public function login(Request $r)
    {
        $credentials = Input::only('email', 'password'); 
        if ( ! Auth::attempt($credentials))
        {
            Session::flash('error', 'Dados de Login Incorretos');
            return redirect('/Instrutor/Login');
        }else{
            Session::flash('message', 'Login efetuado com sucesso!');
            if (Auth::user()->tipo == 1)
               return redirect('/Instrutor/Dashboard');
           else if (Auth::user()->tipo == 2)
            return redirect('/Aluno/Dashboard');
        else if (Auth::user()->tipo == 3)
            return redirect('/Afiliado/Dashboard');
        else
            return redirect('/Instrutor/Login');
    }

}

public function dashboard()
{
   return view('front.instrutor.dashboard');
}

public function perfil()
{
    return view('front.instrutor.perfil');
}

public function atualiza(Request $r)
{
    $validator = Validator::make(Input::all(), Instrutor::$rules, Instrutor::$messages);

    if ($validator->fails()) {     
       $messages = $validator->messages();
       return Redirect('/Instrutor/Perfil')->withErrors($validator);
   }else{

    $u = User::find(Auth::user()->id);
    $u->fill($r->all());
    $u->save();

    Session::flash('sucess', 'Dados atualizados com sucesso!');
    return Redirect('/Instrutor/Perfil');
}
}

public function instrutor_foto(Request $r, $id)
{
    if($r->file != ''){
        $imageName = md5(date('YmdHis')).'.'.$r->file('file')->getClientOriginalExtension();
        $r->file('file')->move(base_path().'/public/uploads/usuarios/', $imageName);

        $u = Instrutor::where('id', $id)->get()->first();
        $u->foto = $imageName;
        $u->save();
    }

    return redirect('/Instrutor/Perfil');
}


public function financeiro_busca(Request $r)
{

    if($r->inicio != null) {
        $d = explode('/', $r->inicio);
        $de = $d[2] . '-' . $d[1] . '-' . $d[0];
    }else{
        $de = '2000-01-01';
    }    
    if($r->ate != null) {
        $d = explode('/', $r->ate);
        $ate = $d[2] . '-' . $d[1] . '-' . $d[0];
    }else{
        $ate = '2099-01-01';
    }

    $q = \App\UserCurso::join('cursos', function ($join) {
        $join->on('cursos.id', '=', 'users_cursos.curso_id');
    })
    ->join('vendas_produtos', function ($join) {
        $join->on('vendas_produtos.produto_id', '=', 'users_cursos.curso_id')
        ->on('vendas_produtos.user_id', '=', 'users_cursos.user_id');
    })
    ->join('vendas', function ($join) {
        $join->on('vendas_produtos.venda_id', '=', 'vendas.id');
    })
    ->whereBetween('users_cursos.data', array($de, $ate))
    ->where('cursos.instrutor_id', Auth::id())
    ->where('vendas.status', '1');

    if($r->curso != null){
        $q->where('curso_id', $r->curso);
    }
    
    if($r->curso == null && $r->inicio == null && $r->ate == null){
        $total = $q->sum('vendas_produtos.valor_unitario');

    }else{
        $q->paginate(10);
        $total = 0.00;
        foreach ($q->get() as $usercurso) {
            $total = $total + (!empty($usercurso->vendido)?number_format($usercurso->vendido->valor_unitario, 2, '.', ''):0.00);
        } 
    }


    return view('front.instrutor.financeiro.financeiro')
    ->with('total', $total)
    ->with('qs',  $q->paginate(10));
}

}
