<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PaperProduct;
use App\Http\Requests\PaperProductsRequest;

use Illuminate\Http\Request;

class PaperProductsController extends Controller {


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
		$papers = PaperProduct::latest()->get();

		//return $tickets;  //switch these two .. just for sandbox returning tickets as json
		return view('PaperProducts.index',compact('papers'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('PaperProducts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PaperProductsRequest $request)
	{
		$paper = new PaperProduct($request->all());
		$paper->save();

		return redirect('paper_products');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$paper = PaperProduct::findOrFail($id);
		return view('PaperProducts.show',compact('paper'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$paper = PaperProduct::findOrFail($id);
		return view('PaperProducts.edit', compact('paper'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PaperProductsRequest $request)
	{
		$paper = PaperProduct::findOrFail($id);
		$paper->update($request->all());
		return redirect('paper_products');
	}

	public function sortBy($term)
	{
		
		$papers = PaperProduct::orderBy($term, 'asc')->get();

		//dd($papers);
		return view('PaperProducts.index',compact('papers'));

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
