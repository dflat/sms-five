(function(app){

	app.filter('timestampToISO', function() {
	    return function(input) {
	    	if(input=="Just Now"){
	    		return input;
	    	}
	        input = new Date(input).toISOString();
	        return input;
	    };
	});

	var ReportsController = function($scope, $http){

		// $('.datepicker').pickadate({
		// 	formatSubmit: 'yyyy-mm-dd',
		// 	format: 'yyyy-mm'
		// });


		$http.get('/api/reports/tickets/profit', {params: {date_range:2015}})
					.success(function(data){
						$scope.tickets = data;

						// angular.forEach($scope.ticket_sales, function(ticket, index){
							
						// 	myBarChart.addData([ticket.sold_this_month], ticket.name);
						// });

				});

		

		
		}


	app.controller('ReportsController', ReportsController);

}(angular.module('myApp')));
