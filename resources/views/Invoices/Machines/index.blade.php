@extends('sandbox.navi')

@section('content')
	<h4 class="invoice-header">
		<strong>Machine Invoices</strong>
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
					@if($invoice->reports_uploaded)
	  				<a href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'invoice'])}}" class="list-group-item list-group-item-success">
	  				@else
	  				<a href="/invoice/machines/{{$invoice->invoice_no}}/upload" class="list-group-item list-group-item-success">
	  				@endif
				<!-- <a href="{{route('invoice.machines.show', $invoice->invoice_no)}}" class="list-group-item list-group-item-success"> -->
				@else
					@if($invoice->reports_uploaded)
	  				<a href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'invoice'])}}" class="list-group-item">
	  				@else
	  				<a href="/invoice/machines/{{$invoice->invoice_no}}/upload" class="list-group-item">
	  				@endif
	  			@endif 
	  				<div class="row">
	  					<div class="col-xs-3">{{$invoice->invoice_no}}</div>
	  					<div class="col-xs-4">{{$invoice->org_name}}</div>
	  					<div class="col-xs-2">{{$invoice->total_after_discount}}</div>
	  					<div class="col-xs-3">{{$invoice->invoice_date}}</div>
	  				</div>
	  			</a>
	  		@endforeach
		</div>
	</div>

	<div id="invoice-make" class="width-third float-left">
		<div class="well">
			{!! Form::open(['url' => 'invoice/machines']) !!}	
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
