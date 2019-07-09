<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Tinele - Página não existe</title>
	<link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/libs/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="/libs/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="/libs/rslides/responsiveslides.css">
	<link rel="stylesheet" href="/libs/slick/slick.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/custom/css/custom.css">

	
	<link rel="stylesheet" type="text/css" href="/megacourse/css/library/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/megacourse/css/library/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/megacourse/css/md-font.css">
	<link rel="stylesheet" type="text/css" href="/megacourse/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/fix.css">
	
	<link rel="stylesheet" href="/stars/themes/fontawesome-stars.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600%7CMontserrat:300,400,600%7CRaleway:300,400,400i,600%7COpen+Sans:400,400i%7CVarela+Round">

</style>

</head>

<body id="index3" class="page">
	<header style="top: 0;position: fixed;z-index: 999;width: 100%;">
		<div class="container" >
			<div id="topbar" >
				<div class="pull-right">
					<div class="navigation">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<i class="zmdi zmdi-menu zmdi-hc-lg"></i>
						</button>
						<nav class="collapse navbar-collapse" id="myNavbar">

							<form class="navbar-form navbar-left hidden-xs hidden-sm hidden-md" style="margin-top: -1px;" action="/busca" method="POST">
								{{ csrf_field() }}
								<input type="text" class="form-control" placeholder="Pesquisar" style="border-radius: 50px;width: 220px;color: #18c967;" name="q" required>
								<button type="button" class="btn btn-default" style="background: transparent;border: none;margin-left: -40px;color: #18c967;"><span class="glyphicon glyphicon-search"></span></button>
							</form>

							<ul>							
								<li>
									<a href="/Cursos">Cursos</a>
								</li> 
								<li class="hidden-xs">	
									<a href="#">Categorias</a>
									<ul class="submenu submenu-list">
										@php
										$categorias = DB::table('categorias')->where('categoria_id', null)->get();
										@endphp

										@foreach($categorias as $C)
										<li><a href="/Categoria/{{ $C->id }}">{{ $C->nome }}</a></li>
										@endforeach
									</ul>
								</li>
								@if(Auth::user() == null)
								<li>
									<a href="/Instrutor/Registrar">Seja um Professor</a>
								</li>
								@endif 	
								@if(Auth::user() == null)

								@endif 	

								@if(Auth::user() == null)
								<li class="visible-xs">
									<a href="/Instrutor/Login">LOGIN</a>
								</li>
								<li class="visible-xs">
									<a href="/Instrutor/Registrar">REGISTRAR</a>
								</li>
								@endif

								@if(Auth::user() != null && Auth::user()->tipo == 2)
								<li>	
									<a href="/Aluno/Dashboard">{{Auth::user()->name}}</a>
									<ul class="submenu submenu-list">
										<li><a href="/Aluno/Dashboard">Dashboard</a></li>
										<li><a href="/Aluno/Editar">Perfil</a></li>
										<li><a href="/Aluno/Dashboard">Meus Cursos</a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
									</ul>
								</li>					
								@endif							
								@if(Auth::user() != null && Auth::user()->tipo == 1)
								<li>	
									<a href="/Aluno/Dashboard">{{Auth::user()->name}}</a>
									<ul class="submenu submenu-list">
										<li><a href="/Instrutor/Dashboard">Dashboard</a></li>
										{{-- <li><a href="/Instrutor/Editar">Perfil</a></li> --}}
										<li><a href="/Instrutor/Cursos">Meus Cursos</a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
									</ul>
								</li>					
								@endif
								@if(Auth::user() != null && Auth::user()->tipo == 3)
								<li>	
									<a href="/Afiliado/Cursos">{{Auth::user()->name}}</a>
									<ul class="submenu submenu-list">
										<li><a href="/Afiliado/Cursos">Cursos</a></li>
										<li><a href="/Afiliado/Dashboard">Receitas</a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
									</ul>
								</li>											
								@endif
							</ul>

						</nav>
					</div>
					@if(Auth::user() == null)
					<a href="/Logar" class="blueplay login hidden-xs">LOGIN</a>
					<a href="/Aluno/Adicionar" class="register hidden-xs">REGISTRAR</a>
					@endif
					<div class="cart">
						<a href="#" id="cart_menu"><i class="fa fa-shopping-cart"></i><span>{{\Cart::content()->count()}}</span></a>
						<div class="cart-container">
							<h6>CARRINHO</h6>
							@foreach(\Cart::content() as $row)
							<div class="cart-item clearfix">
								@if(!empty($row->options->curso->imagem))
								<img src="/uploads/cursos/{{ $row->options->curso->imagem }}" alt="{{ $row->name }}" class="pull-left"/>
								@else
								<img src="{{asset('images/nopicture.jpg')}}" alt="{{ $row->name }}" class="pull-left"/>
								@endif

								<a href="#">{{ $row->name }}</a>
								<p class="quantity">{{ ($row->price=='0'?"Grátis":"R$ ".$row->price) }}</p>
								<form id="remove_item" action="/carrinho/remove_item" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="item_cart" value="{{ $row->rowId }}">
									<button class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button>	
								</form>
							</div>
							@endforeach
							<div class="cart-controls text-center">
								<a href="/pagamento" class="checkout">FINALIZAR</a>
								<a href="/carrinho" class="viewcart">VER CARRINHO</a>
								<a href="/Cursos" class="addcourse">+ CURSOS</a>
							</div>
						</div>
					</div>
					<div class="search hidden-lg">
						<a href="#" class="search"><i class="zmdi zmdi-search zmdi-hc-lg"></i></a>
						<div class="search-something">
							<form id="search_form" action="/busca" method="POST">
								{{ csrf_field() }}
								<input type="search" placeholder="Pesquisar..." name="q">
								<a href="#" onclick="$('#search_form').submit()"><i class="zmdi zmdi-search"></i></a>
							</form>
						</div>
					</div>
				</div>
				<h1 class="logo"><a href="/"><img src="/images/logo.png" alt="Logo" style="max-height: 50px;"></a></h1>
			</div>

		</header>
		<div class="container">

			<div class="hero-unit" style="margin-bottom: 25px;">
			<h2>Erro 404</h2>
			<p>Essa página não existe.</p>
			<p>
				<a href="/" class="btn btn-primary">
					Inicio
				</a>
			</p>
		</div>

	</div>

	<footer class="footer-bs">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-4">
						<h6>TINELE</h6>
						<ul class="information">
							<li><a href="#">Ajuda e FAQ</a></li>
							<li><a href="#">Blog</a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6>USUÁRIOS</h6>
						<ul class="information">
							<li><a href="/Aluno/Adicionar">Registrar-se</a></li>
							<li><a href="/Instrutor/Registrar">Seja um professor</a></li>
							<li><a href="/Logar">Entrar</a></li>
							<li><a href="/verificar-certificado">Verificar Certificado</a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6>CURSOS</h6>
						<ul class="information">
							<li><a href="/Cursos">Recentes</a></li>
							<li><a href="/Cursos">Populares</a></li>
							<li><a href="/Cursos">Grátis</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 footer-ns animated fadeInRight">
					<h4>Receba as novidades</h4>
					<p>A gente promete enviar só coisas boas!;)</p>
					<p>
						<form action="/newsletter" method="POST">
							{{ csrf_field() }}
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Seu email" name="email" required="" >
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-envelope"></span></button>
								</span>
							</div><!-- /input-group -->
							<input type="hidden" id="aula_assistir_gratis" name="aula_assistir_gratis" value="0">
							<input type="hidden" name="aula_id" value="">
						</form>
					</p>
				</div>
			</div>

			<div class="about">
				<div class='hr'>
					<hr>
					<img src='/images/logo_basic.png' alt=''>
				</div>
				<p>SIGA ESTA CAUSA EDUCACIONAL</p>

				<div class="social-media">
					<ul class="list-inline">
						<li><a href="https://www.facebook.com/tineleead/" title=""><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/tineleead/" title=""><i class="fa fa-instagram"></i></a></li>
						<li><a href="https://www.youtube.com/channel/UC20B0sCjtPpnnEtyPHxL0bQ/featured?view_as=subscriber" title=""><i class="fa fa-youtube"></i></a></li>
					</ul>
				</div>
				<p>&copy;2018 Tinele - Todos os direitos reservados</p>
			</div>


		</footer>

		<script src="/libs/jquery/jquery.js"></script>
		<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
		<script src="/libs/rslides/responsiveslides.min.js"></script>
		<script src="/libs/jquery-ui/jquery-ui.min.js"></script>
		<script src="/libs/slick/slick.min.js"></script>
		<script src="/js/main.js"></script>


		<!-- Start of atendimentotinele Zendesk Widget script -->
		<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=7ba0fc53-2eb3-49b2-8af6-502dc45cd155"> </script>
		<!-- End of atendimentotinele Zendesk Widget script -->


		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124066846-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-124066846-1');
		</script>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>


	</body>
	</html>
