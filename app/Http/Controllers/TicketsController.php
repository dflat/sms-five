<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Ticket;
use App\Http\Requests\TicketRequest;
use Auth;



class TicketsController extends Controller {


	public function __construct(){
		$this->middleware('auth');

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tickets = Ticket::latest()->get();

		//return $tickets;  //switch these two .. just for sandbox returning tickets as json
		return view('Tickets.index',compact('tickets'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('Tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TicketRequest $request)
	{

		//validation due to type-hinted parameter $request auto triggered before method execution continues

		$ticket = new Ticket($request->all());
		//dd($ticket);
		Auth::user()->tickets()->save($ticket);

		return redirect('tickets');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = Ticket::findOrFail($id);
		$unsold_inventory = $ticket->inventory()->where('sold', 0)->get();

		return view('Tickets.show', compact('ticket', 'unsold_inventory'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ticket = Ticket::findOrFail($id);
		return view('Tickets.edit', compact('ticket'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, TicketRequest $request)
	{
		$ticket = Ticket::findOrFail($id);
		$ticket->update($request->all());
		return redirect('tickets');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$ticket = Ticket::findOrFail($id);
		$ticket->delete();
		return redirect()->back();

	}

	public function sortBy($term)
	{
		
		$tickets = Ticket::orderBy($term, 'asc')->get();

		//dd($tickets);
		return view('Tickets.index',compact('tickets'));

	}

	public function inventory($ticketId){
		$ticket = Ticket::findOrFail($ticketId);
		$inventory = $ticket->inventory()->paginate(5);//get();
		//return $inventory;
		//$ticekt = Ticket::orderBy('created_at', 'desc')->paginate(10);
		return view('Tickets.inventory',compact('inventory','ticket'));

	}

	

}
