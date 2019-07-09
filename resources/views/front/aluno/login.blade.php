@extends('layouts.front')
@section('title', 'Login')
@section('titulo')
    <div class="title">
        <div class="title-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>Acessar o Tinele</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
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
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="/assets/img/nopicture.png"
                alt="">
                <form class="form-signin" method="POST" action="/Aluno/Logar">
                    {{ csrf_field() }}
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Entrar</button>                
                    <a href="#" class="pull-right need-help" style="text-decoration:none;">Esqueci minha senha </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="/Aluno/Adicionar" class="text-center new-account" style="text-decoration:none;">Seja um aluno</a>
        </div>
    </div>
</div>
<br><BR>

@endsection
