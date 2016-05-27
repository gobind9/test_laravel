@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Customer Management </h1>
		<a href="{{ route('customer.create') }}" class="btn btn-success">Add Customer</a>
      
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Name</th>
              <th>Email</th>
              <th>City</th>
              <th>Number of orders</th>
              <th>Total Ordered Amount</th>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
		  
            @foreach($datas as $data)
            <tr>
				<td>{{ $data->name }}</td>
				<td>{{ $data->email }}</td>
				<td>{{ $data->city }}</td>
				<td>{{ $data->totalOrder }}</td>
				<td>{{ (float)$data->totalAmount }}</td>
             
              <td>          
				 {!! Form::model($data, ['route' => ['customer.destroy', $datas ], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
				<a href="{{route('order.index','id='.$data->id)}}" class="btn btn-warning">List Orders</a>
				<a href="{{route('customer.edit',$data->id)}}" class="btn btn-warning">Update</a>
				|
                  {!! Form::submit('delete', ['class'=>'btn btn-info btn-danger js-submit-confirm']) !!}
                {!! Form::close()!!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
		{!! $datas->links() !!}
      </div>
    </div>
  </div>
@endsection
