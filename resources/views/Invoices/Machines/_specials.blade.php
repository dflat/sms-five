<em> Specials Report </em>
<hr>
<table id="specials_data" class="table">
	<thead>
		<tr>
			<th><strong>Product</strong></th>
			<th><strong>Price</strong></th>
			<th><strong>Gross Sold</strong></th>
			<th><strong>Gross Sales</strong></th>
			<th><strong>Void Count</strong></th>
			<th><strong>Voided Sales</strong></th>
			<th><strong>Net Sold</strong></th>
			<th><strong>Net Sales</strong></th>
		</tr>
	</thead>
	<tbody>
		@foreach($lines as $line)
			@if($line->report_code == 113)
				<tr>
					<td>{{$line->name}}</td>
					<td>{{$line->price}}</td>
					<td>{{$line->gross_sold}}</td>
					<td>{{$line->gross_sales}}</td>
					<td>{{$line->voids}}</td>
					<td>{{$line->void_sales}}</td>
					<td>{{$line->net_sold}}</td>
					<td>{{$line->net_sales}}</td>
				</tr>
			@endif
		@endforeach
	</tbody>
</table>
</hr>