@extends('sandbox.navi')

@section('imports')
<script src="/js/jquery.table2excel.js"></script>
@stop

@section('content')


<div id="str-container" class="printable-table">
	<h4 class="inline-block">State Transaction Report: {{$organization->name}}</h4> 

	<div  id="export-xls" class="pull-right invoice-edit-button">
		<span class="glyphicon glyphicon-save-file"</span>
	</div>

	<table id="table2excel" class="table">
	    <!-- <thead>
	      <tr>
	        <th>Electronic Package</th>
	        <th>Price</th>
	        <th>Sold Count</th>
	        <th>Sold Sales</th>
	        <th>Void Count</th>
	        <th>Void Sales</th>
	        <th>Net Count</th>
	        <th>Net Sales</th>
	      </tr>
	    </thead> -->
	    <tbody>
			@foreach($reports as $report)
				@if(count($report->line_items) > 0)
				<tr class="str-header">
			        <td><strong>Electronic Package</strong></td>
			        <td><strong>Price</strong></td>
			        <td><strong>Sold Count</strong></td>
			        <td><strong>Sold Sales</strong></td>
			        <td><strong>Void Count</strong></td>
			        <td><strong>Void Sales</strong></td>
			        <td><strong>Net Count</strong></td>
			        <td><strong>Net Sales</strong></td>
	     		</tr>

	     		<tr>
	     			<td  class="str-date" colspan='8'>{{ date('d-M-y', strtotime($report->report_date))}}</td>
	     		</tr>
				
				@foreach($report->line_items as $line)
			    <tr>
			        <td>{{$line->line_name}}</td>
			        <td>{{$line->price}}</td>
			        <td>{{$line->sold_count}}</td>
			        <td>{{$line->price * $line->sold_count}}</td>
			        <td>{{$line->void_count}}</td>
			        <td>{{$line->price * $line->void_count}}</td>
			        <td>{{$line->sold_count - $line->void_count}}</td>
			        <td>{{($line->sold_count - $line->void_count) * $line->price}}</td>	
			     </tr>
			     @endforeach
			

				<tr class="str-totals">
					<td colspan='7'>Total: </td>
	     			<td colspan='1'>{{$report->total}}</td>
	     		</tr>

	     		<tr>
					<td class="table-gap" colspan='8'></td>
				</tr>
				<tr>
					<td class="table-gap" colspan='8'></td>
				</tr>
	     		@endif
			@endforeach
		
	    </tbody>
	  </table>
</div>


<script>
$("#export-xls").click(function(){

  $("#table2excel").table2excel({

    exclude: ".noExl",

    name: "StateTransactionReport",

    filename: "StateTransactionReport"

  });

});

</script>
@stop		