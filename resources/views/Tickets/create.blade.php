@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
	
		{!! Form::open(['url' => 'tickets']) !!}
		
		@include('tickets._form', ['submitButtonText'=>'Add Ticket'])

		{!! Form::close() !!}

		@include('errors.list')
	</div>


@stop