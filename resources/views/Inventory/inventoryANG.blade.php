<div ng-app="myApp" ng-cloak>
	<div class="row" ng-controller="TicketsController">
		
<!-- <li class="onlineIndicator" ng-show="online == 'online'"><span class="glyphicon glyphicon-ok pull-right"></span></li> -->

		<div id="inventory-container" class="col-md-7">
				<!-- <h2>Inventory Manifest <small ng-if="totalChargeDynamic()">( Total: <%totalChargeDynamic() | currency:"$"%> )</small></h2> -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Inventory On Hand <small ng-if="totalOnHand()">( Units: <strong><%totalOnHand() %></strong> )</small></h2>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
						<input id="ticketFilter" class="form-control pad-bottom" type="text" placeholder="Filter By Ticket" ng-model="searchTicket.$">
						</div>
						<div class="col-md-6">
						<input class="form-control pad-bottom" type="text" placeholder="Filter By Serial" ng-model="searchSerial">
						</div>
					</div>
				
				

					<ul class="list-group">
						<li class="list-group-item inv-list-header">
							<div class="row">
								<!-- <div class="col-md-1"></div> -->
								<div class="col-md-3"><strong>Ticket Name</strong></div>
								<div class="col-md-2"><strong>Form</strong></div>
								<div class="col-md-2"><strong>Serial</strong></div>
								<div class="col-md-2"><strong>Price</strong></div>
								<div class="col-md-2"><strong>Added</strong></div>

							</div>
						</li>
						
						
						<div ng-repeat="ticket in filteredByTicket = (tickets | filter:searchTicket | limitTo:limit)">
							
							<div class="row list-group-item row-tab-holder">
								<div class="row-tab">

									<input ng-model="showTicket" type="checkbox" id='<%ticket.id%>' class='tags-checkbox sr-only'/>

									    <label for='<%ticket.id%>'>
									        <i class='glyphicon glyphicon-triangle-right'></i>
									        <i class='glyphicon glyphicon-triangle-bottom'></i>
									    </label>

									<kbd class="label label-default"><%ticket.name%></kbd>
								
									<span 
									ng-class="{'inv-count-critical':ticket.inventory.length < ticket.reorder_point, 'inv-count-low':ticket.inventory.length < (ticket.reorder_point + (ticket.reorder_point * .1))}" 
									class="label label-default inv-count"><%ticket.inventory.length%> in stock</span>
										
								</div>
							</div>

							<div class="inventory-by-ticket-container" ng-if="showTicket">
								<a href="/tickets/<%ticket.id%>/inventory" class="list-group-item" 
									ng-repeat="item in filteredBySerial = (ticket.inventory | filter:searchSerial | orderBy:'-created_at')">

									<div class="row">

										<!-- <div class="col-md-1"><input ng-click="getInventoryByTicket(ticket.id)" type="checkbox"></div> -->
										<div class="col-md-3"><%ticket.name%></div>
										<div class="col-md-2"><%ticket.form%></div>
										<div class="col-md-2"><%item.serial%></div>
										<div class="col-md-2"><%ticket.price | currency:"$"%></div>
										<div class="col-md-2"><%item.created_at | timestampToISO | date%></div>
										<span ng-show="item.created_at == 'Just Now'" class="badge">new</span>
									
									</div>
								</a>
							</div>
						</div>

					</ul>
				</div>
			</div>
		</div>
		<div id="new-inventory-form-container" class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2><span class="glyphicon glyphicon-download-alt"></span> New Inventory</h2>
					<span ng-show="newlyAdded" class="badge pull-right"><%newlyAdded%> new</span>
				</div>
				<div class="panel-body">
					<form ng-submit="addTicket()">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input ng-model="newInventoryForm" class="form-control pad-bottom" type="text" placeholder="Form #" id="inputFormNo">
								</div>
								<div class="col-md-6">
									<input ng-model="newInventorySerial" class="form-control pad-bottom" type="text" placeholder="Serial #" id="inputSerialNo">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-default btn-block center" type="submit">Add To Inventory</button>
								</div>
							</div>
						</div>			
						
					</form>

					<div ng-show="alreadyAdded" class="alert alert-danger">
						<span>Item already in inventory ( <%currentTicketName%> : <%errorSerial%> )</span>
					</div>

					<div ng-show="invalidForm" class="alert alert-danger">
						<span>Invalid form number ( <%errorForm%> )</span>
					</div>

					<div ng-show="addedSuccessfully" class="alert alert-success">
						<span>Inventory Added ( <%currentTicketName%> : <%errorSerial%> )</span>
					</div>

					<div ng-show="missingInput" class="alert alert-danger">
						<span>Must provide Form and Serial number.</span>
					</div>

				</div>

				
			</div>
		</div>
	</div>
</div>
