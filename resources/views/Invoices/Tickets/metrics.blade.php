@extends('sandbox.navi')

@section('imports')
<script type="text/javascript" src="/js/myApp.js"></script>
<script type="text/javascript" src="/js/MetricsController.js"></script>
<script type="text/javascript" src="/js/Chart.min.js"></script>
<script type="text/javascript" src="/js/picker.js"></script>
<script type="text/javascript" src="/js/picker.date.js"></script>
<link rel="stylesheet" href="/css/default.css">
<link rel="stylesheet" href="/css/default.date.css">


@stop

@section('content')
@include('invoices.tickets.metricsANG')
@stop		
		