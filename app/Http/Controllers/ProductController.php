<?php
namespace App\Http\Controllers;

use Request;

use App\Product;
use App\Order;
use App\User;
use App\OrderLine;
use App\MeasureUnit;

use Auth;

use App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use View;

use Session;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index()
   {
       $products = Product::paginate(10);     
	   $measure_units = MeasureUnit::lists('name', 'id');
	   $measure_units = $measure_units->toArray();
	   return view('products.index',compact(['products', 'measure_units']));
   }
   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {     
	 $measure_units = MeasureUnit::lists('name', 'id');
	 $measure_units = $measure_units->toArray();	
	 return view('products.create',compact('measure_units'));
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store(Request $request)
   {
       
	   // validation rule      
			$rules = array(
				'name'       => 'required',
				'id_uom'      => 'required',
				'price_per_unit' => 'required|numeric',
				'qty_in_stock' => 'required|numeric'
			);
			 $validator = Validator::make($request::all(), $rules);
			if ($validator->fails())
			{
				return Redirect::to('products/create')
					->withErrors($validator);
			}else{
				$products = Request::all();	 
				Product::create($products);
				Session::flash('alert-success', 'Product added successfully!');
				return Redirect::to('products');
			}
   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
  public function edit($id)
	{
	   $products = Product::findOrFail($id);
	   $measure_units = MeasureUnit::lists('name', 'id');
	   $measure_units = $measure_units->toArray();
	   return view('products.edit',compact(['products', 'measure_units']));
	   
	}
   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update(Request $request, $id)
   {
      $productUpdate = $request::all();
	  $product = Product::find($id);
      $rules = array(
				'name'       => 'required',
				'id_uom'      => 'required',
				'price_per_unit' => 'required|numeric',
				'qty_in_stock' => 'required|numeric'
			);
	  $validator = Validator::make($request::all(), $rules);
	  
	  //$this->validate($request, $rules);
		if ($validator->fails())
		{	
			return Redirect::to('products/'.$id.'/edit')
					->withErrors($validator);
		}else{
			$product->update($productUpdate);
			Session::flash('alert-success', 'Product updated successfully!');
			return Redirect::to('products');
		}
		
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
      Product::find($id)->delete();
	  Session::flash('alert-success', 'Product deleted successfully!');
	  return Redirect::to('products');
   }
   

   public function order(){
		
	   $products = Product::paginate(10); 
	   $measure_units = MeasureUnit::lists('name', 'id');
	   $measure_units = $measure_units->toArray();
	   return view('products.order',compact(['products', 'measure_units']));
   }

   /**
    * ajax request to get credit info
    */
	public function creditcheck(Request $request){
		$products = Request::all();	
		
		
		$available = 1;
		$amt=1;
		
		$sum_amt= 0;
		$sum_qty = 0;
		$id_user = Auth::user()->id;
		$tax = 0;
		
		
		
		if(count($products) > 0 && isset($products['pid'])){
			
			$userArr	= User::find($id_user)->toArray();
			$amount	= $userArr['credit_limit'];
			
			foreach($products['pid'] as $val){
				$productArr	= Product::find($val)->toArray();
		
				if($products['qty_in_stock_'.$val] > $productArr['qty_in_stock']){
					$available=0;
					Session::flash('alert-warning', 'Quantity not available');
					break;
				}else{
					$sum_amt = $sum_amt + ($products['qty_in_stock_'.$val] * $productArr['price_per_unit']);
					$sum_qty = $sum_qty + $products['qty_in_stock_'.$val];
				}
			}
				
			if($sum_amt > $amount){
				$amt=0;	
				Session::flash('alert-warning', 'Insufficient amount');
				return Redirect::to('products/order');
			}
			
			if($sum_qty == 0){
				Session::flash('alert-warning', 'Quantity cannot be null.');
				return Redirect::to('products/order');
			}
			
			//insert into order table
			$order_total = $tax + $sum_amt;		
			$orders = array('id_user'=>$id_user,'id_customer'=>$id_user,'total_cost'=>$sum_amt,'tax'=>$tax,'order_total'=>$order_total);
			
			$orderData= Order::create($orders);
			$id_order = $orderData->id;
			//INSERT into order_line table
			if($amt ==1 && $available == 1){
				foreach($products['pid'] as $val){
					$productArr	= Product::find($val)->toArray();
					$order_line = array(
					'id_order'=>$id_order,
					'id_product'=>$val,
					'qty'=>$products['qty_in_stock_'.$val],
					'sale_price_per_unit'=>$productArr['price_per_unit']
					);
					OrderLine::create($order_line);
					//reduce quantity from product table
					$qty_in_stock = $productArr['qty_in_stock'] - $products['qty_in_stock_'.$val];
					
					$products_update = array('qty_in_stock'=>$qty_in_stock);
					$product = Product::find($val);
					$product->update($products_update);
				}
				Session::flash('alert-success', 'Order has been done successfully!');
			}
		}else{
			Session::flash('alert-warning', 'Invalid request');
		}	
		
		return Redirect::to('products/order');
		
		
   	}

}
