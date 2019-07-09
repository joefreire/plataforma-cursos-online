@extends('layouts.instrutor')
@section('title', 'Materiais')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-book position-left"></i> Materiais Complementares
			<a href="/Instrutor/Material/Novo/{{ $aula->id }}" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Novo Material</a>
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')
<div class="card card-inverse card-flat">
	<div class="card-header">
		<div class="card-title">{{ $aula->nome }}</div>
	</div>
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
			<table class="table datatable datatable-selection-single dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">
						<tr role="row">								
							<th>Nome</th>							
							<th class="text-center">Ações</th>								
						</tr>
					</tr>
				</thead>
				<tbody>	
                    @if(isset($materiais))
					@foreach($materiais as $a)
					<tr role="row" class="odd">	
						<td>{{ $a->descricao }}</td>																	
						<td class="text-center">
							<ul class="icons-list">								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<a href="/Instrutor/Material/Editar/{{ $a->id }}" class="dropdown-item"><i class="icon-pencil6"></i> Editar</a>
										
										<a href="#" onclick="REMOVER('{{ $a->id }}', '{{ $a->descricao }}')" class="dropdown-item"><i class="icon-trash"></i> Deletar</a>
										<form id="delete-form-{{ $a->id }}" action="/Instrutor/Material/Remover/{{ $a->id }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					@endforeach
                    @endif
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
    content: 'Tem certeza que deseja remover o material: '+nome+'?',
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