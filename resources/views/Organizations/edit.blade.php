@extends('sandbox.navi')

@section('content')

	<div class="left-third-push">
	
		{!! Form::model($organization, ['method' => 'PATCH', 'action' => ['OrganizationsController@update', $organization->id]]) !!}
		
		@include('organizations._form', ['submitButtonText' => 'Update Organization'])

		{!! Form::close() !!}

		@include('errors.list')

	</div>


@stop