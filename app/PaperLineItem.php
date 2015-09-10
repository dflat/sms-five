<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class PaperLineItem extends Model {

	protected $fillable = ['paper_invoice_id','inventory_id', 'sale_price', 'sale_cost'];
	
	public function invoice(){

		return $this->belongsTo('App\PaperInvoice');
		
	}

	public function paper_products(){

		return $this->belongsTo('App\PaperProduct');

	}

	public function getCreatedAtAttribute($value)
    {
        $date = new DateTime($this->attributes['created_at']);
        
        $date = $date->format('M D Y');
        
       
        return $date;
    }

}
