@extends('layouts.videoaulas')
@section('title', 'Assistir')

@section('content')

@if(isset($aula))
<div class="title-ct">
    <h3><strong>{{$aula->aula_nome}}</strong><br>{{$aula->modulo_nome}}</h3>

    @if(Auth::user()->tipo != 0)
    <div class="tt-right">
        <form id="form-marcar" action="/Aluno/MarcarAssistido/{{$aula->aula_id}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{$aula->aula_id}}" name="aula_id">
            @if(isset($proxima_aula))
            <input type="hidden" value="{{$proxima_aula}}" name="proxima_aula">
            @endif
            <input type="checkbox" @if(isset($assistido)) checked="" @endif id="markaslearned" name="visualizado" onclick="$('#form-marcar').submit();">
            <label for="markaslearned">
                Marque como assistido
                <i class="icon md-check-2"></i>
            </label>
        </form>
    </div>

    @endif

</div>
<div class="abc">
   <div class='embed-container'>
    @if(isset($aula) && $aula->aula_video != '')
    @if($vimeo_status == 'complete')
    <div data-vimeo-id='{{{$aula->aula_video}}}' data-vimeo-width="640" id="player_{{{$aula->aula_video}}}"></div>
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

@php
$materiais_ = DB::table('materiais')->where('aula_id', $aula->aula_id)->get();           
@endphp

@if(count($materiais_) > 0)
<div class="download">
    <a href="/Aluno/Material/Baixar/{{ $aula->aula_id }}"  style="margin-left: 35px; color:black;"><i class="icon md-download-1" style="font-size:16pt;"></i>
        <div class="download-ct">
            <span>Baixar Material</span>
        </div></a>        
    </div>                                                                    
    @endif

    @endif


    @endsection
    @section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var player = new Vimeo.Player($('#player_{{{$aula->aula_video}}}'));
            player.on('ended', function() {
                $("#form-marcar").submit();
            });

        });
    </script>
    @endsection