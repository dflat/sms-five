<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ElectronicProduct;
use App\StateTransactionReport;
use App\StateTransactionLineItem;
use App\MachineReport;
use App\MachineReportLineItem;
use App\MachineInvoice;
use App\MachineInvoiceLineItem;
use App\SubProduct;
use App\library\StateReportGenerator;
use App\StateTemplate;
use App\InvoiceTemplate;
use App\Organization;


use Illuminate\Http\Request;
use Excel;

class ElectronicsController extends Controller {

	protected $search_terms;
	protected $reports_dir; 
	protected $report112 = '112.xls';
	protected $report113 = '113.xls';
	protected $report222 = '222.xls';
	protected $machine_report_id;
	protected $adm_code = 112;
	protected $specials_code = 113;
	protected $distrib_code = 222;
	protected $report_code;
	protected $sold_count_column;
	protected $void_count_column;
	protected $net_count_column;
	protected $sold_sales_column;
	protected $void_sales_column;
	protected $net_sales_column;
	protected $start_data_column = 1;
	
	protected $start_term;
	protected $end_term;


	//for setup function
	protected $current_product_id;
	protected $inside_button;
	protected $org_id;
	protected $str_id;
	//protected $report_config;

	public function __construct(Request $request)
	{
		//$this->config = ReportConfiguration::where('org_id', $this->org_id);

		
		

		$this->reports_dir = public_path() . '/files/';
		$this->org_id = $request->get('organization', 2);
		$this->search_terms = ElectronicProduct::where('org_id', $this->org_id )->lists('id', 'search_term');
		
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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

	public function upload($id){

		$invoice_id = $id;

		// $report = MachineReport::firstOrNew(['machine_invoice_id'=>$invoice_id]);

		//instead of org_id 1 needs to be the actual org id from session
		//$report = new MachineReport;
		// $report->machine_invoice_id = $invoice_id;
		// $report->org_id = 1;
		// $report->save();


		return view('Electronics.Upload.index', compact('invoice_id'));
	}

	private function moveFile($file){

	}

	public function process(Request $request){

	$id = $request->get('invoice_id');
	$this->str_id = $id;

	$this->machine_report_id = MachineReport::where('machine_invoice_id', $id)->pluck('id');
	//this line will overwrite existing uploaded data for same report
	MachineReportLineItem::where('machine_report_id', $this->machine_report_id)->delete();

	if ($request->hasFile('adm-file')){

			$file = $request->file('adm-file');
			$file->move($this->reports_dir, $this->report112);

			$this->report_code = $this->adm_code;
			$this->start_data_column = 2;
			$this->loadReport();

		}

	if ($request->hasFile('specials-file')){

			$file = $request->file('specials-file');
			$file->move($this->reports_dir, $this->report113);

			$this->report_code = $this->specials_code;
			$this->start_data_column = 1;
			$this->loadReport();

		}
	if ($request->hasFile('distrib-file')){

			$file = $request->file('distrib-file');
			$file->move($this->reports_dir, $this->report222);

			$this->report_code = $this->distrib_code;
			$this->start_data_column = 2;
			$this->loadReport();

		}

		

		$machineReport = MachineInvoice::find($id);
		$machineReport->reports_uploaded = 1;
		$machineReport->save();

		$this->generateStateTransactionReport();
		$this->generateInvoice();
		$this->updateInvoiceTotalFee();

		return redirect('invoice/machines/'.$id . '?report=invoice');
		//return view('Electronics.Upload.index');
	}


	// public function loadFiles(){

	// 	if (Request::hasFile('112')){

	// 		$file = Request::file('112');
	// 		$file->move($this->reports_dir, $this->report112);
	// 	}

	// }
	public function loadReport(){

		//$line = new MachineReportLineItem;
	
		Excel::load('files/'. $this->report_code .'.xls', function($excel)
				{
					
					$excel->noHeading();
			 		$data = $excel->get();	
					
					$data->each(function($row) {							

							if(in_array($row[0], array_keys($this->search_terms)))
							{
								//dd($this->search_terms);
								$line = new MachineReportLineItem;
								$line->machine_report_id = $this->machine_report_id;
								$line->report_code = $this->report_code;
								

								$line->electronic_product_id = $this->search_terms[$row[0]];			


								$line->sold_count = $row[$this->start_data_column];
								$line->sold_sales = $row[$this->start_data_column + 1];
								$line->void_count = $row[$this->start_data_column + 2];
								$line->void_sales = $row[$this->start_data_column + 3];
								$line->net_count = $row[$this->start_data_column + 4];
								$line->net_sales = $row[$this->start_data_column + 5];


								$line->save();
							
							}
						
					});

				});// -> download('xlsx');


	

		// Excel::create('New file', function($excel) {

  //   		$excel->sheet('New sheet', function($sheet) {

  //       	$sheet->loadView('Reports.Tickets.state');

  //   		});

		// })->download('xls');

	}

	public function generateStateTransactionReport(){

		StateTransactionLineItem::where('str_id', $this->str_id)->delete();

		$strLinesWithData = StateTemplate::with(['components'=>function($query){
											$query->join('machine_report_line_items',
													'machine_report_line_items.electronic_product_id',
													'=',
													'str_line_components.product_id')
													->where('machine_report_line_items.machine_report_id','=', $this->str_id);
													
												  
											}])
										->where('org_id', $this->org_id)
										->get();


					

		foreach($strLinesWithData as $strLine){
			
			$str_item = new StateTransactionLineItem;
			$str_item->str_id = $this->str_id;
			$str_item->price = $strLine->price;
			$str_item->line_name = $strLine->line_name;
			$str_item->report_code = $strLine->components[0]->report_code;

			

				foreach($strLine->components as $component){
					$str_item->sold_count += ($component->sold_count * $component->product_count);
					$str_item->void_count += ($component->void_count * $component->product_count);

					//remove this line after deleting column from database..this is just to test
					$str_item->electronic_product_id = $component->product_id;

					

				}


			$str_item->save();

		}

	}

	public function generateInvoice(){

		MachineInvoiceLineItem::where('machine_invoice_id', $this->str_id)->delete();

		$invoiceLinesWithData = InvoiceTemplate::with(['components'=>function($query){
											$query->join('machine_report_line_items',
													'machine_report_line_items.electronic_product_id',
													'=',
													'invoice_template_components.product_id')
													->where('machine_report_line_items.machine_report_id','=', $this->str_id);
													
												  
											}])
										->where('org_id', $this->org_id)
										->get();


		foreach($invoiceLinesWithData as $invoiceLine){

			$invoice_item = new MachineInvoiceLineItem;
			$invoice_item->machine_invoice_id = $this->str_id;
			$invoice_item->price = $invoiceLine->price;
			$invoice_item->line_name = $invoiceLine->line_name;
			$invoice_item->is_fee = $invoiceLine->is_fee;

			

				foreach($invoiceLine->components as $component){
					$invoice_item->sold_count += (($component->sold_count - $component->void_count)* $component->product_count);
					

					//remove this line after deleting column from database..this is just to test
					$invoice_item->electronic_product_id = $component->product_id;

					

				}


			$invoice_item->save();

		}

	}

	public function generateSTR(){
		//delete str lines if reuploading files
		StateTransactionLineItem::where('str_id', $this->str_id)->delete();
		

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
				$str_item->price = $product->price;
				$str_item->sold_count += $sold_count;
				$str_item->void_count += $void_count;

				
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

	}

	public function updateInvoiceTotalFee(){
		$totalFee = MachineInvoiceLineItem::where('machine_invoice_id',$this->str_id)
											->where('is_fee', true)
											->sum(\DB::raw('price * sold_count'));

		$totalSpecials = StateTransactionLineItem::where('str_id',$this->str_id)
											->where('report_code', 113)
											->sum(\DB::raw('price * (sold_count - void_count)'));

		$totalRevenue = MachineInvoiceLineItem::where('machine_invoice_id',$this->str_id)
											->where('is_fee', false)
											->sum(\DB::raw('price * sold_count'));
		$totalRevenue += $totalSpecials;

		MachineInvoice::where('id', $this->str_id)->update(['total' => $totalFee, 'total_after_discount' => $totalFee, 'total_specials'=> $totalSpecials, 'total_revenue' => $totalRevenue]);
	}

	public function setup(){

		Excel::load('files/data_only/'. 'buttons'.'.xls', function($excel)
				{
					$this->org_id = 2; //hardcoded now...
					$excel->noHeading();
			 		$data = $excel->get();	

			 		$this->current_product_id = 0;
					$this->inside_button = -1;

					$data->each(function($row) {	

							if(strpos($row[0], 'Button:') > -1)
							{
								$this->inside_button = 0;
								$button = substr($row[0], 8);
								$product = ElectronicProduct::where('org_id', $this->org_id)
															->where('name', $button)
															->first();
								if($product){

								$this->current_product_id = $product->id;

								}
								else{
									$this->current_product_id = 0;
								}
								

							}
							if($this->inside_button > 0 && $this->current_product_id){

								$sub = new SubProduct;
								$sub->electronic_product_id = $this->current_product_id;
								$sub->name = $row[0];
								$sub->price = str_replace('$','',$row[8]);
								$sub->quanity = $row[7];
								if($sub->price != null){
									$sub->save();
								}
							}
							$this->inside_button++;

						
					});

				});
		// $data = ElectronicProduct::where('org_id', $this->org_id)
		// 							->with(['sub_products'=>function($query){
		// 								$query->where('price','>',0);
		// 							}])->get();

		//return $data;

	}

	public function discoverProducts(Request $request){

		$this->org_id = $request->get('org_id');
		
		dd($this->org_id);
		$this->end_term = "Sub-Total:";

		$organization = Organization::where('id',$this->org_id)->first();
		
		if ($request->hasFile('adm-file')){

			$file = $request->file('adm-file');
			$file->move($this->reports_dir, $this->report112);

			$this->report_code = $this->adm_code;
			$this->start_term = $organization->start_term_112;
			
			$this->start_data_column = 2;
			$this->priceOnReport = true;
			$this->loadDataFromFile();

		}

		if ($request->hasFile('specials-file')){

			$file = $request->file('specials-file');
			$file->move($this->reports_dir, $this->report113);

			$this->report_code = $this->specials_code;
			$this->start_term = $organization->start_term_113;
			$this->start_data_column = 1;
			$this->priceOnReport = false;
			$this->loadDataFromFile();

		}

		if ($request->hasFile('distrib-file')){

			$file = $request->file('distrib-file');
			$file->move($this->reports_dir, $this->report222);

			$this->report_code = $this->distrib_code;
			$this->start_term = $organization->start_term_222;
			$this->start_data_column = 2;
			$this->priceOnReport = true;
			$this->loadDataFromFile();

		}

		return redirect()->back();
	}

	private function loadDataFromFile()
	{
		$rows = [];
		$file = fopen('files/'. $this->report_code .'.xls', "r");
		while(! feof($file))
		  {
		  $rows[]=(fgetcsv($file));
		  }

		fclose($file);

		$start_reading = false;
		$stop_reading = false;
	
		foreach ($rows as $row){

			if($row[0] == $this->start_term){$start_reading = true; continue;}
			if($start_reading && $row[0] == $this->end_term){$stop_reading = true; break;}

			if($start_reading)
			{
				$existingProduct = ElectronicProduct::where('org_id', $this->org_id)
													 ->where('name', $row[0])->first();


				if(!$existingProduct){

					ElectronicProduct::create(
					[
					'org_id' => $this->org_id,
					'name' => $row[0],
					'search_term' => $row[0],
					'price' => $this->priceOnReport ? str_replace('$','',$row[1]) : 1.0,
					'report_to_search' => $this->report_code
					]);
				}
			}

		}
	}

	public function applyDiscount(Request $request){

		$this->str_id = $request->get('invoice_id');
		$type = $request->get('discount');
		$value =  $request->get('discount_value');

		$invoice = MachineInvoice::where('id', $this->str_id)->first();

		switch($type){
			case 'F':
				if($value > 0){
					$invoice->update(['flat_rate' => $value, 'total_after_discount' => $value]);
				}
				else{
					$invoice->update(['flat_rate' => $value, 'total_after_discount' => $invoice->total]);
				}
				break;
			case 'P':
				$invoice->update(['percent_discount' => ($value * .01), 'total_after_discount' => $invoice->total - $invoice->total_after_discount * ($value * .01)]);
				break;
			case 'D':
				$invoice->update(['dollar_discount' => $value, 'total_after_discount' => ($invoice->total - $value) ]);
				break;
			default:
				break;
		}

		
		
		

		return redirect()->back();
	}


	public function editCount(Request $request){

		
		//dd('hello');
		$line_id = $request->get('pk');
	    //get the new marks
	    $new_count = $request->get('value');
	    //get the Student Data Row to be updated with new marks
	    $invoiceLine = MachineInvoiceLineItem::whereId($line_id)->first();
	    $invoiceLine->sold_count = $new_count;
	    $invoiceLine->save();
	    //$this->str_id = 51;
	    //$this->updateInvoiceTotalFee();
	    //dd('lol');

	    
	    return redirect()->back();


	}

	public function doStuff(){
		//these are hardcoded for testing
		$this->org_id = 2;
		$this->str_id = 48;

		$str_gen = new StateReportGenerator($this->org_id, $this->str_id);
		$cool = $str_gen->test();
		//$cool = $well->test();
		dd($cool);


	}

}
