@extends('layouts.aluno')
@section('title', 'Dashboard')

@section('sub_content')

<!-- CONTEN BAR -->
<section class="content-bar">
    <div class="container">
        <ul>
            <li class="current">
                <a href="/Aluno/Dashboard">
                    <i class="icon md-book-1"></i>
                    Meus Cursos
                </a>
            </li>                
            <li>
                <a href="/Aluno/Pedidos">
                    <i class="icon md-shopping"></i>
                    Pedidos
                </a>
            </li>               
            <li>
                <a href="/Aluno/Editar">
                    <i class="icon md-user-minus"></i>
                    Meu Perfil
                </a>
            </li>
            <li>
                <a href="/Aluno/Mensagem">
                    <i class="icon md-email"></i>
                    Mensagens
                </a>
            </li>
            <li>
                <a href="/Aluno/Certificados">
                    <i class="icon md-shopping"></i>
                    Certificados
                </a>
            </li>
        </ul>
    </div>
</section>
<!-- END / CONTENT BAR -->


<!-- COURSE CONCERN -->
<section id="course-concern" class="course-concern">
    @if (count(\Auth::user()->cursos_andamento()) == 0 && count(\Auth::user()->cursos_concluidos()) == 0) 
    <div class="price-course" align="center">
        <!--<i class="icon md-database"></i>-->
        <h3 style="margin-top: 20px; margin-bottom: -40px;">Você não possui nenhum curso em andamento.</h3>                
    </div>
    @endif

    @if (count(\Auth::user()->cursos_andamento()) > 0)        
    <div class="container">

        <div class="price-course">
            <i class="icon md-database"></i>
            <h3 style="margin-top: 20px; margin-bottom: -40px;">Em andamento</h3>                
        </div>
        @if(Session::has('aviso'))
        <div class="bg-success">
            {{Session::get('aviso')}}
        </div>
        @endif
        <div class="row">

            @foreach(\Auth::user()->cursos_andamento() as $ca)

            <div class="col-xs-6 col-sm-4 col-md-3">
                <!-- MC ITEM -->
                <div class="mc-learning-item mc-item mc-item-2">
                    <div class="image-heading">
                        <!--<img src="/megacourse/images/feature/img-1.jpg" alt="">-->
                        <img @if($ca->imagem == '') src="/images/nopicture.jpg"  @else src="/uploads/cursos/{{$ca->imagem}}" @endif class="resp-img" alt="">
                    </div>
                    <!--<div class="meta-categories"><a href="#">Web design</a></div>-->
                    <div class="content-item">
                        <div class="image-author">
                            <img @if($ca->foto == '') src="/assets/img/nopicture.png"  @else src="/uploads/usuarios/{{$ca->foto}}" @endif alt="">
                        </div>
                        <h4>{{$ca->nome}}</h4>
                        <div class="name-author">
                            Prof. <a>{{$ca->name}}</a>
                        </div>
                        @if($ca->link !="" && $ca->link!=null)
                        <a class="btn btn-sm btn-primary" href="{{$ca->link}}">Boleto</a>
                        @endif
                    </div>
                    <div class="ft-item">           
                        <div class="percent-learn-bar">
                            <div class="percent-learn-run percent-learn-run-add" style="width: {{ $ca->andamento }}%;"></div>
                        </div>                 
                        <div class="percent-learn">{{ $ca->andamento }}%<i class="fa fa-trophy"></i></div>
                        <a href="/Aluno/Assistir/{{ $ca->curso_id }}" class="learnnow">Assistir<i class="fa fa-play-circle-o"></i></a>
                    </div>
                </div>
                <!-- END / MC ITEM -->
            </div> 

            @endforeach   
            

        </div>
    </div>
    @endif
    
    
    @if (count(\Auth::user()->cursos_concluidos()) > 0)
    <div class="container">
        
        <div class="price-course">
            <i class="icon md-database"></i>
            <h3 style="margin-top: 20px; margin-bottom: -40px;">Concluídos</h3>                
        </div>

        <div class="row">
            
            @foreach(\Auth::user()->cursos_concluidos() as $cc)


            <div class="col-xs-6 col-sm-4 col-md-3">
                <!-- MC ITEM -->
                <div class="mc-learning-item mc-item mc-item-2">
                    <div class="image-heading">
                        <!--<img src="/megacourse/images/feature/img-1.jpg" alt="">-->
                        <img @if($cc->imagem == '') src="/images/nopicture.jpg"  @else src="/uploads/cursos/{{$cc->imagem}}" @endif class="resp-img" alt="">
                    </div>
                    <!--<div class="meta-categories"><a href="#">Web design</a></div>-->
                    <div class="content-item">
                        <div class="image-author">
                            <img @if($cc->foto == '') src="/assets/img/nopicture.png"  @else src="/uploads/usuarios/{{$cc->foto}}" @endif alt="">
                        </div>
                        <h4>{{$cc->nome}}</h4>
                        <div class="name-author">
                            Prof. <a>{{$cc->name}}</a>
                        </div>
                        @if($cc->link !="" && $cc->link!=null)
                        <a class="btn btn-sm btn-primary" href="{{$cc->link}}">Boleto</a>
                        @endif
                    </div>
                    <div class="ft-item">           
                        <div class="percent-learn-bar">
                            <div class="percent-learn-run percent-learn-run-add" style="width: {{ $cc->andamento }}%;"></div>
                        </div>                 
                        <div class="percent-learn">{{ $cc->andamento }}%<i class="fa fa-trophy"></i></div>
                        <a href="/Aluno/Assistir/{{ $cc->curso_id }}" class="learnnow">Assistir<i class="fa fa-play-circle-o"></i></a>
                    </div>
                </div>
                <!-- END / MC ITEM -->
            </div> 

            @endforeach                 
        </div>
        @endif
    </section>
    <!-- END / COURSE CONCERN -->

    @endsection


    @section('sub_scripts')
    <script type="text/javascript" src="/megacourse/js/library/jquery.appear.min.js"></script>
    <script type="text/javascript" src="/megacourse/js/library/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="/megacourse/js/scripts.js"></script>
    @endsection