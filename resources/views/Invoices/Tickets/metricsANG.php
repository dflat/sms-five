<div ng-app="myApp" ng-cloak>
	<div class="row" ng-controller="MetricsController">
		<div class="container inspect">
		<h2>Inventory Sales Spread</h2>
			<canvas id="myChart" width="600" height="400"></canvas>

		</div>

		<div class="panel-body pull-right">
			<form ng-submit="updateChart()">
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 .picker__holder">
							<input ng-model="dateInput" class="datepicker form-control" type="text" placeholder="Filter By Date" id="dateInput">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default btn-block center" type="submit">Update Chart</button>
						</div>
					</div>
				</div>			
				
			</form>
		</div>
	</div>
</div>