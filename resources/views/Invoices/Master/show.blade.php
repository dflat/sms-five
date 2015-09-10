@extends('sandbox.navi')

@section('content')

<div id="invoice-header-container">
	@include('Invoices.Master._header')
</div>

<div id="ticket-invoice-container" class="printable-table">
	@include('Invoices.Master._ticket_invoice')
<div>

<div id="paper-invoice-container" class="printable-table">
	@include('Invoices.Master._paper_invoice')
</div>

<div id="invoice-footer-container">
	@include('Invoices.Master._footer')
</div>

@stop