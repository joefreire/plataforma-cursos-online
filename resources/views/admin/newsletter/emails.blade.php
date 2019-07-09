@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<div class="layout-content-body">

        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif

   {{--
        @foreach($emails as $E)

        <li>{{$E->email}}</li>

        @endforeach

--}}
        <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">

                  <strong>Boletim Informativo</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Email</th> 
                        <th>Curso</th>                        
                        <th>Data</th>                        
                        <th data-orderable="false">Opções</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($emails as $e)
                            <tr>
                                <td>{{$e->email}}</td>  
                                <td>{{$e->curso_nome}}</td>  
                                <td>{{ date('d/m/Y', strtotime($e->data))}}</td>
                                <td>                                                                                                        
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
                  <b>Total de Emails: {{ count($emails) }} </b>
                </div>
              </div>
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