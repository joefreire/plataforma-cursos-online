@extends('layouts.front')
@section('title', 'Verificar Certificado')
@section('titulo')
    <div class="title">
        <div class="title-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>VERIFICAR CERTIFICADO</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

<main>
	<div class="container success">		
		<form class="contact" method="POST" action="/verificar">
			{{ csrf_field() }}

			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<label class="req">Número de Registro</label>
					<input type="text" name="numero" required="">
					<div class="pull-right">
						<button type="submit" class="greybutton">Verificar</button>
					</div>
				</div>							
			</form>
		</div>	
		@if(isset($certificado))
		<div style="text-align:center;">
			@if($certificado == "Sem Registros")
				Sem certificado com esse registro
			@else
			O aluno <b>{{ $certificado->aluno_nome }}</b> concluiu com êxito <br>
			o curso <b>{{ $certificado->curso_nome }}</b> na data <b>@if(!empty($certificado->data)){{ date('d/m/Y', strtotime($certificado->data)) }}@else {{ date('d/m/Y', strtotime($certificado->updated_at)) }} @endif</b>.
			@endif
		</div>
		@endif


	</main>

	
	@endsection
