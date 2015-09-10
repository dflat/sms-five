   {!! Form::open(['method' => 'POST', 'action' => ['InventoryController@store']]) !!}
		
		{!! Form::submit('add' ,['class' => 'btn btn-xs btn default float-right']) !!}

	{!! Form::close() !!}