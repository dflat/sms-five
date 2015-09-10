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

	var PaperController = function($scope, $http){

		$http.get('/api/inventory/paper')
					.success(function(data){
						$scope.papers = data;
					});
		$http.get('/api/inventory/misc')
					.success(function(data){
						$scope.miscItems = data;
						$scope.selectedItem = $scope.miscItems[0];

					});


		$scope.limit = 20;

		$scope.newlyAdded = 0;
		$scope.newlyAddedMisc = 0;

		initQuantitySelectBox(12);

		makeEnterCharacterActAsTab();

		indicateActiveInputGroup();

		$scope.totalOnHand = function(){
			
			var total = 0;

			angular.forEach($scope.papers, function(paper, index){
				total += paper.inventory.length;
			});
			total += $scope.newlyAddedMisc;
			return total;
		}

		$scope.addMisc = function(){
			$scope.addedSuccessfullyMisc = false;

			var newMiscInventory = {
				form: $scope.selectedItem.form,
				serial: 'misc',
				color: 'Blue'
			}

			//cache values so success message doesnt keep binding until next submit
			var current_name = $scope.selectedItem.name;
			var current_quantity = $scope.selectedQuantity;

			$scope.currentMisc = current_name;
			$scope.currentQuantity = current_quantity;

			//current_paper_inventory.unshift(newMiscInventory);
				for (var x = 0; x < $scope.selectedQuantity; x++){
				$http.post('/PaperInventory',newMiscInventory);
				$scope.newlyAddedMisc++;
				}
				$scope.addedSuccessfullyMisc = true;
				
			
		}

		$scope.addPaper = function(){

			$scope.invalidForm = false;
			$scope.alreadyAdded = false;
			$scope.addedSuccessfully = false;
			$scope.missingInput = false;



			var newInventory = {
				form: $scope.newInventoryForm,
				serial: $scope.newInventorySerial,
				permutation: $scope.newInventoryPerm
			};

			$scope.errorForm = newInventory.form;
			$scope.errorSerial = newInventory.serial;

			if(!newInventory.form || !newInventory.serial){

				$scope.missingInput = true;
				return false;

			}
			//find index of the right paper by its form number
			var index = getIndexByForm($scope.papers, $scope.newInventoryForm);

			if(index == null){
				$scope.invalidForm = true;
				clearFormInput();
				clearSerialInput();
				revertFocusToForm();
				return false;
			}

			var current_paper = $scope.papers[index];
			var current_paper_inventory = current_paper.inventory;

			$scope.currentPaperName = current_paper.name;


			//checkIfInventoryIsInSystem();

			angular.forEach(current_paper_inventory, function(existingInventory, index){
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
				current_paper_inventory.unshift(newInventory);
				$http.post('/PaperInventory',newInventory);
				$scope.addedSuccessfully = true;
				$scope.newlyAdded++;
				//$('#paperFilter').val(current_paper.name);
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

			angular.forEach(current_paper_inventory, function(existingInventory, index){
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

		function indicateActiveInputGroup(){
			$(".activatable").focus(function(){
			   $(this).parent().parent().parent().parent().parent().removeClass("passive-enter");
			   $(this).parent().parent().parent().parent().parent().addClass("active-enter");

			  }).blur(function(){
			       $(this).parent().parent().parent().parent().parent().removeClass("active-enter");
			   $(this).parent().parent().parent().parent().parent().addClass("passive-enter");
			  }); 
		}

		function initQuantitySelectBox(max){
			$scope.options = [];
			while ($scope.options.length < max){
	   	 		$scope.options.push($scope.options.length + 1);
	  		}

	  		$scope.selectedQuantity = $scope.options[0];
  		}

		
	}

	app.controller('PaperController', PaperController);

}(angular.module('myApp')));
