<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Response;
use Mail;
use App\User;
use App\Acesso;

use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'definir_senha', 'definir_senha_update'
        ]]);

    }

    public function index(){
        $lista = User::orderBy('created_at','DESC')->paginate(10);
        return view('admin.usuarios.usuarios')
        ->with('usuarios', $lista);
    }

    public function ver($id){
        $usuario = User::with('UserCursos.curso.instrutor','Compras')->find($id);
        if($usuario->tipo == '1'){
            $cursos = \App\Curso::where('instrutor_id', $usuario->id)->get();
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
            ->where('cursos.instrutor_id', $usuario->id)
            ->where('vendas.status', '1');
            $total = $q->sum('vendas_produtos.valor_unitario');
            return view('admin.usuarios.ver')
            ->with('usuario', $usuario)
            ->with('vendas', $q->get())
            ->with('total', $total)
            ->with('cursos', $cursos);
        }

        return view('admin.usuarios.ver')
        ->with('usuario', $usuario);
    }

    public function create(){
        $acessos = Acesso::orderBy('nome')->get();
        return view('admin.usuarios.usuario_edicao')
        ->with('acessos', $acessos);
    }

    public function insert(Request $r)
    {
        $validator = Validator::make(Input::all(), User::$rules, User::$messages);
        if ($validator->fails()) {     
           $messages = $validator->messages();
           return Redirect('/usuario/adicionar')->withErrors($validator);
       }else{
        $a = new User();
        $a->fill($r->all());
        $a->save();

        $admins = DB::table('users')->where('acesso_id', '1')->get();
        foreach($admins as $ADM){
                //NOTIFY($ADM->id, 'Novo cadastro de usuário: '.$r->name, '/usuario/editar/'.$a->id, 'Simples');
        }

        Session::flash('message', 'Usuário adicionado com sucesso!');
        return redirect('usuarios');

    }
}

public function edit($id)
{
    $a = User::find($id);
    $acessos = Acesso::orderBy('nome')->get();
    return view('admin.usuarios.usuario_edicao')
    ->with('usuario', $a)
    ->with('acessos', $acessos);
}

public function update(Request $r, $id)
{
    $validator = Validator::make(Input::all(), User::$rules, User::$messages);
    if ($validator->fails()) {     
       $messages = $validator->messages();
       return Redirect('/usuario/adicionar')->withErrors($validator);
   }else{
    $a = User::find($id);
    $a->fill($r->all());
    $a->save();

    Session::flash('message', 'Usuário editado com sucesso!');
    return redirect('usuarios');

}
}

public function destroy(Request $r, $id)
{
    $a = User::find($id);
    $a->fill($r->all());
    $a->delete();

    Session::flash('message', 'Usuário removido com sucesso!');
    return redirect('usuarios');
}

public function enviar_acesso($id)
{

    $u = User::find($id);
    $u->remember_token = md5(date('YmdHis'));
    $u->save();

    $titulo = 'Cadastrar Senha';
    $mensagem = 'Você recebeu acesso ao painel da '.config('app.SITE_TITLE').'. Clique no botão abaixo para definir sua senha.';
    $btn_titulo = 'Definir Senha';
    $btn_link = getenv('APP_URL').'/usuario/definir-senha/'.$u->email.'/'.$u->id.'/'.$u->remember_token;

    Session::flash('mail_to', $u->email);

    Mail::send('emails.enviar_acesso', ['titulo' => $titulo, 'mensagem' => $mensagem, 'btn_titulo' => $btn_titulo, 'btn_link' => $btn_link],
        function ($message)
        {
            $message->from(config('mail.username'), config('app.SITE_TITLE'));
            $message->to(Session::get('mail_to'));
            $message->subject('Defina sua senha de acesso - '.config('app.SITE_TITLE'));
        }
    );

    Session::flash('message', 'Acesso enviado com sucesso!');
    return redirect('usuarios');

}

public function definir_senha($email, $id, $token)
{
    $u = User::find($id);

    if($token != $u->remember_token){
        Session::flash('error', 'Essa sessão não é mais válida!');
        return redirect('login');
    }

    return view('auth.recovery')
    ->with('email', $email)
    ->with('id', $id)
    ->with('token', $token)
    ->with('usuario', $u);
}

public function definir_senha_update(Request $r, $email, $id, $token)
{
    if($r->password != $r->password_confirm){
        Session::flash('error', 'Senhas não coincidem!');
        return redirect('usuario/definir-senha/'.$email.'/'.$id.'/'.$token);
    }else{
        $u = User::find($id);
        $u->fill($r->all());
        $u->password = bcrypt($r->password);
        $u->remember_token = md5(rand());
        $u->save();

        Session::flash('message', 'Senha definina com sucesso!');
        return redirect('login');
    }
}

public function contatos()
{
    $lista = User::orderBy('name')->get();
    return view('admin.contatos.contatos')->with('usuarios', $lista);
}

public function contatos_busca(Request $r)
{
    $lista = User::where('name', 'LIKE', '%'.$r->busca.'%')
    ->orWhere('email', 'LIKE', '%'.$r->busca.'%')
    ->orWhere('telefone', 'LIKE', '%'.$r->busca.'%')
    ->orWhere('endereco', 'LIKE', '%'.$r->busca.'%')
    ->orderBy('name')->get();
    return view('admin.contatos.contatos')->with('usuarios', $lista);
}

public function contato_foto(Request $r, $id)
{
    if($r->file != ''){
        $imageName = md5(date('YmdHis')).'.'.$r->file('file')->getClientOriginalExtension();
        $r->file('file')->move(base_path().'/public/uploads/usuarios/', $imageName);

        $u = User::find($id);
        $u->fill($r->all());
        $u->foto = $imageName;
        $u->save();
    }

    return redirect('contatos');

}

public function contato_update(Request $r, $id)
{
    $validator = Validator::make(Input::all(), User::$rules, User::$messages);
    if ($validator->fails()) {     
       $messages = $validator->messages();
       return Redirect('/contatos')->withErrors($validator);
   }else{
    $a = User::find($id);
    $a->fill($r->all());
    $a->save();

    Session::flash('message', 'Contato editado com sucesso!');
    return redirect('contatos');

}
}

public function newsletter()
{
    $emails = DB::table('email_marketing')
    ->join('aulas as a', 'a.id', '=', 'email_marketing.aula_id')
    ->join('modulos_cursos as m', 'm.id', '=', 'a.modulo_id')
    ->join('cursos as c', 'c.id', '=', 'm.curso_id')
    ->groupBy('email')
    ->orderBy('data','desc')
    ->select('email_marketing.*','c.nome as curso_nome')
    ->get();

    return view('admin.newsletter.emails')->with('emails', $emails);
}

public function enviar_mensagem_email(Request $r){
    $msg = $r->msg;                
    Session::flash('mail_to', $r->email);

    Mail::send('emails.remocao_comentario', ['msg' => $msg, 'title' => 'Boletim Informativo'],
        function ($message)
        {
            $message->from(getenv('MAIL_USERNAME'), getenv('SITE_TITLE'));
            $message->to(Session::get('mail_to'));
            $message->subject(getenv('SITE_TITLE'));
        }
    );        

    Session::flash('message', 'Mensagem enviada com sucesso!');
    return redirect('newsletter_report');
}



}
