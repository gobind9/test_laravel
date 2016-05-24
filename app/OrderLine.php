<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_line';
   protected $guarded = ['_token']; 
   public $timestamps = false;
}
