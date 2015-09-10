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

	var PaperInvoicesController = function($scope, $http){

	$scope.limit = 20;


	$http.get('/api/invoice/paper')
				.success(function(data){
					$scope.invoice_lines = data;
				});

	


	$scope.increaseLimit = function(){
		$scope.limit += 10;
	}

	}

	app.controller('PaperInvoicesController', PaperInvoicesController);

}(angular.module('myApp')));