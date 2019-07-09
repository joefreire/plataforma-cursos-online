<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\VendaProduto;
use App\UserCurso;
use App\Venda;
use Auth;
use Cart;
use Moip;
use Session;

class PagamentoController extends Controller
{
    public function pagamento()
    {
        if(!Auth::user()){
            return redirect('/Aluno/Logar')->with('redirect','pagamento');
        }
        return view('front.pagamento');
    }

    public function criarWebhook()
    {
        $moip = Moip::start(); 
        try {
            $notification = $moip->notifications()->addEvent('ORDER.*')
            ->addEvent('PAYMENT.AUTHORIZED')
            ->setTarget('https://tinele.com/Pagamento/Webhook')
            ->create();
            print_r($notification);
        } catch (Exception $e) {
            printf($e->__toString());    
        }
    }
    public function retornoMoip(Request $request)
    {   


        if(isset($request->event) && $request->event == 'ORDER.PAID'){

            $idMoip = $request->resource['order']['id'];
            if(isset($idMoip)){
             \Log::debug('MOIP Aprovado '.$idMoip.' ====>'.json_encode($request->all()) );
             $venda = Venda::with('Itens')->where('id_transacao', $idMoip)->first();
             $userVenda = $venda->cliente_id;
             if(!empty($venda)){
                $venda->status = 1;
                $venda->save();
                foreach ($venda->Itens as $value) {   
                    $UserCurso = \App\UserCurso::where('user_id', $userVenda)->where('curso_id', $value->produto_id)->get();
                    if(count($UserCurso) == '0' ){
                        $cursoUser = \App\UserCurso::create([
                            'user_id'       => $userVenda,
                            'curso_id'           => $value->produto_id,
                            'andamento'            => '0',
                            'data'   => date('Y-m-d'),
                        ]);
                    }
                }
            }
        }
    }
    if(isset($request->event) && 
        ($request->event == 'ORDER.NOT_PAID' || $request->event == 'ORDER.REVERTED' )){
        $idMoip = $request->resource['order']['id'];
    \Log::debug('MOIP Cancelado '.$request->id.'---'.json_encode($request->all()) );
    if(isset($idMoip)){
        $venda = Venda::where('id_transacao', $idMoip)->first();
        $venda->status = 2;
        $venda->save();
    }
}
\Log::debug('MOIP '.json_encode($request->all()) );
}
public function EnviaEmail($vendaId)
{
    $venda = \App\Venda::with('Itens.produto')->where('id',$vendaId)->first();
    $user = Auth::user();
    $mensagem = 'Olá '.$user->name.', <br><br>';
    $mensagem = $mensagem.'Obrigado por sua compra, ela está sendo processada e logo mais será enviado outro email com a confimação<br>';
    $mensagem = $mensagem.'Segue Abaixo os detalhes <br><br>';
    $mensagem = $mensagem.'<table id="cart" class="table table-hover table-condensed table-responsive" style="margin-top: 5px;">
    <thead>
    <tr>
    <th style="width:80%;font-family:Helvetica, Arial, sans-serif;font-weight:bold;padding-bottom:12px;background-color:#F0F0F0;padding-left:24px;padding-right:24px">Curso</th>
    <th style="width:10%font-family:Helvetica, Arial, sans-serif;font-weight:bold;padding-bottom:12px;background-color:#F0F0F0;padding-left:24px;padding-right:24px">Preço</th>
    </tr>
    </thead>
    <tbody>
    <tr>';


    foreach ($venda->Itens as $value) {

        $mensagem= $mensagem.'<td data-th="Curso" align="left" style="font-family:Helvetica, Arial, sans-serif;padding-bottom:12px;padding-left:24px;padding-right:24px">
        <div class="row">';
        if(!empty($value->produto->imagem)){
            '<div class="col-sm-2 hidden-xs"><img src="'.asset('/uploads/cursos/').
            $value->produto->imagem.'" class="img-responsive" style="max-width: 180px;"></div>';
        }else{ 
            $mensagem= $mensagem.'<div class="col-sm-2 hidden-xs"><img src="'.asset('images/nopicture.jpg').'" class="img-responsive" style="max-width: 180px;"></div>';
        }
        $mensagem= $mensagem.'<h4 class="nomargin">'. $value->produto->nome .'</h4>
        <p>'. $value->produto->descricao.'</p>
        </div>
        </div>
        </td>
        <td data-th="Preço" align="center" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;padding-left:20px;padding-right:24px"> ';
        if($value->produto->valor=='0'){
           $mensagem= $mensagem. 'Grátis</td></tr>';
       }else{
        $mensagem= $mensagem. $value->produto->valor.'</td></tr>';
    }


}

$mensagem= $mensagem.'</tbody>
<tfoot>
<tr>
<td></td>
<td align="right" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;padding-left:20px;padding-right:24px"><strong>Total R$: '.$venda->total.'</strong></td>
</tr>
</tfoot>
</table>';
$titulo = 'Sua compra de cursos no Tinele';    
\Mail::to($user->email)->queue(new \App\Mail\EmailGeral($user, $titulo, $mensagem));
}

public function pagar(Request $request)
{
    if(!Auth::user()){
        return redirect('/Aluno/Logar')->with('redirect','pagamento');
    }
    if(count(\Cart::content())==0){
        return Redirect('/Cursos');
    }
    $rules = array(           
        'name' => 'required',
        'cpf' => 'required|cpf',
        'telefone' => 'required',
        'dt_nascimento' => 'required|data',
        'cep' => 'required|formato_cep',
        'endereco' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
    );
    $validator = \Validator::make($request->all(), $rules, Aluno::$messages);

    if ($validator->fails()) {              
        return Redirect('/pagamento')->withErrors($validator)->withInput();
    }else{

        $u = Aluno::find(Auth::user()->id);
        $u->fill($request->all());           
        $u->save();
        if(Session::has('desconto')){
            if(\Session::get('desconto')->tipo == 'percentual'){
                $total_carrinho = myFloatValue(( myFloatValue(\Cart::total()) - ( myFloatValue(\Cart::total()) *number_format(\Session::get('desconto')->desconto,2 ) / 100) ));
            }else{
              $total_carrinho = myFloatValue(\Cart::total()) - myFloatValue(\Session::get('desconto')->desconto );
          }
      }else{
        $total_carrinho = myFloatValue(Cart::total());
    }
    
    if($total_carrinho == 0.00){                

        $venda = Venda::create([
            'cliente_id'       => Auth::id(),
            'status'           => '1',
            'total'            => '0,00',
            'meio pagamento'   => 'Grátis',
        ]); 
        $cart = Cart::content();      
        foreach ($cart as $key => $value) {
            $VendaProduto = VendaProduto::create([                        
                'produto_id'   => $value->id,
                'user_id'   => Auth::id(),
                'venda_id'     => $venda->id,
                'quantidade'   => '1',
                'valor_unitario' => $value->price,
            ]);
            $userCurso = UserCurso::create([
                'user_id'       => Auth::id(),
                'curso_id'           => $value->id,
                'andamento'            => '0',
                'data'   => date('Y-m-d'),
            ]);
        }   
        $this->EnviaEmail($venda->id);
        Cart::destroy();
        \Session::flash('sucess', 'Compra Realizada com sucesso');
        \Session::forget('desconto');
        return Redirect('/Aluno/Dashboard');

    }else{
                //pagamento via moip
        $telefone = explode(' ',$request->telefone);
        $ddd = (int) filter_var($telefone[0], FILTER_SANITIZE_NUMBER_INT);
        $date = explode('/', $request->dt_nascimento);
        $cart = Cart::content();  
        if(checkdate($date[1], $date[0], $date[2]) ){                    
            $dt_nascimento = \Carbon\Carbon::createFromFormat('d/m/Y',$request->dt_nascimento);
        }else{
            $validator->errors()->add('Pagamento', 'Data de nascimento invalida');
            return Redirect('/pagamento')->withErrors($validator)->withInput();
        }   
        $moip = Moip::start(); 

        if($request->forma_pagamento == 'moip'){
            try {
                $customer = $moip->customers()->setOwnId(uniqid())
                ->setFullname($request->name)
                ->setEmail(Auth::user()->email)
                ->setBirthDate($dt_nascimento)
                ->setPhone($ddd, $telefone[1])
                ->setTaxDocument($request->cpf)
                ->addAddress('BILLING',
                    $request->endereco, $request->numero,
                    $request->bairro, $request->cidade, $request->estado,
                    $request->cep, '')
                ->addAddress('SHIPPING',
                    $request->endereco, $request->numero,
                    $request->bairro, $request->cidade, $request->estado,
                    $request->cep, '')
                ->create();
            } catch (\Exception $e) {
                foreach ($e->getErrors() as $key => $value) {                           
                    $validator->errors()->add('Pagamento', $value->getDescription());
                }
                return Redirect('/pagamento')->withErrors($validator)->withInput();
            }

            try {
                $order = $moip->orders()->setOwnId(uniqid());
                $setDiscount = 0;
                foreach ($cart as $key => $value) {
                    if($value->price>0){
                        $valor_item = (\Session::has('desconto') ? ( \Session::get('desconto')->tipo == 'percentual' ?
                           myFloatValue(( myFloatValue($value->price) - ( myFloatValue($value->price) * myFloatValue(\Session::get('desconto')->desconto ) / 100) ))
                           : (myFloatValue($value->price) - myFloatValue(Session::get('desconto')->desconto ))) : myFloatValue($value->price));
                        $valor_item = (int)($valor_item*100);
                        if($valor_item == 0000){
                            $valor_item = 0001;
                        }
                        $order->addItem($value->options->curso->nome,1,'sku'.$value->id, $valor_item);

                    }else{
                        $setDiscount++;
                        $order->addItem($value->options->curso->nome,1,'sku'.$value->id, 0001);
                    }
                }
                $order->setShippingAmount(0)->setAddition(0)->setDiscount($setDiscount);
                $order->setCustomer($customer)->create();

            }catch (\Exception $e) {
                if($e->getMessage() != null){
                    $validator->errors()->add('Pagamento', $e->getMessage());
                    return Redirect('/pagamento')->withErrors($validator)->withInput();
                }
                foreach ($e->getErrors() as $key => $value) {                           
                    $validator->errors()->add('Pagamento', $value->getDescription());
                }
                return Redirect('/pagamento')->withErrors($validator)->withInput();
            }
            $produtos = array();
            foreach ($cart as $key => $value) {    
                $produtos[] = $value->id;
            }  
            $produtos_comprados = VendaProduto::join('vendas', function ($join) {
                $join->on('vendas_produtos.venda_id', '=', 'vendas.id');
            })->where('user_id', Auth::id())->whereIn('produto_id', $produtos)->get();

            if($produtos_comprados->count() == 0){

                $venda = Venda::create([
                    'cliente_id'       => Auth::id(),
                    'status'           => '0',
                    'total'            => $total_carrinho,
                    'meio_pagamento'   => 'Moip',
                    'cupom_desconto'   => (\Session::has('desconto') ? \Session::get('desconto')->id: null),
                    'transacao'        => $order->getLinks()->getCheckout('payCheckout'),
                    'id_transacao'        => $order->getId(),
                ]);     
                foreach ($cart as $key => $value) {                    
                    $VendaProduto = VendaProduto::create([
                        'venda_id'     => $venda->id,
                        'user_id'   => Auth::id(),
                        'produto_id'   => $value->id,
                        'quantidade'   => '1',
                        'valor_unitario' =>(\Session::has('desconto') ? ( \Session::get('desconto')->tipo == 'percentual' ?
                           myFloatValue(( myFloatValue($value->price) - ( myFloatValue($value->price) * myFloatValue(\Session::get('desconto')->desconto ) / 100) ))
                           : (myFloatValue($value->price) - myFloatValue(Session::get('desconto')->desconto ))) : myFloatValue($value->price)),
                    ]);
                } 
                $this->EnviaEmail($venda->id);                    
                \Session::flash('sucess', 'Compra Realizada com sucesso');
                \Session::flash('ultima_venda', $venda->id);
                
            }else{
                \Session::flash('alerta', 'Você já tem uma compra com esse curso');
            }
            \Session::forget('desconto');
            Cart::destroy();
            return Redirect('/Aluno/Pedidos');

        }else if($request->forma_pagamento == 'boleto'){
            try {
                $customer = $moip->customers()->setOwnId(uniqid())
                ->setFullname($request->name)
                ->setEmail(Auth::user()->email)
                ->setBirthDate($dt_nascimento)
                ->setPhone($ddd, $telefone[1])
                ->setTaxDocument($request->cpf)
                ->addAddress('BILLING',
                    $request->endereco, $request->numero,
                    $request->bairro, $request->cidade, $request->estado,
                    $request->cep, '')
                ->addAddress('SHIPPING',
                    $request->endereco, $request->numero,
                    $request->bairro, $request->cidade, $request->estado,
                    $request->cep, '')
                ->create();
            } catch (\Exception $e) {
                foreach ($e->getErrors() as $key => $value) {                           
                    $validator->errors()->add('Pagamento', $value->getDescription());
                }
                return Redirect('/pagamento')->withErrors($validator)->withInput();
            }

            try {
                $order = $moip->orders()->setOwnId(uniqid());
                $setDiscount = 0;
                foreach ($cart as $key => $value) {
                    if($value->price>0){
                        $order->addItem($value->options->curso->nome,1,'sku'.$value->id, (int)$value->price*100);
                    }else{
                        $setDiscount++;
                        $order->addItem($value->options->curso->nome,1,'sku'.$value->id, 0001);
                    }
                }
                $order->setShippingAmount(0)->setAddition(0)->setDiscount($setDiscount);
                $order->setCustomer($customer)->create();

            } catch (\Exception $e) {
                foreach ($e->getErrors() as $key => $value) {                           
                    $validator->errors()->add('Pagamento', $value->getDescription());
                }
                return Redirect('/pagamento')->withErrors($validator)->withInput();
            }

            try {
                $logo_uri = 'https://cdn.moip.com.br/wp-content/uploads/2016/05/02163352/logo-moip.png';
                $expiration_date = (new \DateTime())->add(new \DateInterval('P3D'));
                $instruction_lines = ['Pagamento curso Tinele', '', ''];
                $payment = $order->payments()->setBoleto($expiration_date, $logo_uri, $instruction_lines)
                ->execute();

                $pagamentoid = $payment->getId();

                $venda = Venda::create([
                    'cliente_id'       => Auth::id(),
                    'status'           => '0',
                    'total'            => $total_carrinho ,
                    'meio_pagamento'   => 'Boleto',
                    'transacao'        => $pagamentoid,
                ]);     
                foreach ($cart as $key => $value) {                    
                    $VendaProduto = VendaProduto::create([
                        'venda_id'     => $venda->id,
                        'user_id'   => Auth::id(),
                        'produto_id'   => $value->id,
                        'quantidade'   => '1',
                        'valor_unitario' => $value->price,
                    ]);
                } 
                $this->EnviaEmail($venda->id);
                Cart::destroy();
                \Session::flash('sucess', 'Compra Realizada com sucesso');
                \Session::flash('boleto', $pagamentoid);
                return Redirect('/Aluno/Pedidos');


            } catch (Exception $e) {
                foreach ($e->getErrors() as $key => $value) {                           
                    $validator->errors()->add('Pagamento', $value->getDescription());
                }
                return Redirect('/pagamento')->withErrors($validator)->withInput();
            }


        }elseif($request->forma_pagamento == 'cartao'){
           try {
            $customer = $moip->customers()->setOwnId(uniqid())
            ->setFullname($request->nome_titular)
            ->setEmail(Auth::user()->email)
            ->setBirthDate($dt_nascimento)
            ->setPhone($ddd, $telefone[1])
            ->setTaxDocument($request->cpf_titular)
            ->addAddress('BILLING',
                $request->endereco, $request->numero,
                $request->bairro, $request->cidade, $request->estado,
                $request->cep, 8)
            ->create();
        } catch (\Exception $e) {
            foreach ($e->getErrors() as $key => $value) {                           
                $validator->errors()->add('Pagamento', $value->getDescription());
            }
            return Redirect('/pagamento')->withErrors($validator)->withInput();
        }

        try {
            $order = $moip->orders()->setOwnId(uniqid());
            $setDiscount = 0;
            foreach ($cart as $key => $value) {
                if($value->price>0){
                    $order->addItem($value->options->curso->nome,1,'sku'.$value->id, (int)$value->price*100);
                }else{
                    $setDiscount++;
                    $order->addItem($value->options->curso->nome,1,'sku'.$value->id, 0001);
                }
            }
            $order->setShippingAmount(0)->setAddition(0)->setDiscount($setDiscount);
            $order->setCustomer($customer)->create();

        } catch (\Exception $e) {
            foreach ($e->getErrors() as $key => $value) {                           
                $validator->errors()->add('Pagamento', $value->getDescription());
            }
            return Redirect('/pagamento')->withErrors($validator)->withInput();
        }
        try {       
            $payment = $order->payments()
            ->setCreditCardHash($request->encrypted_value, $customer)
                    //->setInstallmentCount(3)
            ->setStatementDescriptor('Compra Tinele')
            ->execute();

            $pagamentoid = $payment->getId();

            $venda = Venda::create([
                'cliente_id'       => Auth::id(),
                'status'           => '0',
                'total'            => $total_carrinho ,
                'meio_pagamento'   => 'Cartão',
                'transacao'        => $pagamentoid,
            ]);     
            foreach ($cart as $key => $value) {                    
                $VendaProduto = VendaProduto::create([
                    'venda_id'     => $venda->id,
                    'user_id'   => Auth::id(),
                    'produto_id'   => $value->id,
                    'quantidade'   => '1',
                    'valor_unitario' => $value->price,
                ]);
            } 
            Cart::destroy();
            \Session::flash('sucess', 'Compra Realizada com sucesso');
            return Redirect('/Aluno/Pedidos');

        } catch (\Exception $e) {
            foreach ($e->getErrors() as $key => $value) {                           
                $validator->errors()->add('Pagamento', $value->getDescription());
            }
            return Redirect('/pagamento')->withErrors($validator)->withInput();
        }
    }

}

}
}


}
