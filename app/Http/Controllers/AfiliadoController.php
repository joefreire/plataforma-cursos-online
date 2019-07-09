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
use App\Curso;
use Redirect;
use Auth;
use DB;

class AfiliadoController extends Controller
{
    public function registro(){
        return view('front.aluno.cadastrar_afiliado');
    }

    public function registrar(Request $r){
        
        $validator = Validator::make(Input::all(), User::$rules, User::$messages);
    	if ($validator->fails()) {     	        
            return Redirect::back()->withErrors($validator);
        }else{
            
            $u = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'tipo' => '3'
            ]);

            $credentials = Input::only('email', 'password'); 
            Auth::attempt($credentials);
            
            Session::flash('message', 'Registro efetuado com sucesso!');
            return redirect('/Afiliado/Dashboard');
        }
    }    

    public function dashboard()
    {
        $vendas = DB::table('vendas')->where('afiliado', Auth::user()->id)->where('status', '1')->orderBy('data', 'desc')->get();
    	return view('front.afiliado.dashboard')->with('vendas', $vendas);
    }

    public function cursos()
    {
        $cursos = Curso::orderBy('comissao', 'desc')->where('comissao','>', '0')->where('aprovado', '1')->get();
        return view('front.afiliado.cursos')->with('cursos', $cursos);
    }

    public function calc_cod($cod)
    {
        $cod = base64_decode($cod);
        $c = explode('-', $cod);

        Session::put('Afiliado', $cod);

        return Redirect('/Curso/Detalhes/'.$c[0]);
    }

}
