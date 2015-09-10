<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ElectronicProduct;

use App\MachineReportLineItem;
use App\StateTransactionLineItem;

use Illuminate\Http\Request;

class ElectronicProductsController extends Controller {

	protected $org_id;
	protected $machine_report_id;

	public function __construct(Request $request){

		$this->org_id = $request->get('org_id', 2);
		$this->machine_report_id = $request->get('machine_report_id', 1);
		$this->str_id = $request->get('str_id', 1);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		

		$data = ElectronicProduct::where('org_id', $this->org_id)
									->with(['sub_products'=>function($query){
										$query->where('price','>',0);
									}])->get();

		// $dataWithSales = MachineReportLineItem::where('machine_report_id', 1)
		// 								->join('electronic_products', 'electronic_products.id','=','machine_report_line_items.electronic_product_id');

		//dd($dataWithSales);

										//get all products with sales data
		$dataWithSales2 = ElectronicProduct::select('electronic_products.id', 
													'electronic_products.name',
													'electronic_products.price',
													'machine_report_line_items.sold_count',
													'machine_report_line_items.void_count',
													'machine_report_line_items.net_count',
													'machine_report_line_items.sold_sales',
													'machine_report_line_items.void_sales',
													'machine_report_line_items.net_sales')
									->where('org_id', $this->org_id)
									->with(['sub_products'=>function($query){
											$query->where('price','>',0);
											}])
									->join('machine_report_line_items', function($join){
											$join->on('machine_report_line_items.electronic_product_id','=','electronic_products.id')
											->where('machine_report_line_items.machine_report_id','=',$this->machine_report_id);
											})
									->get();
		//just str products
		$dataWithSales3 = ElectronicProduct::select('electronic_products.id', 
													'electronic_products.name',
													'electronic_products.price',
													'machine_report_line_items.sold_count',
													'machine_report_line_items.void_count',
													'machine_report_line_items.net_count',
													'machine_report_line_items.sold_sales',
													'machine_report_line_items.void_sales',
													'machine_report_line_items.net_sales'
													)
									->where('org_id', $this->org_id)
									->where('on_str', true)
									->with(['sub_products'=>function($query){
											$query->where('price','>',0)
												  ->where('on_str', true);
											}])
									->join('machine_report_line_items', function($join){
											$join->on('machine_report_line_items.electronic_product_id','=','electronic_products.id')
											->where('machine_report_line_items.machine_report_id','=',$this->machine_report_id);
											})
									->get();

		//in progress
		foreach ($dataWithSales3 as $product) {
			$sold_count = $product->sold_count;
			$void_count = $product->void_count;
			$net_count = $product->net_count;
			
			//for lucky 7,8,9 totals, they have no sub-products, just process parent product
			if(count($product->sub_products) == 0){
				$str_item = new StateTransactionLineItem;
				
				$str_item->str_id = $this->str_id;
				$str_item->line_name = $product->name;
				$str_item->electronic_product_id = $product->id;
		
				$str_item->sold_count += $sold_count;
				$str_item->void_count += $void_count;
				$str_item->price = $product->price;

				
				$str_item->save();

			}

			//else if subproducts do exist iterate over each one...
			foreach ($product->sub_products as $sub_product) {
				//find str_item if it has already been created earlier in this loop
				$str_item = StateTransactionLineItem::where('str_id', $this->str_id)
														->where('line_name', $sub_product->name)
														->first();
				//this if loop signifies the first time the item has been seen in this loop
				if(!$str_item)
				{
					$str_item = new StateTransactionLineItem;
					//$str_item->org_id = $this->org_id;
					$str_item->str_id = $this->str_id;
					$str_item->line_name = $sub_product->name;
					$str_item->electronic_product_id = $product->id;
					$str_item->sub_product_id = $sub_product->id;
					$str_item->price = $sub_product->price;

					//$str_item->sold_count = $sold_count * $sub_product->quanity;
					//$str_item->void_count = $void_count * $sub_product->quanity;
				}
				//these are for duplicate products like eTriangle to be merged
				$str_item->sold_count += ($sold_count * $sub_product->quanity);
				$str_item->void_count += ($void_count * $sub_product->quanity);

					
				$str_item->save();

			}
			
			
		 }

		return $dataWithSales3;
		return view('Electronics.Products.index', compact('data'));
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
	public function store()
	{
		//
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
		//
	}

	

}
