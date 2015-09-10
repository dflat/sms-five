@extends('sandbox.navi')

@section('imports')
<script type="text/javascript" src="/js/myApp.js"></script>
<script type="text/javascript" src="/js/SetupController.js"></script>
@stop

@section('content')
@include('Organizations.setupANG')
<hr>

<div class='color-segment'>
	

	
		
	
	<div class="form-group center">
		{!! Form::open(array('url'=>'electronic/discover','files'=>true)) !!}
			<!-- {!! Form::label('file','File',array('id'=>'','class'=>'form-control')) !!}
			{!! Form::file('file','',array('id'=>'','class'=>'form-control')) !!} -->
		
		<div class="input-group center">
			<h4 class="center">Discover Products</h4>
			<hr>
		 	<div class="row pad-bottom">
			 	<div class="col-xs-3">
	                <span class="input-group-btn width-squeeze">
	                    <span class="btn btn-primary btn-file">
	                        Browse <input type="file" name="adm-file">
	                    </span>  
	                </span>
	            </div>
	            <div class="col-xs-9">
	                <input type="text" id="adm-display" placeholder = "Admissions File" class="form-control" readonly>
	            </div> 
            </div>

            <div class="row pad-bottom">
			 	<div class="col-xs-3">
	                <span class="input-group-btn width-squeeze">
	                    <span class="btn btn-primary btn-file">
	                        Browse <input type="file" name="specials-file">
	                    </span>  
	                </span>
	            </div>
	            <div class="col-xs-9">
	                <input type="text" placeholder = "Specials File" class="form-control" readonly>
	            </div> 
            </div>

              <div class="row pad-bottom">
			 	<div class="col-xs-3">
	                <span class="input-group-btn width-squeeze">
	                    <span class="btn btn-primary btn-file">
	                        Browse <input type="file" name="distrib-file">
	                    </span>  
	                </span>
	            </div>
	            <div class="col-xs-9">
	                <input type="text" placeholder = "Distrib File" class="form-control" readonly>
	            </div> 
            </div>
			
			<div class="col-xs-12">
			{!! Form::hidden('org_id', $org_id) !!}
            {!! Form::submit('Upload Files', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        	</div>

        </div>
        
    </div>

	
	</div>



<script type="text/javascript">

	$('input[type=file]').change(function(){

		var selected_file = this.value;
		var file_name = selected_file.replace(/^.*\\/, "");
		var display_box = $(this).closest('.row').find('input[type=text]');
		//var display_box = $(this).parent().parent().parent().parent().nextAll("input[type=text]").first().addClass('filled');
		display_box.val(file_name);

	

	});

	
</script>


@stop	