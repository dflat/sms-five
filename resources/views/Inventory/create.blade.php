@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
	
		{!! Form::open(['url' => 'inventory']) !!}

		<div class="form-group">
				{!! Form::label('ticket_select','Ticket:') !!}
				{!! Form::select('ticket_select', $ticketsList, $selectedTicket, ['class' => 'form-control']) !!}
			</div>
		
		<!-- <div class="form-group">
			{!! Form::label('form','Form:') !!}
			{!! Form::text('form', null, ['class' => 'form-control']) !!}
		</div> -->

		<div class="form-group">
			{!! Form::label('serial','Serial:') !!}
			{!! Form::text('serial', null, ['class' => 'form-control', 'id'=>'form-serial']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Add To Inventory' ,['class' => 'btn btn-primary form-control']) !!}
			
		</div>

		{!! Form::close() !!}

		@include('errors.list')
	</div>

	<script type="text/javascript">

		 $(function() {
		            $("#form-serial").focus();
		        });

		$(".form-text").bind("keydown", function(event) {
		    if (event.which === 13) {
		        event.stopPropagation();
		        event.preventDefault();
		        $(".form-serial").focus();
		        
		    }
		    //use this if scanner uses paste instead of simulating keyboard
		    // $("input").on("paste",function(e){
		    // $("#txtItem").focus();
		});

</script>


@stop

