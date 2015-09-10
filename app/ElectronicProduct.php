<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectronicProduct extends Model {

	protected $guarded = [];
	public function sub_products(){

		return $this->hasMany('App\SubProduct');

	}

	public function getOnStrAttribute($value)
    {
        return (bool)$value;
   	}

}
