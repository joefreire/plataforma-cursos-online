@extends('layouts.front')
@section('title', 'Registrar Afiliado')

@section('content')

@if (Session::has('errors'))
	@foreach ($errors->all() as $error)
	<div class="alert alert-danger" align="center">
		<span>
			<b> Erro! </b>{{ $error }}
		</span>
	</div>
	@endforeach
@endif

@if (Session::has('error'))
	<div class="alert alert-danger" align="center">
		<span>
			<b> Erro! </b>{{ Session::get('error') }}
		</span>
	</div>
@endif

<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            <h1 class="text-center login-title">Registrar-se no Tinele como Afiliado</h1>
            <div >
                
                <form class="form-signin" method="POST" action="/Afiliado/Registrar">
				{{ csrf_field() }}

                <div class="row">

                <div class="form-group">
					<label for="name" class="login-title" style="font-size:10pt;">Nome</label>
					<input type="text" name="name" class="form-control" placeholder="Nome" required autofocus>
				</div>

                <div class="form-group">
					<label for="email" class="login-title" style="font-size:10pt;">E-mail</label>
					<input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
				</div>

                <div class="form-group">
					<label for="password" class="login-title" style="font-size:10pt;">Senha</label>
					<input type="password" name="password" class="form-control" placeholder="******" required autofocus>
				</div>

                <div class="form-group">
					<label for="password_confirmation" class="login-title" style="font-size:10pt;">Corfirmar Senha</label>
					<input type="password" name="password_confirmation" class="form-control" placeholder="******" required autofocus>
				</div>

                </div>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Entrar</button>                
                </form>
            </div>            
            <a href="/Auth" class="col-sm-6 col-sm-offset-3 text-center new-account" style="text-decoration:none;">Já possuo uma conta.</a>
        </div>
    </div>
</div>
<br><br>
@endsection
