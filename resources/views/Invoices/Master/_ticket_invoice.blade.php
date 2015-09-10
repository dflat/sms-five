<h4>Ticket Summary</h4> 
	 <table class="table">
    <thead>
      <tr>
        <th>Serial #</th>
        <th>Ticket Name</th>
        <th>Form #</th>
        <th>Ticket Count</th>
        <th>Deal Price</th>
        <th>Take In</th>
        <th>Pay Out</th>
        <th>Profit</th>
      </tr>
    </thead>
    <tbody>
		@foreach($ticketInvoice as $line)
			
		    <tr>
		        <td>{{$line->serial}}</td>
		        <td>{{$line->name}}</td>
		        <td>{{$line->form}}</td>
		        <td>{{$line->ticket_count}}</td>
		        <td>${{$line->price}}</td>
		        <td>${{$line->take_in}}</td>
		        <td>${{$line->pay_out}}</td>
		        <td>${{$line->profit}}</td>		   		
		     </tr>
			
		@endforeach
	
		<tr class='totals'>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Total:</td>
			<td>${{$total_take_in}}</td>
			<td>${{$total_pay_out}}</td>
			<td>${{$total_profit}}</td>
		</tr>
	
		<tr class='total-ticket-invoice'>
			<td colspan="8">Ticket Invoice Total : <strong>${{$ticket_total}}</strong></td>
		</tr>
	
    </tbody>
  </table>