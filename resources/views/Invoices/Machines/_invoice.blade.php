<table id="invoice_data" class="table">
	<thead>
		<!-- <tr>
			<th><strong>Product</strong></th>
			<th><strong>Price</strong></th>
			<th><strong>Sold</strong></th>

			
			<th><strong>Net Sales</strong></th>
		</tr> -->
	</thead>
	<tbody>
				<tr class="invoice-header">
					<td class="invoice-header-data" colspan="4">Electronic Revenue</td>
				</tr>
				@foreach($lines as $line)
					@if($line->is_fee == 0)
					<tr class="line-item">
						<td>{{$line->line_name}}</td>
						<td>${{$line->price}}</td>
						<td>{{$line->sold_count}}</td>
						
						<td>${{($line->sold_count * $line->price)}}</td>
					</tr>
					@endunless
				@endforeach

				<tr class="line-item">
						<td colspan = '3'>Electronic Specials Total </td>
						<td>${{($invoice->total_specials)}}</td>
				</tr>
				<tr class="total-fee-line">
					<td class="invoice-header-data" colspan='3'>Total Electronic Revenue</td>
					<td class="invoice-header-data"><strong>${{$invoice->total_revenue}}</strong></td>
				</tr>

				<tr>
					<td class="table-gap" colspan='4'></td>
				</tr>
				<tr class="invoice-header">
					<td class="invoice-header-data" colspan="4">Distributor Fee</td>
				</tr>
				@foreach($lines as $line)
					@if($line->is_fee == 1)
					<tr class="line-item">
						<td>{{$line->line_name}}</td>
						<td>${{$line->price}}</td>
						<td>{{$line->sold_count}}</td>
						
						<td>${{($line->sold_count * $line->price)}}</td>
					</tr>
					@endif
				@endforeach

				<tr>
					<td class="table-gap" colspan='4'></td>
				</tr>

				<tr class="total-fee-line">
					<td class="invoice-header-data" colspan='3'>Total Machine Charge:</td>
					<td class="invoice-header-data"><strong>${{$invoice->total}}</strong></td>
				</tr>
				
				@if($invoice->flat_rate > 0)
				<tr class="discount-line">
					<td class="invoice-header-data" colspan='3'>Discount:</td>
					<td class="invoice-header-data"><strong>(${{($invoice->flat_rate - $invoice->total)*-1}})</strong></td>
				</tr>
				@endif

				@if($invoice->percent_discount > 0)
				<tr class="discount-line">
					<td class="invoice-header-data" colspan='3'>Discount:</td>
					<td class="invoice-header-data"><strong>(${{($invoice->percent_discount * $invoice->total)}})</strong></td>
				</tr>
				@endif

				@if($invoice->dollar_discount > 0)
				<tr class="discount-line">
					<td class="invoice-header-data" colspan='3'>Discount:</td>
					<td class="invoice-header-data"><strong>(${{($invoice->dollar_discount)}})</strong></td>
				</tr>
				@endif
				
				<tr class="total-fee-line">
					<td class="invoice-header-data" colspan='3'>Net Machine Total:</td>
					<td class="invoice-header-data"><strong>${{$invoice->total_after_discount}}</strong></td>
				</tr>

				<!-- gap -->
				<tr>
					<td class="table-gap" colspan='4'></td>
				</tr>
				<!-- end gap -->

				<!-- consumables -->
				@if($ticketInvoice->total > 0)
				<tr class="consumable-fee-line">
					<td class="invoice-header-data" colspan='3'>Instants Total:</td>
					<td class="invoice-header-data"><strong>${{$ticketInvoice->total}}</strong></td>
				</tr>
				@endif

				@if($paperInvoice->total > 0)
				<tr class="consumable-fee-line">
					<td class="invoice-header-data" colspan='3'>Paper Total:</td>
					<td class="invoice-header-data"><strong>${{$paperInvoice->total}}</strong></td>
				</tr>
				@endif

				@if($paperInvoice->total > 0 || $ticketInvoice->total > 0)
				<tr class="consumable-fee-line">
					<td class="invoice-header-data" colspan='3'>Consumables Total:</td>
					<td class="invoice-header-data"><strong>${{$paperInvoice->total + $ticketInvoice->total}}</strong></td>
				</tr>
				@endif
				<!-- end consumables -->

				<tr class="total-fee-line">
					<td class="invoice-header-data" colspan='3'>Grand Total:</td>
					<td class="invoice-header-data"><strong>${{$invoice->total_after_discount + $paperInvoice->total + $ticketInvoice->total}}</strong></td>
				</tr>



				
	</tbody>
</table>
</hr>