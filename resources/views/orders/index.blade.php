@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Order Management </h1>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->id_user}}</td>
              <td></td>
              <td>

				<a href="{{route('order.edit',$order->id)}}" class="btn btn-warning">Update</a>
             
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       
      </div>
    </div>
  </div>
@endsection
