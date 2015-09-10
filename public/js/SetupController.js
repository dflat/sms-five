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

	var SetupController = function($scope, $http, $location){

		

		var org_id = $location.path().split("/")[2]||"Unknown";

		$http.get('/api/organizations/'+ org_id +'/products')
					.success(function(data){
						$scope.products = data;

					});

		$http.get('/api/template/'+ org_id +'/lines')
					.success(function(data){
						$scope.templateLines = data;

					});

		$http.get('/api/template/invoice/'+ org_id +'/lines')
					.success(function(data){
						$scope.invoiceLines = data;

					});
		
		$scope.persistChange = function(product){
			$http.post('/api/organizations/modify',product);
		}
		$scope.persistChangeSubProduct = function(product){
			$http.post('/api/organizations/modifysub', product);
		}
		$scope.markAsFee = function(line){

			var index = $scope.invoiceLines.indexOf(line)
		     $scope.invoiceLines[index].is_fee = true;
			
		     $http.post('/api/template/invoice/modify',line);

		}
		$scope.markAsRevenue = function(line){
			var index = $scope.invoiceLines.indexOf(line)
		     $scope.invoiceLines[index].is_fee = false;
		     line.is_fee = false;

		     $http.post('/api/template/invoice/modify',line);

		}

		$scope.addTemplateLine = function(){
			var newTemplateLine= {
				line_name: $scope.newTemplateLineName,
				price: $scope.newTemplateLinePrice,
				org_id: org_id
			};

			$scope.templateLines.unshift(newTemplateLine);
				$http.post('/api/template',newTemplateLine)
					.then(function(response){

						$http.get('/api/template/'+ org_id +'/lines')
								.success(function(data){
									$scope.templateLines = data;

								});
				});
		}

		$scope.addInvoiceLine = function(){
			var newTemplateLine= {
				line_name: $scope.newInvoiceLineName,
				price: $scope.newInvoiceLinePrice,
				org_id: org_id
			};

			$scope.invoiceLines.unshift(newTemplateLine);
				$http.post('/api/template/invoice',newTemplateLine)
					.then(function(response){

						$http.get('/api/template/invoice/'+ org_id +'/lines')
								.success(function(data){
									$scope.invoiceLines = data;

								});
				});
		}

		$scope.removeTemplateLine = function(line){
			

			 var line_id = line['id'];
		     var index = $scope.templateLines.indexOf(line)
		     $scope.templateLines.splice(index, 1);
			 $http.delete('/api/template/' + line_id );
		}

		$scope.removeInvoiceLine = function(line){
			

			 var line_id = line['id'];
		     var index = $scope.invoiceLines.indexOf(line)
		     $scope.invoiceLines.splice(index, 1);
			 $http.delete('/api/template/invoice/' + line_id );
		}

		$scope.removeComponent = function(line, component){
			
			// $http.get('/api/template/'+ org_id +'/lines')
			// 		.success(function(data){
			// 			$scope.templateLines = data;

			// 		});

			 var line_id = line['id'];
			 var component_id = component['id'];
		     var line_index = $scope.templateLines.indexOf(line);
		     var component_index = $scope.templateLines[line_index].components.indexOf(component);
		     $scope.templateLines[line_index].components.splice(component_index, 1);
			 $http.delete('/api/template/components/' + component_id );
		}

		$scope.removeInvoiceComponent = function(line, component){
			
			// $http.get('/api/template/'+ org_id +'/lines')
			// 		.success(function(data){
			// 			$scope.templateLines = data;

			// 		});

			 var line_id = line['id'];
			 var component_id = component['id'];
		     var line_index = $scope.invoiceLines.indexOf(line);
		     var component_index = $scope.invoiceLines[line_index].components.indexOf(component);
		     $scope.invoiceLines[line_index].components.splice(component_index, 1);
			 $http.delete('/api/template/invoice/components/' + component_id );
		}


		$scope.addComponent = function(selectedComponentProduct, newComponentCount, line){

			

			var newComponentProduct = {
				//name: selectedComponentProduct.name,
				product_id: selectedComponentProduct.id,
				product_count: newComponentCount,
				state_template_id: line.id
			}

			var newComponentInMemory = {
				name: selectedComponentProduct.name,
				product_count: newComponentCount,
			}
			var index = $scope.templateLines.indexOf(line)

			//alert($scope.templateLines[index].components[0].name);
			$scope.templateLines[index].components.unshift(newComponentInMemory);

			$http.post('/api/template/components',newComponentProduct);
			
		}

		$scope.addInvoiceComponent = function(selectedComponentProduct, newComponentCount, line){

			

			var newComponentProduct = {
				//name: selectedComponentProduct.name,
				product_id: selectedComponentProduct.id,
				product_count: newComponentCount,
				invoice_template_id: line.id
			}

			var newComponentInMemory = {
				name: selectedComponentProduct.name,
				product_count: newComponentCount,
			}
			var index = $scope.invoiceLines.indexOf(line)

			//alert($scope.templateLines[index].components[0].name);
			$scope.invoiceLines[index].components.unshift(newComponentInMemory);

			$http.post('/api/template/invoice/components',newComponentProduct);
			
		}

		$scope.showPanel = function(selectedPane){
			$scope.selectedPane = selectedPane;
		}

		
	}

	app.controller('SetupController', SetupController);

}(angular.module('myApp')));
