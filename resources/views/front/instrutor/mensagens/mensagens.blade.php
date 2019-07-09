@extends('layouts.instrutor')
@section('title', 'Mensagens')

@section('header')

<!-- Page header -->
<div class="header">
	<div class="header-content">
		<div class="page-title">
			<i class="icon-envelope position-left"></i>
			Mensagens
		</div>		
	</div>
</div>
<!-- /Page header -->
@endsection


@section('content')

<ul id="lista" class="card media-list media-list-linked media-list-bordered emails-list no-bt" style="">

    @if(isset($mensagens))
    @foreach($mensagens as $m)

    <li class="media bl-xlg bl-info cursor-pointer" onclick="clicar_mensagem('{{$m->id}}')">
        <div class="media-link">
            <div class="media-left">
                <img @if($m->foto == '')
                        src="/assets/img/nopicture.png" 
                        @else 
                        src="/uploads/usuarios/{{$m->foto}}"
                    @endif                                         
                    class="rounded-circle" alt="">
            </div>

            @php
                $last = DB::table('mensagens')
                            ->where('de', Auth::user()->id)
                            ->where('para', $m->id)
                            ->orWhere('de', $m->id)
                            ->where('para', Auth::user()->id)
                            ->orderBy('data','desc')
                            ->first();
            @endphp

            <div class="media-body">
                <div class="media-heading">                    
                    {{$m->name}}
                </div>

                @if(isset($last))
                    {{$last->texto}}
                @endif

                <div class="media-options">                    
                    @if(isset($last))
                    <span class="date">{{ date('d/m/Y H:i:s',  strtotime($last->data)) }}</span>                    
                    @endif
                </div>
            </div>
        </div>
    </li>

    @endforeach
    @endif
</ul>

@if(isset($mensagens))
@foreach($mensagens as $msg)

<div id="message-{{$msg->id}}" class="card card-flat email" style="display:none">    
    <div class="card-block p-20">        
        <button type="button" style="float:right;" class="btn btn-secondary m-r-10 back" onclick="clicar_voltar('{{$msg->id}}')"><i class="icon-arrow-left13"></i></button>
        <ul class="media-list">

            @php
                $lista = DB::table('mensagens')
                            ->where('de', 10)
                            ->where('para', 22)
                            ->orWhere('de', 22)
                            ->where('para', 10)
                            ->join('users as u', 'u.id', '=', 'mensagens.de')                            
                            ->select('u.name as de_nome', 'u.foto as de_foto', 'mensagens.texto as texto',
                                     'mensagens.data as data')
                            ->get();                
            @endphp

            @if(isset($lista))
            @foreach($lista as $l)
            <li class="media">
                <div class="media-left p-r-15">
                    <img @if($l->de_foto == '')
                        src="/assets/img/nopicture.png" 
                        @else 
                        src="/uploads/usuarios/{{$l->de_foto}}"
                    @endif                                         
                    class="rounded-circle" alt="">
                </div>
                <div class="media-body">
                    <p class="m-b-0">{{$l->de_nome}}</p>
                    <p class="text-sm">{{$l->data}}</p>
                </div>                
            </li>
            <br>
            <p>{{$l->texto}}</p>    
            <hr>
            @endforeach
            @endif

        </ul>
        
        <form action="/Instrutor/Mensagens" method="post">
            {{ csrf_field() }}
            <div class="text-semibold m-t-10 m-b-5">Mensagem:</div> 
            <div class="form-group row">                                                                
                <div class="col-lg-12">
                    <textarea name="texto" rows="5" class="form-control" placeholder="Escreva aqui..."></textarea>                
                    <input name="de" type="hidden" value="{{$msg->de}}">
                    <input name="para" type="hidden" value="{{$msg->para}}" >
                </div>
            </div>     
            <button class="btn btn-primary btn-sm pull-right" type="submit" style="float: right;">Enviar</button>          
        </form>
    </div>
</div>

@endforeach
@endif

@endsection

@section('scripts')

<script>

    function clicar_mensagem(id){
        $('#lista').hide();
        $('#message-'+id).show();
    }

    function clicar_voltar(id){
        $('#message-'+id).hide();
        $('#lista').show();
    }

</script>

@endsection