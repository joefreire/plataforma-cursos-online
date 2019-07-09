@extends('layouts.front')
@section('title', 'Ensino, Aprendizagem e Ganhos Compartilhados')

@section('content')

<main>
<section id="features">
	<div class="container featured text-center">

		
		<div class="feature col-sm-10 col-sm-offset-1">
			<h3 style="color:#2ecc71"><b>O que é o Tinele?</b></h3>
			<p>
				Tinele é uma plataforma de ensino, aprendizagem, e ganhos compartilhados.<br>Aqui você pode criar, estudar ou promover cursos online.
			</p>
		</div>
		

		<div class="col-md-4">
			<div class="feature">
				<div class="img-container-bg">
					<img src="/images/features/professor.png" class="make-center" alt="Feature">
				</div>
				<h6>ENSINAR</h6>
				<p>Compartilhe seus conhecimentos e habilidades com o mundo, ganhe dinheiro e ajude milhares de pessoas.
				</p>
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="feature">
				<div class="img-container-bg">
					<img src="/images/features/student.png" class="make-center" alt="Feature">
				</div>
				<h6>APRENDER</h6>
				<p>Escolha um dos nossos cursos 100% online e comece a comandar o seu futuro agora mesmo.</p>
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="feature">
				<div class="img-container-bg">
					<img src="/images/features/deal.png" class="make-center" alt="Feature">
				</div>
				<h6>PROMOVER</h6>
				<p>Seja nosso afiliado, divulgue nossos cursos e ganhe comissão. Fácil assim. (EM BREVE...)</p>
				
			</div>
		</div>
	</div>

</section>	
<section id="destaques">
	<div class="container popular">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3><b>Destaques</b></h3>
				<div class="scrolldown-placeholder">
					<span class="popular-scrolldown"><i class="zmdi zmdi-chevron-down zmdi-hc-lg"></i></span>
				</div>
			</div>
		</div>
		<div class="row tutorials">

			@foreach($destaques as $D)

			<div class="col-md-3">
				<div class="tutorial">
					@if(is_null($D->curso_imagem))
					<a href="/Curso/Detalhes/{{ $D->curso_id }}">
						<div style="background:url(/images/nopicture.jpg) no-repeat center center;background-size: 100%; height:250px" class="resp-img" alt="{{ $D->nome }}"></div>
					</a>
					@else
					<a href="/Curso/Detalhes/{{ $D->curso_id }}">
						<div style="background:url(/uploads/cursos/{{ $D->curso_imagem }}) no-repeat center center;background-size: 100%; height:250px" class="resp-img" alt="{{ $D->nome }}"></div>
					</a>
					@endif
					<div class="tutorial-details">
						<a href="/Curso/Detalhes/{{ $D->curso_id }}">
							<h6 style="min-height:50px">{{ $D->curso_nome }} <br>R$ {{ $D->curso_valor }}</h6>						
						</a>
						<p class="abs" style="min-height:100px">{{ mb_strimwidth($D->curso_descricao, 0, 150, '...') }}</p> 
						
						<br><br>					
						<div class="teacher text-center">
							<div class="imgcontainer">								
								<img @if($D->instrutor_foto == '') src="/assets/img/nopicture.png"  @else src="/uploads/usuarios/{{$D->instrutor_foto}}" @endif style="width:50px;height: 50px;border-radius:50%;" alt="">
							</div>
							<a href="#">{{$D->instrutor_nome}}</a>
						</div>
						
						<a href="/Curso/Detalhes/{{ $D->curso_id }}" class="greybutton">Abrir o Curso</a>
					</div>					
				</div>
			</div>
			@endforeach

			

		</div>
	</div>
</section>
<section id="os_mais_procurados">
	<div class="container-fluid signup text-center">
		<div class="row">
			<div class="col-sm-12">
				<p style="color:#ffffff">Cadastre-se agora!</p>
				<h4>e estude onde quiser!</h4>
				<a href="/Aluno/Adicionar" class="bluebutton">Quero aprender!</a>
			</div>
		</div>
	</div>

	<div class="container popular">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3><b>Os Mais Procurados</b></h3>
				<div class="scrolldown-placeholder">
					<span class="popular-scrolldown"><i class="zmdi zmdi-chevron-down zmdi-hc-lg"></i></span>
				</div>
			</div>
		</div>
		<div class="row tutorials">
			@foreach($procurados as $D)
			<div class="col-md-3">
				<div class="tutorial">
					@if(is_null($D->curso_imagem))
					<a href="/Curso/Detalhes/{{ $D->curso_id }}">
						<div style="background:url(/images/nopicture.jpg) no-repeat center center;background-size: 100%; height:250px" class="resp-img" alt="Tutorial"></div>
					</a>
					@else
					<a href="/Curso/Detalhes/{{ $D->curso_id }}" >
						<div style="background:url(/uploads/cursos/{{ $D->curso_imagem }}) no-repeat center center;background-size: 100%; height:250px" class="resp-img" alt="Tutorial"></div>
					</a>
					@endif
					<div class="tutorial-details">
						<a href="/Curso/Detalhes/{{ $D->curso_id }}">
							<h6 style="min-height:50px">{{ $D->curso_nome }}  <br>R$ {{ $D->curso_valor }}</h6>
						</a>
						<p class="abs" style="min-height:100px">{{ mb_strimwidth($D->curso_descricao, 0, 150, '...') }}</p>

						<br><br>					
						<div class="teacher text-center">
							<div class="imgcontainer">								
								<img @if($D->instrutor_foto == '') src="/assets/img/nopicture.png"  @else src="/uploads/usuarios/{{$D->instrutor_foto}}" @endif style="width:50px;height: 50px;border-radius:50%;" alt="">
							</div>
							<a href="#">{{$D->instrutor_nome}}</a>
						</div>

						<a href="/Curso/Detalhes/{{ $D->curso_id }}" class="greybutton">Abrir o Curso</a>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>

	<br><br>
</section>


</main>


@endsection

@section('scripts')
<script>
	$('#index3').removeClass('page');
	$('#index3').addClass('homepage');
	$('#homeSlider').show();
	$('#homeText').show();
</script>

<script>

	$(document).ready(function() {

		$(window).on("scroll", function() {

			var fromTop = $(window).scrollTop();
			if(fromTop > 1){
				$('#index3').removeClass('homepage');
				$('#index3').addClass('page');
				$('#homeSlider').fadeOut(100);
				$('#homeText').fadeOut(100);
			}else{

				$('#index3').removeClass('page');
				$('#index3').addClass('homepage');
				$('#homeSlider').fadeIn(500);
				$('#homeText').fadeIn(500);
			}



		});
	});

</script>

@endsection