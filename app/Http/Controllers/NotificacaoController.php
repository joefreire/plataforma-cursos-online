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

use App\Notificacao;
use DB;

class NotificacaoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notify($r)
    {
        $n = new Notificacao();
        $n->fill($r->all());
        $n->visualizado = 0;
        $n->save();
            
    }

    public function ler_notificacao($id){
        DB::table('notificacoes')->where('id', $id)->update(['visualizado' => '1']);
        $n = DB::table('notificacoes')->where('id', $id)->get()->first();
        return redirect($n->link);
    }
}
