@extends('layouts.instrutor')

@if (isset($curso))
@section('title', 'Editar Curso')
@else
@section('title', 'Cadastrar Curso')
@endif

@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-books position-left"></i>
			@if (isset($curso))
			<a href="/Instrutor/Cursos/">{{ $curso->nome }}</a> >
			Editar Curso
			@else
			Cadastrar Curso
			@endif
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection

@section('content')

@if (Session::has('errors'))
@foreach ($errors->all() as $error)
<div class="alert alert-danger" align="center">
	<span>
		<b> Erro! </b>{{ $error }}
	</span>
</div>
@endforeach
@endif

<div class="row">
	<div class="col-md-12 col-sm-12">

		<!-- Basic inputs -->
		<div class="card card-inverse">
			<div class="card-header">
				<div class="card-title">@if(isset($curso)) Editar Curso @else Novo Curso @endif</div>
			</div>
			<div class="card-block">
				<form method="POST" enctype="multipart/form-data" 
				@if(isset($curso))
				action="/Instrutor/Curso/Atualiza/{{ $curso->id }}"
				@else 
				action="/Instrutor/Curso/Criar"
				@endif>
				{{ csrf_field() }}
				<div class="form-group row">
					<label class="control-label col-lg-3">Nome</label>
					<div class="col-lg-9">
						<input name="nome" id="nome" type="text" class="form-control" @if(isset($curso)) value="{{ $curso->nome }}" @endif placeholder="">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Subtitulo</label>
					<div class="col-lg-9">
						<input name="subtitulo" id="subtitulo" type="text" class="form-control" @if(isset($subtitulo)) value="{{ $curso->subtitulo }}" @endif placeholder="">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Descrição</label>
					<div class="col-lg-9">
						<textarea name="descricao"  id="descricao" rows="5" class="form-control">@if(isset($curso)){{ $curso->descricao }}@endif</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Valor (R$)</label>
					<div class="col-lg-9">
						<input name="valor" type="text" class="form-control money" @if(isset($curso)) value="{{ $curso->valor }}" @endif placeholder="R$ 0,00">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Comissão (%)</label>
					<div class="col-lg-9">
						<input name="comissao" type="text" class="form-control percent" @if(isset($curso)) value="{{ $curso->comissao }}" @endif placeholder="0,00 %">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Categoria</label>
					<div class="col-lg-9">
						<select id="demo-select2-1" name="categoria_id" class="form-control" required="required">
							<option value="" disabled selected>Selecione uma Categoria</option>

							@foreach ($categorias as $C)
							<option @if(isset($curso) && $curso->categoria_id == $C->id) selected @endif value="{{$C->id}}">{{$C->nome}}</option>
							@if(isset($curso))
							@php
							SUBCATEGORIA_SELECT($C->id, $C->nome, $curso->categoria_id);
							@endphp
							@else
							@php
							SUBCATEGORIA_SELECT($C->id, $C->nome, '0');
							@endphp
							@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Nível</label>
					<div class="col-lg-9">
						<select id="demo-select2-1" name="nivel" class="form-control">
							<option value="">Selecione um Nível</option>
							<option value="Iniciante" @if(isset($curso) && $curso->nivel == 'Iniciante') selected @endif>Iniciante</option>
							<option value="Médio" @if(isset($curso) && $curso->nivel == 'Médio') selected @endif>Médio</option>
							<option value="Avançado" @if(isset($curso) && $curso->nivel == 'Avançado') selected @endif>Avançado</option>                                  									
						</select>
					</div>
				</div>
				<div class="form-group row" style="display:none;">
					<label class="control-label col-lg-3">Duração</label>
					<div class="col-lg-9">
						<input name="duracao" type="text" class="form-control" @if(isset($curso)) value="{{ $curso->duracao }}" @endif placeholder="1h 30min">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Foto de Capa</label>
					<div class="col-lg-9">
						<div class="uploader">
							<input type="file" name="file" class="file-styled-icon">
							<span class="action" style="user-select: none;"><i class="icon-folder2"></i></span>
						</div>
						@if(isset($curso) && $curso->imagem != '') 	

						<div class="alert alert-success" style="margin-top: 15px;">
							Imagem Atual
						</div>						
						<img src="/uploads/cursos/{{ $curso->imagem }}" class="img-responsive" style="    max-width: 100%;">							
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Video de Introdução</label>
					<div class="col-lg-9">
						<div id="progress-container" class="progress" style="display:none;">
							<div id="progress" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">&nbsp;0%
							</div>
						</div>
						<div class="uploader">
							<input id="browse" type="file" class="file-styled-icon">
							<span class="action" style="user-select: none;"><i class="icon-folder2"></i></span>
							<div class="col-md-12">
								<div id="results"></div>
							</div>
							<input type="hidden" id="video" name="video">
							
						</div>
						@if(isset($curso) && $curso->video != '')
						@if($vimeo_status == 'complete')
						<div data-vimeo-id='{{{$curso->video}}}' data-vimeo-width="640" id="handstick"></div>
						@elseif($vimeo_status == 'Sem video')                    
						<div class="alert alert-danger" style="margin-top: 15px;"> 
							Esse arquivo de video não existe
						</div>
						@else
						<div class="alert alert-success" style="margin-top: 15px;"> 
							Seu video está sendo codificado, aguarde uns instantes
						</div>
						@endif
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-lg-3">Introdução da Prova</label>
					<div class="col-lg-9">
						<textarea name="definicao_prova"  id="definicao_prova" rows="5" class="form-control">@if(isset($curso)){{ $curso->definicao_prova }}@endif</textarea>
					</div>
				</div>
				<button id="envio" class="btn btn-primary btn-sm pull-right" type="submit" style="float: right;">Enviar</button>
			</form>
		</div>
	</div>
	<!-- /Basic inputs -->
</div>
</div>

@endsection

@section('scripts')
<script src="/instrutor/lib/js/pages/forms/form_inputs_basic.js"></script>
<script src="{{ asset('/js/jquery.mask.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.money').mask('000.000.000.000.000,00', {reverse: true});
		$('.percent').mask('99,99', {reverse: true});
	});
</script>

<script src="https://player.vimeo.com/api/player.js"></script>
<script src="{{ asset('/js/vimeo-upload.js') }}"></script>

<script type="text/javascript">

        /**
         * Called when files are dropped on to the drop target or selected by the browse button.
         * For each file, uploads the content to Drive & displays the results when complete.
         */
         function handleFileSelect(evt) {
         	evt.stopPropagation()
         	evt.preventDefault()
         	var files = evt.dataTransfer ? evt.dataTransfer.files : $(this).get(0).files
         	var results = document.getElementById('results')
         	$("#browse").prop("disabled",true);
         	$("#envio").prop("disabled",true);
         	$("#envio").html("Aguarde o envio do video");
         	/* Clear the results div */
         	while (results.hasChildNodes()) results.removeChild(results.firstChild)
         		/* Rest the progress bar and show it */
         	updateProgress(0)
         	document.getElementById('progress-container').style.display = 'block'
         	/* Instantiate Vimeo Uploader */
         	;(new VimeoUpload({
         		//name: document.getElementById('nome').value,
         		//description: document.getElementById('descricao').value,
         		file: files[0],
         		token: 'f021b6a57c4c84c92d07683b3bdf9c44',
         		onError: function(data) {
         			console.log(data)
         			showMessage('<strong>Error</strong>: ' + JSON.parse(data).error, 'danger')
         		},
         		onProgress: function(data) {
         			updateProgress(data.loaded / data.total)
         		},
         		onComplete: function(videoId, index) {

         			$("#video").val(videoId)
         			var url = 'https://vimeo.com/' + videoId
         			if (index > -1) {
         				/* The metadata contains all of the uploaded video(s) details see: https://developer.vimeo.com/api/endpoints/videos#/{video_id} */
                        url = this.metadata[index].link //
                        /* add stringify the json object for displaying in a text area */
                        var pretty = JSON.stringify(this.metadata[index], null, 2)
                        console.log(pretty) 
                    }
                    if(pretty != undefined 
                    	&& pretty.status == "available"
                    	&& pretty.transcode == "complete"){
                    	showMessage('<strong>Upload feito com sucesso</strong>.')
                    var vimeovideo = '<div data-vimeo-id="" data-vimeo-width="640" id="handstick"></div>';
                    $('#progress-container').append(vimeovideo)
                }else{
                	showMessage('<strong>Upload feito com sucesso, seu video está sendo processado</strong>.')
                }
                $("#envio").prop("disabled",false);
                $("#envio").html("ENVIAR");
                /**/
            }
        })).upload()
         	/* local function: show a user message */
         	function showMessage(html, type) {
         		/* hide progress bar */
         		document.getElementById('progress-container').style.display = 'none'
         		/* display alert message */
         		var element = document.createElement('div')
         		element.setAttribute('class', 'alert alert-' + (type || 'success'))
         		element.innerHTML = html
         		results.appendChild(element)
         	}
         }
        /**
         * Dragover handler to set the drop effect.
         */
         function handleDragOver(evt) {
         	evt.stopPropagation()
         	evt.preventDefault()
         	evt.dataTransfer.dropEffect = 'copy'
         }
        /**
         * Updat progress bar.
         */
         function updateProgress(progress) {
         	progress = Math.floor(progress * 100)
         	var element = document.getElementById('progress')
         	element.setAttribute('style', 'width:' + progress + '%')
         	element.innerHTML = '&nbsp;' + progress + '%'
         }
        /**
         * Wire up drag & drop listeners once page loads
         */
         document.addEventListener('DOMContentLoaded', function() {
         	var browse = document.getElementById('browse')
         	browse.addEventListener('change', handleFileSelect, false)
         })
     </script>
     @endsection