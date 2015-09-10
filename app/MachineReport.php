<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineReport extends Model {

	protected $fillable = ['machine_invoice_id','org_id'];

	public function line_items(){

        return $this->hasMany('App\MachineReportLineItem');
        
    }
}
