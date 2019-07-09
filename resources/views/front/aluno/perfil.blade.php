@extends('layouts.aluno')
@section('title', 'Dashboard')
@section('style')
<link rel="stylesheet" href="{{ asset('libs/sweetalert2-master/dist/sweetalert2.min.css') }}">
@endsection
@section('sub_content')

<!-- CONTEN BAR -->
<section class="content-bar">
    <div class="container">
        <ul>
            <li class="current">
                <a href="/Aluno/Dashboard">
                    <i class="icon md-book-1"></i>
                    Meus Cursos
                </a>
            </li>                
            <li>
                <a href="/Aluno/Pedidos">
                    <i class="icon md-shopping"></i>
                    Pedidos
                </a>
            </li>               
            <li>
                <a href="/Aluno/Editar">
                    <i class="icon md-user-minus"></i>
                    Meu Perfil
                </a>
            </li>
            <li>
                <a href="/Aluno/Mensagem">
                    <i class="icon md-email"></i>
                    Mensagens
                </a>
            </li>
            <li>
                <a href="/Aluno/Certificados">
                    <i class="icon md-shopping"></i>
                    Certificados
                </a>
            </li>
        </ul>
    </div>
</section>



<!-- CREATE COURSE CONTENT -->
<section id="create-course-section" class="create-course-section">		

    @if (Session::has('errors'))
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" align="center">
        <span>
            <b> Erro! </b>{{ $error }}
        </span>
    </div>
    @endforeach
    @endif

    <form name="perfil-form" id="perfil-form" method="POST" action="/Aluno/Editar" enctype="multipart/form-data">

       {{ csrf_field() }}

       <div class="container">			

        <div class="row">


            <div class="col-sm-12">
                <div class="create-course-content">

                    <!-- COURSE BANNER -->
                    <div class="course-banner create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Foto</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="image-info">
                                    <img @if(Auth::user()->foto == '') src="/megacourse/images/img-upload.jpg" 
                                    @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif
                                    alt="">										
                                </div>
                                <div class="upload-recrop">
                                    <div class="upload-image up-file" style="cursor:pointer;">
                                        <a onclick="$('#foto').click();"><i class="icon md-upload"></i>Upload imagem</a>
                                        <input id="foto" name="foto" type="file" accept="image/*" onchange="$('#perfil-form').submit();" style="display:none;">
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / COURSE BANNER -->

                    <!-- COURSE BANNER -->
                    <div class="course-banner create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Capa</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="image-info">
                                    <img @if(Auth::user()->capa == '') src="/megacourse/images/img-upload.jpg" 
                                    @else src="/uploads/usuarios/{{ Auth::user()->capa }}" @endif
                                    alt="">										
                                </div>
                                <div class="upload-recrop">
                                    <div class="upload-image up-file" style="cursor:pointer;">
                                        <a onclick="$('#capa').click();"><i class="icon md-upload"></i>Upload imagem</a>
                                        <input id="capa" name="capa" type="file" accept="image/*" onchange="$('#perfil-form').submit();" style="display:none;">
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / COURSE BANNER -->


                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Nome</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="name" class="form-control" id="name" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->name}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Email</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="" disabled="" 
                                    @if(Auth::user() != null) value="{{Auth::user()->email}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Data Nascimento</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="dt_nascimento" class="form-control" id="dt_nascimento" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->dt_nascimento}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>CPF</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="cpf" class="form-control" id="cpf" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->cpf}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Cep</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="cep" class="form-control" id="cep" placeholder="Digite seu cep..."
                                    @if(Auth::user() != null) value="{{Auth::user()->cep}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Endereço</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="endereco" class="form-control" id="endereco" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->endereco}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Número</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="numero" class="form-control" id="numero" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->numero}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Complemento</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="complemento" class="form-control" id="complemento" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->endereco}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Bairro</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="bairro" class="form-control" id="bairro" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->bairro}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Cidade</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="cidade" class="form-control" id="cidade" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->cidade}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Estado</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="estado" class="form-control" id="estado" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->estado}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Telefone</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="form-item">
                                    <input type="text" name="telefone" class="form-control" id="telefone" placeholder=""
                                    @if(Auth::user() != null) value="{{Auth::user()->telefone}}" @endif>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="promo-video create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Senha</h4>
                            </div>
                            <div class="col-md-4" style="margin-top: -20px; color:#a6a6a6;">
                                <div class="form-item">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                                </div>                                    
                            </div>
                            <div class="col-md-5" style="margin-top: -20px; color:#a6a6a6;">
                                <div class="form-item">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar Senha">
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="description create-item">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Sobre</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="description-editor text-form-editor">                                        
                                  <textarea id="observacoes" name="observacoes" rows="7" placeholder="Sobre..."
                                  class="form-control">{{ Auth::user()->observacoes }}</textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- END / DESCRIPTION -->

                  <div class="form-action">
                    <input type="submit" value="Salvar" id="submit" class="submit mc-btn-3 btn-style-1">
                </div>

            </div>
        </div>
    </div>
</div>

</form>
</section>
<!-- END / CREATE COURSE CONTENT -->




@endsection


@section('sub_scripts')
<script src="{{ asset('/libs/jQuery-Mask/src/jquery.mask.js') }}"></script>
<script src="{{asset('/js/validacpfcnpj.js')}}" charset="utf-8"></script>
<script src="{{ asset('/libs/jQuery-Mask/src/jquery.mask.js') }}"></script>
<script src="{{ asset('/libs/sweetalert2-master/dist/sweetalert2.all.min.js') }}"></script>
<script>
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

    $(function(){

        $("#cep").mask("99999-999");
        $("#cpf").mask('999.999.999-99');
        $("#telefone").mask('(99) 99999-9999');
        $("#dt_nascimento").mask('99/99/9999').val('{{Auth::user()->dt_nascimento }}');
        
        $("#foto_link").on('click', function(e){
            e.preventDefault();
            $("#foto:hidden").trigger('click');
        });

    });
    $("#perfil-form").on('submit', function(event) {

        var owner = $('#name'),
        dt_nasc =$("#dt_nascimento"),
        cpf = $("#cpf"),
        telefone = $("#telefone");
        if (owner.val().length < 5) {
            swal(
              'Oops...',
              'Favor preencher o nome',
              'error'
              )
            return false;
        } 
        if (cpf.val() != '') {

            if (!formata_cpf_cnpj( cpf.val() )) {
                swal(
                  'Oops...',
                  'Favor preencher um cpf valido',
                  'error'
                  )
                return false;
            }
        } 

        return true;
    }); 
</script>
@endsection
