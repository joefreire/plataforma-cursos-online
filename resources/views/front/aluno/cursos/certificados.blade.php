@extends('layouts.aluno')
@section('title', 'Certificados')

@section('sub_content')

<section class="content-bar">
    <div class="container">
        <ul>
            <li>
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
            <li class="current">
                <a href="/Aluno/Certificados">
                    <i class="icon md-shopping"></i>
                    Certificados
                </a>
            </li>
        </ul>
    </div>
</section>

   <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">

            @if(count($certs) == 0)
                <h3 align="center" style="margin-top:0">Você ainda não tem certificados.</h3>
            @else
                <h3 align="center" style="margin-top:0">Selecione o curso para emitir o certificado.</h3>
            @endif

            @foreach($certs as $C)

            @php
                $ca = DB::table('cursos')->where('id', $C->curso_id)->first();
            @endphp

            <div class="col-xs-6 col-sm-4 col-md-3">
                    <!-- MC ITEM -->
                    <div class="mc-learning-item mc-item mc-item-2" style="min-height:0">
                        <div class="image-heading">
                            <!--<img src="/megacourse/images/feature/img-1.jpg" alt="">-->
                            <img @if($ca->imagem == '') src="/images/nopicture.jpg"  @else src="/uploads/cursos/{{$ca->imagem}}" @endif class="resp-img" alt="">
                        </div>
                        <!--<div class="meta-categories"><a href="#">Web design</a></div>-->
                        <div class="content-item">
                            
                            <a target="_blank" href="/Gerar-Certificado/{{ $C->id }}"><h4>{{$ca->nome}}</h4></a>
                            
                        </div>
                        
                    </div>
                    <!-- END / MC ITEM -->
                </div>

            @endforeach
            
        </div>
    </section>
    <!-- END / COURSE CONCERN -->


    

@endsection


@section('sub_scripts')
<script type="text/javascript" src="/megacourse/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="/megacourse/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/megacourse/js/scripts.js"></script>
@endsection