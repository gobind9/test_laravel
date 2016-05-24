@extends('layouts/app')

@section('content')
 <h1>Assergis Products</h1>
 <a href="{{url('/products/create')}}" class="btn btn-success">Create Product</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <!--<th>Id</th>-->
         <th>Product Name</th>
         <th>Unit of Measure</th>
         <th>Price</th>
         <th>Quantity</th>       
         <th colspan="2">Actions</th>
     </tr>
     </thead>
     <tbody>
     @foreach ($products as $product)
         <tr>
             <!--<td>{{ $product->id }}</td>-->
             <td>{{ $product->name }}</td>
              <td>{{ $measure_units[$product->id_uom] }}</td>
             <td>{{ $product->price_per_unit }}</td>
             <td>{{ $product->qty_in_stock }}</td>
             
             <td>
			 <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">Update</a>
			 
			 </td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['products.destroy', $product->id]]) !!}
             {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
 {!! $products->links() !!}
@endsection