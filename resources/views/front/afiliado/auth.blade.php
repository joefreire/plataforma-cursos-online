@extends('layouts.front')
@section('title', 'Login / Registro')

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
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Acessar o Tinele</h1>
            <div class="account-wall">
                <img class="profile-img" src="/assets/img/nopicture.png"
                    alt="">
                <form class="form-signin" method="POST" action="/Afiliado/Login">
				{{ csrf_field() }}
                <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Entrar</button>                
                <a href="#" class="pull-right need-help" style="text-decoration:none;">Esqueci minha senha </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="/Afiliado/Registrar" class="text-center new-account" style="text-decoration:none;">Seja um Afiliado</a>
        </div>
    </div>
</div>
<br><br>
@endsection
