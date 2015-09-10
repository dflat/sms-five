var myApp = angular.module('myApp', [], function($interpolateProvider) {
$interpolateProvider.startSymbol('<%');
$interpolateProvider.endSymbol('%>');
});

myApp.filter('timestampToISO', function() {
    return function(input) {
    	if(input=="Just Now"){
    		return input;
    	}
        input = new Date(input).toISOString();
        return input;
    };
});

function InvoicesController($scope, $http){

	$http.get('/api/invoice/tickets')
				.success(function(data){
					$scope.invoice_lines = data;
				});


}