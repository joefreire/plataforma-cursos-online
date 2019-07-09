@extends('layouts.videoaulas')
@section('title', 'Prova')

@section('content')

<div class="question-content-wrap">
<div class="row">
<div class="col-md-12">

    
    <div class="question-content">
        
        @if (isset($pontuacao))    
        <div align="center">    
            <h4 class="sm"> @if($pontuacao >= 70) Sucesso! @else Que pena! @endif Você acertou:</h4>
            <h1>{{$pontuacao}}%</h1>
            <h4 class="sm">@if($pontuacao < 70) Tente novamente. @endif</h4>
            <a href="/Aluno/Dashboard" class="mc-btn btn-style-1">Concluir</a>            
        <div>        
        @endif
        
    </div>
</div>                  
</div>
</div>
@endsection