(function(){

	angular.module('myApp', [], function($interpolateProvider, $locationProvider) {
							$interpolateProvider.startSymbol('<%');
							$interpolateProvider.endSymbol('%>');

						
							$locationProvider.html5Mode({
														  enabled: true,
														  requireBase: false
														});
							});

}());