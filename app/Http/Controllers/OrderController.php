<?php
namespace App\Http\Controllers;

use Request;
use App\Order;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index()
   {
	   
	 $orders = DB::table('order')
        ->leftJoin('user', 'user.id', '=', 'order.id_customer')
        ->leftJoin('order_line', 'order_line.id_order', '=', 'order.id')
        ->leftJoin('products', 'products.id', '=', 'order_line.id_product',array('name1'=>'name'))
		->select('products.name as productName','user.name','order_line.qty','order_line.sale_price_per_unit')
        ->get();
      return view('orders.index',compact('orders'));
   }

}
