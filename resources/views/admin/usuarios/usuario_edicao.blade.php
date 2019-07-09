@extends('layouts.app')

@if(isset($usuario))
	@section('title', 'Editar Usuário')
@else
	@section('title', 'Cadastrar Usuário')
@endif

@section('content')

<div class="layout-content-body">

		<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
				@if(isset($usuario))
                  	<strong>Editar Usuário</strong>
				@else
					<strong>Cadastrar Usuário</strong>
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
                  
				<form class="form" @if(isset($usuario)) action="/usuario/editar/{{ $usuario->id }}" @else action="/usuario/adicionar" @endif method="POST" data-toggle="validator">
				{{ csrf_field() }}
				<div class="form-group col-md-6">
                    <label for="nome-1">Nome</label>
                    <input id="nome-1" class="form-control" type="text" name="name" required="" @if(isset($usuario)) value="{{ $usuario->name }}" @endif>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="email-1">Email</label>
                    <input id="email-1" class="form-control" type="email" name="email" required="" @if(isset($usuario)) value="{{ $usuario->email }}" @endif>
                  </div>

					<div class="form-group col-md-6">
							<label for="nome-1">Perfil de Acesso</label>
							<select id="form-control-6" name="acesso_id" class="form-control">
									<option value="">Selecione o Perfil de Acesso</option>
									@foreach ($acessos as $A)
										<option @if(isset($usuario) && $usuario->acesso_id == $A->id) selected @endif value="{{$A->id}}">{{$A->nome}}</option>
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

