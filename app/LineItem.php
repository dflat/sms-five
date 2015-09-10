<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class LineItem extends Model {

	protected $fillable = ['ticket_invoice_id','inventory_id', 'sale_price', 'sale_cost'];
	
	public function invoice(){

		return $this->belongsTo('App\TicketInvoice');
		
	}

	public function tickets(){

		return $this->belongsTo('App\Ticket');

	}

	public function getCreatedAtAttribute($value)
    {
        $date = new DateTime($this->attributes['created_at']);
        
        $date = $date->format('M D Y');
        
       
        return $date;
    }

}
