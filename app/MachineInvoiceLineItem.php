<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineInvoiceLineItem extends Model {

	public function invoice(){

		return $this->belongsTo('App\MachineInvoice');
		
	}

}
