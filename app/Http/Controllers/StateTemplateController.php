<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\StateTemplate;
use App\StrLineComponents;

use Illuminate\Http\Request;

class StateTemplateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($org_id)
	{
		$machine_report_id = 48;
		$templateLines = StateTemplate::with(['components'=>function($query){
											$query->select('str_line_components.id','product_id','state_template_id', 'electronic_products.name', 'product_count');
											$query->join('electronic_products',
													'electronic_products.id',
													'=',
													'str_line_components.product_id');		
												  
											}])
										->where('org_id', $org_id)
										->get();

	//use this to build STR
		$templateLines2 = StateTemplate::with(['components'=>function($query){
											$query->join('machine_report_line_items',
													'machine_report_line_items.electronic_product_id',
													'=',
													'str_line_components.product_id')
													->where('machine_report_line_items.machine_report_id','=',48);
													
												  
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

		$line = new StateTemplate($input);

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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		StateTemplate::destroy($id);
	}

	public function destroyComponent($id)
	{
		StrLineComponents::destroy($id);
	}

	public function addComponent(Request $request){
		$input = $request->all();

		$line = new StrLineComponents($input);

		
		$line->save();
		// try{
		// $line->save();
		// }
		// catch(\Exception $e){
		// 	return redirect()->back();
		// }
	}

}
