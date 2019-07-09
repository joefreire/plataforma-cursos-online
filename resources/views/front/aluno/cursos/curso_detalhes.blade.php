@extends('layouts.front')
@section('title', $curso->nome)
@section('style')
<style>
.embed-container {
   position: relative; 
   padding-bottom: 46.25%; 
   height: 0;
   overflow: hidden; 
   max-width: 80%; 
}
.embed-container iframe, .embed-container object, .embed-container embed { 
    position: absolute;
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
}
.descricao_aula_mostra{
    display: block;
}
.descricao_aula_oculta{
    display: none;
}
.seta_down::before{
    content: "\25bc"!important;
    color: #18c967!important;
}
</style>
@endsection
@section('content')

<main>
    <div class="title">
        <div class="title-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>{{ $curso->nome }}</h2>
                    <p class="text-muted" style="margin-bottom: 1%;color: white; font-size: 17px;"><em>{{ $curso->subtitulo }}</em></p>

                </div>
            </div>
        </div>
    </div>

    @if (Session::has('message'))
    <div class="alert alert-success" align="center" style="margin:0; text-align:center">{{ Session::get('message') }}</div>
    @endif

    <div class="page-heading text-center" style="background-color:#dadfe2;padding-top: 20px;">
        <div class="container">

            <div align="center">
                @if($curso->video !='')
                <div class='embed-container'>
                    <div data-vimeo-id='{{{$curso->video}}}'                         
                        id="handstick">                        
                    </div>
                </div>

                @else
                <img src="/uploads/cursos/{{ $curso->imagem }}" alt="Course" class="resp-img course-preview img-course">
                @endif
            </div>

            <div align="center" class="order text-center" style="box-shadow:none;">
                <div align="center">
                    @if($curso->valor > 0)
                    @if($ok == 0)
                    <form method="post" action="/carrinho">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_Curso" value="{{$curso->id}}"/>
                        <input type="submit" style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" class="greybutton" value="Adquirir Curso"/>
                    </form>
                    @else
                    <a style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" href="#" class="greybutton">Curso Já Adquirido</a>
                    @endif

                    @else
                    @if($ok == 0)
                    <form method="post" action="/carrinho">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_Curso" value="{{$curso->id}}"/>
                        <input type="submit" style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" class="greybutton" value="Adquirir Curso"/>
                    </form>

                    @else
                    <a style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" href="#" class="greybutton">Curso Já Adquirido</a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="class-details">
                    <h3 style="color: #2ecc71">Descrição do Curso</h3>

                    <span class="lessons"><i class="zmdi zmdi-assignment"></i>{{ $modulos->count() }} Módulos</span>
{{--                     <span class="duration"><i class="zmdi zmdi-time"></i>3:15h</span>
<span class="views"><i class="zmdi zmdi-eye"></i>2241 VIEWS</span> --}}
<span class="tag"><i class="zmdi zmdi-label"></i>{{ $curso->categoria->nome }}</span>
<p class="abs">
    {{ $curso->descricao }}                                
</p>
</div>


@if(Auth::user() != null && Auth::user()->tipo == '3')
<p class="abs">                                
    <b>Link de compartilhamento:</b><br><span style="font-size:20px;">{{ config('app.APP_URL').'/Afiliado/'.base64_encode($curso->id.'-'.Auth::user()->id) }}</span>
</p>
@endif


<h4 style="color: #2ecc71;">Conteúdo do Curso</h4>
<ul class="course-accordion">	

    @foreach($modulos as $M)
    <li id="menu_modulos" class="accordion-option">	
        <div class="option-title">{{ $M->nome }}</div>
        <div class="option-wrapper">
            <ul class="option-items">

                @php
                $aulas = DB::table('aulas')->where('modulo_id', $M->id)->get()
                @endphp

                @foreach($aulas as $A)
                <li class="option-item aula_id">
                    @if(!empty(Auth::user()))
                    <a href="#" class="aula">{{ $A->nome }} @if($A->gratis == '1')<a id="btn_aula_gratis-{{ $A->id }}" data-toggle="modal" data-target="#myModal-aula-{{ $A->id }}" style="float:right; margin-right: 15px;" onclick="$('#aula_assistir_gratis').val('{{ $A->id }}')"> Assistir Aula Grátis </a> @endif</a>
                    @else
                    <a href="#" class="aula">{{ $A->nome }} @if($A->gratis == '1')<a id="btn_aula_gratis-{{ $A->id }}" style="float:right; margin-right: 15px;" href="/Aluno/Adicionar"> Assistir Aula Grátis </a> @endif</a>  
                    @endif
                    <div class="descricao_aula descricao_aula_oculta" style="padding-left: 2%;">
                        <p>{{ $A->descricao }}</p>
                    </div>
                </li>

                @endforeach
            </ul>
        </div>
    </li>
    @endforeach


</ul>

<br><br>

<div class="pros" style="width:100%; margin-bottom:20px;box-shadow:none;display: flex;">
    <div class="teacher" >
        <div class="imgcontainer" style="box-shadow:none;">
            <!--<img src="/images/avatars/2.png" alt="Avatar">-->

            <img @if( $curso->foto == '' ) src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $curso->foto }}" @endif alt="{{ $curso->name }}"
            style="width:130px; height:130px;">

        </div>
    </div>

    <div >
        <h4 style="font-size: 20px;margin:0;"><small>Sobre o Professor</small><br>{{ $curso->name }}</h4>

        <span>{{ $curso->observacoes }}</span>

    </div>


</div>




<div class="pros col-md-12" style="background:#e4e4e4;box-shadow:none;">

    <h4 style="text-align:-webkit-center;font-size:20px;color:#444444">O QUE NOSSOS ALUNOS ESTÃO FALANDO</h4>

    <div class="col-md-6">    
        <div class="rating" style="pointer-events: none;margin-top:-3px;">
            <h5 style="color:#444444">Classificação Média</h5>
            <h2 style="color:#444444; margin:0;">{{ round($curso->stars) }}</h2>
            @php
            for($i=0;$i<$curso->stars;$i++){
                echo '<a href="#" class="on"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
            }

            for($i=0;$i<(5 - $curso->stars);$i++){
                echo '<a href="#"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
            }

            @endphp

        </div>
    </div>

    <div class="col-md-6">
        <h5 style="color:#444444; margin-left:-15px;">Detalhes</h5>

        @php
        $total_votos = count($comentarios);
        @endphp

        @for($i=1;$i<6;$i++)

        @php
        $calc = DB::table('comentarios')->where('curso_id', $id)->where('rating', (6 - $i))->count();
        if($calc == 0 || $total_votos == 0){
            $porc = 0;
        }else{
            $porc = ($calc * 100) / $total_votos;
        }

        @endphp

        <div class="row">
            <b style="float:left; margin-right:10px;">{{ (6 - $i) }} @if($i == 5) Estrela &nbsp; @else Estrelas @endif</b>
            <div class="progress" style="float:left;width:70%;">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $porc }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $porc }}%"></div>
            </div>
            <b style="float:left; margin-left:10px;">{{ round($porc) }}%</b>
        </div>
        @endfor





    </div>

    <div class="col-md-12"> 

        @foreach($comentarios as $C)

        @php
        $u = DB::table('users')->where('id', $C->aluno_id)->first();
        @endphp

        <div class="comment clearfix">	
            <img width="50" height="50" style="width:50px; height:50px;" @if($u->foto == '') src="/images/offer1.png" @else src="/uploads/usuarios/{{ $u->foto }}" @endif alt="Avatar" class="pull-left">
            <a href="#">{{ $u->name }}</a>
            <span class="postedon">{{ date('d/m/Y',  strtotime($C->data)) }}</span>

            <p class="abs">
                {{ $C->comentario }}
            </p>

            <div class="rating" style="pointer-events: none;margin-top:-3px;">
                @php
                for($i=0;$i<$C->rating;$i++){
                    echo '<a href="#" class="on"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
                }

                for($i=0;$i<(5 - $C->rating);$i++){
                    echo '<a href="#"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
                }

                @endphp
            </div>
        </div>

        @endforeach

        <div style="left: 50%;position: absolute;margin-top: 20px;">{{ $comentarios->links() }}</div>


        <h4 style="margin-top: 70px;">Deixe seu comentário!</h4>
        @if(Auth::user())
        <form class="contact" style="margin:0;" method="POST" action="/Curso/Detalhes/{{ $id }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12" align="center">
                    <label class="req">Avalie nosso curso!</label>
                    <select id="example" name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="req">Mensagem</label>
                    <textarea name="mensgem" placeholder="Deixe uma mensagem..." required></textarea>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <button type="submit" class="greybutton">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <a href="/Aluno/Logar" class="register">Efetue o Login para Comentar</a><br><br>
        @endif
    </div>
</div>

</div>

<div class="col-md-12">
    <h4 style="text-align:-webkit-center;font-size:20px;color:#444444">INVESTIMENTO</h4>
    <div align="center" class="order text-center" style="box-shadow:none;">
        @if($curso->valor > 0)
        <p class="price" style="margin-top:-20px;">
            <small style="font-size:20px;">R$</small>{{ $curso->valor }}
        </p>                
        <p class="price">
            <small style="font-size:12px;">em até 12x</small>
            {{--        {{ number_format(($curso->valor / 12), 2, '.', '') }} --}}
        </p>
        <div align="center">
            @if($ok == 0)
            <form method="post" action="/carrinho">
                {{ csrf_field() }}
                <input type="hidden" name="id_Curso" value="{{$curso->id}}"/>
                <input type="submit" style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" class="greybutton" value="Adquirir Curso"/>
            </form>
            @else
            <a style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" href="#" class="greybutton">Curso Já Adquirido</a>
            @endif

            @else

            <p class="price" style="font-size:55px;">Grátis!!!</p>
            <div align="center">
                @if($ok == 0)
                <form method="post" action="/carrinho">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_Curso" value="{{$curso->id}}"/>
                    <input type="submit" style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" class="greybutton" value="Adquirir Curso"/>
                </form>

                @else
                <a style="border-radius:20px;width:300px;font-size:22px;font-weight:700;" href="#" class="greybutton">Curso Já Adquirido</a>
                @endif
                @endif

                <br>
                <img src="/compra_segura.png"/>

            </div>
        </div>

    </div>
</div>
</div>
</div>


</main>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">
                <p>Informe seu email para acessar as aulas gratuitas!</p>
                <br>
                <form action="/newsletter" method="POST">
                    {{ csrf_field() }}
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required="" autofocus="">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>	
                    <input type="hidden" id="aula_assistir_gratis" name="aula_assistir_gratis">
                </form>

            </div>

        </div>

    </div>
</div>
@if(!empty(Auth::user()))
@foreach($modulos as $M)

@php
$aulas = DB::table('aulas')->where('modulo_id', $M->id)->get()
@endphp

@foreach($aulas as $A)

@if($A->gratis == '1')

<!-- Modal -->
<div id="myModal-aula-{{ $A->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">
                <p><b>{{ $A->nome }}</b> - Aula Grátis!</p>

                <div class="video embed-responsive embed-responsive-16by9">
                    <div data-vimeo-id='{{$A->video}}'                         
                        id="handstick">                        
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endif

@endforeach
@endforeach

@endif
@endsection

@section('scripts')

<script>
    $('#index3').attr('id', 'course-single');
</script>

@if(Session::has('aula_assistir_gratis'))
<script>
    $('#btn_aula_gratis-{{ Session::get("aula_assistir_gratis") }}').click();
</script>
@endif


<script src="/stars/jquery.barrating.min.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script type="text/javascript">
    $(function() {
        $('.aula').on('click', function(e){
            e.preventDefault();
            if($(this).nextAll('.descricao_aula').hasClass('descricao_aula_mostra')){
                $(this).nextAll('.descricao_aula').removeClass('descricao_aula_mostra').addClass('descricao_aula_oculta')
                $(this).parent().removeClass('seta_down')
            }else if($(this).nextAll('.descricao_aula').hasClass('descricao_aula_oculta')){
                $(this).nextAll('.descricao_aula').removeClass('descricao_aula_oculta').addClass('descricao_aula_mostra')
                $(this).parent().addClass('seta_down')
            }
            
        });
        $('#example').barrating({
            theme: 'fontawesome-stars'
        });

    });
</script>
@endsection