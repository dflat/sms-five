@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
	
		{!! Form::model($paper, ['method' => 'PATCH', 'action' => ['PaperProductsController@update', $paper->id]]) !!}
		
		@include('PaperProducts._form', ['submitButtonText' => 'Update Paper Product'])

		{!! Form::close() !!}

		@include('errors.list')

	</div>


@stop