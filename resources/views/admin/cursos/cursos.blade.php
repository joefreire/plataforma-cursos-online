@extends('layouts.app')
@section('title', 'Cursos')

@section('content')

<div class="layout-content-body">

        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

<div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">

                  <strong>Cursos</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nome</th> 
                        <th>Instrutor</th> 
                        <th>Situação</th>                        
                        <th data-orderable="false">Opções</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($cursos as $c)

                            <tr>
                                <td>{{$c->nome}}</td>  
                                <td>{{(!empty($c->instrutor->name)?$c->instrutor->name:'')}}</td>  
                                <td>
        
                                    @if($c->aprovado == null)
                                        <span class="badge badge-danger">Aguardando Aprovação</span>
                                    @else
                                        <span class="badge badge-success">Aprovado e Disponível</span>
                                    @endif

                                </td>                              
                                <td>
                                    <a target="_blank" href="/Aluno/Assistir/{{ $c->id }}" class="btn btn-info btn-xs btn-options">Visualizar</a>
                                    <a href="/curso/habilitar/{{ $c->id }}" class="btn btn-danger btn-xs btn-options">Ativar / Desativar</a>
                                </td>                        
                            </tr>
                            @php
                              //SUBCATEGORIA($c->id, $c->nome);
                            @endphp
                        @endforeach
                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</div>

@endsection