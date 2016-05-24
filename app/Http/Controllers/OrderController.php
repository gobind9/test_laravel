<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
   public function index(Request $request)
   {
	   
	 $q = $request->get('q');  
	 $fromDate = $request->get('from');  
	 $toDate = $request->get('to'); 
	 $cust = $request->get('customer');
	 $customers = DB::table('user')->select('id', 'name')->where('user_type','=','1')->lists('name','id'); 
	 $orders = DB::table('order')
        ->leftJoin('user', 'user.id', '=', 'order.id_customer')
        ->leftJoin('order_line', 'order_line.id_order', '=', 'order.id')
        ->leftJoin('products', 'products.id', '=', 'order_line.id_product')
		->where(function($query) use ($q, $fromDate, $toDate, $cust){
			

		if($q!=''){
			$query->where('products.name', 'LIKE', '%'.$q.'%');
			
		}
		if($fromDate!='' && $toDate==''){
			$query->where('order.order_date', '>=', $fromDate);
			
		}
		if($fromDate=='' && $toDate!=''){
			$query->where('order.order_date', '<=', $toDate);
			
		}
		if($fromDate!='' && $toDate!=''){
			$query->where('order.order_date', '>=', $fromDate);
			$query->where('order.order_date', '<=', $toDate);
			
		}
		
		if($cust!=''){
			$query->where('user.id', '=', $cust);
		}
		})
		->select('products.name as productName','user.name','order_line.qty','order_line.sale_price_per_unit')
		->paginate(1);
		
		
      return view('orders.index',compact('orders','customers','q','toDate','fromDate','cust'));
   }

}
