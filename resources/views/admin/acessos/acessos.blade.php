@extends('layouts.app')

@section('title', 'Acessos')

@section('content')

<div class="layout-content-body">

        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <a href="/acesso/adicionar" class="btn btn-info btn-sm btn-add" title="Adicionar "><i class="icon icon-plus"></i> Adicionar</a>
                  </div>
                  <strong>Acessos</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nome</th>                        
                        <th data-orderable="false">Opções</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($acessos as $a)
                            <tr>
                                <td>{{$a->nome}}</td>                                
                                <td>
                                    <a href="/acesso/editar/{{ $a->id }}" class="btn btn-info btn-xs btn-options">Editar</a>
                                    <a onclick="REMOVER('{{ $a->id }}', '{{ $a->nome }}')" class="btn btn-danger btn-xs btn-options">Remover</a>                                    

                                    <form id="delete-form-{{ $a->id }}" action="/acesso/remover/{{ $a->id }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </td>                        
                            </tr>
                        @endforeach
                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	function REMOVER(id, nome)
	{
    $.confirm({
    title: 'Remover',
    content: 'Tem certeza que deseja remover o acesso: '+nome+'?',
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