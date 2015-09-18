<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaperInvoice;
use App\TicketInvoice;
use App\PaperLineItem;
use App\MachineInvoice;
use App\MachineReport;
use App\StateTransactionReport;
use App\Organization;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PaperInvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoices =  PaperInvoice::select('organizations.name as org_name', 'paper_invoices.id as invoice_no', 'total', 'sale_date')
									->join('organizations','organizations.id','=','paper_invoices.organization_id')
									->orderBy('paper_invoices.id','DESC')
									->take(10)
									->get();

		$organizations = Organization::lists('name','id');
		//dd($invoices);
		return view('Invoices.Paper.index', compact('invoices','organizations'));
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
		return redirect('invoice/paper');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = PaperInvoice::select('paper_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date')
								->where('paper_invoices.id',$id)
								->join('organizations','organizations.id','=','paper_invoices.organization_id')
								->first();
		//put this in a queryScope...
		//$invoice = $invoice->toArray();
		$lines = PaperLineItem::select('paper_products.name', 'paper_products.form', 'paper_inventory.serial', 'paper_line_items.sale_price')
						->where('paper_invoice_id', $id)
						->join('paper_inventory', 'paper_inventory.id', '=', 'paper_line_items.inventory_id')
						->join('paper_products', 'paper_products.id', '=', 'paper_inventory.paper_product_id')
						->get();
		//dd($invoice);
		//$invoiceAndItems = $invoice->with('line_items')->latest()->get();
		return view('Invoices.Paper.show', compact('invoice','lines'));
		//return [$invoice,$lines];
		//return $lines;

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoice = PaperInvoice::select('paper_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date')
								->where('paper_invoices.id',$id)
								->join('organizations','organizations.id','=','paper_invoices.organization_id')
								->first();
		//put this in a queryScope...
		//$invoice = $invoice->toArray();
		$lines = PaperLineItem::select('paper_products.name', 'paper_products.form', 'paper_inventory.serial', 'paper_line_items.sale_price')
						->where('paper_invoice_id', $id)
						->join('paper_inventory', 'paper_inventory.id', '=', 'paper_line_items.inventory_id')
						->join('paper_products', 'paper_products.id', '=', 'paper_inventory.paper_product_id')
						->get();
		//dd($invoice);
		//$invoiceAndItems = $invoice->with('line_items')->latest()->get();
		return view('Invoices.Paper.edit', compact('invoice','lines'));
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

	public function inspect(){
		return view('Invoices.Paper.inspect');

	}

	public function metrics(){
		return view('Invoices.Paper.metrics');
		
	}

}
