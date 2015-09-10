<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('test', 'HomeController@test');

Route::get('playground', function(){
	return View::make('sandbox.playground');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('lines','LineItemsController');
Route::resource('paper_lines','PaperLineItemsController');
// Route::get('/lines', function(){
// return "hello";
// });
// Route::post('/lines', function(){
	
// 	$input = Input::all();
// 	LineItem::create($input);
// return "hello"; //LineItem::create(Input::all());
// });

// Route::group(['prefix' => 'i'], function() {
// Route::resource('inventory','InventoryController');
// });

Route::resource('inventory','InventoryController');

Route::resource('PaperInventory','PaperInventoryController');

Route::resource('tickets','TicketsController');

Route::resource('paper_products','PaperProductsController');

Route::resource('organizations', 'OrganizationsController');

Route::group(['prefix' => 'organizations'], function() {
	//Route::get('/{id}/setup', 'OrganizationsController@setup');
	Route::get('/{id}/setup', [
    'as' => 'organizations.setup', 'uses' => 'OrganizationsController@setup'
	]);
	

});

Route::get('/tickets/sortby/{term}',['as'=>'tickets.sort','uses'=>'TicketsController@sortBy']);
Route::get('/paper_products/sortby/{term}',['as'=>'paper_products.sort','uses'=>'PaperProductsController@sortBy']);

Route::get('tickets/{id}/inventory', 'TicketsController@inventory');
Route::get('PaperProducts/{id}/inventory', 'PaperProductsController@inventory');


Route::group(['prefix' => 'api'], function() {
	Route::get('/inventory/misc', 'ApiInventoryController@getMisc');
	Route::get('/inventory/paper', 'ApiInventoryController@getPaper');
	
	Route::resource('inventory', 'ApiInventoryController');
	
	Route::get('/invoice/tickets/metrics', 'ApiTicketInvoicesController@metrics');
	Route::get('/reports/tickets/profit', 'ReportsController@profitsByPeriod');
	

	Route::resource('invoice/tickets', 'ApiTicketInvoicesController');
	Route::resource('invoice/paper', 'ApiPaperInvoicesController');

	Route::post('/organizations/modify', 'OrganizationsController@modify');
	Route::post('/organizations/modifysub', 'OrganizationsController@modifySub');
	Route::get('/organizations/{id}/products', 'OrganizationsController@getProducts');

	//for invoice template API
	Route::post('/template/invoice/modify', 'InvoiceTemplateController@modify');
	Route::get('/template/invoice/{org_id}/lines', 'InvoiceTemplateController@index');
	Route::post('/template/invoice', 'InvoiceTemplateController@store');
	Route::delete('/template/invoice/{id}', 'InvoiceTemplateController@destroy');
	Route::delete('/template/invoice/components/{id}', 'InvoiceTemplateController@destroyComponent');
	Route::post('/template/invoice/components', 'InvoiceTemplateController@addComponent');


	//for STR template API
	Route::get('/template/{org_id}/lines', 'StateTemplateController@index');
	Route::post('/template', 'StateTemplateController@store');
	Route::delete('/template/{id}', 'StateTemplateController@destroy');
	Route::delete('/template/components/{id}', 'StateTemplateController@destroyComponent');
	Route::post('/template/components', 'StateTemplateController@addComponent');

});

Route::get('/sandbox', function(){
	return View::make('sandbox.navi');
});
Route::get('/sandbox/v2', function(){
	return View::make('sandbox.v2');
});

Route::group(['prefix' => 'invoice'], function() {
	Route::get('/tickets/inspect', 'TicketInvoicesController@inspect');
	Route::get('/tickets/metrics', 'TicketInvoicesController@metrics');
	Route::get('/paper/inspect', 'PaperInvoicesController@inspect');
	Route::resource('master', 'MasterInvoicesController');
	Route::resource('tickets', 'TicketInvoicesController');
	Route::resource('paper', 'PaperInvoicesController');
	Route::get('/machines/{id}/upload', 'ElectronicsController@upload');

	//Route::get('/machines/{id}/{report}',['as'=>'machines.report','uses'=>'MachineInvoicesController@show']);

	Route::get('/setup', 'ElectronicsController@setup');
	Route::resource('machines', 'MachineInvoicesController');
	

});

// Route::group(['prefix' => 'inventory'], function() {
// 	Route::resource('paper','PaperInventoryController');
// });

Route::group(['prefix' => 'reports'], function() {

	Route::get('/electronic/{org}', [
    'as' => 'reports.electronic', 'uses' => 'MachineInvoicesController@getSTRbyOrg'
	]);

	//Route::get('/electronic/{org}', 'MachineInvoicesController@getSTRbyOrg');

	Route::group(['prefix' => 'tickets'], function() {
		Route::get('/profit', 'ReportsController@index');
		Route::get('/state', 'ReportsController@stateReportingTickets');

		});

});

Route::group(['prefix' => 'electronic'], function() {
	Route::get('/invoice', 'ElectronicsController@load112File');
	Route::get('/upload', 'ElectronicsController@upload');
	Route::post('/upload', 'ElectronicsController@process');
	Route::post('/discount', 'ElectronicsController@applyDiscount');
	Route::post('/discover', 'ElectronicsController@discoverProducts');
	Route::resource('products', 'ElectronicProductsController');

	

	

});

Route::get('/test', 'ElectronicsController@doStuff');

