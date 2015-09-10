@extends('sandbox.navi')

@section('content')
	@foreach($data as $product)
	<div class="panel panel-default width-squeeze">

		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-6">
					<strong>{{$product->name}}</strong>
				</div>

				<div class="col-xs-6">
					<strong class="pull-right">{{$product->price}}</strong>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<ul class="list-group width-squeeze">
			
				@if(isset($product->sub_products[0]))
				<div class="row">
						<div class="col-xs-4">
							<strong>Sub-Product</strong>
						</div>
						<div class="col-xs-4">
							<strong>Price</strong>
						</div>
						<div class="col-xs-4">
							<strong>Quantity</strong>
						</div>
				</div>
				@endif

				@foreach($product->sub_products as $sub)
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-4">
							{{$sub->name}}
						</div>
						<div class="col-xs-4">
							{{$sub->price}}
						</div>
						<div class="col-xs-4">
							{{$sub->quanity}}
						</div>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endforeach
@stop