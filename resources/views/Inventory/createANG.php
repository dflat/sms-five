<div ng-app="myApp">
	<div class="width-squeeze center" ng-controller="TicketsController">
			<h2>Add New Inventory <small ng-if="totalChargeDynamic()">( Total: <%totalChargeDynamic() | currency:"$"%> )</small></h2>

			<input class="form-control pad-bottom" type="text" placeholder="Filter By Ticket" ng-model="searchTicket.$">
			<input class="form-control pad-bottom" type="text" placeholder="Filter By Serial" ng-model="searchSerial">
			<!-- <div class="well">
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
			</div> -->
		<ul class="list-group">
			<li class="list-group-item">
				<div class="row">
					<!-- <div class="col-md-1"></div> -->
					<div class="col-md-3"><strong>Ticket Name</strong></div>
					<div class="col-md-3"><strong>Form</strong></div>
					<div class="col-md-3"><strong>Serial</strong></div>
					<div class="col-md-2"><strong>Price</strong></div>
				</div>
			</li>
			
			
			<div ng-repeat="ticket in filtered = (tickets | filter:searchTicket)">
				<a href="/tickets/<%ticket.id%>/inventory" class="list-group-item" ng-repeat="item in ticket.inventory | filter:searchSerial | orderBy:'-created_at'">

					<div class="row">
						<!-- <div class="col-md-1"><input ng-click="getInventoryByTicket(ticket.id)" type="checkbox"></div> -->
						<div class="col-md-3"><%ticket.name%></div>
						<div class="col-md-3"><%ticket.form%></div>
						<div class="col-md-3"><%item.serial%></div>
						<div class="col-md-2"><%ticket.price | currency:"$"%></div>
					</div>
				</a>
				
			</div>

		</ul>

		<!-- <a ng-repeat="item in inventoryz">
				<%item.id%>
			</a> -->
	</div>
</div>
