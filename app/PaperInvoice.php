<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperInvoice extends Model {

	protected $fillable = ['org_id', 'total', 'sale_date'];

	public function line_items(){

        return $this->hasMany('App\PaperLineItem');
        
    }

    public function organization(){

    	return $this->belongsTo('App\Organization');
    }

}
