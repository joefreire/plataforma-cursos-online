@extends('layouts.instrutor')
@section('title', 'Módulos')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-grid position-left"></i> 
			<a href="/Instrutor/Cursos/">{{$curso->nome}}</a> >
			Módulos	
			<a href="/Instrutor/Curso/Modulo/Novo/{{$cursoId}}" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Novo módulo</a>
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')
<div class="card card-inverse card-flat">
	<div class="card-header">
		<div class="card-title">{{ $curso->nome }}</div>
	</div>		
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
			<table class="table datatable datatable-selection-single dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">						
						
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Nome">
							Nome
						</th>

						<th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" class="text-center">Ações</th></tr>
					</thead>
					<tbody>	
						@foreach($modulos as $m)
						<tr role="row" class="odd">						
							<td>{{ $m->nome }}</td>												
							<td class="text-center">
								<ul class="icons-list">

									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<a href="/Instrutor/Curso/Modulo/Editar/{{ $m->id }}" class="dropdown-item"><i class="icon-pencil6"></i> Editar</a>

											<a href="#" onclick="REMOVER('{{ $m->id }}', '{{ $m->nome }}')" class="dropdown-item"><i class="icon-trash"></i> Deletar</a>
											<form id="delete-form-{{ $m->id }}" action="/Instrutor/Curso/Modulo/Deletar/{{ $m->id }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>										

											<div class="dropdown-divider"></div>
											<a href="/Instrutor/Curso/Modulo/{{ $m->id }}/Aulas" class="dropdown-item"><i class="icon-video-camera"></i> Aulas</a>
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
					content: 'Tem certeza que deseja remover o curso: '+nome+'?',
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
