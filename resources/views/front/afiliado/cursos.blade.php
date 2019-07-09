@extends('layouts.front')
@section('title', 'Dashboard')

@section('content')

<div class="page-heading text-center">
    <div class="container">
        
        <h2>CURSOS</h2>
        
    </div>
</div>

<!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="">
            
         
                
        <div class="container courses-browse popular no-gutters">		        	

		<div class="row">
			
			
			<div class="col-sm-12">
				

					@if($cursos->count() == 0)
						<h3 align="center">Nenhum curso foi encontrado!</h3>
					@endif

					@foreach($cursos as $c)

				
					<div class="row tutorial">
						<div class="col-sm-2">
							<img src="/uploads/cursos/{{$c->imagem}}" class="resp-img" alt="">
						</div>
						<div class="col-sm-10">
							<div class="tutorial-details">
								<div class="pull-right fav">
									<span style="font-size:20pt;">R$ {{$c->valor}}</span>
									@if(isset(Auth::user()->id) && Auth::user()->tipo == 3)
									@if(isset($c->comissao)) <p class="abs"><b>COMISSÃO:</b> <span style="font-size:10pt;">R$  {{ CALCULAR_COMISSAO($c->valor, $c->comissao) }} </span></p>@endif
									@endif
								</div>
								<h6>{{$c->curso_nome}}</h6>					

								<p class="abs">
									<b>Link de compartilhamento:</b><br><span style="font-size:20px;">{{ env('APP_URL').'/Afiliado/'.base64_encode($c->id.'-'.Auth::user()->id) }}</span>
								</p>
																
								
							</div>                
						</div>
					</div>
					
				
					

					@endforeach
					
					
					<br>
				
			</div>
		</div>

	</div>
                   
             

        </div>
    </section>
    <!-- END / COURSE CONCERN -->

  
@endsection

@section('scripts')


<script type="text/javascript" src="js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

<script type="text/javascript">

    $.each($('.table-wrap'), function() {
        $(this)
            .find('.table-item')
            .children('.thead:not(.active)')
            .next('.tbody').hide();
        $(this)
            .find('.table-item')
            .delegate('.thead', 'click', function(evt) {
                evt.preventDefault();
                if ($(this).hasClass('active')==false) {
                    $('.table-item')
                        .find('.thead')
                        .removeClass('active')
                        .siblings('.tbody')
                            .slideUp(200);
                }
                $(this)
                    .toggleClass('active')
                    .siblings('.tbody')
                        .slideToggle(200);
        });
    });

</script>

@endsection