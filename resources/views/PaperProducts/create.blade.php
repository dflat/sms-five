@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
	
		{!! Form::open(['url' => 'paper_products']) !!}
		
		@include('PaperProducts._form', ['submitButtonText'=>'Add Paper Product'])

		{!! Form::close() !!}

		@include('errors.list')
	</div>


@stop