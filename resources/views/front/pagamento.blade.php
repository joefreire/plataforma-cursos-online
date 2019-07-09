@extends('layouts.front')
@section('title', 'Pagamento')
@section('style')
<link rel="stylesheet" href="{{ asset('libs/sweetalert2-master/dist/sweetalert2.min.css') }}">
<style type="text/css">
.table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
.input-group-addon {
    padding: 0px 1px !important;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
        width:20%;
        display: inline !important;
    }
    .actions .btn{
        width:36%;
        margin:1.5em 0;
    }
    
    .actions .btn-info{
        float:left;
    }
    .actions .btn-danger{
        float:right;
    }
    
    table#cart thead { display: none; }
    table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
    table#cart tbody tr td:first-child { background: lightgray; }
    table#cart tbody td:before {
        content: attr(data-th); font-weight: bold;
        display: inline-block; width: 8rem;
    }
    
    
    
    table#cart tfoot td{display:block; }
    table#cart tfoot td .btn{display:block;}
    
}
</style>
@endsection
@section('titulo')
<div class="title">
    <div class="title-image"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>FINALIZAR PEDIDO</h2>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<main>

    <div class="interno container">
        <div class="hero-unit">

            @if(count(\Cart::content())>0)
            <table id="cart" class="table table-hover table-condensed table-responsive" style="margin-top: 5%;">
                <thead>
                    <tr>
                        <th style="width:80%">Cursos</th>
                        <th></th>
                        <th></th>
                        <th style="width:10%">Preço</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach(\Cart::content() as $row)
                        <td data-th="Curso">
                            <div class="row">
                                @if(!empty($row->options->curso->imagem))
                                <div class="col-sm-2 hidden-xs"><img src="/uploads/cursos/{{ $row->options->curso->imagem }}" alt="{{ $row->name }}" class="img-responsive"/></div>
                                @else
                                <div class="col-sm-2 hidden-xs"><img src="{{asset('images/nopicture.jpg')}}" alt="{{ $row->name }}" class="img-responsive"/></div>
                                @endif
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{ $row->name }}</h4>
                                    <p>{{ $row->options->curso->descricao }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden-xs"></td>
                        <td class="hidden-xs"></td>
                        <td data-th="Preço">{{ ($row->price=='0'?"Grátis":"R$ ".myFloatValue($row->price)) }}</td>

                        <td class="actions" data-th="">
                            <form id="remove_item" action="/carrinho/remove_item" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="item_cart" value="{{ $row->rowId }}">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>    
                            </form>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total {{\Cart::total()}}</strong></td>
                    </tr>
                    <tr>
                        <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Adicionar Mais</a></td>
                        <td style="width: 100%;">
                            @if(Session::has('desconto'))
                            <label class="form-label">Cupom de desconto</label><br>
                            <i class="fa fa-tags"></i> {{Session::get('desconto')->cupom }} ( -{{ (Session::get('desconto')->tipo == 'percentual'? Session::get('desconto')->desconto.'%':'R$'.Session::get('desconto')->desconto) }} )
                            @else
                            <form id="adiciona_desconto" class="form-inline" action="/carrinho/desconto" method="post" style="width: 100%;">
                                {{ csrf_field() }}
                                <label class="form-label">Cupom de desconto</label>
                                <div class="input-group">
                                    <input type="text" name="cupom" id="cupom" class="form-control">
                                    <span class="input-group-addon">
                                        <button class="btn btn-success btn-sm"><i class="fa fa-tags"></i>
                                        </button> 
                                    </span>  
                                </div>
                            </form>
                            @endif
                        </td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong>Total  @if(Session::has('desconto')) {{ ( Session::get('desconto')->tipo == 'percentual' ?
                             myFloatValue(( myFloatValue(\Cart::total()) - ( myFloatValue(\Cart::total()) * myFloatValue(Session::get('desconto')->desconto ) / 100) ))
                        : (myFloatValue(\Cart::total()) - myFloatValue(Session::get('desconto')->desconto ) ) ) }}@else {{ myFloatValue(\Cart::total()) }} @endif </strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="accordion-body collapse in" id="collapse-two" aria-expanded="true" style="">
                <div class="row accordion-body-wrapper">
                    <form id="pagamento" class="form-group" method="post" action="/pagamento">
                        {{ csrf_field() }}
                        <div class="col-sm-6 padding-right-md"><h3 class="subtitle">Dados Pessoais</h3>
                            <div class="xs-margin half">
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="form-label">Nome Completo

                                </label>
                                <input type="text" name="name" id="name" class="form-control" required="" value="{{Auth::user()->name}}">
                            </div>

                            <div class="form-group">
                                <label for="telephone" class="form-label">CPF

                                </label>
                                <input type="text" name="cpf" id="cpf" class="form-control" required="" value="{{Auth::user()->cpf}}">
                            </div>
                            <div class="form-group">
                                <label for="telefone" class="form-label">Telefone

                                </label>
                                <input type="text" name="telefone" id="telefone" class="form-control" required="" value="{{Auth::user()->telefone}}">
                            </div>
                            <div class="form-group">
                                <label for="company" class="form-label">Data Nascimento

                                </label>
                                <input type="text" name="dt_nascimento" id="dt_nascimento" class="form-control" required="" value="{{Auth::user()->dt_nascimento}}">
                            </div>
                            <div class="answer" style="margin-bottom: 50px;
                            {{(\Cart::total() == '0,00'?'display: none;':'')}}">
                            {{-- <h3 class="subtitle">Forma de pagamento</h3> --}}
                            <input type="hidden" name="forma_pagamento" id="forma_pagamento" value="moip">
                            <input type="hidden" name="encrypted_value" id="encrypted_value">
                            {{-- <ul class="answer-list">
                                <li>
                                    <input type="radio" name="radio-1" id="radio-1" val="boleto">
                                    <label for="radio-1">
                                        <i class="icon icon_radio"></i>
                                        BOLETO
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="radio-1" id="radio-2" val="cartao">
                                    <label for="radio-2">
                                        <i class="icon icon_radio"></i>
                                        CARTÃO DE CRÉDITO
                                    </label>
                                </li>

                            </ul>
                            <div class="bg-light p-3 rounded cartao_credito" style="margin-top: 20px;display: none;">
                              <div class="form-group">
                                  <label for="parcelas">Parcelas</label>
                                  <select class="form-control" id="parcelas" name="parcelas">
                                    <option value=""> </option>
                                    <option value="1x">1x - {{ \Cart::total() }} </option>
                                    <option value="2x">2x - </option>
                                    <option value="3x">3x - </option>
                                    <option value="4x">4x - </option>
                                    <option value="5x">5x - </option>
                                    <option value="6x">6x - </option>
                                    <option value="7x">7x - </option>
                                    <option value="8x">8x - </option>
                                    <option value="9x">9x - </option>
                                    <option value="10x">10x - </option>
                                    <option value="11x">11x - </option>
                                    <option value="12x">12x - </option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label class="mb-0" for="inputCard">Número do Cartão de crédito</label>
                              <input type="text" class="form-control form-control-sm" id="inputCard">
                          </div>

                          <div class="form-group">
                              <label for="inputFullname">Nome do titular</label>
                              <input type="text" name="nome_titular" class="form-control form-control-sm" id="nome_titular">
                          </div>
                          <div class="form-group">
                              <label for="cpf_titular">CPF do titular</label>
                              <input type="text" name="cpf_titular" class="form-control form-control-sm" id="cpf_titular">
                          </div>
                          <div class="form-group row">
                              <div class="col-md-6">
                                <label for="">Validade</label>
                                <div class="row"> <div class="col-xs-6"> <div class="float-label"> 
                                    <div class="selectbox"> <select class="form-control" id="creditCard-ccMonth" name="creditCardCardExpirationMonth">
                                        <option value="">Mês </option>
                                        <option value="1">1</option>
                                        <option  value="2">2</option>
                                        <option  value="3">3</option>
                                        <option  value="4">4</option>
                                        <option value="5">5</option>
                                        <option  value="6">6</option>
                                        <option  value="7">7</option>
                                        <option  value="8">8</option>
                                        <option  value="9">9</option>
                                        <option value="10">10</option>
                                        <option  value="11">11</option>
                                        <option  value="12">12</option>
                                    </select>
                                </div> </div> </div> <div class="col-xs-6"> <div class="float-label" > <div class="selectbox"> 
                                    <select class="form-control " id="creditCard-ccYear" name="creditCardCreditCardExpiryYear"><option value="">Ano </option>
                                        @for($x=0; $x<10; $x++)
                                        <option value="{{date("Y")+$x}}">{{date("Y")+$x}}</option>
                                        @endfor
                                    </select> </div> </div> </div> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-0" for="inputCvv">Código de Segurança</label>
                                    <input type="text" class="form-control form-control-sm" id="inputCvv">
                                </div>
                            </div>
                        </div> --}}
                        <img src="/compra_segura.png" style="margin-top: 15px;">
                    </div>

                </div>
                <div class="md-margin visible-xs clearfix">
                </div>
                <div class="col-sm-6 padding-left-md form-group"><h3 class="subtitle">Endereço</h3>
                    <div class="xs-margin half">
                    </div>
                    <div class="form-group">
                        <label for="address1" class="form-label">Cep
                        </label>
                        <input type="text" name="cep" id="cep" class="form-control"  required="" value="{{Auth::user()->cep}}">
                    </div>
                    <div class="form-group">
                        <label for="address2" class="form-label">Rua
                        </label>
                        <input type="text" name="endereco" id="endereco" class="form-control" required="" value="{{Auth::user()->endereco}}">
                    </div>
                    <div class="form-group">
                        <label for="address2" class="form-label">Bairro
                        </label>
                        <input type="text" name="bairro" id="bairro" class="form-control" required="" value="{{Auth::user()->bairro}}">
                    </div>
                    <div class="row form-group">                            
                        <div class="col-sm-6">
                            <label for="address2" class="form-label">Numero
                            </label>
                            <input type="text" name="numero" id="numero" class="form-control" value="{{Auth::user()->numero}}">
                        </div>                         
                        <div class="col-sm-6">
                            <label for="address2" class="form-label">Complemento
                            </label>
                            <input type="text" name="complemento" id="complemento" class="form-control" value="{{Auth::user()->Complemento}}">
                        </div>
                    </div>
                    <div class="row form-group">                            
                        <div class="col-sm-6">
                            <label for="city" class="form-label">Cidade

                            </label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required="" value="{{Auth::user()->cidade}}">
                        </div>                         
                        <div class="col-sm-6">
                            <label for="postcode" class="form-label">Estado
                            </label>
                            <input type="text" name="estado" id="estado" class="form-control" required="" value="{{Auth::user()->estado}}">
                        </div>
                    </div>


                    <div class="xs-margin">
                    </div>
                    <button class="btn btn-success btn-block">Fechar pedido <i class="fa fa-angle-right"></i></button> 
                </div>



            </form>

        </div>
    </div>
    @else

    <h2>Carrinho Vazio</h2>
    <p>Volte e busque cursos primeiro.</p>
    <p>
        <a href="/" class="btn btn-primary">
            Inicio
        </a>
    </p>

    @endif
</div>
</div>
</main>
<textarea id="public_key" style="display:none;">
    -----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAq3emImGgBMTsLM5kfzFE
    N+M3E5i9DYy4e/H7KgJwZ12tMRdRY0bRJ86IU6t+PsMRA5lSgFLRPZNXeosRIuut
    38InRjJ3wV5zvBQJbsLFzRbUc8/T6sd7Ge0KJ7TPXKm0WSOn3RyNtQHT8cdcj+mT
    Kn7gwClU8W84xulBlql08u1KD7BIR6BWa6dQuxwRWoVkAKF80SnyxxedS9IofUcR
    nqtiTmO3cL+BaZT2uuYu04AKHYtLQfKM/croSYvQPZK3W1ubeflO6akjCqUhsfF/
    saGCI85/eDc7BCFmCW2S6JQ/NVTuSYIDJdf2iG5B3+IK61G4cpHOmpUUIa168Ps+
    VwIDAQAB
    -----END PUBLIC KEY-----
</textarea>
@endsection
@section('scripts')
<script src="{{ asset('/libs/jQuery-Mask/src/jquery.mask.js') }}"></script>
<script src="{{ asset('/libs/sweetalert2-master/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('/js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{asset('/js/validacpfcnpj.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="//assets.moip.com.br/v2/moip.min.js"></script>
<script>
    $(function(){
        var owner = $('#name'),
        dt_nasc =$("#dt_nascimento"),
        cpf = $("#cpf"),
        telefone = $("#telefone");
        $("#cep").mask("99999-999");
        $("#inputCard").mask("9999 9999 9999 9999");
        $("#inputCvv").mask("9999");
        $("#cpf").mask('999.999.999-99');
        $("#telefone").mask('(99) 99999-9999');
        $("#dt_nascimento").mask('99/99/9999').val('{{Auth::user()->dt_nascimento }}');

        $("#pagamento").on('submit', function(e) {
            if($("#forma_pagamento").val() =='cartao'){
               var cc = new Moip.CreditCard({
                number  : $("#inputCard").val(),
                cvc     : $("#inputCvv").val(),
                expMonth: $("#creditCard-ccMonth").val(),
                expYear : $("#creditCard-ccYear").val(),
                pubKey  : $("#public_key").val()
            });
             //console.log(cc);
             if( cc.isValid()){
                $("#encrypted_value").val(cc.hash());
            }
            else{
                $("#encrypted_value").val('');
                swal(
                  'Oops...',
                  'Favor preencher um cartão valido',
                  'error'
                  )
                return false;
            }
        }
        if (owner.val().length < 5) {
            swal(
              'Oops...',
              'Favor preencher o nome',
              'error'
              )
            return false;
        } 
        if (cpf.val() == '') {
            swal(
              'Oops...',
              'Favor preencher o cpf',
              'error'
              )
            return false;
        } else {
            if (cpf.val().length < 14) {
              swal(
                'Oops...',
                'Favor preencher um cpf valido',
                'error'
                )
              return false;
          } else {
              if (!formata_cpf_cnpj( cpf.val() )) {
                swal(
                  'Oops...',
                  'Favor preencher um cpf valido',
                  'error'
                  )
                return false;
            }
        } 
    }
    
}); 
    }); 

    $("input[name=radio-1]").on('change', function(event) {
        if($("#radio-2").is(":checked")){
            $("#forma_pagamento").val('cartao')
            $(".cartao_credito").show()            
        }else{
            $("#forma_pagamento").val('boleto')
            $(".cartao_credito").hide()
        }
    })

    $("#cep").on('change', function(event) {
      var self = $(this);

      if ($("#cep").val() == '') {
        swal(
          'Oops...',
          'Digite o CEP',
          'error'
          )
        return false;
        $("#cep").focus();
        return false;
    } else {
        $.ajax({
          url:'http://cep.republicavirtual.com.br/web_cep.php',
          data:{'formato':'javascript', 'cep':$("#cep").val()},
          type:'get',
          dataType:'script',
              timeout: (1000 * 30), //30 segundos                    
              success:function(retorno) {
                  eval(retorno);
                  switch(resultadoCEP['resultado']) {
                    case '1':
                    $("#endereco").val(unescape(resultadoCEP['tipo_logradouro']) + ' ' + unescape(resultadoCEP['logradouro']));
                    $("#bairro").val(unescape(resultadoCEP['bairro']));
                    $("#cidade").val(unescape(resultadoCEP['cidade']));
                    $("#estado").val(unescape(resultadoCEP['uf']));
                    $("#numero").val('');
                    $("#numero").focus();
                    break;
                    case '2':
                    $("#cidade").val(unescape(resultadoCEP['cidade']));
                    $("#estado").val(unescape(resultadoCEP['uf']));
                    $("#endereco").focus();
                    break;
                    default:
                    swal(
                      'Oops...',
                      'CEP não encontrado',
                      'error'
                      )
                    $("#cep").focus();
                    break;
                }
            },
            error:function(){
              swal(
                'Oops...',
                'Erro interno ao buscar CEP',
                'error'
                )
          }
      });
    }
});  
</script>
@endsection