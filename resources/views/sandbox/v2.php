<html ng-app="myApp">
	<head>
		<title>Simple app</title>

		<link href="/css/sandbox.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	</head>
	<body ng-cloak>
	
		<div class="width-squeeze center" ng-controller="TicketsController">
			<h2>Inventory Manifest <small ng-if="totalCharge()">( Total: {{totalCharge()}} )</small></h2>

			<input class="form-control pad-bottom" type="text" placeholder="Filter By Ticket" ng-model="searchTicket">
			<input class="form-control pad-bottom" type="text" placeholder="Filter By Serial" ng-model="searchSerial">
			<div class="well">
				<form ng-submit="addTicket()">
					<div class="form-group">
						<div class="col-md-6">
							<input ng-model="newInventoryForm" class="form-control pad-bottom" type="text" placeholder="Form #">
						</div>
						<div class="col-md-6">
							<input ng-model="newInventorySerial" class="form-control pad-bottom" type="text" placeholder="Serial #">
						</div>
					</div>
					<button class="btn btn-default btn-block" type="submit">confirm</button>
				</form>
			</div>
			
		<div ng-repeat="ticket in tickets | filter:searchTicket">
				<small ng-if="getInventoryByTicket()">{{inventoryz[1]}}</small>
				{{ticket.name}}
			</div>
		<!-- <ul class="list-group">
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-3"><strong>Ticket Name</strong></div>
					<div class="col-md-3"><strong>Form</strong></div>
					<div class="col-md-3"><strong>Serial</strong></div>
					<div class="col-md-2"><strong>Price</strong></div>
				</div>
			</li>

			
		

			<!-- <li class="list-group-item" ng-repeat="ticket in tickets | filter:search">

				<div class="row">
					<div class="col-md-1"><input type="checkbox" ng-model="ticket.completed"></div>
					<div class="col-md-3">{{ticket.name}}</div>
					<div class="col-md-3">{{ticket.form}}</div>
					<div class="col-md-3">{{ticket.inventory[0].serial}}</div>
					<div class="col-md-2">{{ticket.price}}</div>
				</div>
				
			</li> -->
		</ul>
		</div>

		<script type="text/javascript">
		// $.ajaxSetup({
  // 		 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		// 		});
		</script>
		<script type="text/javascript" src="js/sandbox.js"></script>
	</body>
</html>