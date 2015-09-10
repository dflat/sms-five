<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\PaperProduct;
use App\Inventory;


use Illuminate\Http\Request;

class ApiInventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//\DB::enableQueryLog();
		$tickets = Ticket::with(['inventory'=>function($query){
			$query->where('sold', 0);
		}])->latest()->get();
		//dd(\DB::getQueryLog());
		return $tickets;
	}

	public function getPaper()
	{
		//\DB::enableQueryLog();
		

		$papers = PaperProduct::with(['inventory'=>function($query){
			$query->where('sold', 0);
		}])->latest()->get();
		//dd(\DB::getQueryLog());
		return $papers;
	}

	public function getMisc()
	{
		//\DB::enableQueryLog();
		
		

		$miscItems = PaperProduct::where('faces_on','=','')->with(['inventory'=>function($query){
			$query->where('sold', 0);
		}])->latest()->get();
		//dd(\DB::getQueryLog());
		return $miscItems;
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
		$ticket = Ticket::findOrFail($id);
		$inventory = $ticket->inventory;
		return $inventory;
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
