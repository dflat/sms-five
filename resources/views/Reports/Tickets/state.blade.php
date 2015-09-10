@extends('sandbox.navi')

@section('imports')
<script src="/js/jquery.table2excel.js"></script>
@stop

@section('content')
<div id="ticket-invoice-container" class="printable-table">
	<h4 class="inline-block">State Report: Instant Bingo</h4> 

	<div  id="export-xls" class="pull-right invoice-edit-button">
		<span class="glyphicon glyphicon-save-file"</span>
	</div>

	<table id="table2excel" class="table">
	    <thead>
	      <tr>
	        <th>DCG #</th>
	        <th>Organization</th>
	        <th>Address</th>
	        <th>City</th>
	        <th>State</th>
	        <th>Zip Code</th>
	        <th>Invoice #</th>
	        <th>Invoice Date</th>
	        <th>Invoice Total</th>
	        <th>Invoice Line Amount</th>
	        <th>Instant Bingo Name of Deal</th>
	        <th>Instant Bingo Form #</th>
	        <th>Instant Bingo Serial #</th>
	        <th>Instant Bingo Ticket Count</th>
	        <th>Instant Bingo Take In</th>
	        <th>Instant Bingo Pay Out</th>  
	      </tr>
	    </thead>
	    <tbody>
			@foreach($report as $line)
				
			    <tr>
			        <td>{{$line->DCG}}</td>
			        <td>{{$line->sold_to}}</td>
			        <td>{{$line->address}}</td>
			        <td>{{$line->city}}</td>
			        <td>{{$line->state}}</td>
			        <td>{{$line->zip}}</td>
			        <td>{{$line->invoice_no}}</td>
			        <td>{{ date('d-M-y', strtotime($line->invoice_date))}}</td>
			        <td>${{$line->invoice_total}}</td>
			        <td>${{$line->invoice_line_amount}}</td>	
			        <td>{{$line->deal_name}}</td>
			        <td>{{$line->form_number}}</td>
			        <td>{{$line->serial}}</td>	 
			        <td>{{$line->ticket_count}}</td>	
			        <td>${{$line->take_in}}</td>	
			        <td>${{$line->pay_out}}</td>	  		
			     </tr>
				
			@endforeach
		
	    </tbody>
	  </table>
</div>
<script>
$("#export-xls").click(function(){

  $("#table2excel").table2excel({

    exclude: ".noExl",

    name: "SupplierReportingInstantBingo",

    filename: "SupplierReportingInstantBingo"

  });

});

</script>
@stop		
		