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
use App\User;
use App\Aluno;
use App\Curso;
use App\Categoria;
use App\Mensagem;
use App\UserCurso;
use DB;

class AlunoController extends Controller
{
    public function create(){
        Session::reflash();
        if(empty(Auth::user())){
            return view('front.aluno.cadastrar');
        }else{
            return redirect('/Aluno/Dashboard');
        }
    }

    public function registro(Request $r){
        $validator = Validator::make(Input::all(), Aluno::$rules, Aluno::$messages);
        if ($validator->fails()) {     	        
            return Redirect('/Aluno/Adicionar')->withErrors($validator);
        }else{
            $credentials = Input::only('email', 'password'); 
            Auth::attempt($credentials);

            if(empty(Auth::user())){
                $u = User::create([
                    'name' => $r->name,
                    'email' => $r->email,
                    'password' => bcrypt($r->password),
                    'tipo' => '2'
                ]);
                $credentials = Input::only('email', 'password'); 
                Auth::attempt($credentials);
                $titulo = 'Registo Tinele';
                $mensagem = '<p>Bem-vindo &agrave; Tinele!</p>
                <p>Ol&aacute;, meu nome &eacute; Alcionildo e eu vou lhe ajudar aqui na Tinele.</p>
                <p>A primeira coisa que voc&ecirc; precisa saber &eacute; que nossa Equipe est&aacute; sempre &agrave; disposi&ccedil;&atilde;o para ajudar voc&ecirc; com qualquer d&uacute;vida ou dificuldade.</p>
                <p>Para entrar em contato basta voc&ecirc; enviar um e-mail para atendimento@tinele.com Agora voc&ecirc; faz parte de uma plataforma de cursos online, que conecta alunos aos melhores instrutores ao redor do mundo.</p>
                <p>N&oacute;s acreditamos que todas as pessoas que possuem conhecimentos e habilidades para ofertar ao mundo podem se conectar com outras que buscam empoderamento atrav&eacute;s da aprendizagem, da capacita&ccedil;&atilde;o e do aperfei&ccedil;oamento pessoal e profissional.</p>
                <p>Ent&atilde;o nossa miss&atilde;o &eacute; promover a conex&atilde;o entre essas pessoas num espa&ccedil;o online de cursos e troca experi&ecirc;ncias que poder&atilde;o transformar vidas e realizar prop&oacute;sitos.</p>
                <p>Estamos nos esfor&ccedil;ando para sermos a maior plataforma de educa&ccedil;&atilde;o online do mundo at&eacute; 2025. Nossos principais valores s&atilde;o Liberdade, Meritocracia e Amor.</p>
                <p>N&oacute;s oferecemos a voc&ecirc; duas op&ccedil;&otilde;es:</p>
                <p>Converter seus conhecimentos ou habilidades num curso online, com o qual ganhar&aacute; dinheiro e contribuir&aacute; para transformar a vida de outras pessoas; ou adquirir conhecimentos e habilidades para conquistar seu espa&ccedil;o no mundo e realizar seus prop&oacute;sitos.</p>
                <p>Para continuar conosco e se juntar em nossa causa, clique no bot&atilde;o abaixo e escolha seu curso:</p>
                <p style="text-align: center;"><a href="https://tinele.com/Cursos">ESCOLHER UM CURSO PARA ESTUDAR</a></p>
                <p>Estamos muito felizes em ter voc&ecirc; aqui. E lembre-se: sempre que precisar, conte com a gente.</p>
                <p>Esperamos que a sua jornada na Tinele seja Lend&aacute;ria.</p>
                <p>Um abra&ccedil;o!</p>
                <p>Alcionildo Fontinele</p>
                <p style="text-align: center;">SIGA ESTA CAUSA EDUCACIONAL</p>
                <p style="text-align: center;"><a href="https://www.facebook.com/tineleead/">Facebook</a> - <a href="https://www.instagram.com/tineleead/">Instagram</a> - <a href="https://www.youtube.com/channel/UC20B0sCjtPpnnEtyPHxL0bQ/featured?view_as=subscriber">Youtube</a></p>';
                \Mail::to($u->email)->queue(new \App\Mail\EmailGeral($u, $titulo, $mensagem));

                if(\Session::has('redirect')){
                    return redirect(Session::get('redirect'));
                }else{
                    Session::flash('sucess', 'Registro efetuado com sucesso!');
                    return redirect('/Aluno/Dashboard');
                }
            }else{
                return redirect('/Aluno/Dashboard');
            }

        }
    }

    public function redirect_login()
    {
        Session::reflash();
        if(empty(Auth::user())){
            return view('front.aluno.login');
        }else{
            return redirect('/Aluno/Dashboard');
        }
        return view('front.aluno.login');
    }

    public function login(Request $r)
    {
        $credentials = Input::only('email', 'password'); 
        if ( ! Auth::attempt($credentials))
        {
            Session::reflash();
            Session::flash('error', 'Dados de Login Incorretos');
            return redirect('/Aluno/Logar');
        }else{
            if(Session::has('redirect')){
                return redirect(Session::get('redirect'));
            }else{
                Session::flash('message', 'Login efetuado com sucesso!');
                return redirect('/Aluno/Dashboard');
            }

        }    	
    }

    public function dashboard()
    {
        $cursos_andamento = UserCurso::where('user_id', Auth::user()->id)
        // ->where('users_cursos.andamento', '<', 100)
        ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
        ->join('users as u', 'u.id', '=', 'c.instrutor_id')                    
        /*->join('vendas as v', 'v.cliente_id', '=', 'users_cursos.user_id')*/
        ->get();

        $cursos_concluidos = UserCurso::where('user_id', Auth::user()->id)
        ->where('users_cursos.andamento','>=', 100)
        ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
        ->join('users as u', 'u.id', '=', 'c.instrutor_id')                    
        ->get();

        //return response()->json($cursos_andamento);

        return view('front.aluno.dashboard')
        ->with('cursos_andamento', $cursos_andamento)
        ->with('cursos_concluidos', $cursos_concluidos);
    }

    public function edit(){
        return view('front.aluno.perfil');
    }
    public function pedidos(){
        $pedidos = \App\Venda::with('Itens.produto')->where('cliente_id',Auth::id())->get();

        return view('front.aluno.pedidos')
        ->with('pedidos', $pedidos);
    }

    public function update(Request $r)
    {
        $rules = array(           
            'name' => 'required',
            'password' => 'confirmed'
        );
        $validator = Validator::make(Input::all(), $rules, Aluno::$messages);

        if ($validator->fails()) {     	        
            return Redirect('/Aluno/Editar')->withErrors($validator);
        }else{

            $u = Aluno::find(Auth::user()->id);
            $pwd = $u->password;
            $u->fill($r->all());

            if ($r->file('foto') != ''){
                $imageName = md5(date('YmdHis')).'.'.$r->file('foto')->getClientOriginalExtension();
                $r->file('foto')->move(base_path().'/public/uploads/usuarios/', $imageName);
                $u->foto = $imageName;
            }

            if ($r->file('capa') != ''){
                $imageName = md5(date('YmdHis')).'.'.$r->file('capa')->getClientOriginalExtension();
                $r->file('capa')->move(base_path().'/public/uploads/usuarios/', $imageName);
                $u->capa = $imageName;
            }

            if (isset($r->password) && strlen($r->password) >= 6) {
                $u->password = bcrypt($r->password);
            }else{
                $u->password = $pwd;
            }

            $u->save();

            Session::flash('message', 'Dados atualizados com sucesso!');
            return Redirect('/Aluno/Editar');
        }
    }

    public function mensagem(){

        $contatos = UserCurso::where('user_id', Auth::user()->id)
        ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
        ->join('users as u', 'u.id', '=', 'c.instrutor_id')
        ->select('u.*')
        ->groupBy('users_cursos.user_id')
        ->get();

        return view('front.aluno.mensagem')
        ->with('contatos',$contatos);
    }  

    public function mensagens($id){

        $contatos = UserCurso::where('user_id', Auth::user()->id)
        ->join('cursos as c', 'c.id', '=', 'users_cursos.curso_id')
        ->join('users as u', 'u.id', '=', 'c.instrutor_id')
        ->select('u.*')
        ->groupBy('users_cursos.user_id')
        ->get();

        if (isset($id)){            

            $msgs = DB::table('mensagens')
            ->where('de', Auth::user()->id)
            ->where('para', $id)
            ->orWhere('de', $id)
            ->where('para', Auth::user()->id)
            ->join('users as u', 'u.id', '=', 'mensagens.de')
            ->join('users as us', 'us.id', '=', 'mensagens.para')  
            ->select('u.name as de_nome','u.foto as de_foto', 'us.name as para_nome, us.foto as para_foto',
             'mensagens.texto as texto', 'mensagens.data as data')
            ->get();

            //return response()->json($msgs);
            return view('front.aluno.mensagem')
            ->with('msgs', $msgs)
            ->with('contatos',$contatos)
            ->with('user_id', $id);    
        }

        return view('front.aluno.mensagem')
        ->with('contatos',$contatos);
    }    

    public function enviarMensagem(Request $r){

        $m = new Mensagem();
        $m->fill($r->all());    
        $m->data = date('Y-m-d H:i:s');
        $m->de = Auth::user()->id;
        $m->visualizado = 0;

        $x = Mensagem::where('de', Auth::user()->id)
        ->where('para', $m->para)
        ->orWhere('de', $m->para)
        ->where('para', Auth::user()->id)
        ->first();

        if (isset($x) && ($x->rand_log != null || $x->rand_log != '')){
            $m->rand_log = $x->rand_log;
        }else{
            $m->rand_log = date('Ymdhis').md5('Ymdhis');
        }

        $m->save();

        return Redirect('/Aluno/Mensagem/'.$r->para);

        // $m->de = Auth::user()->id;
        // $m->para = 
    }

    public function certificados(){


     // $cursos_user = DB::table('users_cursos')->where('user_id', Auth::user()->id);
     // $aulas_curso = DB::table('aulas')
     // ->select('curso_id', DB::raw('count(*) as total'))
     // ->join('modulos_cursos', 'aulas.modulo_id', '=', 'modulos_cursos.id')
     // ->whereIn('modulos_cursos.curso_id', $cursos_user->pluck('curso_id'))
     // ->groupBy('curso_id')->get()->toArray();

     // $userAula = DB::table('users_aulas')  
     // ->select('m.curso_id', DB::raw('count(*) as total'))      
     // ->join('aulas as a', 'a.id', '=', 'users_aulas.aula_id')
     // ->join('modulos_cursos as m', 'm.id', '=', 'a.modulo_id')
     // ->where('user_id', Auth::user()->id)
     // ->groupBy('m.curso_id')->get()->toArray();

    //  foreach ($aulas_curso as $key => $completo) {
    //      foreach ($userAula as $key => $feito) {
    //         if($feito->curso_id == $completo->curso_id && $feito->total == $completo->total){
    //             $cursos_feitos[]=$feito->curso_id;
    //         }
    //     }
    // }


        if(isset($cursos_feitos)){
            $certs = $cursos_user->where('nota', '!=', null)     
            ->orWhereIn('curso_id', $cursos_feitos)
            ->groupBy('curso_id')
            ->get();
        }else{
            $certs = DB::table('users_cursos')->where('user_id', Auth::user()->id)->where('nota', '!=', null)->Where('andamento','>=','100')->get();
        }

    // dd(Auth::id(), $certs);


        return view('front.aluno.cursos.certificados')->with('certs', $certs);

    }


    public function gerar_certificado($id)
    {
        $cert = DB::table('users_cursos')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(empty($cert)){
            return view('front.aluno.dashboard')->with('error', 'Esse certificado não existe ou não pertence a esse usuario');
        }
        $aluno = DB::table('users')->where('id', Auth::user()->id)->first();
        $curso = DB::table('cursos')->where('id', $cert->curso_id)->first();
        $professor = DB::table('users')->where('id', $curso->instrutor_id)->first();

        $imagem = imagecreatefromjpeg( "certificado.jpg" );
        $cor = imagecolorallocate( $imagem, 0, 0, 0 );   

        $validacao = substr(md5($id), 0, 12);
        $font = public_path('/fonts/Roboto.ttf');


        $width = imagesx($imagem);
        $height = imagesy($imagem);
        $centerX = $width / 2;
        $centerY = $height / 2;

        list($left, $bottom, $right, , , $top) = imageftbbox('100', '0', $font, $aluno->name);
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;
        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;
        //imagestring( $imagem, 15, 15, 515, $aluno->name, $cor );
        /*
        tem q alterar o certificado
        if($aluno->cpf != ''){
            imagettftext($imagem, 100, 0, $x, ($y - 130), $cor, $font, $aluno->name.', CPF '.$aluno->cpf);
        }else{            
            imagettftext($imagem, 100, 0, $x, ($y - 130), $cor, $font, $aluno->name);
        }*/
        imagettftext($imagem, 100, 0, $x, ($y - 130), $cor, $font, $aluno->name);


        list($left, $bottom, $right, , , $top) = imageftbbox('100', '0', $font, $curso->nome);
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;
        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;

        imagettftext($imagem, 100, 0, $x, ($y + 270), $cor, $font, $curso->nome);
        if(!empty($cert->data_nota)){
            $data = date('d/m/Y',  strtotime($cert->data_nota));
        }else{
            $data = date('d/m/Y',  strtotime($cert->updated_at));
        }
        list($left, $bottom, $right, , , $top) = imageftbbox('50', '0', $font, $data);
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;
        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;

        imagettftext($imagem, 50, 0, $x, ($y + 410), $cor, $font, $data);

        list($left, $bottom, $right, , , $top) = imageftbbox('50', '0', $font, $professor->name);
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;
        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;

        imagettftext($imagem, 50, 0, $x, ($y + 810), $cor, $font, $professor->name);

        list($left, $bottom, $right, , , $top) = imageftbbox('50', '0', $font, $validacao);
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;
        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;

        imagettftext($imagem, 50, 0, ($x + 1400), ($y + 900), $cor, $font, $validacao);


        header( 'Content-type: image/jpeg' );
        imagejpeg( $imagem, 'certificados/'.$validacao.'.jpg', 80 );
        header("Content-disposition: attachment; filename=".$validacao.".jpg");
        header('Content-Description: File Transfer');
        readfile('certificados/'.$validacao.".jpg");

        return '<script>window.close()</script>';

    }


}
