<div ng-app="myApp" ng-cloak>
	<div class="row" ng-controller="SetupController">
		<div id="product-pool" class="col-md-7">
			<div ng-repeat="product in filteredByProduct = (products | filter:searchProduct | limitTo:limit)">
				
				<div class="row list-group-item row-tab-holder">
					<div class="row-tab-extended">
							
						<input ng-model="showPaper" type="checkbox" id='<%product.id%>' class='tags-checkbox sr-only'/>

						    <label for='<%product.id%>'>
						        <i class='glyphicon glyphicon-triangle-right'></i>
						        <i class='glyphicon glyphicon-triangle-bottom'></i>
						    </label>

						<kbd class="label label-default"><%product.name%></kbd>
					
						<span ng-if="product.sub_products.length" class="label label-default inv-count">
							<%product.sub_products.length%> sub products
						</span>
						
						<span class="label label-default pull-right">
							<%product.price | currency:"$"%>
						</span>
					</div>
					<div id="checkboxes" class="pull-right">
					
						<input ng-model="product.on_str" ng-change="persistChange(product)" type="checkbox" id='<%product.id%>STR' class='tags-checkbox sr-only'/>

					    <label for='<%product.id%>STR'>
					        <i class='glyphicon glyphicon-unchecked g-big'></i>
					        <i class='glyphicon glyphicon-check g-big'></i>
					    </label>

					    <!-- <input ng-model="onINV" type="checkbox" id='<%product.id%>INV' class='tags-checkbox sr-only'/>

					    <label for='<%product.id%>INV'>
					        <i class='glyphicon glyphicon-unchecked g-big'></i>
					        <i class='glyphicon glyphicon-check g-big'></i>
					    </label> -->
					</div>
				</div>

				<div class="inventory-by-ticket-container" ng-if="showPaper">
					<li class="list-group-item" 
						ng-repeat="sub in filteredSubproducts = (product.sub_products | filter:searchSerial | orderBy:'-created_at')">

						<div class="row">

							<div class="col-md-4"><%sub.name%></div>
							<div class="col-md-2"><%sub.price | currency:"$"%></div>
							<div class="col-md-2"><%sub.quanity%></div>
							<div class="col-md-4">
								<input ng-model="sub.on_str" ng-change="persistChangeSubProduct(sub)" type="checkbox" id='<%sub.id%>STRsub' class='tags-checkbox sr-only'/>

							    <label for='<%sub.id%>STRsub'>
							        <i class='glyphicon glyphicon-unchecked g-big'></i>
							        <i class='glyphicon glyphicon-check g-big'></i>
							    </label>
							</div>
						
						</div>
					</li>
				</div>

				
				
			</div>
		</div>



	
	<div id="preferences-pane" class="col-md-4">

		<div class="col-md-6">
			<button 
			class="btn btn-default btn-block center tab-round"
			ng-class="{'selected-tab': selectedPane=='str'}"
			ng-click="showPanel('str')">STR Setup</button>
		</div>
		<div class="col-md-6">
			<button 
				class="btn btn-default btn-block center tab-round"
				ng-class="{'selected-tab': selectedPane=='invoice'}"
				ng-click="showPanel('invoice')">Invoice Setup</button>
		</div>

		<hr>
		<hr>
		
		<!-- str template -->
		
		<div id="str-template" ng-show="selectedPane=='str'">
			<form ng-submit="addTemplateLine()">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input ng-model="newTemplateLineName" class="form-control pad-bottom" type="text" placeholder="STR Line Name" id="inputFormNo" required>
								</div>
								<div class="col-md-6">
									<input ng-model="newTemplateLinePrice" class="form-control pad-bottom" type="number" step="any" placeholder="STR Line Price" id="inputSerialNo" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-default btn-block center add-template-btn" type="submit">Add STR Line</button>
								</div>
							</div>
						</div>			
						
			</form>

			<li class="list-group-item" ng-class="{'selected-bg': showSTRcomponents}"
						ng-repeat="line in filteredTemplateLines = (templateLines | filter:searchSerial | orderBy:'-created_at')">

						<div class="row">

							<div class="col-md-4"><%line.line_name%></div>
							<div class="col-md-2"><%line.price | currency:"$"%></div>
							<div class="col-md-2"><%line.product_id%></div>
							<div class="col-md-4 pull-right">

								<!-- <input ng-model="sub.on_str" ng-change="persistChangeSubProduct(sub)" type="checkbox" id='<%sub.id%>STRsub' class='tags-checkbox sr-only'/>
								
							    <label for='<%sub.id%>STRsub'>
							        <i class='glyphicon glyphicon-unchecked g-big'></i>
							        <i class='glyphicon glyphicon-check g-big'></i>
							    </label> -->
							</div>

							<input ng-model="showSTRcomponents" type="checkbox" id='<%line.id%>Comp' class='tags-checkbox sr-only'/>

						    <label for='<%line.id%>Comp'>
						        <i class='glyphicon glyphicon-triangle-right'></i>
						        <i class='glyphicon glyphicon-triangle-bottom'></i>
						    </label>

							<span ng-click="removeTemplateLine(line)" class='glyphicon glyphicon-remove pull-right g-close'></span>

							
						</div>


						<div class="inventory-by-ticket-container" ng-if="showSTRcomponents">

							<form ng-submit="addComponent(selectedComponentProduct, newComponentCount, line)">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<select ng-model="selectedComponentProduct" ng-options="item.name for item in products" class="form-control pad-bottom activatable" id="inputProductName"></select>
										</div>
										<div class="col-md-6">
											<input ng-model="newComponentCount" class="form-control pad-bottom" type="number" placeholder="Product Count" id="inputProductCount" required>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-default btn-xs btn-block center add-template-btn" type="submit">Add Component</button>
										</div>
									</div>
								</div>						
							</form>
						
							<div class="list-group-item" ng-repeat="component in line.components"> 
								
								<div class="row component-div">

									<div class="col-md-6"><%component.name%></div>
									<div class="col-md-6"><%component.product_count%>
										<span ng-click="removeComponent(line, component)" class='glyphicon glyphicon-remove pull-right c-close'></span>
									</div>
									
									
								</div>

							</div>
						</div>


			</li>	
		</div>
		<!-- end str template -->

		<!-- invoice template -->

		<div id="str-template" ng-show="selectedPane=='invoice'">
			<form ng-submit="addInvoiceLine()">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input ng-model="newInvoiceLineName" class="form-control pad-bottom" type="text" placeholder="Invoice Line Name" id="inputFormNoInvoice" required>
								</div>
								<div class="col-md-6">
									<input ng-model="newInvoiceLinePrice" class="form-control pad-bottom" type="number" step="any" placeholder="Invoice Line Price" id="inputSerialNoInvoice" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-default btn-block center add-template-btn" type="submit">Add Invoice Line</button>
								</div>
							</div>
						</div>			
						
			</form>

			<li class="list-group-item" ng-class="{'selected-bg': showInvoiceComponents}"
						ng-repeat="line in filteredInvoiceLines = (invoiceLines | filter:searchSerial | orderBy:'-created_at')">

						<div class="row">

							<div class="col-md-4"><%line.line_name%></div>
							<div class="col-md-2"><%line.price | currency:"$"%></div>
							<div class="col-md-2"><%line.product_id%></div>
							<div class="col-md-4 pull-right">

								<!-- <input ng-model="sub.on_str" ng-change="persistChangeSubProduct(sub)" type="checkbox" id='<%sub.id%>STRsub' class='tags-checkbox sr-only'/>
								
							    <label for='<%sub.id%>STRsub'>
							        <i class='glyphicon glyphicon-unchecked g-big'></i>
							        <i class='glyphicon glyphicon-check g-big'></i>
							    </label> -->
							</div>

							<input ng-model="showInvoiceComponents" type="checkbox" id='<%line.id%>CompInvoice' class='tags-checkbox sr-only'/>

						    <label for='<%line.id%>CompInvoice'>
						        <i class='glyphicon glyphicon-triangle-right'></i>
						        <i class='glyphicon glyphicon-triangle-bottom'></i>
						    </label>

							<span ng-click="removeInvoiceLine(line)" class='glyphicon glyphicon-remove pull-right g-close'></span>

							
						</div>


						<div class="inventory-by-ticket-container" ng-if="showInvoiceComponents">

							<form ng-submit="addInvoiceComponent(selectedInvoiceComponentProduct, newInvoiceComponentCount, line)">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<select ng-model="selectedInvoiceComponentProduct" ng-options="item.name for item in products" class="form-control pad-bottom activatable" id="inputInvoiceProductName"></select>
										</div>
										<div class="col-md-6">
											<input ng-model="newInvoiceComponentCount" class="form-control pad-bottom" type="number" placeholder="Product Count" id="inputInvoiceProductCount" required>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-default btn-xs btn-block center add-template-btn" type="submit">Add Component</button>
										</div>
									</div>
								</div>						
							</form>
						
							<div class="list-group-item" ng-repeat="component in line.components"> 
								
								<div class="row component-div">

									<div class="col-md-6"><%component.name%></div>
									<div class="col-md-6"><%component.product_count%>
										<span ng-click="removeInvoiceComponent(line, component)" class='glyphicon glyphicon-remove pull-right c-close'></span>
									</div>
									
									
								</div>

							</div>

							<div id="fee-or-revenue-switch" class="row">

								<div class="col-md-6">
									<button ng-click="markAsFee(line)" ng-class="{'fee-btn':line.is_fee }" class="btn btn-xs btn-block center bool-btn" type="submit">Fee</button>
								</div>
								<div class="col-md-6">
									<button ng-click="markAsRevenue(line)" ng-class="{'revenue-btn':!line.is_fee }" class="btn btn-xs btn-block center bool-btn" type="submit">Revenue</button>
								</div>
							</div>

						</div>
						


			</li>	
		</div>
		<!-- end invoice template -->

	</div>

	</div>
</div>