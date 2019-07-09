@extends('layouts.front')
@section('title', 'Carrinho')
@section('style')
<style type="text/css">
.table>tbody>tr>td, .table>tfoot>tr>td{
	vertical-align: middle;
}
@media screen and (max-width: 600px) {
	table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
	
	table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	table#cart tbody tr td:first-child { background: lightgray; }
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
	
}
</style>
@endsection
@section('content')
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>CARRINHO</h2>
		</div>
	</div>
	<div class="interno container">
		@if(count(\Cart::content())>0)
		<table id="cart" class="table table-hover table-condensed table-responsive" style="margin-top: 5%;">
			<thead>
				<tr>
					<th style="width:80%">Curso</th>
					<th></th>
					<th></th>
					<th style="width:10%">Preço</th>
					<th style="width:10%"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach(\Cart::content() as $row)
					<td data-th="Curso">
						<div class="row">
							@if(!empty($row->options->curso->imagem))
							<div class="col-sm-2 hidden-xs"><img src="/uploads/cursos/{{ $row->options->curso->imagem }}" alt="{{ $row->name }}" class="img-responsive"/></div>
							@else
							<div class="col-sm-2 hidden-xs"><img src="{{asset('images/nopicture.jpg')}}" alt="{{ $row->name }}" class="img-responsive"/></div>
							@endif
							<div class="col-sm-10">
								<h4 class="nomargin">{{ $row->name }}</h4>
								<p>{{ $row->options->curso->descricao }}</p>
							</div>
						</div>
					</td>
					<td class="hidden-xs"></td>
					<td class="hidden-xs"></td>
					<td data-th="Preço">{{ ($row->price=='0'?"Grátis":"R$ ".$row->price) }}</td>

					<td class="actions" data-th="">
						<form id="remove_item" action="/carrinho/remove_item" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="item_cart" value="{{ $row->rowId }}">
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>	
						</form>

					</td>
					
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="visible-xs">
					<td class="text-center"><strong>Total {{\Cart::total()}}</strong></td>
				</tr>
				<tr>
					<td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Adicionar Mais</a></td>
					<td colspan="2" class="hidden-xs"></td>
					<td class="hidden-xs text-center"><strong>Total {{\Cart::total()}}</strong></td>
					<td><a href="/pagamento" class="btn btn-success btn-block">Finalizar <i class="fa fa-angle-right"></i></a></td>
				</tr>
			</tfoot>
		</table>
		@else
		<div class="hero-unit">
			<h2>Carrinho Vazio</h2>
			<p>Volte e busque cursos primeiro.</p>
			<p>
				<a href="/" class="btn btn-primary">
					Inicio
				</a>
			</p>
		</div>
		@endif
	</div>
</main>
@endsection