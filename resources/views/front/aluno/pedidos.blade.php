@extends('layouts.aluno')
@section('title', 'Dashboard')
@section('style')
<link href="//cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" type="text/css" rel="stylesheet" />
@endsection

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
            <li class="current">
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
                <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Cursos</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>
                                @foreach ($pedido->Itens as $Item)
                                {{ ($loop->last?$Item->produto->nome:$Item->produto->nome.',') }}
                                @endforeach
                            </td>
                            <td>R$ {{$pedido->total}}</td>
                            <td>{{$pedido->created_at}}</td>
                            <td>@if($pedido->status != '1')
                                <a href="" class="btn btn-success btn-flat btn-sm" data-izimodal-open="#modal_{{ $pedido->id }}">Pagar $$$</a>
                                @endif
                                <span class="label label-{{($pedido->status == '0'?'info':($pedido->status == '1'?'success':'danger'))}}">{{($pedido->status == '0'?'Aberto':($pedido->status == '1'?'Fechado':'Cancelado'))}}</span></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

@foreach($pedidos->where('status','!=',"1") as $pedido )
    <div id="modal_{{ $pedido->id }}" class="modais" data-izimodal-transitionin="fadeInDown" data-izimodal-title="Pagamento" data-izimodal-iframeURL="{{ $pedido->transacao }}">
        
    </div>

@endforeach


@endsection


@section('sub_scripts')
<script type="text/javascript" src="/megacourse/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="/megacourse/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/megacourse/js/scripts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".modais").iziModal({            
            iframeHeight: 800,
            closeButton: true,
            overlayClose: true,
            closeOnEscape: true,
            iframe : true,
            fullscreen: true,
            headerColor: '#000000',
            loop: true
        });
    });
</script>

@if(\Session::has('ultima_venda'))
<script type="text/javascript">
    $(document).ready(function() {
        $("#modal_{!! Session::get('ultima_venda') !!}").iziModal('open');
    });
</script>
@endif
@if(\Session::has('boleto'))
<script type="text/javascript">
    $(document).ready(function() {
        window.open('https://checkout.moip.com.br/boleto/{!! Session::get('boleto') !!}/print');
    });
</script>
@endif
@endsection