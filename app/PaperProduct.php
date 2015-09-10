<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperProduct extends Model {

	protected $fillable = ['name','form','serial','price','sheet_count','faces_on','sheets_up','qoh','reorder_point'];
	
	public function inventory(){

        return $this->hasMany('App\PaperInventory');
        
    }

    public function scopeByForm($query, $form)
    {
        return $query->select('id','price','name','cost')->where('form', $form);  
    }

}
