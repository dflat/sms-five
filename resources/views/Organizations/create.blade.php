@extends('sandbox.navi')

@section('content')

<div class="left_third_push">
	
		{!! Form::open(['url' => 'organizations']) !!}
		
		@include('organizations._form', ['submitButtonText'=>'Add Organization'])

		{!! Form::close() !!}

		@include('errors.list')
</div>

@stop