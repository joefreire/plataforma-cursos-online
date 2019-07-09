@extends('layouts.app')

@section('title', 'Usuários')

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
                    <a href="/usuario/adicionar" class="btn btn-info btn-sm btn-add" title="Adicionar "><i class="icon icon-plus"></i> Adicionar</a>
                  </div>
                  <strong>Usuários</strong>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>E-mail</th>
                        <th>Data Registro</th>
                        <th data-orderable="false">Opções</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($usuarios as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{CONVERTER_TIPO($u->tipo)}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{$u->created_at->format('d/m/Y')}}</td>
                                <td>
                                    <a href="/usuario/ver/{{ $u->id }}" class="btn btn-info btn-xs btn-options">Ver informações</a>
{{--                                     <a onclick="REMOVER('{{ $u->id }}', '{{ $u->name }}')" class="btn btn-danger btn-xs btn-options">Remover</a>
                                    <a href="/usuario/enviar-acesso/{{ $u->id }}" class="btn btn-success btn-xs btn-options">Enviar Acesso</a>
                                     --}}
{{-- 
                                    <form id="delete-form-{{ $u->id }}" action="/usuario/remover/{{ $u->id }}" method="POST" style="display: none;">
						                          {{ csrf_field() }}
						                        </form> --}}
                                </td>                        
                            </tr>
                        @endforeach
                   
                    </tbody>
                  </table>
                  {{ $usuarios->links() }}
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
    content: 'Tem certeza que deseja remover o usuário: '+nome+'?',
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