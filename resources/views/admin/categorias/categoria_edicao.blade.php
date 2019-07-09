@extends('layouts.app')

@if(isset($categoria))
	@section('title', 'Editar Categoria')
@else
	@section('title', 'Cadastrar Categoria')
@endif

@section('content')

  <div class="layout-content-body">

		<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
				@if(isset($acesso))
                  	<strong>Editar Categoria</strong>
				@else
					<strong>Cadastrar Categoria</strong>
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
                  
				<form class="form" @if(isset($categoria)) action="/categoria/editar/{{ $categoria->id }}" @else action="/categoria/adicionar" @endif method="POST" data-toggle="validator">
				{{ csrf_field() }}
				<div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input id="nome" class="form-control" type="text" name="nome" @if(isset($categoria)) value="{{ $categoria->nome }}" @endif required="">
                  </div>
          
          <div class="form-group col-md-6">
							<label for="nome-1">Categoria</label>
							<select id="demo-select2-1" name="categoria_id" class="form-control">
									<option value="" disabled selected>Selecione a Categoria</option>                
                                  
									@foreach ($categorias as $C)
										<option @if(isset($categoria) && $categoria->categoria_id == $C->id) selected @endif value="{{$C->id}}">{{$C->nome}}</option>
                      @if(isset($categoria))
                        @php
                        SUBCATEGORIA_SELECT($C->id, $C->nome, $categoria->categoria_id);
                        @endphp
                      @else
                        @php
                        SUBCATEGORIA_SELECT($C->id, $C->nome, '0');
                        @endphp
                      @endif
									@endforeach
								</select>
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