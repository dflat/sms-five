<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Invoice;
use Excel;
use DB;


class ApiPaperInvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $invoice_lines = \DB::select('
		// select ticket_invoices.id as invoice_no, tickets.name as ticket_name, tickets.form as form_no, inventory.serial as serial_no, organizations.name as sold_to, line_items.sale_price as sale_price, line_items.created_at as sale_date from line_items
		// join inventory on inventory.id = line_items.inventory_id
		// join ticket_invoices on ticket_invoices.id = line_items.ticket_invoice_id
		// join tickets on tickets.id = inventory.ticket_id
		// join organizations on organizations.id = ticket_invoices.organization_id
		// order by invoice_no DESC;
		// ');

		$invoice_lines = 
			DB::table('paper_line_items')
            ->join('paper_inventory', 'paper_inventory.id', '=', 'paper_line_items.inventory_id')
            ->join('paper_invoices', 'paper_invoices.id', '=', 'paper_line_items.paper_invoice_id')
            ->join('paper_products', 'paper_products.id', '=', 'paper_inventory.paper_product_id')
            ->join('organizations', 'organizations.id', '=', 'paper_invoices.organization_id')
            
            //->where('line_items.created_at','LIKE',"%$dateInput%") 
            ->select(DB::raw('paper_invoices.id as invoice_no, paper_products.name as ticket_name, paper_products.form as form_no, paper_inventory.serial as serial_no, organizations.name as sold_to, paper_line_items.sale_price as sale_price, paper_line_items.created_at as sale_date'))
            //->groupBy('ticket_id')
            ->orderBy('invoice_no','desc')
           // ->take(10)
            ->get();


		

		//$invoices = Organization::with('ticketInvoices.line_items')->get();

		return $invoice_lines;
		
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

	public function metrics(){

	
		$dateInput = \Request::input('date_range', 2015);
		$direction = \Request::input('sort', 'ASC');
			
	

		// $ticket_sales = \DB::select('
		// select tickets.name, count(*) as sold_this_month
		// from inventory 
		// join tickets on tickets.id = inventory.ticket_id 
		// join line_items on line_items.inventory_id = inventory.id
		// where sold=1 
		// and line_items.created_at LIKE "%?%"
		// group by ticket_id 
		// order by count(*);
		// ');

		$ticket_sales = 
			DB::table('inventory')
            ->join('tickets', 'tickets.id', '=', 'inventory.ticket_id')
            ->join('line_items', 'line_items.inventory_id', '=', 'inventory.id')
            ->where('inventory.sold', 1)
            ->where('line_items.created_at','LIKE',"%$dateInput%") //this variable
            ->select(DB::raw('tickets.name, count(*) as sold_this_month'))
            ->groupBy('ticket_id')
            ->orderBy('sold_this_month','desc')
            ->take(10)
            ->get();

         


	

		return $ticket_sales;
	}


}
