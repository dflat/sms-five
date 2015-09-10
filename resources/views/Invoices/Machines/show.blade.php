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

      	<div class="modal-location-button" data-destination="Associated Ticket Invoice">
       		<a href="{{route('invoice.tickets.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-copy"></a>
     	</div>

     	<div class="modal-location-button" data-destination="Associated Paper Invoice">
       		<a href="{{route('invoice.paper.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-file"></a>
     	</div>

     	<div class="modal-location-button" data-destination="Master Invoice">
       		<a href="{{route('invoice.master.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-folder-close"></a>
       		
     	</div>

     	<div class="modal-location-button" data-destination="All Machine Invoices">
       		<a href="{{route('invoice.machines.index')}}" class="glyphicon glyphicon-list"></a>
       		
     	</div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@include('Invoices.Machines._discountModal')


<div id="invoice-display">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<div class="float-left">
				<h4>
					<strong>Machine Invoice # {{$invoice->invoice_no}}</strong>
					<small>{{$invoice->invoice_date}} ( {{$invoice->sold_to}} ) </small>
				</h4>
			</div>

			<div class="invoice-edit-button float-left left-margin">
				<button type="button" class="btn btn-info btn-xs modal-btn-custom" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-new-window"</span></button>
				<!-- <a href="{{route('invoice.tickets.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-copy" data-toggle="modal" data-target="#myModal"></a> -->
			</div>
			<!-- <div class="invoice-edit-button float-right">
				<a href="{{route('invoice.paper.edit', ['id'=>$invoice->invoice_no,'action'=>'sell'])}}" class="glyphicon glyphicon-plus-sign"></a>
			</div> -->


			<div class="invoice-edit-button float-right left-margin">
				<a href="/invoice/machines/{{$invoice->invoice_no}}/upload" class="glyphicon glyphicon-cloud-upload"></a>
			</div>
			
			<div class="invoice-edit-button float-right left-margin top-margin">
				<button type="button" class="btn btn-info btn-xs modal-btn-custom" data-toggle="modal" data-target="#discountModal"><span class="glyphicon glyphicon-tag"</span></button>
				<!-- <a href="{{route('invoice.tickets.show', $invoice->invoice_no)}}" class="glyphicon glyphicon-copy" data-toggle="modal" data-target="#myModal"></a> -->
			</div>

			<div class="logo-container pull-right only-printable">
				<img src="{{asset('images/501Logo.png')}}" class="logo-501">
				<img src="{{asset('images/services.png')}}" class="logo-services">
			</div>

		</div>
		<div class="panel-body">
			

			<div class="report-buttons">
				<!-- <a class="btn btn-info" id="admissions" role="button" href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'admissions'])}}">Admissions</a>
				<a class="btn btn-info" id="specials" role="button" href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'specials'])}}">Specials</a>
				<a class="btn btn-info" id="distrib" role="button" href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'distrib'])}}">Distributor</a> -->
				
				<a class="btn btn-info btn-tab" id="invoice" role="button" href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'invoice'])}}">Invoice</a>
				<a class="btn btn-info btn-tab" id="STR" role="button" href="{{route('invoice.machines.show', ['id' => $invoice->invoice_no, 'report' => 'STR'])}}">STR</a>
			</div>
			
			

			@if(Input::get('report') == 'admissions')
				@include('Invoices.Machines._admissions')
			@endif

			@if(Input::get('report') == 'specials')
				@include('Invoices.Machines._specials')
			@endif

			@if(Input::get('report') == 'distrib')
				@include('Invoices.Machines._distrib')
			@endif

			@if(Input::get('report') == 'STR')
				@include('Invoices.Machines._str')
			@endif
			
			@if(Input::get('report') == 'invoice')
				@include('Invoices.Machines._invoice')
			@endif

		</div>
		<div class="panel-footer">
			<div class="row">
				<!-- <div class="col-xs-3 col-md-offset-9">
					<strong>Total: {{$invoice->total}}</strong>
				</div> -->
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#{{Input::get('report')}}").addClass('selected-report-btn');
</script>

@stop
