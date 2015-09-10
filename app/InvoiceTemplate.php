<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceTemplate extends Model {

	protected $guarded = [];

	public function components(){

        return $this->hasMany('App\InvoiceTemplateComponent');
        
    }

}
