
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

// myApp.run(function($rootScope) {
//       // console.log("online:" + navigator.onLine);

//       $rootScope.online = navigator.onLine ? 'online' : 'offline';
//       $rootScope.$apply();

//       if (window.addEventListener) {
//         window.addEventListener("online", function() {
//           $rootScope.online = "online";
//           $rootScope.$apply();
//         }, true);
//         window.addEventListener("offline", function() {
//           $rootScope.online = "offline";
//           $rootScope.$apply();
//         }, true);
//       } else {
//         document.body.ononline = function() {
//           $rootScope.online = "online";
//           $rootScope.$apply();
//         };
//         document.body.onoffline = function() {
//           $rootScope.online = "offline";
//           $rootScope.$apply();
//         };
//       }
//     });




function TicketsController($scope, $http){

	$http.get('/api/inventory')
				.success(function(data){
					$scope.tickets = data;
				});

	$scope.newlyAdded = 0;

	makeEnterCharacterActAsTab();

	// $scope.getInventoryByTicket = function(ticketId){
	// 	var url = '/api/inventory/'+ ticketId;
		
	// 	$scope.inventoryz = [];
	// 	$http.get(url)
	// 			.success(function(data){
	// 				$scope.itemsOnHand = data;
	// 				angular.forEach(data, function(item, index) {
	// 					//alert(item.id);
	// 					$scope.inventoryz.push(item);
						
	// 				});
	// 			});
	// 			//alert(inventoryz[0]);
	// 			//alert($scope.inventoryz[0].serial);
	// 			return true;
	// }

	$scope.total = function(){
		var count = 0;

		 angular.forEach($scope.tickets, function(ticket){
			count+= ticket.completed ? 1 : 0;
		});

		return count;
	}

	$scope.totalCharge = function(){
		var total = 0;

		angular.forEach($scope.tickets, function(ticket,index){
			angular.forEach(ticket.inventory, function(item,index){

			var dollars = ticket.price;
			total+= ticket.price;//Number(dollars.replace(/[^0-9\.]+/g,"")); //strip money formatting to total prices
		});
		});

		return total.toFixed(2);
	}

	$scope.totalChargeDynamic = function(){
		var total = 0;

		angular.forEach($scope.filteredByTicket, function(ticket,index){
			angular.forEach(ticket.inventory, function(item,index){

			var dollars = ticket.price;
			total+= ticket.price;//Number(dollars.replace(/[^0-9\.]+/g,"")); //strip money formatting to total prices
		});
		});

		return total.toFixed(2);
	}

	$scope.totalOnHand = function(){
		// var total = 0;
		// angular.forEach($scope.filteredByTicket, function(ticket,index){
		// 	angular.forEach(ticket.inventory, function(item,index){

		// 	total++;
		// });

		// });
		// return total;
		var total = 0;
		angular.forEach($scope.tickets, function(ticket, index){
			total += ticket.inventory.length;
		});
		return total;
	}

	$scope.addTicket = function(){

		$scope.invalidForm = false;
		$scope.alreadyAdded = false;
		$scope.addedSuccessfully = false;
		$scope.missingInput = false;



		var newInventory = {
			form: $scope.newInventoryForm,
			serial: $scope.newInventorySerial
		};

		$scope.errorForm = newInventory.form;
		$scope.errorSerial = newInventory.serial;

		if(!newInventory.form || !newInventory.serial){

			$scope.missingInput = true;
			return false;

		}
		//find index of the right ticket by its form number
		var index = getIndexByForm($scope.tickets, $scope.newInventoryForm);

		if(index == null){
			$scope.invalidForm = true;
			clearFormInput();
			clearSerialInput();
			revertFocusToForm();
			return false;
		}

		var current_ticket = $scope.tickets[index];
		var current_ticket_inventory = current_ticket.inventory;

		$scope.currentTicketName = current_ticket.name;


		//checkIfInventoryIsInSystem();

		angular.forEach(current_ticket_inventory, function(existingInventory, index){
			if(existingInventory.serial == newInventory.serial){
				$scope.alreadyAdded = true;
			}
		});

			
		if($scope.invalidForm){

			// clearFormInput();
			// clearSerialInput();
			// revertFocusToForm();

		}
		else if($scope.alreadyAdded){

			clearSerialInput();
			revertFocusToSerial();

		}
		else {


			newInventory.created_at = "Just Now";
			current_ticket_inventory.unshift(newInventory);
			$http.post('/inventory',newInventory);
			$scope.addedSuccessfully = true;
			$scope.newlyAdded++;
			//$('#ticketFilter').val(current_ticket.name);
			clearSerialInput();
			revertFocusToSerial();

			

		}		
	}

	function getIndexByForm(arr, form) {
	    for (var index = 0, len = arr.length; index < len; index += 1) {
	        if (arr[index].form === form) {
	            return index;
	        }
	    }
	}

	function checkIfInventoryIsInSystem(){

		angular.forEach(current_ticket_inventory, function(existingInventory, index){
			if(existingInventory.serial == newInventory.serial){
				$scope.alreadyAdded = true;
			}
		});

		}

	function clearSerialInput(){
		$("#inputSerialNo").val("");
	}
	function clearFormInput(){
		$("#inputFormNo").val("");
	}

	function revertFocusToSerial(){

		$("#inputSerialNo").focus();	      
	}

	function revertFocusToForm(){

	
		$("#inputFormNo").focus();
		      
	}

	function makeEnterCharacterActAsTab(){

		$("#inputFormNo").bind("keydown", function(event) {
		    if (event.which === 13) {
		        event.stopPropagation();
		        event.preventDefault();
		        $("#inputSerialNo").focus();
		        
		    }
		   
		});
	}

	
}
