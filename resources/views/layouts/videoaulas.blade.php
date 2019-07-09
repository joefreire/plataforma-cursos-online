<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="/megacourse/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/megacourse/css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/megacourse/css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/megacourse/css/md-font.css">
    <link rel="stylesheet" type="text/css" href="/megacourse/css/style.css">
    {{--    <link rel="stylesheet" type="text/css" href="/plyr/plyr.css"> --}}
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <style type="text/css">
    .embed-container {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      max-width: 100%;
  }

  .embed-container iframe,
  .embed-container object,
  .embed-container embed {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
  }
  @media (max-width: 993px) {

      #logotinele{
          position: absolute;
          max-height: 40px;
          z-index: 100;
      }
      #nome_curso{
        margin-top: 42px!important;
    }
}

</style>
<title>@yield('title') - Tinele</title>
</head>
<body id="page-top">

    <!-- PAGE WRAP -->
    <div id="page-wrap">

        <div class="top-nav">



            <h4 class="sm black bold">
                <a href="/" style="float:left;"><img src="/images/logo.png" id="logotinele" alt="Logo" style="max-height: 40px;"></a>             
                <div class="row" style="float:left; margin-top: 10px;" id="nome_curso">
                    <a style="padding:15px; margin-left:15px;" >{{ $curso->nome}}</a>
                </div>
            </h4>

            <ul class="top-nav-list">
                @if(isset($aula_anterior))
                <li class="prev-course"><a href="/Aluno/Assistir/{{ $curso->id }}/{{ $aula_anterior->id }}"><i class="icon md-angle-left"></i></a></li>
                @endif
                @if(isset($proxima_aula))
                <li class="next-course"><a href="/Aluno/Assistir/{{ $curso->id }}/{{ $proxima_aula->id }}"><i class="icon md-angle-right"></i></a></li>
                @endif

                <li class="outline-learn active" >
                    <a href="#"><i class="icon md-list"></i></a>
                    <div class="list-item-body outline-learn-body">
                        @if(count($modulos)==0)
                        <div class="section-learn-outline">
                            <h5 class="section-title">Sem modulos Cadastrados</h5>
                            <ul class="section-list">     

                            </ul>
                        </div>
                        @endif
                        @foreach($modulos as $m)

                        <div class="section-learn-outline">
                            <h5 class="section-title">{{$m->nome}}</h5>
                            <ul class="section-list">

                                @php
                                $aulas = DB::table('aulas')
                                ->where('modulo_id', $m->id)                                                                                
                                ->select('aulas.nome as aula_nome', 'aulas.descricao as aula_descricao', 'aulas.id as id')
                                ->get();                                                                
                                @endphp

                                @foreach($aulas as $a)

                                @php
                                $assistido = DB::table('users_aulas')->where('user_id', Auth::user()->id)
                                ->where('aula_id', $a->id)
                                ->first();
                                @endphp

                                <!--<li @if(isset($aula) && $a->id == $aula->aula_id) class="o-view" @endif>-->
                                    <li @if(isset($assistido)) class="o-view" @endif>

                                        @php
                                        $materiais = DB::table('materiais')
                                        ->where('aula_id', $a->id)
                                        ->get();
                                        @endphp

                                        <div class="list-body">
                                            <a href="/Aluno/Assistir/{{$curso->id}}/{{$a->id}}">
                                                <h6>{{$a->aula_nome}}</h6>
                                                <p>{{$a->aula_descricao}}</p>
                                            </a>
                                        </div>
                                        <div class="download">
                                            <a href="/Aluno/Assistir/{{$curso->id}}/{{$a->id}}"><i class="fa fa-play-circle-o" style="font-size:20pt;"></i></a>                                                                                                            
                                            <div class="download-ct">
                                                <span>Assistir</span>
                                            </div>
                                        </div>

                                        @if(count($materiais) > 0)
                                        <div class="download" style="margin-right: 50px;">
                                            <a href="/Aluno/Material/Baixar/{{ $a->id }}"><i class="icon md-download-1" style="font-size:16pt;"></i></a>
                                            <div class="download-ct">
                                                <span>Baixar Material</span>
                                            </div>
                                        </div>                                                                    
                                        @endif

                                        <div class="div-x"><i class="icon md-check-2"></i></div>
                                    </li>
                                    @endforeach



                                </ul>
                            </div>

                            @endforeach

                            @if(Auth::user()->tipo != 0)

                            @if (isset($questoes) && count($questoes) > 0)
                            <div class="section-learn-outline">
                                <h5 class="section-title">Avaliação Final</h5>
                                <ul class="section-list">                                                                
                                    <li @if(isset($x) && $x->nota != null) class="o-view" @endif>
                                        <div class="list-body">
                                            <a href="/Aluno/Prova/Introducao/{{ $curso->id }}">
                                                <h6>Prova</h6>
                                                <p>Avaliação Final Obrigatória para emissão do certificado.</p>
                                            </a>
                                        </div>
                                        <div class="download">
                                            <a href="/Aluno/Prova/Introducao/{{ $curso->id }}"><i class="fa fa-pencil" style="font-size:18pt;"></i></a>
                                            <div class="download-ct">
                                                <span>Realizar Prova</span>
                                            </div>
                                        </div>
                                        <div class="div-x"><i class="icon md-check-2"></i></div>
                                    </li>                                
                                </ul>
                            </div>
                            @endif

                            @endif

                        </div>
                    </li>
                    
                    <!-- NOTE LEARN -->
                    @if(isset($aula))
                    <li class="note-learn">
                        <a href="#"><i class="icon md-file"></i></a>
                        <div class="list-item-body note-learn-body">
                            <div class="note-title">
                                <h5>Notas</h5>
                                <a href="#" onclick="ENVIAR_TEXTO()"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                            </div>                    
                            <div id="texto" contenteditable="true" class="note-body">
                                @if (isset($anotacao))
                                {!! $anotacao->texto !!}
                                @endif
                            </div>
                        </div>
                    </li>
                    @endif

                    <li class="backpage">
                        <a href="/Aluno/Dashboard"><i class="icon md-close-1"></i></a>
                    </li>
                </ul>

            </div>


            <section id="learning-section" class="learning-section learn-section">
                <div class="container">  
                    @yield('content')      

                </div>
            </section>


        </div>
        <!-- END / PAGE WRAP -->

        <!-- Load jQuery -->
        <script type="text/javascript" src="/megacourse/js/library/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/megacourse/js/library/bootstrap.min.js"></script>
        <script type="text/javascript" src="/megacourse/js/library/jquery.owl.carousel.js"></script>
        <script type="text/javascript" src="/megacourse/js/library/jquery.appear.min.js"></script>
        <script type="text/javascript" src="/megacourse/js/library/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="/megacourse/js/library/jquery.easing.min.js"></script>
        <script type="text/javascript" src="/megacourse/js/scripts.js"></script>
        {{--   <script type="text/javascript" src="/plyr/plyr.js"></script> --}}
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if(isset($aula_id))
            function ENVIAR_TEXTO(){
                var dados = 'texto='+$('#texto').html();

                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: '/Aluno/Anotacao/{{ $aula_id }}',
                    data: dados,
                    beforeSend: function(){},
                    success: function(response) {
                        toastr["success"]("Anotação salva com sucesso")
                    }
                });
            }
            @endif
        </script>
        @yield('scripts') 

        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type='text/javascript'>
            (function(){ var widget_id = '3yIz1CEANw';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
        </script>
        <!-- {/literal} END JIVOSITE CODE -->

        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124066846-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-124066846-1');
        </script>


    </body>
    </html>