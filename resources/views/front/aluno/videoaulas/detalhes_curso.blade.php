@extends('layouts.videoaulas')
@section('title', 'Assistir')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="sidebar-course-intro">

            <div class="video-course-intro">
                <div class="inner">
                    <div class='embed-container'>
                        @if(isset($curso) && $curso->video != '')
                        @if($vimeo_status == 'complete')
                        <div data-vimeo-id='{{{$curso->video}}}' data-vimeo-width="640" id="handstick"></div>
                        @elseif($vimeo_status == 'Sem video')                    
                        <div class="alert alert-danger" style="margin-top: 15px;"> 
                            Esse arquivo de video não existe
                        </div>
                        @else
                        <div class="alert alert-success" style="margin-top: 15px;"> 
                            Seu video está sendo codificado, aguarde uns instantes
                        </div>
                        @endif
                        @elseif($curso->imagem != '')
                        <div class="video-place">
                            <div class="img-thumb">
                                <img src="/uploads/cursos/{{ $curso->imagem }}" class="img-responsive" style="    max-width: 100%;">    
                            </div>
                        </div>
                        @else
                        <div class="video-place">
                            <div class="img-thumb">
                                <img src="/images/nopicture.jpg" class="img-responsive" style="    max-width: 100%;">    
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                <div class="price">
                 {{ ($curso->valor=='0'?"Grátis":"R$ ".$curso->valor) }}
             </div>
             {{--  <a href="#" class="take-this-course mc-btn btn-style-1">Take this course</a> --}}
         </div>


         <hr class="line">
         <div class="about-instructor">
            <h4 class="xsm black bold">Instrutor</h4>
            <ul>
                <li>
                    <div class="image-instructor text-center">
                        @if($curso->instrutor->foto != '')
                        <img src="/uploads/usuarios/{{$curso->instrutor->foto}}" alt="foto professor">
                        @else
                        <img src="/images/nopicture.jpg" alt="foto professor">
                        @endif
                    </div>
                    <div class="info-instructor">
                        <cite class="sm black"><a href="#">{{$curso->instrutor->name}}</a></cite>
                       {{--  <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                        <a href="#"><i class="fa fa-check-square"></i></a> --}}
                        <p>{{$curso->instrutor->observacoes}}</p>
                    </div>
                </li>

            </ul>
        </div>
        <hr class="line">
{{--         <div class="widget widget_equipment">
            <i class="icon md-config"></i>
            <h4 class="xsm black bold">Equipment</h4>
            <div class="equipment-body">
                <a href="#">Photoshop CC</a>,
                <a href="#">Illustrator CC</a>
            </div>
        </div>
        <div class="widget widget_tags">
            <i class="icon md-download-2"></i>
            <h4 class="xsm black bold">Tag</h4>
            <div class="tagCould">
                <a href="#">Design</a>, 
                <a href="#">Photoshop</a>, 
                <a href="#">Illustrator</a>, 
                <a href="">Art</a>, 
                <a href="">Graphic Design</a>
            </div>
        </div>
        <div class="widget widget_share">
            <i class="icon md-forward"></i>
            <h4 class="xsm black bold">Share course</h4>
            <div class="share-body">
                <a href="#" class="twitter" title="twitter">
                    <i class="icon md-twitter"></i>
                </a>
                <a href="#" class="pinterest" title="pinterest">
                    <i class="icon md-pinterest-1"></i>
                </a>
                <a href="#" class="facebook" title="facebook">
                    <i class="icon md-facebook-1"></i>
                </a>
                <a href="#" class="google-plus" title="google plus">
                    <i class="icon md-google-plus"></i>
                </a>
            </div>
        </div> --}}
    </div>
</div>    
<div class="col-md-7">
    <div class="tabs-page">
        <div class="nav-tabs-wrap">
            <ul class="nav-tabs" role="tablist">
                <li class="active">
                    <a href="#introduction" role="tab" data-toggle="tab"><h4 class="sm black bold">Descrição</h4></a>
                </li>
{{--             <li class=""><a href="#outline" role="tab" data-toggle="tab">Outline</a></li>
            <li class=""><a href="#review" role="tab" data-toggle="tab">Review</a></li>
            <li class=""><a href="#student" role="tab" data-toggle="tab">Student</a></li>
            <li class=""><a href="#conment" role="tab" data-toggle="tab">Conment</a></li> --}}
            <li class="tabs-hr" style="left: 0px; width: 88px;">

            </li>
        </ul>
    </div>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- INTRODUCTION -->
        <div class="tab-pane fade active in" id="introduction">
         {{--  <h4 class="sm black bold">Descrição</h4> --}}
         <p>{{$curso->descricao}}</p>
     </div>
     <!-- END / INTRODUCTION -->

     <!-- OUTLINE -->
     <div class="tab-pane fade" id="outline">

     </div>
     <!-- END / OUTLINE -->

     <!-- REVIEW -->
     <div class="tab-pane fade" id="review">

     </div>
     <!-- END / REVIEW -->

     <!-- STUDENT -->
     <div class="tab-pane fade" id="student">

     </div>
     <!-- END / STUDENT -->

     <!-- COMMENT -->
     <div class="tab-pane fade" id="conment">

     </div>
     <!-- END / COMMENT -->
 </div>
</div>
</div>
</div>
@endsection
@section('scripts')

@endsection