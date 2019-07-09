@extends('layouts.instrutor')

@if(isset($aula))
	@section('title', 'Editar Material')
@else
	@section('title', 'Cadastrar Material')
@endif

@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-video-camera position-left"></i>
			@if(isset($material))
				Editar Material
			@else
				Cadastrar Material
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
				<div class="card-title">@if(isset($material)) Editar Material @else Novo Material @endif</div>
			</div>
			<div class="card-block">
				<form method="POST"
					
					@if(isset($material))						
						action="/Instrutor/Material/Atualiza/{{ $material->id }}"
					@else 
						action="/Instrutor/Material/Criar/{{ $aula->id }}"
					@endif enctype="multipart/form-data" >

					{{ csrf_field() }}
					
					<div class="form-group row">
						<label class="control-label col-lg-3">Aula</label>
						<div class="col-lg-9">
							<input readonly type="text" class="form-control" 
								@if(isset($aula)) value="{{$aula->nome}}" @endif>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-lg-3">Nome</label>
						<div class="col-lg-9">
							<input name="descricao" type="text" class="form-control" @if(isset($material)) value="{{ $material->descricao }}" @endif>
						</div>
					</div>					
					
					<div class="form-group row">
						<label class="control-label col-lg-3">Material</label>
						<div class="col-lg-9">
							<div class="uploader">
								<input type="file" name="arquivo" class="file-styled-icon">
								<span class="action" style="user-select: none;"><i class="icon-folder2"></i></span>
							</div>							
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