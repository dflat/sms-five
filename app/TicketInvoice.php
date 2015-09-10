<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketInvoice extends Model {

	protected $fillable = ['org_id', 'total', 'sale_date'];

	public function line_items(){

        return $this->hasMany('App\LineItem');
        
    }

    public function organization(){

    	return $this->belongsTo('App\Organization');
    }

}
