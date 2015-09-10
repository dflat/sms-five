<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StateTemplate extends Model {

	protected $guarded = [];

	public function components(){

        return $this->hasMany('App\StrLineComponents');
        
    }

}
