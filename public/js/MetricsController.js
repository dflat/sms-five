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

	var MetricsController = function($scope, $http){

		$('.datepicker').pickadate({
			formatSubmit: 'yyyy-mm-dd',
			format: 'yyyy-mm'
		});


		$http.get('/api/invoice/tickets/metrics', {params: {date_range: 2015}})
					.success(function(data){
						$scope.ticket_sales = data;

						angular.forEach($scope.ticket_sales, function(ticket, index){
							
							myBarChart.addData([ticket.sold_this_month], ticket.name);
						});

				});

		

		$scope.c_data = {
	    labels: [],
	
	    datasets: [
	        {
	            label: "My First dataset",
	            fillColor: "rgba(220,220,220,0.2)",
	            strokeColor: "rgba(220,220,220,1)",
	            pointColor: "rgba(220,220,220,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(220,220,220,1)",
	            data: []
	        }
	    ]
	};


	$scope.c_options =
	{
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero : true,

    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,

    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,

    //Boolean - If there is a stroke on each bar
    barShowStroke : true,

    //Number - Pixel width of the bar stroke
    barStrokeWidth : 2,

    //Number - Spacing between each of the X value sets
    barValueSpacing : 5,

    //Number - Spacing between data sets within X values
    barDatasetSpacing : 1,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

};

		
		var ctx = $("#myChart").get(0).getContext("2d");
	
		var myBarChart = new Chart(ctx).Bar($scope.c_data, $scope.c_options);

		$scope.updateChart = function(){
			$http.get('/api/invoice/tickets/metrics', {params: {date_range: $scope.dateInput}})
					.success(function(data){
						$scope.ticket_sales = data;
						$scope.c_data.labels = [];
						myBarChart.destroy();

						myBarChart = new Chart(ctx).Bar($scope.c_data, $scope.c_options);
						angular.forEach($scope.ticket_sales, function(ticket, index){
							
							myBarChart.addData([ticket.sold_this_month], ticket.name);
						});

				});
		}


	}


	app.controller('MetricsController', MetricsController);

}(angular.module('myApp')));
