@extends('sandbox.navi')

@section('content')
<div class="width-squeeze center">
	<h2> Organizations </h2>
	<hr>
	<div class="list-group">
		@foreach($organizations as $organization)
			<div class="row">
				<div class="col-xs-6">
					<a href ={{route('organizations.edit', $organization->id)}} class="list-group-item">{{$organization->name}}</a>
				</div>
				<div class="col-xs-3">
					<a href ={{route('organizations.setup', $organization->id)}} class="btn btn-default">manage preferences</a>
				</div>
				<div class="col-xs-3">
					<a href ={{route('reports.electronic', $organization->id)}} class="btn btn-default">Running STR</a>
				</div>
			</div>
			<hr>
		@endforeach
	</div>

</div>


@stop