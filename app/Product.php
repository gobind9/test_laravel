<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
	public $timestamps = false;
	//protected $fillable = ['_token'];
	protected $guarded = ['_token'];
}
