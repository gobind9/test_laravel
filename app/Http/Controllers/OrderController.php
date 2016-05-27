<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function __construct(){		
		$this->middleware('auth');
	  
	}
   public function index(Request $request)
   {
	   
		if(empty(Auth::check())){
		   return Redirect::to('/');
	   }
		$fromDate = $request->get('from');  
		$id = $request->get('id');  
		$toDate = $request->get('to'); 
	 
	 
		$orders = DB::table('order')
        ->Join('user', 'user.id', '=', 'order.id_customer')
		->where(function($query) use ($fromDate, $toDate,$id){
			
		$query->where('user.user_type', '=', '1');
		
		if($id!='' && $id>0) {
			$query->where('order.id_customer','=',$id);
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
		})
		->select('order.id as id','total_cost', 'tax','order_total','order_date','name')
		->paginate(10);
		
		
      return view('orders.index',compact('orders','toDate','fromDate','id'));
   }
   
   public function orderdetails(Request $request)
   {
		if(empty(Auth::check())){
		   return Redirect::to('/');
	   }
		$id = $request->get('id');
		$orderLists = DB::table('order')
        ->Leftjoin('order_line', 'order.id', '=', 'order_line.id_order')
        ->Leftjoin('user', 'user.id', '=', 'order.id_customer')
        ->Leftjoin('products', 'products.id', '=', 'order_line.id_product')
		->where(function($query) use ($id){
			$query->where('user.user_type', '=', '1');
			if($id!='' && $id > 0) {
				$query->where('order.id','=',$id);
			}
		})
		->select('user.name as customerName','total_cost', 'tax','order_total','order_date','products.name as productName','qty','sale_price_per_unit','id_product')
		->paginate(10);
	   return view('orders.orderdetails', compact('orderLists'));
   }
   
   
   public function deleteorder(Request $request)
   {
	 	$id = $request->get('id');
		$results = DB::table('order')
        ->Leftjoin('order_line', 'order.id', '=', 'order_line.id_order')
        ->Leftjoin('user', 'user.id', '=', 'order.id_customer')
        ->Leftjoin('products', 'products.id', '=', 'order_line.id_product')
		->where(function($query) use ($id){
			$query->where('user.user_type', '=', '1');
			if($id!='' && $id > 0) {
				$query->where('order.id','=',$id);
			}
		})
		->select('user.name as customerName','user.id as userId','total_cost', 'tax','order_total','order_date','products.name as productName','qty','sale_price_per_unit','id_product','order_line.id as OLId','order.id')->get();
	
		if(count($results)>0){
			
			foreach($results  as $result) {
				$amount  =$result->sale_price_per_unit;
				$userId  =$result->userId;
				$prod = $result->id_product;
				$prodQty = $result->qty;
				$orderId = $result->id;
				$OLId = $result->OLId;
			
				//adding amountin user credit_limit
				DB::table('user')
				->where('id', $userId)
				->update(['credit_limit' => DB::raw('credit_limit+'.(float)$amount)]);
			
		
				
				if($this->isProductExits($prod)){
					//adding product Qnty
					DB::table('products')
					->where('id', $prod)
					->update(['qty_in_stock' => DB::raw('qty_in_stock+'.(int)$prodQty)]);
					
				}
					
				if($OLId>0){	
					DB::table('order_line')->where('id', '=', $OLId)->delete();
				}
			}
			
			DB::table('order')->where('id', '=', $id)->delete();
		}
		
		$request->session()->flash('alert-success', 'Order was successful deleted!');
        return Redirect::to('order/index');
		die;
		
   }
   
   public function isProductExits($proid)
    {
		$products = DB::table('products')
		->where(function($query) use ($proid){

		$query->where('products.id', '=', $proid); 

		})
		->lists('id');
		
		if(count($products)>0){
			return true;
		}else{
			return false;
		}
    }
   
   
}
