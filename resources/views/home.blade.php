@extends('sandbox.navi')

@section('content')
<div class="container">
	<div class="brand501">
		<span class="logo501">501</span>
		<span class="SMS">SALES MANAGEMENT SYSTEM</span>
	</div>
</div>

<script>
 $(function() {

	$(".logo501").fadeIn(
        {duration: 1800, queue: false });

    $(".logo501").animate(
    {letterSpacing: '-20px'}, { duration: 400, queue: false });
    	
    	$(".SMS").fadeIn({duration:2300, queue:false});
  

   

    });
 
 	
         



</script>
@endsection

