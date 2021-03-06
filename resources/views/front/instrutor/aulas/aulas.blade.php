@extends('layouts.instrutor')
@section('title', 'Aulas')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-video-camera position-left"> </i>
			<a href="/Instrutor/Cursos/">{{$modulo->curso->nome}}</a> >
			<a href="/Instrutor/Curso/Modulo/{{ $modulo->curso->id }}">{{$modulo->nome}}</a> >
			Aulas		
			
			<a href="/Instrutor/Curso/Modulo/{{ $modulo_id }}/Nova-Aula" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Nova aula</a>
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')
<div class="card card-inverse card-flat">
	<div class="card-header">
		<div class="card-title">{{ $modulo->nome }}</div>
	</div>
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
			<table class="table datatable datatable-selection-single dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">
						<tr role="row">								
							<th>Nome</th>							
							<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Nome">Ordem</th>
							<th class="text-center">Ações</th>								
						</tr>
					</tr>
				</thead>
				<tbody>	
					@foreach($aulas as $a)
					<tr role="row" class="odd">	
						<td>{{ $a->nome }} @if($a->gratis == 1) (Aula Grátis) @endif </td>											
						<td>{{ $a->ordem }}</td>						
						<td class="text-center">
							<ul class="icons-list">								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<a href="/Instrutor/Curso/Modulo/{{ $modulo_id }}/Editar-Aula/{{ $a->id }}" class="dropdown-item"><i class="icon-pencil6"></i> Editar</a>
										<a href="/Instrutor/Curso/Modulo/{{ $modulo_id }}/Editar-Aula/{{ $a->id }}/Gratis" class="dropdown-item"><i class="icon-cash3"></i> Habilitar Aula Grátis</a>
										
										<a href="#" onclick="REMOVER('{{ $a->id }}', '{{ $a->nome }}')" class="dropdown-item"><i class="icon-trash"></i> Deletar</a>
										<form id="delete-form-{{ $a->id }}" action="/Instrutor/Curso/Modulo/Aula/Deletar/{{ $a->id }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>

										<div class="dropdown-divider"></div>
										<a href="/Instrutor/Curso/Modulo/Aula/Material/{{ $a->id }}" class="dropdown-item"><i class="icon-book"></i> Material</a>

									</ul>
								</li>
							</ul>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endsection

	@section('scripts')
	<script src="/instrutor/lib/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="/instrutor/lib/js/pages/tables/datatable_advanced.js"></script>

	<script type="text/javascript">		

		function REMOVER(id, nome)
		{
			$.confirm({
				title: 'Remover',
				content: 'Tem certeza que deseja remover a aula: '+nome+'?',
				buttons: {
					confirmar: {
						text: 'Remover',
						btnClass: 'btn-danger',
						keys: ['enter', 'shift'],
						action: function(){
							document.getElementById('delete-form-'+id).submit();
						}
					},
					cancelar: function () {},
				}
			});

		}
	</script>
	@endsection