<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StateTransactionReport extends Model {

	protected $guarded = [];

	public function line_items(){

        return $this->hasMany('App\StateTransactionLineItem', 'str_id');
        
    }

}
