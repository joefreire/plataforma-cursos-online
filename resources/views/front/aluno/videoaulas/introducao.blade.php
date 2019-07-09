@extends('layouts.videoaulas')
@section('title', 'Assistir')

@section('content')

<div class="title-ct">
    <h3><strong>Avaliação</strong></h3>    
</div>

<div class="question-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="question-content" style="min-height:unset;">
                <h4 class="md">Introdução</h4>
                <p><p>{!! nl2br($curso->definicao_prova) !!}</p></p>
                <div class="form-action">
                    <a href="/Aluno/Prova/{{$curso->id}}" class="mc-btn btn-style-1">Iniciar Prova</a>                    
                </div>
            </div>            
        </div>


        
    </div>
</div>

@endsection