<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - Tinele</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
  <link rel="stylesheet" href="/assets/css/vendor.min.css">
  <link rel="stylesheet" href="/assets/css/elephant.min.css">
  <link rel="stylesheet" href="/assets/css/application.min.css">
  <link rel="stylesheet" href="/assets/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="/assets/css/demo.min.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
  @yield('styles')
</head>
<body class="layout layout-header-fixed">
  <div class="layout-header">
    <div class="navbar navbar-default">
      <div class="navbar-header">
        <a class="navbar-brand navbar-brand-center" href="index.html">
          <img class="navbar-brand-logo" src="{{ config('app.LOGO') }}" alt="Tinele" >
        </a>
        <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
          <span class="sr-only">Toggle navigation</span>
          <span class="bars">
            <span class="bar-line bar-line-1 out"></span>
            <span class="bar-line bar-line-2 out"></span>
            <span class="bar-line bar-line-3 out"></span>
          </span>
          <span class="bars bars-x">
            <span class="bar-line bar-line-4"></span>
            <span class="bar-line bar-line-5"></span>
          </span>
        </button>
        <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="arrow-up"></span>
          <span class="ellipsis ellipsis-vertical">
            <img class="ellipsis-object" width="32" height="32" src="/assets/img/nopicture.png" alt="{{ Auth::user()->name }}">
          </span>
        </button>
      </div>
      <div class="navbar-toggleable">
        <nav id="navbar" class="navbar-collapse collapse">
          <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
              <span class="bar-line bar-line-4 in"></span>
              <span class="bar-line bar-line-5 in"></span>
              <span class="bar-line bar-line-6 in"></span>
            </span>
          </button>
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs-block">
              <h4 class="navbar-text text-center">{{ Auth::user()->name }}</h4>
            </li>
              <!----
              <li class="hidden-xs hidden-sm">
                <form class="navbar-search navbar-search-collapsed">
                  <div class="navbar-search-group">
                    <input class="navbar-search-input" type="text" placeholder="Pesquisar...">
                    <button class="navbar-search-toggler" title="" aria-expanded="false" type="submit">
                      <span class="icon icon-search icon-lg"></span>
                    </button>
                  </div>
                </form>
              </li>
              ---->

              @php
              $messages = DB::table('mensagens')
              ->where('para', Auth::user()->id)
              ->where('visualizado', '0')
              ->orderBy('data', 'desc')
              ->groupBy('rand_log')
              ->get();
              @endphp
              <!----
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                  <span class="icon-with-child hidden-xs">
                    <span class="icon icon-envelope-o icon-lg"></span>
                    @if(count($messages) > 0)
                      <span class="badge badge-danger badge-above right">{{ count($messages) }}</span>
                    @endif
                  </span>
                  <span class="visible-xs-block">
                    <span class="icon icon-envelope icon-lg icon-fw"></span>
                    @if(count($messages) > 0)
                      <span class="badge badge-danger pull-right">{{ count($messages) }}</span>
                    @endif
                    Mensagens
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                  <div class="dropdown-header">
                    <h5 class="dropdown-heading">Mensagens recentes</h5>
                  </div>

                  <div class="dropdown-body">
                    <div class="list-group list-group-divided custom-scrollbar">
                      @foreach($messages as $M)
                      @php
                      $U = DB::table('users')->where('id', $M->de)->get()->first();
                      @endphp
                      <a class="list-group-item" href="/mensagens/{{ $U->id }}/{{ URL_AMIGAVEL($U->name) }}">
                        <div class="notification">
                          <div class="notification-media">
                            <img class="rounded" width="40" height="40" @if($U->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $U->foto }}" @endif alt="{{ $U->name }}">
                          </div>
                          <div class="notification-content">
                            <small class="notification-timestamp">{{ date('d/m/Y H:i:s',  strtotime($M->data)) }}</small>
                            <h5 class="notification-heading">{{ $U->name }}</h5>
                            <p class="notification-text">
                              <small class="truncate">{{ $M->texto }}</small>
                            </p>
                          </div>
                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  
                  <div class="dropdown-footer">
                    <a class="dropdown-btn" href="/mensagens">Abrir Todas</a>
                  </div>
                </div>

              </li>
              ---->

              @php
              $notifys = DB::table('notificacoes')
              ->where('para', Auth::user()->id)
              ->where('visualizado', '0')
              ->get();
              @endphp
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                  <span class="icon-with-child hidden-xs">
                    <span class="icon icon-bell-o icon-lg"></span>
                    @if(count($notifys) > 0)
                    <span class="badge badge-danger badge-above right">{{ count($notifys) }}</span>
                    @endif
                  </span>
                  <span class="visible-xs-block">
                    <span class="icon icon-bell icon-lg icon-fw"></span>
                    @if(count($notifys) > 0)
                    <span class="badge badge-danger pull-right">{{ count($notifys) }}</span>
                    @endif
                    Notificações
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                  <div class="dropdown-header">
                    <h5 class="dropdown-heading">Notificações Recentes</h5>
                  </div>

                  <div class="dropdown-body">
                    <div class="list-group list-group-divided custom-scrollbar">
                      @foreach($notifys as $N)
                      <a class="list-group-item" href="/notificacao/{{ $N->id }}">
                        <div class="notification">
                          <div class="notification-media">
                            <span class="icon icon-exclamation-triangle bg-warning rounded sq-40"></span>
                          </div>
                          <div class="notification-content">
                            <h5 class="notification-heading">{{ $N->tipo }}</h5>
                            <p class="notification-text">
                              <small class="truncate">{{ $N->evento }}</small>
                            </p>
                          </div>
                        </div>
                      </a>
                      @endforeach

                    </div>
                  </div>

                </div>
              </li>
              <li class="dropdown hidden-xs">
                <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                  <img class="rounded" width="36" height="36" src="/assets/img/nopicture.png" alt="{{ Auth::user()->name }}"> {{ Auth::user()->name }}
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#">Contatos</a></li>
                  <li><a href="#">Perfil</a></li>
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
                  <li class="divider"></li>
                  <li class="navbar-upgrade-version">Versão: 1.0.1</li>
                </ul>
              </li>
              <li class="visible-xs-block">
                <a href="#">
                  <span class="icon icon-users icon-lg icon-fw"></span>
                  Contatos
                </a>
              </li>
              <li class="visible-xs-block">
                <a href="#">
                  <span class="icon icon-user icon-lg icon-fw"></span>
                  Perfil
                </a>
              </li>
              <li class="visible-xs-block">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span class="icon icon-power-off icon-lg icon-fw"></span>
                  Sair
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="layout-main">
      <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
          <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
              <ul class="sidenav">
                <li class="sidenav-search hidden-md hidden-lg">
                  <form class="sidenav-form" action="/">
                    <div class="form-group form-group-sm">
                      <div class="input-with-icon">
                        <input class="form-control" type="text" placeholder="Pesquisar...">
                        <span class="icon icon-search input-icon"></span>
                      </div>
                    </div>
                  </form>
                </li>
                <li class="sidenav-heading">Navegação</li>

                <li class="sidenav-item">
                  <a href="/home">
                    <span class="sidenav-icon icon icon-home"></span>
                    <span class="sidenav-label">Painel de Controle</span>
                  </a>
                </li>

{{--                 <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-users"></span>
                    <span class="sidenav-label">Usuários</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Usuários</li>
                    <li><a href="/usuarios">Todos Usuários</a></li>
                    <li><a href="/usuario/adicionar">Criar Usuário</a></li>
                  </ul>                  
                </li> --}}
                <li class="sidenav-item">
                  <a href="/usuarios">
                    <span class="sidenav-icon icon icon-users"></span>
                    <span class="sidenav-label">Usuários</span>
                  </a>
                </li>
{{--                 
                 <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-key"></span>
                    <span class="sidenav-label">Acessos</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Acessos</li>
                    <li><a href="/acessos">Todos Acessos</a></li>
                    <li><a href="/acesso/adicionar">Criar Acesso</a></li>
                  </ul>                  
                </li> --}}

                <li class="sidenav-item">
                  <a href="/contatos">
                    <span class="sidenav-icon icon icon-book"></span>
                    <span class="sidenav-label">Contatos</span>
                  </a>
                </li>
                <li class="sidenav-item">
                  <a href="/comentarios">
                    <span class="sidenav-icon icon icon-comments"></span>
                    <span class="sidenav-label">Comentários</span>
                  </a>
                </li>
                <!---
                <li class="sidenav-item">
                  <a href="/mensagens">
                    <span class="sidenav-icon icon icon-comments"></span>
                    <span class="sidenav-label">Mensagens</span>
                  </a>
                </li>
                ---->

                <li class="sidenav-item">
                  <a href="/categorias">
                    <span class="sidenav-icon icon icon-list"></span>
                    <span class="sidenav-label">Categorias</span>
                  </a>
                </li>

                <li class="sidenav-item">
                  <a href="/cursos">
                    <span class="sidenav-icon icon icon-graduation-cap"></span>
                    <span class="sidenav-label">Cursos</span>
                  </a>
                </li>

                <li class="sidenav-item">
                  <a href="/newsletter_report">
                    <span class="sidenav-icon icon icon-envelope"></span>
                    <span class="sidenav-label">Boletim Informativo</span>
                  </a>
                </li>

              </ul>
            </nav>
          </div>
        </div>
      </div>

      <div class="layout-content">        

        @yield('content')
        
      </div>

      <div class="layout-footer">
        <div class="layout-footer-body">
          <small class="version">V 1.0.1</small>

        </div>
      </div>
    </div>
    <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/elephant.min.js"></script>
    <script src="/assets/js/application.min.js"></script>
    <script src="/assets/js/jquery-confirm.min.js"></script>
    <script src="/assets/js/demo.min.js"></script>
    

    @yield('scripts')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>

  </body>
  </html>