@extends('layouts.front')
@section('title', 'Dashboard')

@section('content')

<div class="page-heading text-center">
    <div class="container">
        
        <h2>RECEITAS</h2>
        
    </div>
</div>

<!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">
            
            <div class="table-asignment">
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade in active" id="mysubmissions">
                        <div class="table-wrap">
                            <!-- TABLE HEAD -->
                            <div class="table-head">
                                <div class="submissions"></div>
                                <div class="total-subm"></div>
                                <div class="replied">Qtd. Vendas</div>
                                <div class="latest-reply">Total</div>
                                <div class="tb-icon"></div>
                            </div>
                            <!-- END / TABLE HEAD -->

                            
                            @php

                                $total = 0;
                                foreach($vendas as $V){
                                    $total = $total + (($V->total / 100) * $V->comissao);
                                }

                            @endphp


                            <!-- TABLE BODY -->
                            <div class="table-body">
                                <!-- TABLE ITEM -->
                                <div class="table-item">
                                    <div class="thead">
                                        <div style="color:#000000" class="submissions">Receita geral</div>
                                        <div style="color:#000000" class="total-subm"></div>
                                        <div style="color:#000000" class="replied">{{ count($vendas) }}</div>
                                        <div style="color:#000000" class="latest-reply"><b>R$ {{ number_format($total, 2, '.', '') }}</b></div>
                                        <div class="toggle tb-icon">
                                            <a href="#"><i class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>

                                    <div class="tbody">
                                     
                                     @foreach($vendas as $V)

                                        @php
                                            $curso = DB::table('vendas_produtos')->where('rand_log', $V->rand_log)->first();
                                            $c = DB::table('cursos')->where('id', $curso->produto_id)->first();
                                        @endphp

                                        <div class="item">
                                            <div class="submissions"><a href="#">{{ $c->nome }}</a></div>
                                            <div class="total-subm">{{ $V->comissao }}%</div>
                                            <div class="replied">R${{ number_format((($V->total / 100) * $V->comissao), 2,'.','') }}</div>
                                            <div class="latest-reply">{{ date('d/m/Y',  strtotime($V->data)) }}</div>
                                         
                                        </div>
                                    @endforeach
                                   

                                        

                                    </div>
                                </div>
                                <!-- END / TABLE ITEM -->

                                
                                </div>
                                <!-- END / TABLE ITEM -->
                                
                            </div>
                            <!-- END / TABLE BODY -->
                        </div>

                    </div>
                    <!-- END / MY SUBMISSIONS -->

                    

                </div>

            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->

  
@endsection

@section('scripts')


<script type="text/javascript" src="js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

<script type="text/javascript">

    $.each($('.table-wrap'), function() {
        $(this)
            .find('.table-item')
            .children('.thead:not(.active)')
            .next('.tbody').hide();
        $(this)
            .find('.table-item')
            .delegate('.thead', 'click', function(evt) {
                evt.preventDefault();
                if ($(this).hasClass('active')==false) {
                    $('.table-item')
                        .find('.thead')
                        .removeClass('active')
                        .siblings('.tbody')
                            .slideUp(200);
                }
                $(this)
                    .toggleClass('active')
                    .siblings('.tbody')
                        .slideToggle(200);
        });
    });

</script>

@endsection