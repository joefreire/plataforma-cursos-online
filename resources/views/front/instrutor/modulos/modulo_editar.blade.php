@extends('layouts.instrutor')

@if(isset($curso))
	@section('title', 'Editar Módulo')
@else
	@section('title', 'Cadastrar Módulo')
@endif

@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-users2 position-left"></i> 
			@if(isset($curso))
				Editar Módulo
			@else
				Cadastrar Módulo
			@endif
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
	<div class="col-md-12 col-sm-12">

		<!-- Basic inputs -->
		<div class="card card-inverse">
			<div class="card-header">
				<div class="card-title">@if(isset($modulo->id)) Editar módulo @else Novo Módulo @endif</div>
			</div>
			<div class="card-block">
				<form method="POST"					
					@if(isset($modulo))
						action="/Instrutor/Curso/Modulo/Atualiza/{{ $modulo->id }}"
					@else 
						action="/Instrutor/Curso/Modulo/Criar/{{ $curso->id }}"
					@endif>

					{{ csrf_field() }}
					
					<div class="form-group row">
						<label class="control-label col-lg-3">Curso</label>
						<div class="col-lg-9">
							<input readonly type="text" class="form-control" value="@if(isset($curso)) {{ $curso->nome }} @endif">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-3">Nome</label>
						<div class="col-lg-9">
							<input name="nome" type="text" class="form-control" required @if(isset($modulo)) value="{{ $modulo->nome }}" @endif>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-3">Descrição</label>
						<div class="col-lg-9">
							<textarea name="descricao" rows="5" class="form-control">@if(isset($modulo)){{ $modulo->descricao }}@endif</textarea>
						</div>
					</div>
					<button class="btn btn-primary btn-sm pull-right" type="submit" style="float: right;">Enviar</button>
				</form>
			</div>
		</div>
		<!-- /Basic inputs -->
	</div>
</div>

@endsection

@section('scripts')
	<script src="/instrutor/lib/js/pages/forms/form_inputs_basic.js"></script>
@endsection