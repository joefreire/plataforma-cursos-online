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

use App\Comentario;
use App\User;
use Mail;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $lista = Comentario::join('users as u', 'u.id', '=', 'comentarios.aluno_id')
                        ->join('cursos as c', 'c.id', '=', 'comentarios.curso_id')
                        ->select('comentarios.*', 'u.name as aluno_nome', 'c.nome as curso_nome')
                        ->get();

        return view('admin.comentarios.comentarios')
                    ->with('comentarios', $lista);
    }

    public function destroy(Request $r, $id)
    {
        $u = User::find($r->id);
                
        $msg = $r->motivo;                
        Session::flash('mail_to', $u->email);
        
        Mail::send('emails.remocao_comentario', ['msg' => $msg, 'title' => 'Cancelamento de Comentário'],
            function ($message)
            {
                $message->from(config('mail.username'), config('app.SITE_TITLE'));
                $message->to(Session::get('mail_to'));
                $message->subject('Cancelamento de Comentário - '.config('app.SITE_TITLE'));
            }
        );

        $c = Comentario::find($id);
        $c->delete();

        Session::flash('message', 'Comentário removido com sucesso!');
        return redirect('comentarios');
    } 
}
