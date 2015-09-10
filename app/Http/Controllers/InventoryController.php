<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Inventory;

use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $tickets = Ticket::with('inventory')->latest()->get();
		// return $tickets;
		return view('Inventory.index');
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$selectedTicket = null;
		$ticketsList = Ticket::lists('name','form');

		if(\Session::has('selected_ticket')){
		$selectedTicket = \Session::pull('selected_ticket');
		}

		return view('Inventory.create',compact('ticketsList', 'selectedTicket'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(InventoryRequest $request)
	{
		


		$input = $request->all();

		//from drop down in order to persist choice of ticket for mass inventory entry
		if($request['ticket_select']){
		\Session::put('selected_ticket', $request['ticket_select']);
		$input['form'] = $request['ticket_select'];
		}
		//form and serial are put in session if inventory is already in system
		//this is called to add the inventory in this special case
		if(\Session::has('form')){
			$input=[];
			$input['form'] = \Session::pull('form');
			$input['serial'] = \Session::pull('serial');
		}
		$ticket = Ticket::where('form', '=', $input['form'])->get()->first();
		$inventory = new Inventory($input);

		try{
		$ticket->inventory()->save($inventory);
		}
		catch(\Exception $e){
			return redirect()->back();
		}
		//DB::table('users')->increment('position');
		$ticket->increment('qoh');

		return redirect()->back();
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

	public function apiGet(){
		// $tickets = Ticket::with('inventory')->latest()->get();
		// return $tickets;

	}

}
