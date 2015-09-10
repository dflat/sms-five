<table id="str_data" class="table">
	<thead>
		<tr class="invoice-header">
			<th><strong>Product</strong></th>
			<th><strong>Price</strong></th>
			<th><strong>Gross Sold</strong></th>
			<th><strong>Gross Sales</strong></th>
			<th><strong>Void Count</strong></th>
			<th><strong>Voided Sales</strong></th>
			
			<th><strong>Net Sales</strong></th>
		</tr>
	</thead>
	<tbody>
		@foreach($lines as $line)

				<tr>
					<td>{{$line->line_name}}</td>
					<td>${{$line->price}}</td>
					<td>{{$line->sold_count}}</td>
					<td>${{$line->sold_count * $line->price}}</td>
					<td>{{$line->void_count}}</td>
					<td>${{$line->void_count * $line->price}}</td>
				
					<td>${{($line->sold_count * $line->price) - ($line->void_count * $line->price)}}</td>
				</tr>
		
		@endforeach

		<tr class="total-fee-line">
					<td class="invoice-header-data" colspan='6'>Total Electronic Revenue</td>
					<td class="invoice-header-data"><strong>${{$str->total}}</strong></td>
		</tr>
	</tbody>
</table>