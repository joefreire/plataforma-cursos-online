@extends('layouts.videoaulas')
@section('title', 'Prova')

@section('content')

<div class="question-content-wrap">
<div class="row">
<div class="col-md-12">

    <form action="/Aluno/FinalizarProva/{{$curso->id}}">

    @if (isset($questoes))
    @foreach($questoes as $i=>$q)
    <div class="question-content" style="min-height: unset; padding: 30px 30px 10px 60px;">
        <h4 class="sm">Questão {{++$i}}</h4>
        <p>{!! nl2br($q->enunciado) !!}</p>
        <div class="answer">
            <h4 class="sm">Respostas</h4>
            <ul class="answer-list">

                @php
                    $alternativas = DB::table('alternativas')->where('questao_id', $q->id)->get();
                @endphp

                @foreach($alternativas as $j=>$a)
                <li>                    
                    <input type="radio" name="radio_{{$i}}" id="radio-{{$i}}{{++$j}}" value="{{ $j }}">
                    <label for="radio-{{$i}}{{$j}}">
                        <i class="icon icon_radio"></i>
                        {{$a->descricao}}
                    </label>
                </li>
                @endforeach                
            </ul>
        </div>        
    </div>
    @endforeach
    @endif

        <button type="submit" class="mc-btn btn-style-1" style="float:right; margin-right: 30px;">Finalizar Prova</button>
    </form>
</div>
</div>
</div>
@endsection