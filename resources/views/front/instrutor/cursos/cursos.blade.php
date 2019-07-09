@extends('layouts.instrutor')
@section('title', 'Cursos')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-books position-left"></i> Cursos
			<a href="/Instrutor/Curso/Novo" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Novo curso</a>
		</div>
		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')

<div class="card card-inverse card-flat">
	<div class="card-header">
		<div class="card-title">Meus cursos</div>
	</div>
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
			<table class="table datatable datatable-selection-single dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">						
						<th width="60">Nome</th>						
						<th width="20">Categoria</th>						
						<th width="15">Nivel</th>						
						<th width="5" class="text-center">Ações</th>
					</tr>
				</thead>

				<tbody>	
					@foreach($cursos as $c)
					<tr role="row" class="odd">						
						<td>
							<a href="/Instrutor/Curso/Editar/{{ $c->id }}" class="dropdown-item">{{ $c->nome }}<a>
						</td>					
						<td>
							{{ (isset($c->categoria->nome)?$c->categoria->nome:'') }}
						</td>						
						<td>
							{{ $c->nivel }}
						</td>						
						
						<td class="text-center">
							<ul class="icons-list">								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="ações"></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<a href="/Instrutor/Curso/Editar/{{ $c->id }}" class="dropdown-item"><i class="icon-pencil6"></i> Editar</a>
										
										<a href="#" onclick="REMOVER('{{ $c->id }}', '{{ $c->nome }}')" class="dropdown-item"><i class="icon-trash"></i> Deletar</a>
										<form id="delete-form-{{ $c->id }}" action="/Instrutor/Curso/Remover/{{ $c->id }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
										
										<div class="dropdown-divider"></div>
										<a href="/Instrutor/Curso/Modulo/{{ $c->id }}" class="dropdown-item"><i class="icon-grid"></i> Módulos</a>
										<a href="/Instrutor/Prova/{{ $c->id }}" class="dropdown-item"><i class="icon-magazine"></i> Prova</a>
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
