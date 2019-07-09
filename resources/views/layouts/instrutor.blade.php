<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="theme-color" content="#1C2B36" />
	<title>@yield('title') - {{ config('app.SITE_TITLE') }}</title>    

	<!-- Global stylesheets -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="/instrutor/lib/css/animate.min.css">
	<link type="text/css" rel="stylesheet" href="/instrutor/lib/css/metalgrey-material.css">
	<!-- /Global stylesheets -->
{{-- 
	<link type="text/css" rel="stylesheet" href="/assets/css/jquery-confirm.min.css"> --}}
	<link type="text/css" rel="stylesheet" href="/assets/css/custom.css">


	<!-- Page css -->
	<link type="text/css" rel="stylesheet" href="/instrutor/lib/assets/icons/weather/weather-icons.min.css">
	{{-- 	<link type="text/css" rel="stylesheet" href="/instrutor/lib/assets/icons/weather/weather-icons-wind.min.css"> --}}

	@yield('style')
	<!-- /page css -->
	<style>
	@media screen and (min-width: 1024px){
		.menu-container.screen{
			display: inherit;
		}
		.menu-container.handheld{
			display: none;
		}
	}
	@media screen and (max-width: 1023px){
		.menu-container.screen{
			display: none;
		}
		.menu-container.handheld{
			display: inherit;
		}
	}
</style>
</head>
<body id="top">



	<div id="body-wrapper" class="body-container">

		<!-- Header begins -->
		<header class="main-nav clearfix">

			<!-- Searchbar -->
			<div class="top-search-bar">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="search-input-addon">
								<span class="addon-icon"><i class="icon-search4"></i></span>
								<input type="text" class="form-control top-search-input" placeholder="Enter your keyword...">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Searchbar -->

			<!-- Branding -->
			<div class="navbar-left float-left">
				<div class="clearfix">
					<ul class="left-branding float-left">
						<li class="visible-handheld"><span class="left-toggle-switch"><i class="icon-menu7"></i></span></li>
						<li>
							<a href="/Instrutor/Dashboard">
								<img src="{{ asset('/images/logo.png') }}" class="img-logo">
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /Branding -->

			<!-- Navbar icons -->
			<div class="navbar float-right navbar-toggleable-sm">
				<div class="clearfix">
					<ul class="float-right top-icons">
						<li><a href="#" class="btn-top-search hidden-sm-up"><i class="icon-search4"></i></a></li>

						<!-- User dropdown -->
						<li class="dropdown user-dropdown">
							<a href="#" class="btn-user dropdown-toggle hidden-xs-down" data-toggle="dropdown">
								<img style="height:38px;" @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif class="rounded-circle user"/></a>
								<a class="user-name hidden-xs-down" data-toggle="dropdown">{{ Auth::user()->name }}<small>Professor</small></a>
								<a href="#" class="dropdown-toggle hidden-sm-up" data-toggle="dropdown"><i class="icon-more"></i></a>
								<div class="dropdown-menu animated fadeIn no-p">
									<div class="user-icon text-center p-t-15">
										<img @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif class="rounded-circle"/></a>
										<h5 class="text-center p-b-15">{{ Auth::user()->name }}</h5>
									</div>
									<div class="text-center p-10"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-block"><i class="icon-exit3 i-16 position-left"></i> Sair</a></div>
								</div>
							</li>
							<!-- /User dropdown -->

						</ul>
					</div>
				</div>
				<!-- /Navbar icons -->

			</header>
			<!-- /Header ends -->

			<!-- Sidebar -->
			<aside class="menu sidebar" style="top: 60px;">
				<div class="left-aside-container">


					<!-- Main menu -->
					<div class="menu-container handheld">
						<ul class="sidebar-accordion">
							<li><a href="/Instrutor/Perfil"><i class="icon-user"></i><span class="list-label"> Perfil</span></a></li>					
							<li><a href="/Instrutor/Financeiro"><i class="icon-wallet"></i><span class="list-label"> Relatório de Vendas</span></a></li>	
							<li><a href="/Instrutor/Cursos"><i class="icon-books"></i><span class="list-label"> Cursos</span></a></li>
							<li><a href="/Instrutor/Mensagens"><i class="icon-envelope"></i><span class="list-label"> Mensagens</span></a></li>
							<li><a href="/Instrutor/Emails"><i class="icon-envelope"></i><span class="list-label"> E-mails</span></a></li>
						</ul>
					</div>

					<div class="menu-container screen">
						<ul class="sidebar-accordion">
							<li><a href="/Instrutor/Perfil"><i class="icon-user"></i><span class="list-label"> Perfil</span></a></li>
							<li><a href="/Instrutor/Cursos"><i class="icon-books"></i><span class="list-label"> Cursos</span></a></li>
							<li><a href="/Instrutor/Financeiro"><i class="icon-wallet"></i><span class="list-label"> Relatório de Vendas</span></a></li>				    				    
							<li><a href="/Instrutor/Mensagens"><i class="icon-envelope"></i><span class="list-label"> Mensagens</span></a></li>
							<li><a href="/Instrutor/Emails"><i class="icon-envelope"></i><span class="list-label"> E-mails</span></a></li>
						</ul>
					</div>
					<!-- /Main menu -->

				</div>
			</aside>
			<!-- /Sidebar -->

			<!-- Page container begins -->
			<section class="main-container" style="margin-top: 60px;">

				@if(Session::has('error'))
				<div class="header-content" style="width: 100% ;padding-bottom: 0px">
					<div class="alert alert-danger" style="margin-top: 15px;"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						{!! Session::get('error') !!}
					</div>
				</div>
				@endif
				@if(Session::has('sucess'))
				<div class="header-content" style="width: 100% ;padding-bottom: 0px">
					<div class="alert alert-success" style="margin-top: 15px;"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						{!! Session::get('sucess') !!}
					</div>
				</div>
				@endif
				@yield('header')

				<div class="container-fluid page-content">

					@yield('content')

				</div>



			</section>
			<!-- /Page Container ends -->

			<!-- ScrolltoTop -->
			<a id="scrollTop" href="#top"><i class="icon-arrow-up12"></i></a>
			<!-- /ScrolltoTop -->

		</div>

		<!-- Layout settings -->
		<div class="layout"></div>
		<span class="is_hidden" id="jquery_vars">
			<span class="is_hidden switch-active"></span>
			<span class="is_hidden switch-inactive"></span>
			<span class="is_hidden chart-bg"></span>
			<span class="is_hidden chart-gridlines-color"></span>
			<span class="is_hidden chart-legends-text-color"></span>
			<span class="is_hidden chart-grid-text-color"></span>
			<span class="is_hidden chart-data-color-option1"></span>
			<span class="is_hidden chart-data-color-option2"></span>
			<span class="is_hidden chart-data-color-option3"></span>
			<span class="is_hidden chart-data-color-option4"></span>
			<span class="is_hidden chart-data-color-option5"></span>
			<span class="is_hidden chart-data-color-option6"></span>
			<span class="is_hidden chart-data-color-option7"></span>
			<span class="is_hidden chart-data-color-option8"></span>
		</span>
		<!-- /Layout settings -->
		
		<!-- Global scripts -->
		<script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
		<script src="/instrutor/lib/js/core/jquery/jquery.ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

		{{-- <script src="/instrutor/lib/js/core/bootstrap/jasny_bootstrap.min.js"></script> --}}
		{{-- <script src="/instrutor/lib/js/core/navigation/nav.accordion.js"></script> --}}
		<script src="/instrutor/lib/js/core/hammer/hammer.min.js"></script>
		<script src="/instrutor/lib/js/core/hammer/jquery.hammer.js"></script>
		<script src="/instrutor/lib/js/core/slimscroll/jquery.slimscroll.js"></script>
		<script src="/instrutor/lib/js/extensions/smart-resize.js"></script>
		<script src="/instrutor/lib/js/extensions/blockui.min.js"></script>
		<script src="/instrutor/lib/js/forms/uniform.min.js"></script>
		<script src="/instrutor/lib/js/forms/switchery.js"></script>
		<script src="/instrutor/lib/js/forms/select2.min.js"></script>
{{-- 		<script src="/instrutor/lib/js/forms/datepicker.min.js"></script>
		<script src="/instrutor/lib/js/forms/datepicker.en.js"></script> --}}

{{-- <script src="/instrutor/lib/js/plugins/ekko-lightbox.min.js"></script>
<!-- /Global scripts -->
<script src="/instrutor/lib/js/core/jquery/jquery.easing.min.js"></script>
<script src="/instrutor/lib/js/charts/jquery.easypiechart.min.js"></script>
<script src="/instrutor/lib/js/charts/raphael-min.js"></script>
<script src="/instrutor/lib/js/charts/morris.min.js"></script>
<script src="/instrutor/lib/js/maps/jvectormap/jvectormap.min.js"></script>
<script src="/instrutor/lib/js/maps/jvectormap/map_files/world.js"></script>
<script src="/instrutor/lib/js/pages/dashboard.js"></script>


<script src="/instrutor/lib/js/pages/forms/picker_date.js"></script> --}}


<!-- Core scripts -->
<script src="/instrutor/lib/js/core/app/layouts.js"></script>
<script src="/instrutor/lib/js/core/app/core.js"></script>
<script>
	if ($.fn.navAccordion) {
		$('.sidebar-accordion').each(function() {
			$(this).navAccordion({
				eventType: 'click',
				hoverDelay: 100,
				autoClose: true,
				saveState: false,
				disableLink: true,
				speed: 'fast',
				showCount: false,
				autoExpand: true,
				classExpand: 'acc-current-parent'
			});
		});
	}

	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
	$(".sidebar ul.sidebar-accordion li a").each(function(){
		if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
		{
			$(this).addClass(" active");
			$(this).parent().parent().css("display","block");
			$(this).parent().parent().parent().addClass(" active");
			$(this).parent().parent().parent().parent().css("display","block");
			$(this).parent().parent().parent().parent().parent().addClass(" active");
		}
	})
	$(".leftmenu ul.sidebar-accordion li a").each(function(){
		if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
		{
			$(this).addClass(" active");
			$(this).parent().parent().css("display","block");
			$(this).parent().parent().parent().addClass(" active");
			$(this).parent().parent().parent().parent().css("display","block");
			$(this).parent().parent().parent().parent().parent().addClass(" active");
		}
	})
</script>

<script>
	if ($.fn.navAccordion) {
		$('.sidebar-accordion').each(function() {
			$(this).navAccordion({
				eventType: 'click',
				hoverDelay: 100,
				autoClose: true,
				saveState: false,
				disableLink: true,
				speed: 'fast',
				showCount: false,
				autoExpand: true,
				classExpand: 'acc-current-parent'
			});
		});
	}

	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
	$(".sidebar ul.sidebar-accordion li a").each(function(){
		if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
		{
			$(this).addClass(" active");
			$(this).parent().parent().css("display","block");
			$(this).parent().parent().parent().addClass(" active");
			$(this).parent().parent().parent().parent().css("display","block");
			$(this).parent().parent().parent().parent().parent().addClass(" active");
		}
	})
	$(".leftmenu ul.sidebar-accordion li a").each(function(){
		if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
		{
			$(this).addClass(" active");
			$(this).parent().parent().css("display","block");
			$(this).parent().parent().parent().addClass(" active");
			$(this).parent().parent().parent().parent().css("display","block");
			$(this).parent().parent().parent().parent().parent().addClass(" active");
		}
	})
</script>

{{-- 	<script src="/assets/js/jquery-confirm.min.js"></script> --}}
@yield('scripts')

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	{{ csrf_field() }}
</form>

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

</body>
</html>
