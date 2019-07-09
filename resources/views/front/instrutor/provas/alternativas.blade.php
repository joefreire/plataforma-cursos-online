@extends('layouts.instrutor')
@section('title', 'Prova')

@section('header')
<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-magazine position-left"></i> Prova
			
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
		<div class="card-title">Alternativas</div>
	</div>	
	
	<div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
		
		<div class="datatable-scroll">
            
            <form action="/Instrutor/Alternativas/{{$questao->id}}" method="post">
            {{ csrf_field() }}
			<table class="table datatable dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
				<thead>
					<tr role="row">						
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Ordem" style="text-align:center;">
							Opção
						</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Ordem">
							Descrição
						</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Nome" style="text-align:center;">
							Correto
						</th>																					
				</thead>
				<tbody>	
                    @if (isset($alternativas))
					@foreach($alternativas as $key=>$a)
					<tr role="row" class="odd">						
                        <td style="text-align:center;">{{ ++$key }}</td>
                        <td>                            
                            <div class="form-group row">                                                                
                                <div class="col-lg-12">
                                    <textarea name="descricao[]" rows="3" class="form-control">@if($a->descricao != ''){{ $a->descricao }}@endif</textarea>
                                    <input type="hidden" name="id[]" value="{{ $a->id }}">
                                </div>
                            </div>					                            
                        </td>
						<td style="text-align:center;">
                            <input type="radio" name="correto" value="{{ $key }}" @if($a->resposta == $key) checked @endif>
                        </td>
					</tr>
                    
					@endforeach
                    @endif
				</tbody>
			</table>
            <button class="btn btn-primary btn-sm pull-right" type="submit" style="float: right; margin-bottom: 20px; margin-right:20px;">Salvar</button>
            </form>
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
