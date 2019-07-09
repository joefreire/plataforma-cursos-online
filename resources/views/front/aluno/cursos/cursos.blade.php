@extends('layouts.front')
@section('title', 'Cursos')
@section('titulo')
<div class="title">
	<div class="title-image"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				@if(!isset($categoria))		
				<h2>CURSOS</h2>
				@else
				@if(isset($busca))
				<h2>BUSCA</h2>
				@else
				<h2>{{ $categoria }}</h2>
				@endif
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')

<main>
	<div class="container courses-browse popular no-gutters">		        	
		<div class="row">
			<div class="col-sm-3" style="margin-top:50px;margin-bottom: 25px;">
				<aside class="categories">
					<h6>CATEGORIAS</h6>
					<ul>
						@foreach($categorias as $C)
						<li><a href="/Categoria/{{ $C->id }}">{{ $C->nome }}</a></li>
						@endforeach
						
					</ul>
				</aside>			
			</div>
			<div class="col-sm-9">

				@if($cursos->count() == 0)
				<h3 align="center">Nenhum curso foi encontrado!</h3>
				@endif

				@foreach($cursos as $c)
				<a href="/Curso/Detalhes/{{ $c->id }}">
					<div class="row tutorial">
						<div class="col-sm-4">
							@if(!empty($c->imagem))
							<img src="{{asset('/uploads/cursos/'.$c->imagem)}}" class="resp-img" alt="">
							@else
							<img src="{{asset('/images/nopicture.jpg')}}" class="resp-img" alt="">
							@endif
						</div>
						<div class="col-sm-8">
							<div class="tutorial-details">
								<div class="pull-right fav">
									<span style="font-size:20pt;">R$ {{$c->valor}}</span>
									@if(isset(Auth::user()->id) && Auth::user()->tipo == 3)
									@if(isset($c->comissao)) <p class="abs"><b>COMISSÃO:</b> <span style="font-size:10pt;">R$  {{ CALCULAR_COMISSAO($c->valor, $c->comissao) }} </span></p>@endif
									@endif
								</div>
								<h6>{{$c->nome}}</h6>					

								<p class="abs">
									<b>POR:</b> {{ (!empty($c->instrutor)?strtoupper($c->instrutor->name):'') }}
								</p>
								<p class="abs">
									<b>CATEGORIA:</b> {{ (!empty($c->categoria)?$c->categoria->nome:'') }}
								</p>
								<p class="abs">
									<b>NÍVEL:</b> {{ $c->nivel }}
								</p>

								<p class="abs">
									{{$c->descricao}}
								</p>			

								
							</div>                
						</div>
					</div>
				</a>

				@endforeach

				<div class="row text-center">
					<div class="col-xs-12">
						@if(!isset($busca)) {{ $cursos->links() }} @endif
					</div>
				</div>
				<br>

			</div>
		</div>

	</div>


</main>


@endsection


@section('scripts')

<script>

// function DETALHE(id){
//     window.location.href = "/Curso/Detalhes/"+id;
// }

$('#index3').attr('id', 'courses-list');
</script>

@endsection