<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\InvoiceTemplate;
use App\InvoiceTemplateComponent;

use Illuminate\Http\Request;

class InvoiceTemplateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($org_id)
	{
		$templateLines = InvoiceTemplate::with(['components'=>function($query){
											$query->select('invoice_template_components.id','product_id','invoice_template_id', 'electronic_products.name', 'product_count');
											$query->join('electronic_products',
													'electronic_products.id',
													'=',
													'invoice_template_components.product_id');		
												  
											}])
										->where('org_id', $org_id)
										->get();

		return $templateLines;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();

		$line = new InvoiceTemplate($input);

		try{
		$line->save();
		}
		catch(\Exception $e){
			return redirect()->back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function modify(Request $request){

		$updatedProduct = $request->all();
	

		$existingProduct = InvoiceTemplate::where('id', $updatedProduct['id'])->first();
		
		$existingProduct->is_fee = $updatedProduct['is_fee'];

		$existingProduct->save();

		

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		InvoiceTemplate::destroy($id);
	}

	public function destroyComponent($id)
	{
		InvoiceTemplateComponent::destroy($id);
	}

	public function addComponent(Request $request){
		$input = $request->all();

		$line = new InvoiceTemplateComponent($input);

		
		$line->save();
		
	}

}
