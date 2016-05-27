@extends('layouts/app')
@section('content')
<script>
$(document).ready(function() {
	var url = "/products/addcart"; 
	$("[id*='addcart_']").click(function(){
		var pidstr = $(this).attr('id').split('_');
		var pid = pidstr[1];	
		var _token = $('input[name=_token]').val();
		$.ajax({
			type: "POST",
			url: url,
			data: ({pid: pid,'_token': _token}),		
			success: function(response){				
					//console.log(response);
					if(response==1){
						window.location = "/products/order";
					}
					
				
			}
		});
	});
});
</script>
 <h1>Assergis Products</h1>
 <hr>
 {!! Form::open(array('method'=>'POST', 'id'=>'myform')) !!}
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
             <td>{{ $product->name }}</td>
              <td>{{ $measure_units[$product->id_uom] }}</td>
             <td>{{ $product->price_per_unit }}</td>
             <td>{{ $product->qty_in_stock }}</td>
             
             <td>
			 <a href="JavaScript:void(0);" class="btn btn-warning" id="addcart_{{ $product->id }}">Add to Cart</a>
			 
			 </td>            
         </tr>
     @endforeach

     </tbody>

 </table>
 {!! Form::close() !!}
 {!! $products->links() !!}
@endsection
