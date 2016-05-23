<?php
namespace App\Http\Controllers;

use Request;
use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index()
   {
      $orders = Order::leftJoin('customer', function($join) {
      $join->on('order.customer_id', '=', 'customer.id')->all();
    });
	echo "<pre>";
	print_r($orders);
	die;
      return view('orders.index',compact('orders'));
   }

}
