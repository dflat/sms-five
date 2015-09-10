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

	var InvoicesController = function($scope, $http){

	$scope.limit = 20;


	$http.get('/api/invoice/tickets')
				.success(function(data){
					$scope.invoice_lines = data;
				});

	


	$scope.increaseLimit = function(){
		$scope.limit += 10;
	}

	}

	app.controller('InvoicesController', InvoicesController);

}(angular.module('myApp')));