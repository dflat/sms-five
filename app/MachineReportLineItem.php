<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineReportLineItem extends Model {

	public function report(){

		return $this->belongsTo('App\MachineReport');
		
	}

}
