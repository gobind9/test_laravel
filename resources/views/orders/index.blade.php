@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Customer Order</h1>
		{!! Form::open(['url' => 'order', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="form-group">
				<input type="hidden" name="id" id="id" value="{{ $id }}"/>
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
              <th>Total Cost</th>
              <th>Tax</th>
              <td>Total Order</td>
              <td>Order Date</td>
              <td>Action</td>
			  
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->name }}</td>
              <td>{{ $order->total_cost}}</td>
              <td>{{ $order->tax}}</td>
              <td>{{ $order->order_total}}</td>
              <td>{{ $order->order_date}}</td>
			  <td> 
			  
				<a href="/order/orderdetails?id={{ $order->id }}" class="btn btn-info">Show Order</a>
				
              |
			 
				<a href="/order/deleteorder?id={{ $order->id }}" class="btn btn-warning">Delete Order</a>
                 
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
