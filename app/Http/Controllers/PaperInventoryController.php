<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;
use App\PaperProduct;
use App\PaperInventory;

class PaperInventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('PaperInventory.index');
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
	public function store(InventoryRequest $request)
	{
		


		$input = $request->all();

		// //from drop down in order to persist choice of ticket for mass inventory entry
		// if($request['ticket_select']){
		// \Session::put('selected_ticket', $request['ticket_select']);
		// $input['form'] = $request['ticket_select'];
		// }
		// //form and serial are put in session if inventory is already in system
		// //this is called to add the inventory in this special case
		// if(\Session::has('form')){
		// 	$input=[];
		// 	$input['form'] = \Session::pull('form');
		// 	$input['serial'] = \Session::pull('serial');
		// }
		$paper = PaperProduct::where('form', '=', $input['form'])->get()->first();
		$inventory = new PaperInventory($input);

		try{
		$paper->inventory()->save($inventory);
		}
		catch(\Exception $e){
			return redirect()->back();
		}
		//DB::table('users')->increment('position');
		$paper->increment('qoh');

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

}
