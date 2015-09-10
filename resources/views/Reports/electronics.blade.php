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

	<!-- <table id="table2excel" class="table">
	    <thead>
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
	    </thead>
	    <tbody>
			@foreach($reports as $report)
				<tr>
			        <td>Electronic Package</td>
			        <td>Price</td>
			        <td>Sold Count</td>
			        <td>Sold Sales</td>
			        <td>Void Count</td>
			        <td>Void Sales</td>
			        <td>Net Count</td>
			        <td>Net Sales</td>
	     		</tr>

	     		<tr>
	     			<td>{{ date('d-M-y', strtotime($report->report_date))}}</td>
	     		</tr>

				@foreach($report->line_items as $line)
			    <tr>
			        <td>{{$line->line_name}}</td>
			        <td>{{$line->price}}</td>
			        <td>{{$line->sold_count}}</td>
			        <td>{{$line->price * $line->sold_count}}</td>
			        <td>{{$line->void_count}}</td>
			        <td>{{$line->price * line->void_count}}</td>
			        <td>{{$line->sold_count - $line->void_count}}</td>
			        <td>{{($line->sold_count - $line->void_count) * $line->price}}</td>	
			     </tr>
			     @endforeach

				<tr>
					<td>Total: </td>
	     			<td>{{$report->total}}</td>
	     		</tr>
			@endforeach
		
	    </tbody>
	  </table> -->
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