@extends('sandbox.navi')

@section('content')

	<h1>Pull Tabs</h1> 
	 <table class="table table-hover">
    <thead>
      <tr>
        <th><a href={{route('tickets.sort', 'name')}}>Ticket Name</a></th>
        <th><a href={{route('tickets.sort', 'price')}}>Deal Price</a></th>
        <th><a href={{route('tickets.sort', 'ticket_count' )}}>Ticket Count</a></th>
        <th><a href={{route('tickets.sort', 'take_in')}}>Take In</a></th>
        <th><a href={{route('tickets.sort', 'pay_out')}}>Payout</a></th>
        <th><a href={{route('tickets.sort', 'qoh' )}}>In Stock</a></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
		@foreach($tickets as $ticket)
			@if($ticket->qoh < $ticket->reorder_point)
		    <tr class="danger">
		
		    @elseif($ticket->qoh < $ticket->reorder_point + 2)
		  
		    <tr class="warning">
		    @else
		    <tr> 
		    
		    @endif

		      	
		        <td><a href={{route('tickets.show', $ticket->id)}} class="min_link">{{$ticket->name}}</a></td>
		        <td>{{$ticket->price}}</td>
		        <td>{{$ticket->ticket_count}}</td>
		        <td>{{$ticket->take_in}}</td>
		        <td>{{$ticket->pay_out}}</td>
		        <td>{{$ticket->qoh}}</td>
		        <td>
		        	{!! Form::open(['method' => 'DELETE', 'action' => ['TicketsController@destroy', $ticket->id]]) !!}
		        	
		        	<button type="submit" class="min_link btn btn-xs btn-link">
  					<span class="glyphicon glyphicon-trash"></span>
					</button>
		  
		        	{!! Form::close() !!}
		        </td>
		   		
		      </tr>
			
		@endforeach
    </tbody>
  </table>




@stop