@extends('layouts/app')

@section('content')
 <h1>Asergis Products</h1>



 <hr>
{!! Form::open(['url' => 'products/creditcheck','id'=>'orderform']) !!}

<div style="float: right; padding:0 20px 0 0">My credits: {{$credit_limit}}</div>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th></th>
         <th>Product Name</th>
         <th>Unit of Measure</th>
         <th>Price</th>
         <th>Quantity</th>   
         <th></th>       
     </tr>
     </thead>
     <tbody>
	@if(count($products)){
     @foreach ($products as $product)
         <tr>
             <td>
             {{ Form::hidden('pid[]', $product->pid, null, ['id'=>'pid_'.$product->pid]) }}
             {{ Form::hidden('orderline[]', $product->id, null, []) }}
             </td>
             <td>{{ $product->name }}</td>
             <td>{{ $product->unit_name }}</td>

             <td id="qty_{{ $product->id }}">{{ $product->price_per_unit }}</td>
             <td>{!! Form::text('qty_in_stock_'.$product->pid, $product->qty, ['class'=>'form-control', 'style'=>'width:40px;', 'id'=>$product->pid]) !!}</td> 
         	 <td>{!! Form::button('Delete', ['class' => 'btn btn-danger',
			 'onclick'=>"window.location.href='/products/deletefromcard/?id=".$product->id."'"])!!}</td>
         </tr>
     @endforeach
		<tr class="bg-info">
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Total</strong></td>
            <td id="totalamt"></td>
            <td align="right">{!! Form::button('Delete', ['class' => 'btn btn-danger','onclick'=>"window.location.href='/products/deletecart'"]) !!}</td>
            <td><div style="float: left">{!! Form::submit('Save Order', ['class' => 'btn btn-success']) !!}</div></td> 
         </tr>
     
    @else
    	<tr class="bg-info">
        	<td colspan="6" align="center">You do not have any item in your cart!!</td> 
         </tr>
         </tbody>
	@endif
 </table>
 {!! Form::close() !!}
@endsection