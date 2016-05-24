<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


   protected $table = 'order';
   protected $guarded = ['_token']; 
   public $timestamps = false;

 
  public function user()
    {
        return $this->belongsTo('App/User');
    }
	


}
