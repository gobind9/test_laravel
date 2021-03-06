<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use View;
use App\User;
use App\Order;
use Auth;
use DB;


class CustomerController extends Controller
{

	public function __construct(){		
		$this->middleware('auth');
	  
	}
	public function index(Request $request)
   {
	   if(empty(Auth::check())){
		   return Redirect::to('/');
	   }
		$fromDate = $request->get('from');  
		$toDate = $request->get('to'); 
		// $customers = DB::table('user')->select('id', 'name','email','city','credit_limit')->where('user_type','=','1')->lists('name','id'); 
		$datas = DB::table('user')
		->leftJoin('order', 'user.id', '=', 'order.id_customer')
		->where(function($query) use ($fromDate, $toDate){
			
		$query->where('user.user_type', '=', '1');
			

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
		->groupBy('user.id')
		->select('user.name','user.email','user.city','user.credit_limit', 'user.id',DB::raw('count(order.id) as totalOrder'),DB::raw('sum(order_total) as totalAmount'))
		->paginate(10);
	
		
		return view('customer.index',compact('datas'));
   }
   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
	  if(empty(Auth::check())){
		   return Redirect::to('/');
	   }
     return View::make('customer.create');
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store(Request $request)
    {
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email|unique:user,email',
			'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'country' => 'required',
			 'credit_limit' => array('required', 'regex:/^\d*(\.\d{2})?$/')
			
        );
		$msg = array('integer'=>"Only number value are allowed.");
        $validator = Validator::make($request->all(), $rules,$msg);

        // process the login
        if ($validator->fails())
		{
            return Redirect::to('customer/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
		else
		{
            // store
            $user = new User;
            $user->name       	= $request->get('name');
            $user->email      	= $request->get('email');
            $user->password   	= bcrypt($request->get('password'));
            $user->address1   	= $request->get('address1');
            $user->address2   	= $request->get('address2');
            $user->city   	 	= $request->get('city');
            $user->country   	= $request->get('country');
            $user->credit_limit = $request->get('credit_limit');
            $user->user_type   	= 1;
            $user->save();

            // redirect
            //Session::flash('message', 'Successfully created nerd!');
			$request->session()->flash('alert-success', 'Customer was successful added!');
            return Redirect::to('customer/index');
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
	   if(empty(Auth::check())){
		   return Redirect::to('/');
	   }
       $user = User::findOrFail($id);
       return view('customer.edit', compact('user'));
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update(Request $request,$id)
   {
		$user = User::findOrFail($id);
		$rules = array(
            'name'       => 'required',
            'email'      => 'required|email|unique:user,email,'.$user->id,
            'password' => 'required',
			'address1' => 'required',
            'city' => 'required',
            'country' => 'required',
            'credit_limit' => array('required', 'regex:/^\d*(\.\d{2})?$/')
        );
		
		
		$this->validate($request, $rules);
		
        $user->update($request->all());
        //\Flash::success('User updated successfully.');
		$request->session()->flash('alert-success', 'Customer was updated successfully.');
        return redirect()->route('customer.index');
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy(Request $request,$id)
   {
		User::find($id)->delete();
		$request->session()->flash('alert-success', 'Customer was deleted successfully.');
        return redirect()->route('customer.index');
   }
}
