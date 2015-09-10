@extends('sandbox.navi')

@section('content')
<div id="invoice-display-edit" class="float-left">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<div class="float-left">
				<h4>
					<strong>Invoice # {{$invoice->invoice_no}}</strong>
					<small>{{$invoice->sale_date}} ( {{$invoice->sold_to}} ) </small>
				</h4>
			</div>
			<div id="invoice-edit-button" class="invoice-edit-button float-right">
				<a href="{{route('invoice.tickets.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-ok-circle"></a>
			</div>
		</div>

		<div class="panel-body">
			<table id="ticket_invoice" class="table">
				<thead>
					<tr>
						<th><strong>Ticket Name</strong></th>
						<th><strong>Form</strong></th>
						<th><strong>Serial</strong></th>
						<th><strong>Price</strong></th>
					</tr>
				</thead>
				<tbody>
					@foreach($lines as $line)
						<tr>
							<td>{{$line->name}}</td>
							<td>{{$line->form}}</td>
							<td>{{$line->serial}}</td>
							<td>{{$line->sale_price}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-3 col-md-offset-9">
					<strong>Total: {{$invoice->total}}</strong>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="invoice-add-line-form" class="width-third float-left">

	@if(Input::get('action')=='sell')
	<div class="well clearfix">
		{!! Form::open(['url' => 'lines']) !!}	
		{!! Form::hidden('invoice_no',$invoice->invoice_no) !!}
		<div class="form-group">
			{!! Form::label('form','form:') !!}
			{!! Form::text('form', null, ['class' => 'form-control form-text','id'=>"form-number"]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('serial','serial:') !!}
			{!! Form::text('serial', null, ['class' => 'form-control form-serial']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Sell' , ['class' => 'btn btn-primary form-control']) !!}
		</div>
		{!! Form::close() !!}
	</div>

	@elseif(Input::get('action')=='return')
	<div class="well clearfix">
		{!! Form::open(['action' => ['LineItemsController@destroy'], 'method' => 'DELETE']) !!}	
		{!! Form::hidden('invoice_no',$invoice->invoice_no) !!}
		<div class="form-group">
			{!! Form::label('form','form:') !!}
			{!! Form::text('form', null, ['class' => 'form-control form-text','id'=>"form-number"]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('serial','serial:') !!}
			{!! Form::text('serial', null, ['class' => 'form-control form-serial']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Return' , ['class' => 'btn btn-primary form-control']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	@endif
	
	@if (Session::has('invalid_form'))
	<div class="alert alert-danger">
		<strong>{{ Session::get('invalid_form') }}</strong> is not a valid form number.
	</div>

	@elseif (Session::has('not_in_inventory'))
	<div class="alert alert-warning">
		{{Session::get('not_in_inventory')}}
		<!-- <strong>{{ Session::get('serial') }}</strong>
		<small> ( {{ Session::get('ticket_name') }} )</small>
		not in system. 
		@include('invoices.tickets._add_now') -->
	</div>

	@elseif (Session::has('already_sold'))
	<div class="alert alert-warning">
		{{ Session::get('already_sold') }}
	</div>

	@elseif (Session::has('wrong_invoice'))
	<div class="alert alert-warning">
		{{ Session::get('wrong_invoice') }}
	</div>

	@elseif (Session::has('action_successful'))
	<div class="alert alert-success">
		{{ Session::get('action_successful') }}

	</div>
	@endif

	@include('errors.list')

</div>



<script type="text/javascript">
 $(function() {
            $("#form-number").focus();
        });

$(".form-text").bind("keydown", function(event) {
    if (event.which === 13) {
        event.stopPropagation();
        event.preventDefault();
        $(".form-serial").focus();
        
    }
    //use this if scanner uses paste instead of simulating keyboard
    // $("input").on("paste",function(e){
    // $("#txtItem").focus();
});

</script>
@stop
