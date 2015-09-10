<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\LineItem;
use Excel;

class ReportsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// $rows = [];

		// $file = fopen("http://salesmanager.dev/files/TicketInformation.txt","r");
		// while(! feof($file))
		//   {
		//   $rows[]=(fgetcsv($file));
		//   }

		// fclose($file);

		// dd($rows);

		return view('reports.tickets.profit');
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
	public function stateReportingTickets(){
		$report =
		\DB::select('
		select organizations.dcg as DCG,
		organizations.name as sold_to, 
		organizations.address as address, 
		organizations.city as city,
		organizations.state as state,
		organizations.zip as zip,
		ticket_invoices.id as invoice_no, 
		ticket_invoices.sale_date as invoice_date, 
		ticket_invoices.total as invoice_total,
		line_items.sale_price as invoice_line_amount,
		tickets.name as deal_name, 
		tickets.form as form_number,
		inventory.`serial`,
		tickets.ticket_count as ticket_count,
		tickets.take_in as take_in,
		tickets.pay_out as pay_out
	
		from ticket_invoices
		join line_items on line_items.`ticket_invoice_id` = ticket_invoices.id
		join inventory on inventory.id = line_items.inventory_id
		join tickets on tickets.id = inventory.ticket_id
		join organizations on organizations.id = ticket_invoices.organization_id
		order by ticket_invoices.id;
		');

		// Excel::create('New file', function($excel) use($report) {

  //   		$excel->sheet('New sheet', function($sheet) use($report) {

  //       	$sheet->loadView('Reports.Tickets.state');

  //   		});

		// })->download('xls');

		return view('reports.tickets.state', compact('report'));

	}
	public function profitsByPeriod(){
		// SELECT tickets.name, tickets.price, COUNT(*) as deals_sold, 
		// SUM(line_items.sale_price) as ticket_total_revenue, 
		// SUM(line_items.sale_cost) as ticket_total_cost, 
		// SUM((line_items.sale_price - line_items.sale_cost)) as ticket_total_profit 
		// FROM line_items 
		// JOIN inventory on inventory.id = line_items.inventory_id
		// JOIN tickets on tickets.id = inventory.ticket_id
		// WHERE line_items.created_at LIKE "%2015-09%"
		// GROUP BY by tickets.name;

		$profit_per_ticket = LineItem::join('inventory','inventory.id','=','line_items.inventory_id')
					->join('tickets','tickets.id','=','inventory.ticket_id')
					->where('line_items.created_at','LIKE', '%2015-09%')
					->select('tickets.name','tickets.price',
						\DB::Raw('COUNT(*) as deals_sold'),
						\DB::Raw('SUM(line_items.sale_price) as total_ticket_revenue'),
						\DB::Raw('SUM(line_items.sale_cost) as total_ticket_cost'),
						\DB::Raw('SUM((line_items.sale_price - line_items.sale_cost)) as total_ticket_profit'),
						\DB::Raw('(SUM((line_items.sale_price - line_items.sale_cost)) / tickets.ticket_count * 100) as profit_ratio'))
					->groupBy('tickets.name')
					->orderBy('profit_ratio','DESC')
					->get();

					return $profit_per_ticket;
	}

}
