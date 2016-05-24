@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Order Management </h1>
		{!! Form::open(['url' => 'order', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="form-group">
				Product Name {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control']) !!}
				Customer {!! Form::select('customer', $customers, isset($cust) ? $cust : 0, ['class' => 'form-control']) !!}
				From <div class='input-group date'>
				<input type='text' class="form-control" data-provide="datepicker" date-date-formate="YY-MM-DD" id="from" name="from" value="{{ $fromDate }}" />
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
				</div>
				To <div class='input-group date'>
				<input type='text' class="form-control" data-provide="datepicker" date-date-formate="YY-MM-DD" id="to" name="to" value="{{ $toDate }}" />
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
				</div>
            </div>

          {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}
		{!! Form::close() !!}
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Customer Name</th>
              <th>Product</th>
              <th>Qnty</th>
              <td>Price</td>
              <td>OrderDate</td>
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
			  <td>{{ $order->order_date}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       {!! $orders->links() !!}
      </div>
    </div>
  </div>
  	<script type="text/javascript">
		$(function () {
		$('#from').datepicker({
			format:'yyyy-mm-dd'});
			$('#to').datepicker({
			format:'yyyy-mm-dd'});
		});
	</script>

@endsection
