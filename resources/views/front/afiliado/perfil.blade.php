@extends('layouts.instrutor')
@section('title', 'Perfil')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-users2 position-left"></i> {{ Auth::user()->name }}
			<button id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Editar</button>
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')

@if (Session::has('errors'))
	@foreach ($errors->all() as $error)
	<div class="alert alert-danger" align="center">
		<span>
			<b> Erro! </b>{{ $error }}
		</span>
	</div>
	@endforeach
@endif

<div class="row">
	<div class="col-lg-3 col-sm-4">

		<!-- User thumbnail -->
		<div class="card card-block">
			<div class="thumb thumb-rounded" style="width: 100px;">
				<img @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif style="width:100px; height:100px;">
			</div>
			<div class="caption text-center">
				<h3 class="m-t-20">{{ Auth::user()->name }} </h3>
				<button onclick="$('#file_input').click()" type="button" class="btn btn-info">Alterar Foto do Perfil</button>
				<form id="form_foto_{{ Auth::user()->id }}" method="POST" action="/Afiliado/{{ Auth::user()->id }}/foto" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input id="file_input" style="display:none;" type="file" name="file" onchange="$('#form_foto_{{ Auth::user()->id }}').submit();">
				</form>
			</div>
		</div>
		<!-- /user thumbnail -->

	</div>

	<div class="col-lg-9 col-sm-8">

		<div class="card card-inverse card-flat">
			<div class="card-header">
				<div class="card-title">
					<i class="fa fa-user position-left"></i>Informações
					<div>
						@if(Auth::user()->cpf == null || Auth::user()->cep == null || Auth::user()->numero == null ||  Auth::user()->complemento == null || Auth::user()->bankNumber == null || Auth::user()->accountCheckNumber == null)
							<div class="alert alert-warning">
								<strong>Atenção!</strong> Clique em "EDITAR" e preencha todos os dados antes de continuar.
							</div>
						@endif
					</div>
				</div>
			</div>
			<form id="form-dados" action="/Afiliado/Atualiza" method="POST">
				{{ csrf_field() }}
				<table id="dados" class="table table-borderless table-striped">
					<tbody>
						
						<tr>
							<td><strong>Nome</strong></td>
							<td colspan="2">
								<input disabled="true" class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
							</td>
						</tr>
						<tr>
							<td><strong>CPF</strong></td>
							<td colspan="2">
								<input class="form-control" type="text" name="cpf" value="{{ Auth::user()->cpf }}">
							</td>
						</tr>
						<tr>
							<td><strong>E-mail</strong></td>
							<td colspan="2">
								<input class="form-control" type="text" name="email" value="{{ Auth::user()-> email }}">
							</td>
						</tr>
						<tr>
							<td><strong>Telefone</strong></td>
							<td colspan="2">
								<input class="form-control" type="text" name="telefone" value="{{ Auth::user()->telefone }}">
							</td>
						</tr>
						<tr>
							<td><strong>CEP</strong></td>
							<td colspan="2">
								<input id="cep" class="form-control" type="text" name="cep" value="{{ Auth::user()->cep }}">
							</td>
						</tr>
						<tr>
							<td><strong>Logradouro</strong></td>
							<td colspan="2">
								<input id="rua" class="form-control" type="text" name="logradouro" value="{{ Auth::user()->logradouro }}">
							</td>
						</tr>
						<tr>
							<td><strong>Número</strong></td>
							<td colspan="2">
								<input class="form-control" type="text" name="numero" value="{{ Auth::user()->numero }}">
							</td>
						</tr>
						<tr>
							<td><strong>Complemento</strong></td>
							<td colspan="2">
								<input class="form-control" type="text" name="complemento" value="{{ Auth::user()->complemento }}">
							</td>
						</tr>
						<tr>
							<td><strong>Bairro</strong></td>
							<td colspan="2">
								<input id="bairro" class="form-control" type="text" name="bairro" value="{{ Auth::user()->bairro }}">
							</td>
						</tr>
						<tr>
							<td><strong>Município</strong></td>
							<td colspan="2">
								<input id="cidade" class="form-control" type="text" name="municipio" value="{{ Auth::user()->municipio }}">
							</td>
						</tr>

						<tr>
							<td><strong>Estado</strong></td>
							<td colspan="2">
								<input id="uf" class="form-control" type="text" name="estado" value="{{ Auth::user()->estado }}">
								<input id="ibge" class="form-control" type="hidden" name="ibge" value="{{ Auth::user()->ibge }}">
							</td>
						</tr>

						<tr>
							<td style="width: 20%;"><strong>Sobre</strong></td>
							<td colspan="2">
								<textarea class="form-control" name="observacoes" rows="4" style="width:100%;">{{ Auth::user()->observacoes }}</textarea>
							</td>				
						</tr>
						<tr>
							<td><strong>Banco</strong></td>
							<td>
								<input id="bankNumber" class="form-control" type="number" name="bankNumber" placeholder="Número do banco" value="{{ Auth::user()->bankNumber }}">
							</td>
							<td>
								<input id="bankName" class="form-control" type="text" name="bankName" placeholder="Nome do Banco" value="{{ Auth::user()->bankName }}">
							</td>
						</tr>
						<tr>
							<td><strong>Agência</strong></td>
							<td>
								<input id="agencyNumber" class="form-control" type="number" name="agencyNumber" placeholder="Número da agência" value="{{ Auth::user()->agencyNumber }}">
							</td>
							<td>
								<input id="agencyCheckNumber" class="form-control" type="number" name="agencyCheckNumber" placeholder="Digito Verificador" value="{{ Auth::user()->agencyCheckNumber }}">
							</td>
						</tr>

						<tr>
							<td><strong>Conta Corrente</strong></td>
							<td>
								<input id="accountNumber" class="form-control" type="number" name="accountNumber" placeholder="Número da conta" value="{{ Auth::user()->accountNumber }}">
							</td>
							<td>
								<input id="accountCheckNumber" class="form-control" type="number" name="accountCheckNumber" placeholder="Digito Verificador" value="{{ Auth::user()->accountCheckNumber }}">
							</td>
						</tr>


					</tbody>
				</table>
				<br>
				<div align="right" style="margin-right:10px;">
					<button class="btn btn-primary btn-sm" type="submit">Enviar</button>
				</div>
				<br>
			</form>
		</div>

	</div>
</div>
@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		$('#form-dados input, #form-dados textarea, #form-dados button').attr('disabled',true);
		$( "#editar" ).click(function() {			
			$('#form-dados input, #form-dados textarea, #form-dados button').attr('disabled',false);
		});
		$("#cep").blur(function() {

			//Nova variável "cep" somente com dígitos.
			var cep = $(this).val().replace(/\D/g, '');

			//Verifica se campo cep possui valor informado.
			if (cep != "") {

				//Expressão regular para validar o CEP.
				var validacep = /^[0-9]{8}$/;

				//Valida o formato do CEP.
				if(validacep.test(cep)) {

					//Preenche os campos com "..." enquanto consulta webservice.
					$("#rua").val("...");
					$("#bairro").val("...");
					$("#cidade").val("...");
					$("#uf").val("...");
					$("#ibge").val("...");

					//Consulta o webservice viacep.com.br/
					$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

						if (!("erro" in dados)) {
							//Atualiza os campos com os valores da consulta.
							$("#rua").val(dados.logradouro);
							$("#bairro").val(dados.bairro);
							$("#cidade").val(dados.localidade);
							$("#uf").val(dados.uf);
							$("#ibge").val(dados.ibge);
						} //end if.
						else {
							//CEP pesquisado não foi encontrado.
							limpa_formulário_cep();
							alert("CEP não encontrado.");
						}
					});
				} //end if.
				else {
					//cep é inválido.
					limpa_formulário_cep();
					alert("Formato de CEP inválido.");
				}
			} //end if.
			else {
				//cep sem valor, limpa formulário.
				limpa_formulário_cep();
			}
		});
	});	
</script>
@endsection