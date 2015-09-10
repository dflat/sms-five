		<div class="form-group">
			{!! Form::label('name','Ticket Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('form','Form #:') !!}
			{!! Form::text('form', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('price','Price:') !!}
			{!! Form::text('price', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('ticket_count','Ticket Count:') !!}
			{!! Form::text('ticket_count', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('take_in','Take In:') !!}
			{!! Form::text('take_in', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('pay_out','Payout:') !!}
			{!! Form::text('pay_out', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('qoh','In Stock:') !!}
			{!! Form::text('qoh', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('reorder_point','Reorder Point:') !!}
			{!! Form::text('reorder_point', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit($submitButtonText ,['class' => 'btn btn-primary form-control']) !!}
			
		</div>