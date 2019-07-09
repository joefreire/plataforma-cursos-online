@extends('layouts.instrutor')
@section('title', 'Emails de aulas grátis')

@section('header')
    <!-- Page header -->
    <div class="header">
        <div class="header-content">
            <div class="page-title">
                <i class="icon-envelope position-left"></i> Emails de aulas grátis
                {{--<a href="/Instrutor/Curso/Novo" id="editar" class="btn btn-primary pull-right" style="float:right; top:20px;">Novo curso</a>--}}
            </div>

        </div>
    </div>
    <!-- /Page header -->
@endsection


@section('content')

<div class="card card-inverse card-flat">
    <div class="card-header">
        <div class="card-title">Meus emails</div>
        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif
    </div>
    <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">

        <div class="datatable-scroll">
            <table class="table datatable datatable-selection-single dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                <thead>
                <tr role="row">
                    <th>Email</th>
                    <th>Curso</th>
                    <th>Data</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emails as $e)
                    <tr role="row" class="odd">
                        <td>{{ $e->email }}</td>
                        <td>{{$e->curso_nome}}</td>
                        <td>{{ date('d/m/Y', strtotime($e->data))}}</td>
                        <td class="text-center">
                            <a onclick="REMOVER('{{ $e->id }}')" class="btn btn-danger btn-xs btn-options">Remover</a>
                            <form id="delete-form-{{ $e->id }}" action="/newsletter/remover/{{ $e->id }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                            <a onclick="ENVIAR_MENSAGEM({{ $e->id }}, '{{ $e->email }}')" class="btn btn-info btn-xs btn-options">Enviar Mensagem</a>
                            <form id="msg-form-{{ $e->id }}" action="/enviar_mensagem_email" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="msg" id="msg_enviar_{{ $e->id }}">
                                <input type="hidden" name="email" value="{{ $e->email }}">
                            </form>
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

<script type="text/javascript">
	function REMOVER(id)
	{
    $.confirm({
    title: 'Remover',
    content: 'Tem certeza que deseja remover o newslleter?',
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

  function ENVIAR_MENSAGEM(id, email)
	{
    $.confirm({
    title: 'Enviar Mensagem',
    content: `
              <div>                
                <p><label>Para:</label> `+ email +`</p>                
                <label>Mensagem</label><br/>
                <textarea id="msg" class="form-control" rows="7"></textarea>
              </div>`,
    buttons: {
      confirmar: {
            text: 'Enviar',
            btnClass: 'btn-info',
            keys: ['enter', 'shift'],
            action: function(){              

              if ($('#msg').val().trim() != ''){
                $('#msg_enviar_'+id).val($('#msg').val());
                document.getElementById('msg-form-'+id).submit();
              }else{
                $.alert({
                  title: 'Erro',
                  content: "O campo Mensagem deve ser preenchido, você pode verificar isso?",
                  type: 'red'
                });
              }

            }
        },
        cancelar: function () {},
      }
    });

	}
</script>

@endsection