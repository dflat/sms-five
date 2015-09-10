@extends('sandbox.navi')

@section('imports')
<script type="text/javascript" src="/js/DomManipulationHelpers.js"></script>
@stop

@section('content')

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="hovered-icon-text" class="modal-title">Go To</h4>
      </div>
      <div class="modal-body">
      	
      	<div class="modal-location-button" data-destination="Associated Paper Invoice">
       		<a href="{{route('invoice.paper.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-copy"></a>
     	</div>

     	<div class="modal-location-button" data-destination="Associated Electronic Invoice">
       		<a href="{{route('invoice.machines.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-flash"></a>
     	</div>

     	<div class="modal-location-button" data-destination="Master Invoice">
       		<a href="{{route('invoice.master.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-folder-close"></a>
       		
     	</div>

     	<div class="modal-location-button" data-destination="All Ticket Invoices">
       		<a href="{{route('invoice.tickets.index')}}" class="glyphicon glyphicon-list"></a>
       		
     	</div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="invoice-display">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<div class="float-left">
				<h4>
					<strong>Ticket Invoice # {{$invoice->invoice_no}}</strong>
					<small>{{$invoice->sale_date}} ( {{$invoice->sold_to}} ) </small>
				</h4>
			</div>
			<div class="invoice-edit-button float-left left-margin">
				<button type="button" class="btn btn-info btn-xs modal-btn-custom" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-new-window"</span></button>
				<!-- <a href="{{route('invoice.tickets.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-copy" data-toggle="modal" data-target="#myModal"></a> -->
			</div>
			<div class="invoice-edit-button float-right">
				<a href="{{route('invoice.tickets.edit', ['id'=>$invoice->invoice_no,'action'=>'sell'])}}" class="glyphicon glyphicon-plus-sign"></a>
			</div>
			<div class="invoice-edit-button float-right">
				<a href="{{route('invoice.tickets.edit', ['id'=>$invoice->invoice_no,'action'=>'return'])}}" class="glyphicon glyphicon-minus-sign"></a>
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

@stop
