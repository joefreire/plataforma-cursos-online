@extends('layouts.app')

@section('title', 'Comentários')

@section('content')

<div class="layout-content-body">

        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif

<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">                  
                  <strong>Comentários</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Data</th>                        
                        <th>Aluno</th>                                                
                        <th>Curso</th>                        
                        <th>Comentário</th>                        
                        <th>Rating</th>
                        <th data-orderable="false">Opções</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($comentarios as $c)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($c->data))}}</td>
                                <td>{{$c->aluno_nome}}</td>
                                <td>{{$c->curso_nome}}</td>
                                <td>{{$c->comentario}}</td>
                                <td>{{$c->rating}}</td>
                                <td>                                    
                                    <a onclick="REMOVER('{{ $c->id }}')" class="btn btn-danger btn-xs btn-options">Remover</a>                                    

                                    <form id="delete-form-{{ $c->id }}" action="/comentario/remover/{{ $c->id }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="motivo_delete_{{ $c->id }}" name="motivo">
                                        <input type="hidden" name="id" value="{{$c->aluno_id}}">
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
	function REMOVER(id)
	{
    $.confirm({
    title: 'Remover',
    content: `
              <div>
                Tem certeza que deseja remover o comentário?
                <br/><br/>
                <label for="motivo">Escreva o Motivo</label>
                <textarea id="motivo" class="form-control" type="text" required="" ></textarea>
              </div>`,
    buttons: {
      confirmar: {
            text: 'Remover',
            btnClass: 'btn-danger',
            keys: ['enter', 'shift'],
            action: function(){
              
              if ($('#motivo').val().trim() != ''){
                $('#motivo_delete_'+id).val($('#motivo').val());
                document.getElementById('delete-form-'+id).submit();
              }else{
                $.alert({
                  title: 'Erro',
                  content: "O campo motivo deve ser preenchido, você pode verificar isso?",
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