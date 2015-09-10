@extends('sandbox.navi')

@section('content')

	<ul class="list-group">
		<li class="list-group-item">{{$ticket->name}} : {{$ticket->form}}</li>
		@foreach($inventory as $item)
		<li class="list-group-item">{{$item->serial}}</li>
		@endforeach
	</ul>
	{!! $inventory->render() !!}


@stop