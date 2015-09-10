<div ng-app="myApp" ng-cloak>
	<div class="row" ng-controller="PaperInvoicesController">
		<div class="container inspect">
			<div class="row filterInputs">
				<div class="col-md-2">
					<input type="text" placeholder="Invoice #" ng-model="search.invoice_no" class="form-control">
				</div>
				<div class="col-md-2">
					<input type="text" placeholder="Paper Type" ng-model="search.ticket_name" class="form-control">
				</div>
				<div class="col-md-1">
					<input type="text" placeholder="Form #" ng-model="search.form_no" class="form-control">
				</div>
				<div class="col-md-1">
					<input type="text" placeholder="Serial #" ng-model="search.serial_no" class="form-control">
				</div>
				<div class="col-md-2">
					<input type="text" placeholder="Customer" ng-model="search.sold_to" class="form-control">
				</div>
				<div class="col-md-2">
					<input type="text" placeholder="Sale Price" ng-model="search.sale_price" class="form-control">
				</div>
				<div class="col-md-2">
					<input type="text" placeholder="Date Sold" ng-model="search.sale_date" class="form-control">
				</div>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item inv-list-header">
					<div class="row">
						<div class="col-md-1">Invoice #</div>
						<div class="col-md-3">Paper Type</div>
						<div class="col-md-1">Form #</div>
						<div class="col-md-1">Serial #</div>
						<div class="col-md-2">Customer</div>
						<div class="col-md-2">Sale Price</div>
						<div class="col-md-2">Date Sold</div>
					</div>
				</li>
				<div class="all-results" ng-click="increaseLimit()">
					
						
							<a href="/invoice/paper/<%invoice_line.invoice_no%>" class="list-group-item" ng-repeat="invoice_line in filteredInvoiceLines = (invoice_lines | filter:search | limitTo:limit)">
								
								<div class="row">
									<div class="col-md-1"><%::invoice_line.invoice_no%></div>
									<div class="col-md-3"><%::invoice_line.ticket_name%></div>
									<div class="col-md-1"><%::invoice_line.form_no%></div>
									<div class="col-md-1"><%::invoice_line.serial_no%></div>
									<div class="col-md-2"><%::invoice_line.sold_to%></div>
									<div class="col-md-2"><%::invoice_line.sale_price | currency:"$"%></div>
									<div class="col-md-2"><%::invoice_line.sale_date | timestampToISO | date%></div>
								</div> 
								
							</a>
						
					
				</div>
			</ul>
		</div>
	</div>
</div>