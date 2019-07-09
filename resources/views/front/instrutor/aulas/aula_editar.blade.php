@extends('layouts.instrutor')

@if(isset($aula))
@section('title', 'Editar Aula')
@else
@section('title', 'Cadastrar Aula')
@endif


@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-video-camera position-left"></i>
			<a href="/Instrutor/Cursos/">{{$modulo->curso->nome}}</a> >
			<a href="/Instrutor/Curso/Modulo/{{ $modulo_id }}">{{$modulo->nome}}</a> >

			@if(isset($aula))
			Editar Aula
			@else
			Cadastrar Aula
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

				<div class="card-title">@if(isset($aula)) Editar Aula @else Nova Aula @endif</div>
			</div>
			<div class="card-block">
				<form method="POST"

				@if(isset($aula))						
				action="/Instrutor/Curso/Modulo/{{ $modulo_id }}/Atualiza-Aula/{{ $aula->id }}"
				@else 
				action="/Instrutor/Curso/Modulo/{{ $modulo_id }}/Salvar-Aula"
				@endif enctype="multipart/form-data" >

				{{ csrf_field() }}

				<div class="form-group row">
					<label class="control-label col-lg-3">Curso / Módulo</label>
					<div class="col-lg-9">
						<input readonly name="modulo_id" type="text" class="form-control" 
						@if(isset($modulo) && isset($curso)) value="{{$curso->nome}} / {{$modulo->nome}}" @endif>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Nome</label>
					<div class="col-lg-9">
						<input name="nome" type="text" class="form-control" @if(isset($aula)) value="{{ $aula->nome }}" @endif>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-lg-3">Descrição</label>
					<div class="col-lg-9">
						<textarea name="descricao" rows="5" class="form-control">@if(isset($aula)){{ $aula->descricao }}@endif</textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-lg-3">Video aula</label>
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
                       @if(isset($aula) && $aula->video != '')             
                       @if($vimeo_status == 'complete')
                       <div data-vimeo-id='{{{$aula->video}}}' data-vimeo-width="640" id="handstick"></div>
                       @else
                       <div class="alert alert-success" style="margin-top: 15px;"> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        Seu video está sendo codificado, aguarde uns instantes
                    </div>
                    @endif
                    @endif
                </div>
            </div>
            <div class="form-group row">
             <label class="control-label col-lg-3">Ordem</label>
             <div class="col-lg-9">
              <input type="number" name="ordem" min="0" required class="form-control" @if(isset($aula)) value="{{ $aula->ordem }}" @endif>
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
         	$("#envio").html("Aguarde o envio do video");
         	$("#envio").prop("disabled",true);
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