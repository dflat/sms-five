<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceTemplateComponent extends Model {

	protected $guarded = [];

	public function invoice_template(){

		return $this->belongsTo('App\InvoiceTemplate');
		
	}

}
