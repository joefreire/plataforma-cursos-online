@extends('layouts.app')

@if(isset($acesso))
	@section('title', 'Editar Acesso')
@else
	@section('title', 'Cadastrar Acesso')
@endif

@section('content')

  <div class="layout-content-body">

		<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
				@if(isset($acesso))
                  	<strong>Editar Acesso</strong>
				@else
					<strong>Cadastrar Acesso</strong>
				@endif
                </div>
                <div class="card-body">

				@if (Session::has('errors'))
					@foreach ($errors->all() as $error)
						<div class="alert alert-danger">
							<span>
								<b> Erro! </b>{{ $error }}
							</span>
						</div>
					@endforeach
				@endif
                  
				<form id="formNiveis" class="form" @if(isset($acesso)) action="/acesso/editar/{{ $acesso->id }}" @else action="/acesso/adicionar" @endif method="POST" data-toggle="validator">
				{{ csrf_field() }}
				<div class="form-group col-md-12">
                    <label for="nome">Nome</label>
                    <input id="nome" class="form-control" type="text" name="nome" @if(isset($acesso)) value="{{ $acesso->nome }}" @endif required="">
                  </div>
				 
                  <table id="demo-datatables-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr >
                        <th>Nome</th>
                        <th data-orderable="false" class="text-center">Visualizar</th>
                        <th data-orderable="false" class="text-center">Inserir</th>
                        <th data-orderable="false" class="text-center">Editar</th>
                        <th data-orderable="false" class="text-center">Deletar</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                        @php
                            $p = array();
                            if (isset($acesso))
                                $p = explode(',', $acesso->regras);
                        @endphp

                        @foreach($modulos as $m)
                            <tr>
                                <td>{{$m->nome}}</td>                                
                                <td class="text-center">
										<label class="custom-control custom-control-primary custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="regras[]" value="{{$m->nome}}_View" @if(in_array($m->nome."_View", $p)) checked @endif>
											<span class="custom-control-indicator"></span> 
										</label>
									</td>
									<td class="text-center">
										<label class="custom-control custom-control-primary custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="regras[]" value="{{$m->nome}}_Insert" @if(in_array($m->nome."_Insert", $p)) checked @endif>
											<span class="custom-control-indicator"></span> 
										</label>
									</td>
									<td class="text-center">
										<label class="custom-control custom-control-primary custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="regras[]"  value="{{$m->nome}}_Edit" @if(in_array($m->nome."_Edit", $p)) checked @endif>
											<span class="custom-control-indicator"></span> 
										</label>
									</td>
									<td class="text-center">
										<label class="custom-control custom-control-primary custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="regras[]" value="{{$m->nome}}_Delete" @if(in_array($m->nome."_Delete", $p)) checked @endif>
											<span class="custom-control-indicator"></span> 
										</label>
									</td>
                            </tr>
                        @endforeach
                   
                    </tbody>
                  </table>
                </div>
     
                  <div class="form-group col-md-12">
                    <button class="btn btn-primary btn-block" type="submit">Salvar</button>
                  </div>
                </form>

                </div>
              </div>
            </div>
          </div>
      </div>

@endsection