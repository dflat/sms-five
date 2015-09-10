<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StateTransactionLineItem extends Model {

	public function report(){

		return $this->belongsTo('App\StateTransactionReport');
		
	}

}
