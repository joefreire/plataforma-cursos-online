@extends('layouts.app')
@section('title', 'Mensagens')

@section('content')
<link rel="stylesheet" href="/assets/css/messenger.min.css">
@php
  $rand_log = '';
@endphp
<div class="messenger">
          <div id="contacts" class="messenger-sidebar @if(!isset($canal)) active @endif">
            <div class="messenger-sidebar-header">
              <div class="title-bar">
                <h1 class="title-bar-title">
                  <span class="d-ib">Mensagens</span>
                </h1>
              </div>
            </div>

            <div class="messenger-sidebar-body">
              <div class="custom-scrollbar">
                <ul class="messenger-list">

                <li class="messenger-list-item" style="display:none;">
                    <a id="btn_chat_chanel" class="messenger-list-link" href="#chat_chanel" data-toggle="tab">
                      <div class="messenger-list-avatar">
                        <img class="rounded" width="40" height="40" src="/assets/img/0601274412.jpg" alt="Sophia Evans">
                      </div>
                      <div class="messenger-list-details">
                        <div class="messenger-list-date">Jun 22</div>
                        <div class="messenger-list-name">Sophia Evans</div>
                        <div class="messenger-list-message">
                          <small class="truncate">Curabitur vel mi ante.</small>
                        </div>
                      </div>
                    </a>
                  </li>

                  @foreach($mensagens as $M)

                  @php
                    if($M->de == Auth::user()->id){
                      $de = $M->para;
                    }else{
                      $de = $M->de;
                    }

                    $UM = DB::table('users')->where('id', $de)->get()->first();

                    $last = DB::table('mensagens')->where('rand_log', $M->rand_log)->orderBy('data', 'desc')->get()->first();

                  @endphp

                  <li class="messenger-list-item">
                    <a class="messenger-list-link" href="/mensagens/{{ $UM->id }}/{{ URL_AMIGAVEL($UM->name) }}" >
                      <div class="messenger-list-avatar">
                        <img class="rounded" width="40" height="40" @if($UM->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $UM->foto }}" @endif alt="{{ $UM->name }}">
                      </div>
                      <div class="messenger-list-details">
                        <div class="messenger-list-date">{{ date('d/m/Y H:i:s',  strtotime($M->data)) }}</div>
                        <div class="messenger-list-name">{{ $UM->name }}</div>
                        <div class="messenger-list-message">
                          <small class="truncate">{{ $last->texto }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                 @endforeach
                </ul>
              </div>
            </div>
          </div>








          @if(isset($canal))
          <div id="chat_chanel" class="messenger-content @if(isset($canal))active @endif">
            <div class="messenger-content-inner">
              <div class="messenger-content-header">
                <div class="messenger-content-header-inner">
                  <div class="messenger-toolbar">
                    <div class="messenger-toolbar-tools pull-xs-left">
                      <div class="btn-group hidden-md hidden-lg">
                        <button class="btn btn-link link-muted" title="Back to Contacts" data-target="#contacts" data-toggle="tab" type="button">
                          <span class="icon icon-caret-left icon-lg icon-fw"></span>
                          Contatos
                        </button>
                      </div>
                      <div class="btn-group hidden-xs hidden-sm">
                        <button class="btn btn-link link-muted" data-container="body" data-trigger="hover" data-placement="bottom" data-toggle="tooltip" type="button">
                          <span class="icon icon-user icon-lg icon-fw"></span>
                          {{ $usuario->name }}
                        </button>
                      </div>
                    </div>
                    <!--
                      <div class="messenger-toolbar-tools pull-xs-right">
                        <div class="btn-group">
                          <button class="btn btn-link link-muted" type="button">
                            <span class="icon icon-phone icon-lg icon-fw"></span>
                            <span class="visible-lg-inline">Start a voice call</span>
                          </button>
                          <button class="btn btn-link link-muted" type="button">
                            <span class="icon icon-video-camera icon-lg icon-fw"></span>
                            <span class="visible-lg-inline">Start a video call</span>
                          </button>
                          <div class="btn-group dropdown">
                            <button class="btn btn-link link-muted" aria-haspopup="true" data-toggle="dropdown" type="button">
                              <span class="icon icon-cog icon-lg icon-fw"></span>
                              <span class="visible-lg-inline">Settings</span>
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li><a href="#">Mute Notifications</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Mark as Unread</a></li>
                              <li><a href="#">Mark as Spam</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      ---->
                  </div>
                </div>
              </div>
              <div class="messenger-content-body">
                <div class="messenger-content-body-inner">
                  <div class="messenger-scrollable-content">
                    <ul class="conversation">
                    
                      @foreach($canal as $C)

                        @php
                          $rand_log = $C->rand_log;
                        @endphp


                        @if($C->de == Auth::user()->id)
                        <li class="conversation-item">
                          <div class="conversation-other">
                            <div class="conversation-avatar">
                              <img class="rounded" width="36" height="36" @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="conversation-messages">
                              <div class="conversation-message">{{ $C->texto }}</div>
                              <div class="conversation-timestamp">{{ date('d/m/Y H:i:s',  strtotime($C->data)) }}</div>
                            </div>
                          </div>
                        </li>
                        @else

                        <li class="conversation-item">
                          <div class="conversation-self">
                            <div class="conversation-avatar">
                              <img class="rounded" width="36" height="36" @if($usuario->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $usuario->foto }}" @endif alt="{{ $usuario->name }}">
                            </div>
                            <div class="conversation-messages">
                              <div class="conversation-message">{{ $C->texto }}</div>
                              <div class="conversation-timestamp">{{ date('d/m/Y H:i:s',  strtotime($C->data)) }}</div>
                            </div>
                          </div>
                        </li>
                        @endif

                        
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
              <div class="messenger-content-footer">
                <div class="messenger-content-footer-inner">
                <form id="mensagem_form" method="POST" action="/mensagens/{{ $usuario->id }}/{{ URL_AMIGAVEL($usuario->name) }}" data-toggle="validator" >
                {{ csrf_field() }}
                  <div class="messenger-compose">
                    <div class="messenger-compose-actions">
                      <!----
                      <div class="messenger-compose-action">
                        <label class="btn btn-link link-muted file-upload-btn">
                          <span class="icon icon-picture-o icon-lg"></span>
                          <input class="file-upload-input" type="file" name="messenger_compose_file">
                        </label>
                      </div>
                      ---->
                      <div class="messenger-compose-action">
                        <button class="btn btn-link" type="submit" >Enviar</button>
                      </div>
                    </div>
                    <div class="messenger-compose-message">
                    
                      <textarea class="messenger-compose-input" name="texto" placeholder="Mensagem..." required=""></textarea>

                      @php
                        if($rand_log == ''){
                          $rand_log = date('Ymdhis').md5('Ymdhis');
                        }
                      @endphp
                    
                      <input type="hidden" name="rand_log" value="{{ $rand_log }}">

                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          @endif



          <div class="messenger-welcome">
            <div class="messenger-welcome-body">
              <div class="messenger-welcome-inner">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="messenger-avatar">
                      <img class="img-rounded" width="128" height="128" @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif alt="{{ Auth::user()->name }}">
                    </div>
                    <h1 class="messenger-heading">Olá, {{ Auth::user()->name }}!</h1>
                    <h6 class="messenger-subheading">Envie uma mensagem!</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
 
    

@endsection

@section('scripts')
<script src="/assets/js/messenger.min.js"></script>
<script>
  @if(isset($canal))
    $('#btn_chat_chanel').click();
  @endif
</script>
@endsection