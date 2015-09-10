@extends('sandbox.navi')

@section('content')

	<h1>Paper Products</h1> 
	 <table class="table table-hover">
    <thead>
      <tr>
        <th><a href={{route('paper_products.sort', 'name')}}>Paper Type</a></th>
        <th><a href={{route('paper_products.sort', 'price')}}>Price</a></th>
        <th><a href={{route('paper_products.sort', 'sheet_count' )}}>Sheet Count</a></th>
        <th><a href={{route('paper_products.sort', 'faces_on')}}>Faces On</a></th>
        <th><a href={{route('paper_products.sort', 'sheets_up')}}>Sheets Up</a></th>
        <th><a href={{route('paper_products.sort', 'qoh' )}}>In Stock</a></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
		@foreach($papers as $paper)
			@if($paper->qoh < $paper->reorder_point)
		    <tr class="danger">
		
		    @elseif($paper->qoh < $paper->reorder_point + 2)
		  
		    <tr class="warning">
		    @else
		    <tr> 
		    
		    @endif

		      	
		        <td><a href={{route('paper_products.show', $paper->id)}} class="min_link">{{$paper->name}}</a></td>
		        <td>{{$paper->price}}</td>
		        <td>{{$paper->sheet_count}}</td>
		        <td>{{$paper->faces_on}}</td>
		        <td>{{$paper->sheets_up}}</td>
		        <td>{{$paper->qoh}}</td>
		        <td>
		        	{!! Form::open(['method' => 'DELETE', 'action' => ['PaperProductsController@destroy', $paper->id]]) !!}
		        	
		        	<button type="submit" class="min_link btn btn-xs btn-link">
  					<span class="glyphicon glyphicon-trash"></span>
					</button>
		  
		        	{!! Form::close() !!}
		        </td>
		   		
		      </tr>
			
		@endforeach
    </tbody>
  </table>




@stop