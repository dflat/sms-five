@extends('sandbox.navi')

@section('imports')
<script type="text/javascript" src="/js/myApp.js"></script>
<script type="text/javascript" src="/js/InvoicesController.js"></script>

@stop

@section('content')
@include('Invoices.Tickets.ticketInvoicesANG')
@stop		
		