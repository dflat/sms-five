@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
		<h2>
			{{$ticket->name}}
		</h2>
		
			<ul class="list-group">
				<a href={{route('tickets.edit', $ticket->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Price:</div>
						<div class="col-md-8">{{$ticket->price}}</div>
					</div>
				</a>
				<a href={{route('tickets.edit', $ticket->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Take In:</div>
						<div class="col-md-8">{{$ticket->take_in}}</div>
					</div>
				</a>
				<a href={{route('tickets.edit', $ticket->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Payout:</div>
						<div class="col-md-8">{{$ticket->pay_out}}</div>
					</div>
				</a>
				<a href={{route('tickets.edit', $ticket->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Ticket Count:</div>
						<div class="col-md-8">{{$ticket->ticket_count}}</div>
					</div>
				</a>
				<a href={{route('tickets.edit', $ticket->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">In Stock:</div>
						<div class="col-md-8">{{$ticket->qoh}}</div>
					</div>
				</a>
			</ul>

			<!-- @foreach($unsold_inventory as $item)
			<div class = "list-group">
				<a class = "list-group-item">{{$item->serial}}</a>
			</div>
			@endforeach -->
	</div>
			 
		
	

@stop