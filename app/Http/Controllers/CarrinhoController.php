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
use App\Curso;

use DB;
use Cart;

class CarrinhoController extends Controller
{
  public function add_cart(Request $r)
  {
   if(!Auth::user()){
    \Session::flash('error', 'Você deve estar logado para adiquirir um curso');
    return redirect('/Aluno/Logar')->with('redirect','Curso/Detalhes/'.$r->id_Curso);
  }

  $rand_log = uniqid().'-'.date('YmdHis').'-'.md5(date('YmdHis'));

  $curso = DB::table('cursos')->where('id', $r->id_Curso)->first();
  $UserCurso = \App\UserCurso::where('user_id', Auth::id())->where('curso_id', $r->id_Curso)->get();
  $cart = Cart::content();

  if(count($cart)>0){
    foreach ($cart as $key => $value) {
      if($value->id != $r->id_Curso){

        if(count($UserCurso) == 0 ){

          $cart = Cart::add($curso->id, $curso->nome, 1, $curso->valor, ['curso' => $curso]);
        }
      }
    }
  }else{
   $cart = Cart::add($curso->id, $curso->nome, 1, $curso->valor, ['curso' => $curso]);
 }
 return view('front.pagamento');

}
public function get_cart(Request $r)
{
  
  return view('front.pagamento');

}
public function remove_item(Request $r)
{
  Cart::remove($r->item_cart);
  return redirect()->back();

}
public function desconto(Request $r)
{
  $desconto = \App\Desconto::where('cupom',$r->cupom)->where('ativo',1)->first();
  if(!empty($desconto)){
    \Session::put('desconto', $desconto);
  }else{
    \Session::flash('alerta', 'Cupom de desconto inválido');
  }
  return redirect()->back();

}
public function destroy()
{

  Cart::destroy();
  return view('front.pagamento');
}
public function checkout()
{

  Cart::destroy();
  return view('front.pagamento');
}


}
