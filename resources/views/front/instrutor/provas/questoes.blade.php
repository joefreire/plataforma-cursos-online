@extends('layouts.instrutor')
@section('title', 'Prova')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-magazine position-left"></i> Prova
			<a href="/Instrutor/Prova/Novo/{{$curso->id}}" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Nova Questão</a>
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')

    @if (Session::has('message'))
<div class="alert alert-success" align="center">
	<span>
		{{ Session::get('message') }}
	</span>
</div>
@endif



<div class="card card-inverse card-flat">
	<div class="card-header">
		<div class="card-title">Questões</div>
	</div>	
	
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
			<table class="table datatable dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">						
						
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Ordem">
							Ordem
						</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Nome">
							Enunciado
						</th>
																
					<th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" class="text-center">Ações</th></tr>
				</thead>
				<tbody>	
                    @if (isset($questoes))
					@foreach($questoes as $q)
					<tr role="row" class="odd">						
                        <td>{{ $q->ordem }}</td>
						<td>{{ $q->enunciado }}</td>
						<td class="text-center">
							<ul class="icons-list">
								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<a href="/Instrutor/Questao/Editar/{{ $q->id }}" class="dropdown-item"><i class="icon-pencil6"></i> Editar</a>
										
										<a href="#" onclick="REMOVER('{{ $q->id }}')" class="dropdown-item"><i class="icon-trash"></i> Deletar</a>
										<form id="delete-form-{{ $q->id }}" action="/Instrutor/Questao/Deletar/{{ $q->id }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>				

                                        <div class="dropdown-divider"></div>
                                        <a href="/Instrutor/Alternativas/{{ $q->id }}" class="dropdown-item"><i class="icon-task"></i> Alternativas</a>
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

	function REMOVER(id)
	{
    $.confirm({
    title: 'Remover',
    content: 'Tem certeza que deseja remover a questão?',
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
