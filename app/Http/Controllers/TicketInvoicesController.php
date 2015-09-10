<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TicketInvoice;
use App\PaperInvoice;
use App\MachineInvoice;
use App\MachineReport;
use App\StateTransactionReport;

use App\LineItem;
use App\Organization;
use Illuminate\Http\Request;

use Carbon\Carbon;

class TicketInvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoices =  TicketInvoice::select('organizations.name as org_name', 'ticket_invoices.id as invoice_no', 'total', 'sale_date')
									->join('organizations','organizations.id','=','ticket_invoices.organization_id')
									->orderBy('ticket_invoices.id','DESC')
									->take(10)
									->get();

		$organizations = Organization::lists('name','id');
		//dd($invoices);
		return view('invoices.tickets.index', compact('invoices','organizations'));
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
		$invoice = new TicketInvoice();
		$invoice->organization_id = $request->input('organization');
		$invoice->sale_date = Carbon::now();
		$invoice->save();

		$paperInvoice = new PaperInvoice();
		$paperInvoice->organization_id = $request->input('organization');
		$paperInvoice->sale_date = Carbon::now();
		$paperInvoice->save();

		$machineInvoice = new MachineInvoice();
		$machineInvoice->org_id = $request->input('organization');
		$machineInvoice->invoice_date = Carbon::now();
		$machineInvoice->save();

		$report = new MachineReport();
		$report->org_id = $request->input('organization');
		$report->machine_invoice_id = $machineInvoice->id;
		$report->report_date = Carbon::now();
		$report->save();

		$str = new StateTransactionReport();
		$str->org_id = $request->input('organization');
		$str->report_date = Carbon::now();
		$str->save();
	

		\Session::flash('new_invoice', $invoice->id);
		return redirect('invoice/tickets');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = TicketInvoice::select('ticket_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date')
								->where('ticket_invoices.id',$id)
								->join('organizations','organizations.id','=','ticket_invoices.organization_id')
								->first();
		//put this in a queryScope...
		//$invoice = $invoice->toArray();
		$lines = LineItem::select('tickets.name', 'tickets.form', 'inventory.serial', 'line_items.sale_price')
						->where('ticket_invoice_id', $id)
						->join('inventory', 'inventory.id', '=', 'line_items.inventory_id')
						->join('tickets', 'tickets.id', '=', 'inventory.ticket_id')
						->get();
		//dd($invoice);
		//$invoiceAndItems = $invoice->with('line_items')->latest()->get();
		return view('invoices.tickets.show', compact('invoice','lines'));
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
		$invoice = TicketInvoice::select('ticket_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date')
								->where('ticket_invoices.id',$id)
								->join('organizations','organizations.id','=','ticket_invoices.organization_id')
								->first();
		//put this in a queryScope...
		//$invoice = $invoice->toArray();
		$lines = LineItem::select('tickets.name', 'tickets.form', 'inventory.serial', 'line_items.sale_price')
						->where('ticket_invoice_id', $id)
						->join('inventory', 'inventory.id', '=', 'line_items.inventory_id')
						->join('tickets', 'tickets.id', '=', 'inventory.ticket_id')
						->get();
		//dd($invoice);
		//$invoiceAndItems = $invoice->with('line_items')->latest()->get();
		return view('invoices.tickets.edit', compact('invoice','lines'));
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
		return view('invoices.tickets.inspect');

	}

	public function metrics(){
		return view('invoices.tickets.metrics');
		
	}

}
