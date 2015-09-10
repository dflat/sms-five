<div ng-app="myApp" ng-cloak>
	<div class="row" ng-controller="ReportsController">
		<div class="container inspect">
			<h2>Profit Per Ticket</h2>

			<div ng-repeat="ticket in tickets" class="panel panel-default card-width float-left">
				<div class="panel-heading">
					<%ticket.name%>
				</div>
				<div class="panel-body card-body">
					<div class="float-left half">
						<h2><span class="label label-default"><%ticket.profit_ratio | number%></span></h2>
						<h3><%ticket.deals_sold%> sold</h2>
					</div>
					<div class="float-right half">
						<h4><%ticket.total_ticket_revenue%></h4>
						<h4>(<%ticket.total_ticket_cost%>)</h4>
						<h4><%ticket.total_ticket_profit%></h4>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>