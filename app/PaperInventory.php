<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperInventory extends Model {

	protected $table = 'paper_inventory';
	protected $fillable = ['serial','permutation'];

	public function paper_products(){

		return $this->belongsTo('App\PaperProduct');
		
	}

}
