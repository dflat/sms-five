<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Inventory extends Model {

	protected $table = 'inventory';
	protected $fillable = ['serial'];

	// public function getCreatedAtAttribute($value)
 //    {
 //        $date = new DateTime($this->attributes['created_at']);
        
 //        $date = $date->format('m-d-Y');
        
       
 //        return $date;
 //    }

	public function tickets(){

		return $this->belongsTo('App\Ticket');
		
	}

}
