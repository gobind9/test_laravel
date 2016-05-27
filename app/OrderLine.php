<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
	protected $table 	= 'order_line';
	protected $guarded 	= ['_token']; 
	public $timestamps 	= false;
	
	public function getCart($userId){		
		$results= \DB::table('order_line as order_line')
                ->join('products as p', function($join) {
                    $join->on('p.id', '=', 'order_line.id_product');
                })
                ->join('measure_units as mu', function($join) {
                    $join->on('mu.id', '=', 'p.id_uom');
                })
                ->where(['id_customer'=>$userId,'id_order'=>0])
                ->select(['order_line.id','order_line.id_customer','order_line.id_order','order_line.id_product','qty',
                'sale_price_per_unit','mu.name as unit_name','p.id as pid','p.name','p.price_per_unit'])
                ->get();
         return  $results;      
	}
}
