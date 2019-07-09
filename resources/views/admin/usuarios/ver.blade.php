@extends('layouts.app')
@section('title', 'Detalhes Usuario')
@section('styles')
<style type="text/css">

.contact-avatar {
  margin: 15px auto;
  position: relative;
  width: 128px;
}
.contact-content-body {
  max-width: 1000px;
  padding: 30px;
  text-align: center;
}
.form-groups {
  padding-bottom: 15px;
  padding-top: 15px;
  text-align: left;
}
</style>
@endsection
@section('content')
<div class="layout-content-body">
  <div class="contact-content-body">
    <div class="contact-avatar">
      <img class="img-rounded" width="128" height="128" @if($usuario->foto == '') src="/assets/img/nopicture.png" @else src="/uploads/usuarios/{{ $usuario->foto }}" @endif alt="{{ $usuario->name }}">
    </div>
    <div class="contact-info">
      <h2 class="contact-name">{{ $usuario->name }}</h2>
      <p class="contact-job-title">{{ CONVERTER_TIPO($usuario->tipo) }}</p>
    </div>
  </div>
  <div class="@if(CONVERTER_TIPO($usuario->tipo) == 'Instrutor') col-md-6 @else col-md-9 @endif">
   <div class="form form-horizontal">
    <div class="form-groups">
      <div class="form-group">
        <label class="col-md-3 control-label">Email</label>
        <div class="col-md-9">
          <input class="form-control" type="email" name="email" value="{{ $usuario->email }}" required="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label">Telefone</label>
        <div class="col-md-9">
          <input class="form-control" type="text" name="telefone" value="{{ $usuario->telefone }}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label">Endereço</label>
        <div class="col-md-9">
          <input class="form-control" type="text" name="endereco" value="{{ $usuario->endereco }}">
        </div>
      </div>

      <div class="form-groups">
        <div class="form-group">
          <label class="col-md-3 control-label">Observações</label>
          <div class="col-md-9">
            <textarea class="form-control" rows="3" name="observacoes">{{ $usuario->observacoes }}</textarea>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
          @if($usuario->id != Auth::user()->id)
          <a class="btn btn-default" href="/mensagens/{{ $usuario->id }}/{{ URL_AMIGAVEL($usuario->name) }}">Enviar Mensagem</a>
          @endif
        </div>
      </div>

    </div>
  </div>
</div>
@if(CONVERTER_TIPO($usuario->tipo) == 'Instrutor')
<div class="contact-form col-md-6">
  <table id="dados" class="table table-borderless table-striped">
    <tbody>
      <tr>
        <td><strong>Banco</strong></td>
        <td>
          <select class="form-control" name="bankNumber" id="bankNumber" style="width: 100%;" disabled="disabled">
            <option value="">-- Selecione --</option>
            @foreach (\App\Banco::all() as $banco)
            <option value="{{$banco->cod}}" {{( $usuario->bankNumber == $banco->cod ? "selected" : '')}}>{{$banco->banco}}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>Agência</strong></td>
        <td>
          <input id="agencyNumber" class="form-control" type="text" name="agencyNumber" placeholder="Número da agência" value="{{ $usuario->agencyNumber }}" disabled="disabled">
        </td>
        <td>
          <input id="agencyCheckNumber" class="form-control" type="text"  name="agencyCheckNumber" maxlength="1" placeholder="Digito Verificador" value="{{ $usuario->agencyCheckNumber }}" disabled="disabled">
        </td>
      </tr>

      <tr>
        <td><strong>Conta Corrente</strong></td>
        <td>
          <input id="accountNumber" class="form-control" type="text" name="accountNumber" placeholder="Número da conta" value="{{ $usuario->accountNumber }}" disabled="disabled">
        </td>
        <td>
          <input id="accountCheckNumber" class="form-control" type="text" maxlength="1" name="accountCheckNumber" placeholder="Digito Verificador" value="{{ $usuario->accountCheckNumber }}" disabled="disabled">
        </td>
      </tr>
    </tbody>
  </table>

</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="card-actions">
        <button type="button" class="card-action card-toggler" title="Collapse"></button>

        <button type="button" class="card-action card-remove" title="Remove"></button>
      </div>
      <strong>Cursos Criados</strong>
    </div>
    <div class="card-body" data-toggle="match-height" style="height: 262px;">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Valor</th>
            <th>Nivel</th>
            <th>Aprovado</th>
            <th>Data Criação</th>
            <th>Açoes Curso</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cursos as $curso)
          <tr>
            <td>             
              {{ $curso->id }}              
            </td>
            <td>
              {{ $curso->nome }}  
            </td>
            <td>
              {{ $curso->descricao }}  
            </td>
            <td>R$ {{$curso->valor}}</td>
            <td>
              {{ $curso->nivel }}  
            </td>
            <td>
              {{ ($curso->aprovado == '1'?'Sim':'Não') }}  
            </td>            
            <td>{{$curso->created_at->format('d/m/Y')}}</td>
            <td> 
              <a target="_blank" href="/Aluno/Assistir/{{ $curso->id }}" class="btn btn-info btn-xs btn-options">Visualizar</a>
              <a href="/curso/habilitar/{{ $curso->id }}" class="btn btn-danger btn-xs btn-options">Ativar / Desativar</a>
            </td>

          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="card-actions">
        <button type="button" class="card-action card-toggler" title="Collapse"></button>

        <button type="button" class="card-action card-remove" title="Remove"></button>
      </div>
      <strong>Cursos Vendidos</strong>
    </div>
    <div class="card-body" data-toggle="match-height" style="height: 262px;">
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Aluno</th>
            <th>Curso</th>
            <th>Valor pago</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vendas as $Q)
          <tr>
            <td>{{ date('d/m/Y',  strtotime($Q->data)) }}</td>
            <td>{{  $Q->user->name }}</td>
            <td>{{ $Q->curso->nome }}</td>
            <td>R$ {{ (!empty($Q->vendido)?number_format($Q->vendido->valor_unitario, 2, '.', ''):'0.00') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col-md-10"></div><div class="col-md-2">Total a receber: <b> R$ {{ number_format($total, 2, '.', '') *0.7 }}</b></div>
    </div>
  </div>
</div>

@endif
@if(CONVERTER_TIPO($usuario->tipo) == 'Aluno')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="card-actions">
        <button type="button" class="card-action card-toggler" title="Collapse"></button>

        <button type="button" class="card-action card-remove" title="Remove"></button>
      </div>
      <strong>Pedidos</strong>
    </div>
    <div class="card-body" data-toggle="match-height" style="height: 262px;">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Cursos</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Cupom Desconto</th>
            <th>Status</th>
            <th>Link para Pagamento</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuario->Compras as $pedido)
          <tr>
            <td>             
              {{ $pedido->id }}              
            </td>
            <td>
              @foreach ($pedido->Itens as $Item)
              {{ ($loop->last?$Item->produto->nome:$Item->produto->nome.',') }}
              @endforeach
            </td>
            <td>R$ {{$pedido->total}}</td>
            <td>{{$pedido->created_at}}</td>
            <td>{{(isset($pedido->Desconto->cupom)?$pedido->Desconto->cupom:'')}}</td>
            <td>
              <span class="label label-{{($pedido->status == '0'?'info':($pedido->status == '1'?'success':'danger'))}}">{{($pedido->status == '0'?'Aberto':($pedido->status == '1'?'Fechado':'Cancelado'))}}</span>
            </td>
            <td>{!!($pedido->status == '0'?'<a href="'.$pedido->transacao.'">MOIP</a>':'')!!}</td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="card-actions">
        <button type="button" class="card-action card-toggler" title="Collapse"></button>

        <button type="button" class="card-action card-remove" title="Remove"></button>
      </div>
      <strong>Cursos</strong>
    </div>
    <div class="card-body" data-toggle="match-height" style="height: 262px;">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Curso</th>
            <th>Professor</th>
            <th>Data Inicio</th>
            <th>Andamento</th>
            <th>Nota</th>
            <th>Data Avaliação</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuario->UserCursos as $curso)
          <tr>
            <td>             
              {{ $curso->id }}              
            </td>
            <td>             
              {{ $curso->curso->nome }}              
            </td>
            <td>             
              {{ $curso->curso->instrutor->name }}              
            </td>
            <td>             
              {{ $curso->data }}              
            </td>
            <td>             
              {{ $curso->andamento }}              
            </td>
            <td>             
              {{ $curso->nota }}              
            </td>
            <td>             
              {{ $curso->data_nota }}              
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endif


</div>

@endsection

@section('scripts')
<script src="/assets/js/contacts.min.js"></script>
@endsection