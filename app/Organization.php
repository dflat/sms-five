<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

	protected $fillable = ['name','license','address','zip','dcg','discount','start_term_112','start_term_113','start_term_222'];

	public function ticketInvoices(){

        return $this->hasMany('App\TicketInvoice');
        
    }

    public function paperInvoices(){

        return $this->hasMany('App\PaperInvoice');
        
    }


}
