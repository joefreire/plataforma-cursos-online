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
use App\Mensagem;
use App\User;

use DB;

class MensagemController extends Controller
{
    public function index(){
       
        $mensagens = Mensagem::where('de', Auth::user()->id)
            ->orWhere('para', Auth::user()->id)
            ->groupBy('rand_log')
            ->orderBy('data', 'desc')
            ->get();

        return view('admin.mensagens.mensagens')
                    ->with('mensagens',$mensagens);
    }

    public function canal($id, $url)
    {

        DB::table('mensagens')->where('de', $id)->update(['visualizado' => '1']);

        $mensagens = Mensagem::where('de', Auth::user()->id)
            ->orWhere('para', Auth::user()->id)
            ->groupBy('rand_log')
            ->orderBy('data', 'desc')
            ->get();
        $usuario = User::find($id);
        $canal = Mensagem::orderBy('data')
            ->where('de', $id)->where('para', Auth::user()->id)
            ->orWhere('para', $id)->where('de', Auth::user()->id)
            ->get();
        return view('admin.mensagens.mensagens')
                    ->with('mensagens',$mensagens)
                    ->with('canal', $canal)
                    ->with('usuario', $usuario);
    }

    public function canal_insere_mensagem(Request $r, $id, $url)
    {
        $m = new Mensagem();
        $m->fill($r->all());
        $m->de = Auth::user()->id;
        $m->para = $id;
        $m->data = date('Y-m-d H:i:s');
        $m->visualizado = 0;
        $m->save();

        return redirect('mensagens/'.$id.'/'.$url);

    }


}
