<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StrLineComponents extends Model {

	protected $guarded = [];

	public function str_template(){

		return $this->belongsTo('App\StateTemplate');
		
	}

}
