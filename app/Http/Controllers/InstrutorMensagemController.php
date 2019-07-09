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

use App\Mensagem;
use App\User;
use Redirect;
use Auth;
use DB;

class InstrutorMensagemController extends Controller
{
    public function index(){
       
        $mensagens = Mensagem::where('de', Auth::user()->id)
            ->orWhere('para', Auth::user()->id)
            ->join('users as u', 'u.id', '=', 'mensagens.de')
            ->orderBy('data', 'desc')
            ->groupBy('rand_log')            
            ->get();            

        return view('front.instrutor.mensagens.mensagens')
                    ->with('mensagens',$mensagens);
    }

    public function insere_mensagem(Request $r)
    {        
        $m = new Mensagem();
        $m->fill($r->all());                
        $m->de = Auth::user()->id;

        if ($r->de == Auth::user()->id)
            $m->para = $r->para;
        else
            $m->para = $r->de;

        $m->data = date('Y-m-d H:i:s');
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
                
        return redirect('/Instrutor/Mensagens');

    }

    public function newsletter()
    {
        $emails = DB::table('email_marketing')
            ->join('aulas as a', 'a.id', '=', 'email_marketing.aula_id')
            ->join('modulos_cursos as m', 'm.id', '=', 'a.modulo_id')
            ->join('cursos as c', 'c.id', '=', 'm.curso_id')
            ->where('instrutor_id',Auth::user()->id)
            ->groupBy('email')
            ->orderBy('data','desc')
            ->select('email_marketing.*','c.nome as curso_nome')
            ->get();

        return view('front.instrutor.emails.emails')->with('emails', $emails);
    }
}
