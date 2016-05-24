@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Product</div>
                <div class="panel-body">					
					 {!! Form::model($products,['method' => 'PATCH','route'=>['products.update',$products->id]]) !!}
					
					
					
					
					 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('Product Name', 'Product Name:*') !!}
                           
                               {!! Form::text('name',null,['class'=>'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>Product name is required.</strong>
                                    </span>
                                @endif
                           
                        </div>
					
					
					
					<div class="form-group">
						{!! Form::label('Unit of Measure', 'Unit of Measure:*') !!}
						{!! Form::select('id_uom', $measure_units, null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group{{ $errors->has('price_per_unit') ? ' has-error' : '' }}">
							  {!! Form::label('Price', 'Price:*') !!}
                           
                               {!! Form::text('price_per_unit',null,['class'=>'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>Price is required.</strong>
                                    </span>
                                @endif
                           
                        </div>
						
						<div class="form-group{{ $errors->has('qty_in_stock') ? ' has-error' : '' }}">
							 {!! Form::label('Quantity', 'Quantity:*') !!}
                           
                             {!! Form::text('qty_in_stock',null,['class'=>'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>Quantity is required.</strong>
                                    </span>
                                @endif
                           
                        </div>		  
					<div class="form-group">
						 {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
					</div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection