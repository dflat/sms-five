<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TicketInvoice;
use App\PaperInvoice;
use App\LineItem;
use App\PaperLineItem;


use Illuminate\Http\Request;

class MasterInvoicesController extends Controller {

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
		$total_take_in = 0.0;
		$total_pay_out = 0.0;
		$total_profit = 0.0;

		$organization = TicketInvoice::find($id)->organization()->first();

		

		$ticketInvoice = TicketInvoice::select('ticket_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date', 'tickets.*','inventory.serial', \DB::raw('(tickets.take_in - tickets.pay_out) as `profit`'))
								->where('ticket_invoices.id',$id)
								->join('organizations','organizations.id','=','ticket_invoices.organization_id')
								->join('line_items', 'line_items.ticket_invoice_id',"=",'ticket_invoices.id')
								->join('inventory', 'inventory.id',"=",'line_items.inventory_id')
								->join('tickets', 'tickets.id',"=",'inventory.ticket_id')
								->get();

		foreach($ticketInvoice as $line){
			$total_take_in += $line->take_in;
			$total_pay_out += $line->pay_out;
			$total_profit += $line->profit;
		}

		
		$ticket_total = count($ticketInvoice) > 0 ? $ticketInvoice[0]->total : 0.0;

		$sale_date = count($ticketInvoice) > 0 ? $ticketInvoice[0]->sale_date : null;


		

		$paperInvoice = PaperInvoice::select('paper_invoices.id as invoice_no','organizations.name as sold_to', 'total', 'sale_date', 'paper_products.*','paper_inventory.serial', 'paper_inventory.permutation')
								->where('paper_invoices.id',$id)
								->join('organizations','organizations.id','=','paper_invoices.organization_id')
								->join('paper_line_items', 'paper_line_items.paper_invoice_id',"=",'paper_invoices.id')
								->join('paper_inventory', 'paper_inventory.id',"=",'paper_line_items.inventory_id')
								->join('paper_products', 'paper_products.id',"=",'paper_inventory.paper_product_id')
								->get();
		$paper_total = count($paperInvoice) > 0 ? $paperInvoice[0]->total : 0.0;

		$consumables_total = $ticket_total + $paper_total;
		$after_discount = $consumables_total - ($consumables_total * $organization->discount);
		$discount_percent = $organization->discount * 100;

		return view('invoices.master.show', compact('ticketInvoice', 'paperInvoice','total_take_in','total_pay_out','total_profit','ticket_total','paper_total','organization','consumables_total','after_discount','discount_percent', 'sale_date'));

		

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
