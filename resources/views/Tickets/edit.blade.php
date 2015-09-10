@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
	
		{!! Form::model($ticket, ['method' => 'PATCH', 'action' => ['TicketsController@update', $ticket->id]]) !!}
		
		@include('tickets._form', ['submitButtonText' => 'Update Ticket'])

		{!! Form::close() !!}

		@include('errors.list')

	</div>


@stop