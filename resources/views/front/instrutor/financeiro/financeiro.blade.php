@extends('layouts.instrutor')
@section('title', 'Financeiro')

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
@endsection

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-grid position-left"></i> Financeiro
		</div>
		<ul class="breadcrumb">
			<li><a href="/Instrutor/Dashboard">  Dashboard</a></li>
			<li class="active">Financeiro</li>
		</ul>
	</div>
</div>
<!-- /Page header -->
@endsection


@section('content')

<h4 align='center' class="m-b-20">Defina as opções abaixo para gerar o relatório.</h4>

<form method="get" action="/Instrutor/Financeiro">
	<div class="col-md-3 col-sm-3">
		<!-- Initialization with default options -->
		<div class="card card-block text-center">
			<h4 class="m-b-20">Data Inicial</h4>

			<div class="input-group">
				<span class="input-group-addon"><i class="icon-calendar2"></i></span>
				<input type='text' class='form-control datepicker-here' id="inicio" name="inicio" placeholder="Data Inicial" autocomplete="off" value="{{  Request::get('inicio') }}"/>
			</div>

		</div>
	</div>

	<div class="col-md-3 col-sm-3">
		<!-- Initialization with default options -->
		<div class="card card-block text-center">
			<h4 class="m-b-20">Data Final</h4>

			<div class="input-group">
				<span class="input-group-addon"><i class="icon-calendar2"></i></span>
				<input type='text' class='form-control datepicker-here' id="ate" name="ate"  placeholder="Data Final" autocomplete="off" value="{{  Request::get('ate') }}"/>
			</div>

		</div>
	</div>

	<div class="col-md-3 col-sm-3">
		<!-- Initialization with default options -->
		<div class="card card-block text-center">
			<h4 class="m-b-20">Curso</h4>

			<div class="input-group">
				<select name="curso" class="form-control">
					<option value="">Todos</option>
					@foreach(\App\Curso::where('instrutor_id',Auth::id())->get() as $C)
					<option value="{{ $C->id }}" {{( Request::get('curso')  == $C->id ? "selected" : '')}}>{{ $C->nome }}</option>
					@endforeach
				</select>
			</div>

		</div>
	</div>

	<div class="col-md-3 col-sm-3">
		<!-- Initialization with default options -->
		<div class="card card-block text-center">
			<h4 class="m-b-20">Pesquisar</h4>

			<div class="input-group" align="center" style="display: -webkit-inline-box;">
				<button type="submit" class="btn btn-primary">Pesquisar</button>
			</div>

		</div>
	</div>


</form>


@if(isset($qs))
<div class="card card-inverse card-flat col-md-12">
	<div class="card-header">
		<div class="card-title">Relatório</div>
	</div>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Data</th>
					<th>Aluno</th>
					<th>Curso</th>
					<th>Valor pago</th>
				</tr>
			</thead>
			<tbody>

				@foreach($qs as $Q)
				<tr>
					<td>{{ date('d/m/Y',  strtotime($Q->data)) }}</td>
					<td>{{  $Q->user->name }}</td>
					<td>{{ $Q->curso->nome }}</td>
					<td>R$ {{ (!empty($Q->vendido)?number_format($Q->vendido->valor_unitario, 2, '.', ''):'0.00') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $qs->appends(Request::capture()->except('page'))->links() }}
	</div>
	<br>
	<h3 align="right" style="margin-bottom: 10%;margin-right: 2%;">Total a receber: <b> R$ {{ number_format($total, 2, '.', '') *0.7 }}</b></h3>
</div>



@endif

@endsection

@section('scripts')
<script src="/js/jquery.mask.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker-here").mask('99/99/9999');
		$("#inicio").datepicker({
			todayBtn:  1,
			language: "pt-BR",
			format: 'dd/mm/yyyy',
			autoclose: true,   
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#ate').datepicker('setStartDate', minDate);
		});

		$("#ate").datepicker({
			language: "pt-BR",
			format: 'dd/mm/yyyy',
			autoclose: true,   
		})
		.on('changeDate', function (selected) {
			var maxDate = new Date(selected.date.valueOf());
			$('#inicio').datepicker('setEndDate', maxDate);
		});

	});
</script>
@endsection