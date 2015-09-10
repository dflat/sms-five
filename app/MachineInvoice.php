<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineInvoice extends Model {

	protected $guarded = [];
	
	public function lines(){

        return $this->hasMany('App\MachineInvoiceLineItem');
        
    }

}
