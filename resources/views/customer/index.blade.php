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
              <th>Password</th>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
            <tr>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->email}}</td>
              <td>{{ $customer->password}}</td>
              <td>          
				 {!! Form::model($customer, ['route' => ['customer.destroy', $customer], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
				<a href="{{route('customer.edit',$customer->id)}}" class="btn btn-warning">Update</a>
              |
                  {!! Form::submit('delete', ['class'=>'btn btn-info btn-danger js-submit-confirm']) !!}
                {!! Form::close()!!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $customers->links() !!}
      </div>
    </div>
  </div>
@endsection
