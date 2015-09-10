<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\ElectronicProduct;
use App\SubProduct;
use App\Http\Requests\OrganizationRequest;

use Illuminate\Http\Request;

class OrganizationsController extends Controller {

	public function __construct(){
		$this->middleware('auth');

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizations = Organization::all();
		return view('organizations.index', compact('organizations'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('organizations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(OrganizationRequest $request)
	{
		$organization = new Organization($request->all());
		//dd($organization);
		$organization->save();

		return redirect('organizations');
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
		$organization = Organization::findOrFail($id);

		return view('organizations.edit', compact('organization'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, OrganizationRequest $request)
	{
		$organization = Organization::findOrFail($id);
		$organization->update($request->all());
		return redirect('organizations');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function setup($id){

		$org_id = $id;
		// $products = ElectronicProduct::select('electronic_products.id', 
		// 											'electronic_products.name',
		// 											'electronic_products.price'
		// 											)
		// 							->where('org_id', $id)
		// 							->with(['sub_products'=>function($query){
		// 									$query->where('price','>',0);
		// 									}])
									
		// 							->get();
		return view('organizations.setup', compact('org_id'));
	}

	public function getProducts($id){

		$products = ElectronicProduct::select('electronic_products.id', 
													'electronic_products.name',
													'electronic_products.price',
													'electronic_products.on_str'
													)
									->where('org_id', $id)
									->with(['sub_products'=>function($query){
											$query->where('price','>',0);
											}])
									
									->get();
									//->toSql();

									  // $query = \DB::getQueryLog();
									  // dd($query);
		return $products;
	}

	public function modify(Request $request){
		$updatedProduct = $request->all();
		//dd($updatedProduct['id']);

		$existingProduct = ElectronicProduct::where('id', $updatedProduct['id'])->first();
		
		$existingProduct->on_str = $updatedProduct['on_str'];

		$existingProduct->save();

		//$product = ElectronicProduct::where('id',$id)->get()->first();

	}

	public function modifySub(Request $request){
		$updatedProduct = $request->all();
		//dd($updatedProduct['id']);

		$existingProduct = SubProduct::where('id', $updatedProduct['id'])->first();
		
		$existingProduct->on_str = $updatedProduct['on_str'];

		$existingProduct->save();

		//$product = ElectronicProduct::where('id',$id)->get()->first();

	}

}
