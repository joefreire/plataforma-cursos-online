@extends('layouts.app')
@section('title', 'Contatos')

@section('content')
<link rel="stylesheet" href="/assets/css/contacts.min.css">
<div class="contact">
  <div id="contacts" class="contact-sidebar active">
    <div class="contact-sidebar-header">
      <div class="title-bar">
        <h1 class="title-bar-title">
          <span class="d-ib">Contatos</span>
        </h1>
      </div>
      <form class="search" action="/contatos" method="POST">
        {{ csrf_field() }}
        <div class="form-group form-group-sm">
          <div class="input-with-icon">
            <input class="form-control" type="text" name="busca" placeholder="Pesquisar..." required="">
            <span class="icon icon-search input-icon"></span>
          </div>
        </div>
      </form>
    </div>
    <div class="contact-sidebar-body">
      <div class="custom-scrollbar">
        <ul class="contact-list">

          @foreach($usuarios as $U)

          <li class="contact-list-item">
            <a class="contact-list-link" href="#{{ $U->id }}" data-toggle="tab">
              <div class="contact-list-avatar">
                <img class="rounded" width="40" height="40" @if($U->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $U->foto }}" @endif alt="{{ $U->name }}">
              </div>
              <div class="contact-list-details">
                <h5 class="contact-list-name">
                  <span class="truncate">{{ $U->name }}</span>
                </h5>
                <small class="contact-list-email">
                  <span class="truncate">{{ $U->email }}</span>
                </small>
              </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  @foreach($usuarios as $U)

  <div id="{{ $U->id }}" class="contact-content">
    <div class="contact-content-header">
      <div class="contact-toolbar">
        <div class="contact-toolbar-tools pull-xs-left">
          <div class="btn-group hidden-md hidden-lg">
            <button class="btn btn-link link-muted" data-target="#contacts" data-toggle="tab" type="button">
              <span class="icon icon-caret-left icon-lg icon-fw"></span>
              Contatos
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="contact-content-body">
      <div class="contact-avatar">
        <label class="contact-avatar-btn">
          <span class="icon icon-camera"></span>
          <form id="form_foto_{{ $U->id }}" class="form-horizontal" method="POST" action="/contato/{{ $U->id }}/foto" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="file-upload-input" type="file" name="file" onchange="$('#form_foto_{{ $U->id }}').submit();">
          </form>
        </label>
        <img class="img-rounded" width="128" height="128" @if($U->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $U->foto }}" @endif alt="{{ $U->name }}">
      </div>
      <div class="contact-info">
        <h2 class="contact-name">{{ $U->name }}</h2>
        <p class="contact-job-title">{{ CONVERTER_TIPO($U->tipo) }}</p>
      </div>
      <div class="contact-form @if(CONVERTER_TIPO($U->tipo) == 'Instrutor') col-md-6 @endif">
        <form class="form-horizontal" method="POST" action="/contato/{{ $U->id }}" enctype="multipart/form-data" data-toggle="validator">
          {{ csrf_field() }}
          <div class="form-groups">
            <div class="form-group">
              <label class="col-md-3 control-label">Nome</label>
              <div class="col-md-9">
                <input class="form-control" type="text" name="name" value="{{ $U->name }}" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Email</label>
              <div class="col-md-9">
                <input class="form-control" type="email" name="email" value="{{ $U->email }}" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Telefone</label>
              <div class="col-md-9">
                <input class="form-control" type="text" name="telefone" value="{{ $U->telefone }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Endereço</label>
              <div class="col-md-9">
                <input class="form-control" type="text" name="endereco" value="{{ $U->endereco }}">
              </div>
            </div>

          </div>

          <div class="form-groups">
            <div class="form-group">
              <label class="col-md-3 control-label">Observações</label>
              <div class="col-md-9">
                <textarea class="form-control" rows="3" name="observacoes">{{ $U->observacoes }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button class="btn btn-primary" type="submit">Salvar</button>

                @if($U->id != Auth::user()->id)
                <a class="btn btn-default" href="/mensagens/{{ $U->id }}/{{ URL_AMIGAVEL($U->name) }}">Enviar Mensagem</a>
                @endif
              </div>
            </div>
          </div>
        </form>
      </div>
      @if(CONVERTER_TIPO($U->tipo) == 'Instrutor')
      <div class="contact-form col-md-6">
        <table id="dados" class="table table-borderless table-striped">
          <tbody>
            <tr>
              <td><strong>Banco</strong></td>
              <td>
                <select class="form-control" name="bankNumber" id="bankNumber" style="width: 100%;" disabled="disabled">
                  <option value="">-- Selecione --</option>
                  @foreach (\App\Banco::all() as $banco)
                  <option value="{{$banco->cod}}" {{( $U->bankNumber == $banco->cod ? "selected" : '')}}>{{$banco->banco}}</option>
                  @endforeach
                </select>
              </td>
            </tr>
            <tr>
              <td><strong>Agência</strong></td>
              <td>
                <input id="agencyNumber" class="form-control" type="text" name="agencyNumber" placeholder="Número da agência" value="{{ $U->agencyNumber }}" disabled="disabled">
              </td>
              <td>
                <input id="agencyCheckNumber" class="form-control" type="text"  name="agencyCheckNumber" maxlength="1" placeholder="Digito Verificador" value="{{ $U->agencyCheckNumber }}" disabled="disabled">
              </td>
            </tr>

            <tr>
              <td><strong>Conta Corrente</strong></td>
              <td>
                <input id="accountNumber" class="form-control" type="text" name="accountNumber" placeholder="Número da conta" value="{{ $U->accountNumber }}" disabled="disabled">
              </td>
              <td>
                <input id="accountCheckNumber" class="form-control" type="text" maxlength="1" name="accountCheckNumber" placeholder="Digito Verificador" value="{{ $U->accountCheckNumber }}" disabled="disabled">
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      @endif
    </div>
  </div>

  @endforeach


  <div class="contact-settings">
    <div class="contact-settings-body">
      <div class="contact-settings-inner">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src="/assets/js/contacts.min.js"></script>
@endsection