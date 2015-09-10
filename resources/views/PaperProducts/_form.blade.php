		<div class="form-group">
			{!! Form::label('name','Paper Name:') !!}
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
			{!! Form::label('sheet_count','Sheet Count:') !!}
			{!! Form::text('sheet_count', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('faces_on','Faces On:') !!}
			{!! Form::text('faces_on', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('sheets_up','Sheets Up:') !!}
			{!! Form::text('sheets_up', null, ['class' => 'form-control']) !!}
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