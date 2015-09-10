<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model {

	public function electronic_product(){ 

		return $this->belongsTo('App\ElectronicProduct');

	}

	public function getOnStrAttribute($value)
    {
        return (bool)$value;
   	}


}
