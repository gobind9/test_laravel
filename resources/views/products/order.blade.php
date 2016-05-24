@extends('layouts/app')

@section('content')
 <h1>Assergis Products</h1>



 <hr>
 {!! Form::open(['url' => 'products/creditcheck','id'=>'orderform']) !!}
   {!! Form::submit('create Order', ['class' => 'btn btn-success']) !!}
   
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
        <th></th>
         <th>Product Name</th>
         <th>Unit of Measure</th>
         <th>Price</th>
         <th>Quantity</th>      
        
     </tr>
     </thead>
     <tbody>

     @foreach ($products as $product)
         <tr>
            <td> {{ Form::checkbox('pid[]', $product->id, null, ['id'=>'pid_'.$product->id]) }}</td>
             <td>{{ $product->name }}</td>
             <td>{{ $measure_units[$product->id_uom] }}</td>
             <td id="qty_{{ $product->id }}">{{ $product->price_per_unit }}</td>
             <td>{!! Form::text('qty_in_stock_'.$product->id,1,['class'=>'form-control','id'=>$product->id]) !!}</td> 
         </tr>
     @endforeach
		<tr class="bg-info">
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Total</strong></td>
            <td id="totalamt"></td>
            <td>&nbsp;</td> 
         </tr>
     </tbody>

 </table>
 {!! Form::close() !!}
@endsection