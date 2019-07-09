@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<div class="layout-content-body">

        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif

<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <a href="/categoria/adicionar" class="btn btn-info btn-sm btn-add" title="Adicionar "><i class="icon icon-plus"></i> Adicionar</a>
                  </div>
                  <strong>Categorias</strong>
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
                    
                        @foreach($categorias as $c)
                            <tr>
                                <td>{{$c->nome}}</td>                                
                                <td>
                                    <a href="/categoria/editar/{{ $c->id }}" class="btn btn-info btn-xs btn-options">Editar</a>
                                    <a onclick="REMOVER('{{ $c->id }}', '{{ $c->nome }}')" class="btn btn-danger btn-xs btn-options">Remover</a>                                    

                                    <form id="delete-form-{{ $c->id }}" action="/categoria/remover/{{ $c->id }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </td>                        
                            </tr>
                            @php
                              SUBCATEGORIA($c->id, $c->nome);
                            @endphp
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
    content: 'Tem certeza que deseja remover a categoria: '+nome+'?',
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