@extends('sandbox.navi')

@section('content')

	<div class="left_third_push">
		<h2>
			{{$paper->name}}
		</h2>
		
			<ul class="list-group">
				<a href={{route('paper_products.edit', $paper->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Price:</div>
						<div class="col-md-8">{{$paper->price}}</div>
					</div>
				</a>
				<a href={{route('paper_products.edit', $paper->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Faces On:</div>
						<div class="col-md-8">{{$paper->faces_on}}</div>
					</div>
				</a>
				<a href={{route('paper_products.edit', $paper->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Sheets Up:</div>
						<div class="col-md-8">{{$paper->sheets_up}}</div>
					</div>
				</a>
				<a href={{route('paper_products.edit', $paper->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">Sheet Count:</div>
						<div class="col-md-8">{{$paper->sheet_count}}</div>
					</div>
				</a>
				<a href={{route('paper_products.edit', $paper->id)}} class="list-group-item">
					<div class="row">
						<div class="col-md-4">In Stock:</div>
						<div class="col-md-8">{{$paper->qoh}}</div>
					</div>
				</a>
			</ul>

			
	</div>
			 
		
	

@stop