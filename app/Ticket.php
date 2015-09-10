<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use DateTime;

class Ticket extends Model {

	protected $fillable = ['name','form','serial','price','ticket_count','take_in','pay_out','qoh','reorder_point'];
	
	 public function getTakeInAttribute($value)
    {
        return money_format('$%.0n',$value);
    }
     public function setTakeInAttribute($value)
    {
        $this->attributes['take_in'] = $this->unMoney($value);
    }

     public function getPayOutAttribute($value)
    {
        return money_format('$%.0n',$value);
    }
      public function setPayOutAttribute($value)
    {
         $this->attributes['pay_out'] = $this->unMoney($value);
    }


    // public function getPriceAttribute($value)
    // {
    //     return money_format('$%.2n',$value);
    // }
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $this->unMoney($value);
    }

    //  public function getCreatedAtAttribute($value)
    // {
    //     $date = new DateTime($this->attributes['created_at']);
        
    //     $date = $date->format('m-d-Y');
        
       
    //     return $date;
    // }

    private function unMoney($str)
	{
    return preg_replace("/([^0-9\\.])/i", "", $str);
	}

    public function inventory(){

        return $this->hasMany('App\Inventory');
        
    }

     public function scopeByForm($query, $form)
    {
        return $query->select('id','price','name', 'cost')->where('form', $form);  
    }


}
