@extends('layouts.aluno')
@section('title', 'Dashboard')

@section('sub_content')

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

   <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">

            <div class="message-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="message-sb">
                            <div class="message-sb-title">
                                <h4>Contatos</h4>
                                <!--<a href="#" class="new-message"><i class="icon md-plus"></i>Nova Mensagem</a>-->
                            </div>
                            <ul class="list-message">
                                
                                @foreach($contatos as $c)

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="/Aluno/Mensagem/{{$c->id}}">
                                        <div class="image">
                                            <img style="margin-top:9px;" @if($c->foto == '') src="/assets/img/nopicture.png"  @else src="/uploads/usuarios/{{$c->foto}}" @endif alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>{{$c->name}}</span>                                                
                                            </div>

                                            @php
                                                $msg = DB::table('mensagens')
                                                            ->where('de', Auth::user()->id)
                                                            ->where('para', $c->id)
                                                            ->orWhere('de', $c->id)
                                                            ->where('para', Auth::user()->id)
                                                            ->orderBy('data','desc')
                                                            ->first();
                                            @endphp

                                            @if (isset($msg))
                                                <p>{{ $msg->texto }}</p>
                                                <div class="time">
                                                    <span>{{ date('d/m/Y H:i:s',  strtotime($msg->data)) }}</span>
                                                </div>                                                
                                            @endif
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->
                                
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">

                        @if(isset($msgs))

                        @foreach($msgs as $m)

                        <div class="message-ct">
                            <div class="author">
                                <div class="image">
                                    <img style="margin-top:8px;"                                         
                                        @if($m->de_foto == '')
                                            src="/assets/img/nopicture.png" 
                                         @else 
                                            src="/uploads/usuarios/{{$m->de_foto}}"
                                        @endif                                        
                                        alt="">
                                </div>
                                <span class="author-name">{{$m->de_nome}}</span>
                                <em>{{ date('d/m/Y H:i:s',  strtotime($m->data)) }}</em>
                            </div>
                            <p>{{$m->texto}}</p>
                        </div>

                        @endforeach                                                

                        @endif

                        @if(isset($user_id))
                        <form method="post" action="/Aluno/EnviarMensagem">
                        {{ csrf_field() }}
                        <div class="message-ct" style="margin-top:-40px;">

                            <div class="text-form-editor">                                
                                <textarea name="texto" id="texto" placeholder="Mensagem..."></textarea>
                                <input type="hidden" name="para" id="para" value="{{ $user_id }}"/>
                            </div>
                            <div class="form-action">
                                <input type="submit" value="Enviar" class="send mc-btn-3 btn-style-1">
                            </div>
                        </div>
                        </form>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->


    

@endsection


@section('sub_scripts')
<script type="text/javascript" src="/megacourse/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="/megacourse/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/megacourse/js/scripts.js"></script>
@endsection