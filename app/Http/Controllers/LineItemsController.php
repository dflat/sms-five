<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Ticket;
use App\LineItem;
use Illuminate\Http\Request;
use App\Http\Requests\LineItemRequest;

class LineItemsController extends Controller {

	protected $form;
	protected $serial;
	protected $invoice_no;

	public function __construct(LineItemRequest $request)
	{
		$this->form = $request->input('form');
		$this->serial = $request->input('serial');
		$this->invoice_no = $request->input('invoice_no');
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
		return view('LineItems.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		try {

			$ticket = $this->findTicketByFormNumber();

			$inventory = Inventory::select('id','sold')
										->where('serial', $this->serial)
										->where('ticket_id', $ticket->id)
										->first();
		

		} catch (\Exception $e) {
			
			\Session::flash('invalid_form', $this->form);
			
			return redirect()->back();
		}

		//dont add new line item if item has already been sold
		if($inventory && $inventory->sold)
		{
			\Session::flash('already_sold', 'Serial: ' . $this->serial . ' ( ' .$ticket->name.' ) already sold.');
			return redirect()->back();
		}

		
		
		//catch if item is not in inventory
		try {
			$invoice_line = new LineItem;

			$invoice_line->ticket_invoice_id = $this->invoice_no;
			$invoice_line->inventory_id = $inventory->id;
			$invoice_line->sale_price = $ticket->price;
			$invoice_line->sale_cost = $ticket->cost;


			$invoice_line->save();
			
		} catch (\Exception $e) {
			\Session::put('invoice_no', $this->invoice_no);
			\Session::put('form', $this->form);
			\Session::put('serial', $this->serial);
			\Session::put('ticket_name', $ticket->name);
			
			\Session::flash('not_in_inventory','Inventory Not In System: ' . $this->serial . ' ( '. $ticket->name . ' )');
			
			return redirect()->back();
			
		}

		// //check if inventory is already sold
		// if($inventory->sold)
		// {
		// 	\Session::flash('already_sold', 'Serial: ' . $serial . 'already sold.');
		// 	return redirect()->back();
		// }
		
		//if no exceptions were thrown flash success 
		\Session::flash('action_successful','Sold: ' . $this->serial . ' ( '. $ticket->name . ' )');
		
		return redirect()->back();//route('invoice.tickets.edit', $invoice_no); //use flash redirect with errors eventually
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
	public function destroy()
	{
		try {

			$ticket = $this->findTicketByFormNumber();

			$inventory = Inventory::select('id','sold')
										->where('serial', $this->serial)
										->where('ticket_id', $ticket->id)
										->first();
		

		} catch (\Exception $e) {
			
			\Session::flash('invalid_form', $this->form);
			
			return redirect()->back();
		}
	

		if($inventory == null)
		{

			\Session::flash('not_in_inventory','Inventory Not In System: ' . $this->serial . ' ( '. $ticket->name . ' )');
			return redirect()->back();
		}
		if(!$inventory->sold)
		{
			\Session::flash('not_in_inventory','Inventory Not Yet Sold: ' . $this->serial . ' ( '. $ticket->name . ' )');
			return redirect()->back();
		}

		if($inventory && $inventory->sold)
		{
			
			$item = LineItem::where('inventory_id', $inventory->id)
						->where('ticket_invoice_id', $this->invoice_no)
						->first();

			if($item){

			$item->delete();

			\Session::flash('action_successful','Returned: ' . $this->serial . ' ( '. $ticket->name . ' )');
			return redirect()->back();

			}

			else{

			\Session::flash('wrong_invoice','Item sold on different invoice: ' . $this->serial . ' ( '. $ticket->name . ' )');
			return redirect()->back();
			}
			

		}

	}

	private function findTicketByFormNumber()
	{
		return Ticket::byForm($this->form)->first();
	}

}
