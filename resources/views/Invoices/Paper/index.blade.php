@extends('sandbox.navi')

@section('content')
	<h4 class="invoice-header">
		<strong>Paper Invoices</strong>
		<small> (most recent)</small>
	</h4>
	<hr>
	
	<div id="invoice-list" class="width-squeeze float-left">
		<div class="list-group">
				<a href="#" class="list-group-item disabled">
					<div class="row">
	  					<div class="col-xs-3">Invoice #</div>
	  					<div class="col-xs-4">Customer</div>
	  					<div class="col-xs-2">Total</div>
	  					<div class="col-xs-3">Sale Date</div>
	  				</div>
	  			</a>
			@foreach($invoices as $invoice)
				@if($invoice->invoice_no == Session::get('new_invoice'))
				<a href="{{route('invoice.paper.show', $invoice->invoice_no)}}" class="list-group-item list-group-item-success">
				@else
	  			<a href="{{route('invoice.paper.show', $invoice->invoice_no)}}" class="list-group-item">
	  			@endif
	  				<div class="row">
	  					<div class="col-xs-3">{{$invoice->invoice_no}}</div>
	  					<div class="col-xs-4">{{$invoice->org_name}}</div>
	  					<div class="col-xs-2">{{$invoice->total}}</div>
	  					<div class="col-xs-3">{{$invoice->sale_date}}</div>
	  				</div>
	  			</a>
	  		@endforeach
		</div>
	</div>

	<div id="invoice-make" class="width-third float-left">
		<div class="well">
			{!! Form::open(['url' => 'invoice/paper']) !!}	
			<div class="form-group">
				{!! Form::label('organization','Organization:') !!}
				{!! Form::select('organization', $organizations, null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('New Invoice' ,['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}
		</div>

		@if (Session::has('new_invoice'))
		<div class="alert alert-success">
		 	Invoice # <strong>{{ Session::get('new_invoice') }}</strong> created.
		</div>
		@endif

	</div>


@stop
