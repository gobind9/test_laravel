@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Show Order Details </h1>

        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Customer Name</th>
              <th>Product Name</th>
              <th>Qty</th>
              <td>Price Per Unit</td>
              <td>Total Amount</td>
              <td>Order Date</td>
             
			  
            </tr>
          </thead>
          <tbody>
            @foreach($orderLists as $orderList)
            <tr>
              <td>{{ $orderList->customerName }}</td>
              <td>{{ $orderList->productName}}</td>
              <td>{{ $orderList->qty}}</td>
              <td>{{ $orderList->sale_price_per_unit}}</td>
			  <td>{{ $orderList->sale_price_per_unit * $orderList->qty}}</td>
              <td>{{ $orderList->order_date}}</td>
			 
            </tr>
            @endforeach
          </tbody>
        </table>
 
      </div>
    </div>
  </div>
@endsection
