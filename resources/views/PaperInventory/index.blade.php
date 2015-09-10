@extends('sandbox.navi')

@section('imports')
<script type="text/javascript" src="js/myApp.js"></script>
<script type="text/javascript" src="js/PaperController.js"></script>
@stop

@section('content')
@include('PaperInventory.inventoryANG')
@stop		
		

	