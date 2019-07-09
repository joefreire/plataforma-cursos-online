@extends('layouts.front')
@section('title', 'Dashboard')
@section('titulo')
<!-- PROFILE FEATURE -->
<section class="profile-feature">
    
    <div class="awe-parallax"
    @if(Auth::user()->capa == '') style="background-image: url(/assets/img/nopicture.png)" 
    @else style="background-image: url(/uploads/usuarios/{{ Auth::user()->capa }})" @endif>
</div>

<div class="awe-overlay overlay-color-3"></div>
<div class="container">
    <div class="info-author">
        <div class="image">
            <img 
            @if(Auth::user()->foto == '') src="/assets/img/nopicture.png" 
            @else src="/uploads/usuarios/{{ Auth::user()->foto }}" @endif
            alt="">                    
        </div>    
        <div class="name-author">
            <h2 class="big">{{Auth::user()->name}}</h2>
        </div>     
        <div class="address-author">
            <i class="fa fa-map-marker"></i>
            <h3>{{Auth::user()->endereco}}</h3>
        </div>
    </div>            
</div>
</section>
@endsection
@section('content')

<!-- END / PROFILE FEATURE -->

@yield('sub_content')    

@endsection

@section('scripts')

@yield('sub_scripts')    

@endsection