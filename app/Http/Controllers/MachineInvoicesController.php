<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MachineInvoice;
use App\MachineReport;
use App\MachineReportLineItem;
use App\StateTransactionReport;
use App\StateTransactionLineItem;
use App\MachineInvoiceLineItem;
use App\TicketInvoice;
use App\PaperInvoice;
use App\Organization;
use Carbon\Carbon;

use Illuminate\Http\Request;

class MachineInvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoices =  MachineInvoice::select('organizations.name as org_name', 'machine_invoices.id as invoice_no', 'total', 'total_after_discount', 'invoice_date', 'reports_uploaded')
									->join('organizations','organizations.id','=','machine_invoices.org_id')
									->orderBy('machine_invoices.id','DESC')
									->take(10)
									->get();

		$organizations = Organization::lists('name','id');
		//dd($invoices);
		return view('invoices.machines.index', compact('invoices','organizations'));
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
		$invoice = new PaperInvoice();
		$invoice->organization_id = $request->input('organization');
		$invoice->sale_date = Carbon::now();
		$invoice->save();

		$ticketInvoice = new TicketInvoice();
		$ticketInvoice->organization_id = $request->input('organization');
		$ticketInvoice->sale_date = Carbon::now();
		$ticketInvoice->save();

		$machineInvoice = new MachineInvoice();
		$machineInvoice->org_id = $request->input('organization');
		$machineInvoice->invoice_date = Carbon::now();
		$machineInvoice->save();

		$report = new MachineReport();
		$report->org_id = $request->input('organization');
		$report->report_date = Carbon::now();
		$report->machine_invoice_id = $machineInvoice->id;
		$report->save();

		$str = new StateTransactionReport();
		$str->org_id = $request->input('organization');
		$str->report_date = Carbon::now();
		$str->save();
		
		\Session::flash('new_invoice', $invoice->id);
		return redirect('invoice/machines');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Request $request)
	{
		$report = $request->get('report');

		


		$invoice = MachineInvoice::select('machine_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'invoice_date', 'flat_rate','percent_discount','dollar_discount', 'total_after_discount', 'total_revenue', 'total_specials')
								->where('machine_invoices.id',$id)
								->join('organizations','organizations.id','=','machine_invoices.org_id')
								->first();
		//put this in a queryScope...
		//$invoice = $invoice->toArray();

		$ticketInvoice = TicketInvoice::where('id', $id)->first();
		$paperInvoice = PaperInvoice::where('id', $id)->first();

		$machineReport = MachineReport::where('machine_invoice_id', $id)->first();
		
		$str;

		if($report == 'STR'){

			$lines = StateTransactionLineItem::where('str_id', $id)->get();
			$str = StateTransactionReport::where('id', $id)->first();

		}

		elseif($report == 'invoice'){

			$lines = MachineInvoiceLineItem::where('machine_invoice_id', $id)->get();
			
		}
		else{

		//this is in progress>>>>>>>				
				$lines = MachineReportLineItem::select('electronic_products.name as name', 'electronic_products.price as price', 'sold_count as gross_sold', 'void_count as voids', 'net_count as net_sold', 'sold_sales as gross_sales', 'void_sales as void_sales' , 'net_sales as net_sales','report_code as report_code')
						->where('machine_report_id', $machineReport->id)
						->join('electronic_products', 'electronic_products.id', '=', 'machine_report_line_items.electronic_product_id')
						->get();
		}
		//dd($invoice);
		//$invoiceAndItems = $invoice->with('line_items')->latest()->get();
		return view('invoices.machines.show', compact('invoice','lines','ticketInvoice','paperInvoice','str'));
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

	public function getSTRbyOrg($org){

		$organization = Organization::where('id', $org)->first();

		$reports = StateTransactionReport::with('line_items')
								->where('org_id', $org)
								->get();
		return view('reports.electronics.show', compact('reports', 'organization'));
		//return view('reports.electronics', compact('reports'));

	}

}
