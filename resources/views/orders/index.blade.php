@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Order Management </h1>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Customer Name</th>
              <th>Product</th>
              <th>Qnty</th>
              <td>Price</td>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->name }}</td>
              <td>{{ $order->productName}}</td>
              <td>{{ $order->qty}}</td>
              <td>{{ $order->qty*$order->sale_price_per_unit}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       
      </div>
    </div>
  </div>
@endsection
