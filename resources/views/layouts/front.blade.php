<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	{!! SEO::generate() !!}
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
	@if (Route::getCurrentRoute()->uri() == '/')
	<link rel="stylesheet" href="/libs/venobox/venobox.css" type="text/css" media="screen" />
	@endif
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600%7CMontserrat:300,400,600%7CRaleway:300,400,400i,600%7COpen+Sans:400,400i%7CVarela+Round">

	@yield('style')

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
										$categorias = DB::table('categorias')->get();
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
{{-- 								<li>
									<a href="/Afiliado/Registro">Seja um Afiliado</a>
								</li> --}}
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
			@if (Route::getCurrentRoute()->uri() == '/')
			<div id="homeText" class="row" style="display:none;">
				<div class="col-md-8 col-md-offset-2 text-center">
					<p class="pretitle"></p>
					<h2>Cresça sem sair de casa!</h2>
					<p>Cursos 100% online, 24h por dia!</p>
					<a class="bluebutton venoboxvid venobox vbox-item" data-gall="gall-video" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/embed/DDAHNL3nmcg">Assista o vídeo!</a>
				</div>
			</div>
		</div>
		<ul id="homeSlider" class="rslides-header" style="display:none;">	
			<li><img src="/images/header-slider/slide-1.jpg" class="resp-img" alt="Slide"></li>
		</ul>
		@endif
	</header>
	@if (Route::getCurrentRoute()->uri() == '/')
	<div id="principal" style="margin-top: 268px;">
		@else
		<div>
			@endif
			@yield('titulo')
			@if(Session::has('alerta'))
			<div class="container" style="width: 100%;padding: 0;">
				<div class="alert alert-warning" style="margin-top: 0px; margin-bottom: 0px;text-align: center;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					{!! Session::get('alerta') !!}
				</div>
			</div>
			@endif
			@if(Session::has('sucess'))
			<div class="container" style="width: 100%;padding: 0;">
				<div class="alert alert-success" style="margin-top: 0px; margin-bottom: 0px;text-align: center;"> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					{!! Session::get('sucess') !!}
				</div>
			</div>
			@endif
			@if(Session::has('message'))
			<div class="alert alert-success" style="margin-top: 0px;text-align: center; margin-bottom: 0px;"> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
				{!! Session::get('message') !!}
			</div>
			@endif

			@if($errors->any())
			<div class="container" style="width: 100%;padding: 0;">
				<div class="alert alert-danger" style="margin-top: 0px; margin-bottom: 0px;text-align: center;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</div>
			</div>
			@endif
			@yield('content')
		</div>

		@extends('layouts.footer')

			<script src="/libs/jquery/jquery.js"></script>
			<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
			<script src="/libs/rslides/responsiveslides.min.js"></script>
			<script src="/libs/jquery-ui/jquery-ui.min.js"></script>
			<script src="/libs/slick/slick.min.js"></script>
			<script src="/js/main.js"></script>
			
			@if (Route::getCurrentRoute()->uri() == '/')
			<script type="text/javascript" src="/libs/venobox/venobox.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('.venobox').venobox(); 
				});
			</script>
			
			@endif

			@yield('scripts')

			<!-- BEGIN JIVOSITE CODE {literal} -->
			<script type='text/javascript'>
				(function(){ var widget_id = '3yIz1CEANw';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
			</script>
			<!-- {/literal} END JIVOSITE CODE -->

			
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