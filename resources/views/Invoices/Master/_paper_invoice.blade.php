<h4>Paper Summary</h4> 
	 <table class="table">
    <thead>
      <tr>
        <th>Serial #</th>
        <th>Description</th>
        <th>Up</th>
        <th>On</th>
        <th>Perm</th>
        <th>Color Start</th>
        <th>Sheets / Books</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
		@foreach($paperInvoice as $line)
			
		    <tr>
		        <td>{{$line->serial}}</td>
		        <td>{{$line->name}}</td>
		        <td>{{$line->sheets_up}}</td>
		        <td>{{$line->faces_on}}</td>
		        <td>{{$line->permutation}}</td>
		        <td>{{$line->color}}</td>
		        <td>{{$line->sheet_count}}</td>
		        <td>{{$line->price}}</td>	   		
		     </tr>
			
		@endforeach

		<tr class='total-ticket-invoice'>
			<td colspan="8">Paper Invoice Total : <strong>${{$paper_total}}</strong></td>
		</tr>

    </tbody>
  </table>