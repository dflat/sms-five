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

	var TicketsController = function($scope, $http){

		$http.get('/api/inventory')
					.success(function(data){
						$scope.tickets = data;
					});

		$scope.limit = 20;
		
		$scope.newlyAdded = 0;

		makeEnterCharacterActAsTab();

		$scope.totalOnHand = function(){
			
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

	app.controller('TicketsController', TicketsController);

}(angular.module('myApp')));
