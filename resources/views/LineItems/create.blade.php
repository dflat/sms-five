		
@extends('app')

@section('content')

	<div class="left_third_push">
	
		{!! Form::open(['url' => 'lines']) !!}
		
		<div class="form-group">
			{!! Form::label('form','Form:') !!}
			{!! Form::text('form', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('serial','Serial:') !!}
			{!! Form::text('serial', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('submit' ,['class' => 'btn btn-primary form-control']) !!}
			
		</div>

		{!! Form::close() !!}

		@include('errors.list')
	</div>


@stop

