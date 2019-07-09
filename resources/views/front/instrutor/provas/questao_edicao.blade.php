@extends('layouts.instrutor')

@if (isset($questao))
	@section('title', 'Editar Questão')
@else
	@section('title', 'Nova Questão')
@endif

@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-books position-left"></i>
			@if (isset($questao))
				Editar Questão
			@else
				Cadastrar Questão
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
				<div class="card-title">@if(isset($questao)) Editar Questão @else Nova Questão @endif</div>
			</div>
			<div class="card-block">
				<form method="POST" enctype="multipart/form-data" 
					@if(isset($questao))
						action="/Instrutor/Questao/Editar/{{ $questao->id }}"
					@else 
						action="/Instrutor/Questao/Criar/{{$curso_id}}"
					@endif>
					{{ csrf_field() }}					
					<div class="form-group row">
						<label class="control-label col-lg-3">Ordem</label>
						<div class="col-lg-9">
							<input name="ordem" type="number" class="form-control" @if(isset($questao)) value="{{ $questao->ordem }}" @endif>
						</div>						
					</div>					
					<div class="form-group row">
						<label class="control-label col-lg-3">Enunciado</label>
						<div class="col-lg-9">
							<textarea name="enunciado" rows="5" class="form-control">@if(isset($questao)){{ $questao->enunciado }}@endif</textarea>
						</div>
						<input type="hidden" value="{{ $curso_id }}" name="curso_id">
					</div>					
					
					<button class="btn btn-primary btn-sm pull-right" type="submit" style="float: right;">Salvar</button>
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