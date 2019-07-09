<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Definir Senha - {{ config('app.SITE_TITLE') }}</title>

    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="/assets/css/vendor.min.css">
    <link rel="stylesheet" href="/assets/css/elephant.min.css">
    <link rel="stylesheet" href="/assets/css/login-1.min.css">
  </head>
  <body>
    <div class="login">
      <div class="login-body">
        <a class="login-brand" href="/">
          <img class="img-responsive" src="{{ config('app.LOGO_DARK') }}" alt="{{ config('app.SITE_TITLE') }}">
        </a>
        <h3 class="login-heading">Defina sua senha</h3>
        <p align="center">Olá, {{ $usuario->name }}, defina sua senha!</p>
        @if (Session::has('error'))
        <div class="alert alert-danger">
            <span>
                {{ Session::get('error') }}
            </span>
        </div>
        @endif

        <div class="login-form">

          <form data-toggle="validator" method="POST" action="/usuario/definir-senha/{{ $email }}/{{ $id }}/{{ $token }}">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="password">Senha</label>
              <input id="password" class="form-control" type="password" name="password" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username." required>
            </div>

            <div class="form-group">
              <label for="password_c">Confirme a Senha</label>
              <input id="password_c" class="form-control" type="password" name="password_confirm" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username." required>
            </div>

            <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit">Definir nova Senha</button>
            </div>
            
          </form>

        </div>
      </div>
      
    </div>
    <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/elephant.min.js"></script>

  </body>
</html>