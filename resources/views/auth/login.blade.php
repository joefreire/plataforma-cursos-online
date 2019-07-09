<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - PlugSe</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#2c3e50">
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
          <img class="img-responsive" src="{{ config('app.LOGO') }}" alt="tinele">
      </a>

      <h3 class="login-heading">Login</h3>

        @if (Session::has('errors'))
        <div class="alert alert-danger">
            <span>
                <b> Erro! </b>Dados de Login incorretos.
            </span>
        </div>
        @endif


        @if (Session::has('error'))
        <div class="alert alert-danger">
            <span>
                {{ Session::get('error') }}
            </span>
        </div>
        @endif

        @if (Session::has('message'))
        <div class="alert alert-success">
            <span>
                {{ Session::get('message') }}
            </span>
        </div>
        @endif

      <div class="login-form">
          <form data-toggle="validator" action="{{ route('login') }}" method="POST">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="username" class="control-label">Email</label>
              <input id="username" class="form-control" type="email" name="email" spellcheck="false" autocomplete="off" data-msg-required="Insira o seu nome." required>
          </div>
          <div class="form-group">
              <label for="password" class="control-label">Senha</label>
              <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Sua senha deve ter no mínimo 6 caracteres." data-msg-required="Insira sua senha." required>
          </div>
          <div class="form-group">
          <button class="btn btn-primary btn-block" type="submit">Login</button>
          </div>

      </form>
  </div>
</div>

</div>
<script src="/assets/js/vendor.min.js"></script>
<script src="/assets/js/elephant.min.js"></script>
</body>
</html>